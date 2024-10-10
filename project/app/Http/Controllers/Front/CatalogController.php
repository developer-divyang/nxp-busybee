<?php

namespace App\Http\Controllers\Front;

use App\{
  Models\Product,
  Models\Category,
  Models\Subcategory,
  Models\Childcategory,
  Models\Report
};
use App\Models\ProductColor;
use App\Models\ProductColorImage;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CatalogController extends FrontBaseController
{

  // CATEGORIES SECTOPN

  public function categories()
  {

    return view('frontend.products');
  }

  // -------------------------------- CATEGORY SECTION ----------------------------------------

  public function category(Request $request, $slug = null, $slug1 = null, $slug2 = null, $slug3 = null)
  {

    // dd($request->all());
    if ($request->view_check) {
      session::put('view', $request->view_check);
    }

    //   dd(session::get('view'));

    $cat = null;
    $subcat = null;
    $childcat = null;
    $flash = null;
    $minprice = $request->min;
    $maxprice = $request->max;
    $sort = $request->sort;
    $search = $request->search;
    $pageby = $request->pageby;
    $minprice = ($minprice / $this->curr->value);
    $maxprice = ($maxprice / $this->curr->value);
    $type = $request->has('type') ?? '';


    if (!empty($slug)) {
      $cat = Category::where('slug', $slug)->firstOrFail();
      $data['cat'] = $cat;
    }

    if (!empty($slug1)) {
      $subcat = Subcategory::where('slug', $slug1)->firstOrFail();
      $data['subcat'] = $subcat;
    }
    if (!empty($slug2)) {
      $childcat = Childcategory::where('slug', $slug2)->firstOrFail();
      $data['childcat'] = $childcat;
    }

    $data['latest_products'] = Product::with('user')->whereStatus(1)->whereLatest(1)
      ->home($this->language->id)
      ->get()
      ->reject(function ($item) {
        if ($item->user_id != 0) {
          if ($item->user->is_vendor != 2) {
            return true;
          }
        }
        return false;
      });


    $prods = Product::when($cat, function ($query, $cat) {
      return $query->where('category_id', $cat->id);
    })
      ->when($subcat, function ($query, $subcat) {
        return $query->where('subcategory_id', $subcat->id);
      })
      ->when($type, function ($query, $type) {
        return $query->with('user')->whereStatus(1)->whereIsDiscount(1)
          ->where('discount_date', '>=', date('Y-m-d'))
          ->whereHas('user', function ($user) {
            $user->where('is_vendor', 2);
          });
      })
      ->when($childcat, function ($query, $childcat) {
        return $query->where('childcategory_id', $childcat->id);
      })
      ->when($search, function ($query, $search) {
        return $query->where('name', 'like', '%' . $search . '%')->orWhere('name', 'like', $search . '%');
      })
      ->when($minprice, function ($query, $minprice) {
        return $query->where('price', '>=', $minprice);
      })
      ->when($maxprice, function ($query, $maxprice) {
        return $query->where('price', '<=', $maxprice);
      })
      ->when($sort, function ($query, $sort) {
        if ($sort == 'date_desc') {
          return $query->latest('id');
        } elseif ($sort == 'date_asc') {
          return $query->oldest('id');
        } elseif ($sort == 'price_desc') {
          return $query->latest('price');
        } elseif ($sort == 'price_asc') {
          return $query->oldest('price');
        }
      })
      ->when(empty($sort), function ($query, $sort) {
        return $query->latest('id');
      });

    $prods = $prods->where(function ($query) use ($cat, $subcat, $childcat, $type, $request) {
      $flag = 0;
      if (!empty($cat)) {
        foreach ($cat->attributes as $key => $attribute) {
          $inname = $attribute->input_name;
          $chFilters = $request["$inname"];

          if (!empty($chFilters)) {
            $flag = 1;
            foreach ($chFilters as $key => $chFilter) {
              if ($key == 0) {
                $query->where('attributes', 'like', '%' . '"' . $chFilter . '"' . '%');
              } else {
                $query->orWhere('attributes', 'like', '%' . '"' . $chFilter . '"' . '%');
              }
            }
          }
        }
      }


      if (!empty($subcat)) {
        foreach ($subcat->attributes as $attribute) {
          $inname = $attribute->input_name;
          $chFilters = $request["$inname"];

          if (!empty($chFilters)) {
            $flag = 1;
            foreach ($chFilters as $key => $chFilter) {
              if ($key == 0 && $flag == 0) {
                $query->where('attributes', 'like', '%' . '"' . $chFilter . '"' . '%');
              } else {
                $query->orWhere('attributes', 'like', '%' . '"' . $chFilter . '"' . '%');
              }
            }
          }
        }
      }

      if (!empty($childcat)) {
        foreach ($childcat->attributes as $attribute) {
          $inname = $attribute->input_name;
          $chFilters = $request["$inname"];

          if (!empty($chFilters)) {
            $flag = 1;
            foreach ($chFilters as $key => $chFilter) {
              if ($key == 0 && $flag == 0) {
                $query->where('attributes', 'like', '%' . '"' . $chFilter . '"' . '%');
              } else {
                $query->orWhere('attributes', 'like', '%' . '"' . $chFilter . '"' . '%');
              }
            }
          }
        }
      }
    });

    $prods = $prods->where('language_id', $this->language->id)->where('status', 1)->get()
      ->reject(function ($item) {

        if ($item->user_id != 0) {
          if ($item->user->is_vendor != 2) {
            return true;
          }
        }

        if (isset($_GET['max'])) {
          if ($item->vendorSizePrice() >= $_GET['max']) {
            return true;
          }
        }
        return false;
      })->map(function ($item) {

        $item->price = $item->price;
        return $item;
      })->paginate(isset($pageby) ? $pageby : $this->gs->page_count);
    $data['prods'] = $prods;
    //    dd($data['prods']);
    if ($request->ajax()) {
      $data['ajax_check'] = 1;
      return view('frontend.ajax.filtered-products', $data);
    }

    return view('frontend.products', $data);
  }


  public function getsubs(Request $request)
  {
    $category = Category::where('slug', $request->category)->firstOrFail();
    $subcategories = Subcategory::where('category_id', $category->id)->get();
    return $subcategories;
  }

  //getColorImages
  public function getColorImages(Request $request)
  {
    $colorId = $request->input('color_id');
    $productId = $request->input('product_id');

    // Fetch the color images based on color ID and product ID
    $colorImages = ProductColorImage::where('color_id', $colorId)
      ->where('product_id', $productId)
      ->first();
      
      if ($colorImages) {
      // $imgs = json_decode($colorImages->image_path);
      // dd($imgs);
      $imageUrls = [];
      //colorImages->image_path is json_endoded array of image paths
      foreach (json_decode($colorImages->image_path) as $colorImage) {
        $imageUrls[] = Storage::url($colorImage);
      }

      return response()->json(['success' => true, 'images' => $imageUrls]);
    } else {
      return response()->json(['success' => false, 'message' => 'No images found for the selected color']);
    }
  }

  public function filterProducts(Request $request)
  {

    // dd($request->all());
    // dd($request->filters['profile']);

    $products = Product::where('status', 1);
    if ($request->input('profile')) {
      $products->whereIn('profile', $request->input('profile'));
    }
    if ($request->input('color')) {
      //selected colors array link with which product only that product will be shown ProductSizeColor model
      $products->whereIn('id', function ($query) use ($request) {
        $query->select('product_id')->from('product_size_colors')->whereIn('color_id', $request->input('color'));
      });
    }



    if ($request->input('fit')) {
      $products->whereIn('fit', $request->input('fit'));
    }
    if ($request->input('bill')) {
      $products->whereIn('bill', $request->input('bill'));
    }
    if ($request->input('size')) {
      // dd($request->input('size'));
      //like query for size array of size
      $products->whereIn('id', function ($query) use ($request) {
        $query->select('product_id')->from('product_size_colors')->whereIn('size_id', $request->input('size'));
      });
    }
    if ($request->input('brand')) {
      $products->whereIn('brand_id', $request->input('brand'));
    }

    if ($request->input('model_number')) {
      $products->whereIn('model_number', $request->input('model_number'));
    }
    if ($request->input('closure')) {
      $products->whereIn('closure', $request->input('closure'));
    }
    if ($request->input('name')) {
      // dd($request->input('name'));
      //like query for name array of name
      $products->where(function ($query) use ($request) {
        foreach ($request->input('name') as $name) {
          // dd($name);
          $query->orWhere('name', 'like', '%' . $name . '%');
        }
      });
    }

    if ($request->input('min_price') && $request->input('max_price')) {
      $products->where(function ($query) use ($request) {
        $query->whereBetween('min_price', [$request->input('min_price'), $request->input('max_price')])
        ->orWhereBetween('max_price', [$request->input('min_price'), $request->input('max_price')]);
      });
    }


    if ($request->input('sort') == 'low_to_high') {
      $products->orderBy('min_price', 'asc');
    } elseif ($request->input('sort') == 'high_to_low') {
      $products->orderBy('max_price', 'desc');
    }

    $products = $products->paginate(9);
    // dd($products);



    $prods = $products;
    $html =  view('frontend.ajax.filtered-products', compact('prods'))->render();
    if ($products->isNotEmpty()) {
      return response()->json([
        'data' => 'Data Found',
        'success' => true,
        'pagination' => (string) $products->links(),
        'message' => 'Products found for the selected option',
        'html' => $html
      ]);
    } else {
      return response()->json([
        'data' => 'No data found',
        'success' => false,
        'message' => 'No Products found for the selected option',
        'html' => $html
      ]);
    }
  }


  public function searchProduct(Request $request)
  {
    $query = Product::query();

    if ($request->filled('fit')) {
      $query->where('fit', $request->fit);
    }

    if ($request->filled('bill')) {
      $query->where('bill', $request->bill);
    }

    if ($request->filled('size')) {
      $productIds = Size::where('id', $request->size)->pluck('product_id');
      $query->whereIn('id', $productIds);
    }

    if ($request->filled('color')) {
      $productIds = ProductColor::where('id', $request->color)->pluck('product_id');
      $query->whereIn('id', $productIds);
    }

    $prods = $query->get();
    $input = $request->all();



    return view('frontend.search-results', compact('prods', 'input'));
  }

  public function report(Request $request)
  {

    //--- Validation Section
    $rules = [
      'note' => 'max:400',
    ];
    $customs = [
      'note.max' => 'Note Must Be Less Than 400 Characters.',
    ];
    $validator = Validator::make($request->all(), $rules, $customs);
    if ($validator->fails()) {
      return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
    }
    //--- Validation Section Ends

    //--- Logic Section
    $data = new Report;
    $input = $request->all();
    $data->fill($input)->save();
    //--- Logic Section Ends

    //--- Redirect Section
    $msg = 'New Data Added Successfully.';
    return response()->json($msg);
    //--- Redirect Section Ends

  }
}
