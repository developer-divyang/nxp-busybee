@extends('layouts.admin')
@section('styles')

<link href="{{asset('assets/admin/css/product.css')}}" rel="stylesheet" />
<link href="{{asset('assets/admin/css/jquery.Jcrop.css')}}" rel="stylesheet" />
<link href="{{asset('assets/admin/css/Jcrop-style.css')}}" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />


@endsection
@section('content')

<div class="content-area">
	<div class="mr-breadcrumb">
		<div class="row">
			<div class="col-lg-12">
				<h4 class="heading">{{ __('Product') }} <a class="add-btn" href="{{ route('admin-prod-types') }}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h4>
				<ul class="links">
					<li>
						<a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
					</li>
					<li>
						<a href="javascript:;">{{ __('Products') }} </a>
					</li>
					<li>
						<a href="{{ route('admin-prod-index') }}">{{ __('All Products') }}</a>
					</li>
					<li>
						<a href="{{ route('admin-prod-types') }}">{{ __('Add Product') }}</a>
					</li>

				</ul>
			</div>
		</div>
	</div>
	<form id="geniusform" action="{{route('admin-prod-store')}}" method="POST" enctype="multipart/form-data">
		{{csrf_field()}}
		@include('alerts.admin.form-both')
		<div class="row">
			<div class="col-lg-12">
				<div class="add-product-content">
					<div class="row">
						<div class="col-lg-12">
							<div class="product-description">
								<div class="body-area">
									<div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>

									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Product Name') }}* </h4>

											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" readonly class="input-field" placeholder="" id="product_name" name="name" required="">
											<input type="hidden" value="1" name="language_id">
										</div>
									</div>

									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Product Sku') }}* </h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ __('Enter Product Sku') }}" name="sku" required="" value="{{ Str::random(3).substr(time(), 6,8).Str::random(3) }}">
										</div>
									</div>




									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Category') }}*</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<select id="cat" name="category_id" required="">
												<option value="">{{ __('Select Category') }}</option>
												@foreach($cats as $cat)
												<option data-href="{{ route('admin-subcat-load',$cat->id) }}" value="{{ $cat->id }}">{{$cat->name}}</option>
												@endforeach
											</select>
										</div>
									</div>



									<div class="row fit">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Fit') }}* </h4>
											</div>
										</div>
										<div class="col-lg-12">
											<select name="fit" id="fit" required>
												<option value="stretch">{{ __('Stretch Fit') }}</option>
												<option value="adjustable">{{ __('Adjustable') }}</option>
											</select>
										</div>
									</div>

									<div class="row style">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Select Style') }}* </h4>
											</div>
										</div>
										<div class="col-lg-12">
											<select name="style" id="style" required>
												<option value="structured">{{ __('Structured (Hard Front)') }}</option>
												<option value="unstructured">{{ __('Unstructured(Floppy Front)') }}</option>
											</select>
										</div>
									</div>

									<div class="row bill">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Bill Type') }}* </h4>
											</div>
										</div>
										<div class="col-lg-12">
											<select name="bill" id="bill" required>
												<option value="curved">{{ __('Curved') }}</option>
												<option value="flat">{{ __('Flat') }}</option>
											</select>
										</div>
									</div>


									<div class="row closure">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Cap Closure') }}* </h4>
											</div>
										</div>
										<div class="col-lg-12">
											<select name="closure" id="closure" required>
												<option value="snapback">{{ __('Snapback') }}</option>
												<option value="n/a">{{ __('N/A') }}</option>
												<option value="buckle">{{ __('Buckle') }}</option>
												<option value="velcro">{{ __('Velcro') }}</option>
											</select>
										</div>

									</div>

									
									<div class="row profile">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Cap Profile') }}* </h4>
											</div>
										</div>
										<div class="col-lg-12">
											<select name="profile" id="profile" required>
												<option value="high">{{ __('High Profile') }}</option>
												<option value="mid">{{ __('Mid Profile') }}</option>
												<option value="low">{{ __('Low Profile') }}</option>
												<option value="pro">{{ __('Pro Style') }}</option>
											</select>
										</div>
									</div>


									<div class="row panel">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Panel ') }}* </h4>
											</div>
										</div>
										<div class="col-lg-12">
											<select name="panel" id="panel" required>
												<option value="5">{{ __('5 Panel') }}</option>
												<option value="6">{{ __('6 Panel') }}</option>
											</select>
										</div>
									</div>


									<div class="row model">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Model Number') }}* </h4>
											</div>
										</div>
										<div class="col-lg-12">
											<select name="model_number" id="model_number" class="select2" required style="width: 100%;">

												@foreach (App\Models\ModelNumber::all() as $model)
												<option value="{{$model->id}}">{{$model->model_number}}</option>
												@endforeach
											</select>
										</div>
									</div>


									<div class="row brand">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Brand') }}* </h4>
											</div>
										</div>
										<div class="col-lg-12">
											<select name="brand_id" id="brand_id" class="select2" required style="width: 100%;">

												@foreach (App\Models\Brand::all() as $brand)
												<option value="{{$brand->id}}">{{$brand->brand}}</option>
												@endforeach
											</select>
										</div>
									</div>


									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Fabric') }}* </h4>

											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ __('Enter Fabric') }}" name="fabric">
										</div>
									</div>


									
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Price Range') }}* </h4>
											</div>
										</div>
										<div class="col-lg-6">
											<input type="number" class="input-field" placeholder="{{ __('Enter Minimum Price') }}" name="min_price" required="">
										</div>
										<div class="col-lg-6">
											<input type="number" class="input-field" placeholder="{{ __('Enter Maximum Price') }}" name="max_price" required="">
										</div>
									</div>




									<div id="catAttributes"></div>
									<div id="subcatAttributes"></div>
									<div id="childcatAttributes"></div>



									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">

											</div>
										</div>
										<div class="col-lg-12">
											<ul class="list">
												<li>
													<input class="checkclick1" name="product_condition_check" type="checkbox" id="product_condition_check" value="1">
													<label for="product_condition_check">{{ __('Allow Product Condition') }}</label>
												</li>
											</ul>
										</div>
									</div>

									<div class="showbox">
										<div class="row">
											<div class="col-lg-12">
												<div class="left-area">
													<h4 class="heading">{{ __('Product Condition') }}*</h4>
												</div>
											</div>
											<div class="col-lg-12">
												<select name="product_condition">
													<option value="2">{{ __('New') }}</option>
													<option value="1">{{ __('Used') }}</option>
												</select>
											</div>
										</div>
									</div>


									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">

											</div>
										</div>
										<div class="col-lg-12">
											<ul class="list">
												<li>
													<input class="checkclick1" name="preordered_check" type="checkbox" id="preorderedCheck" value="1">
													<label for="preorderedCheck">{{ __('Allow Product Preorder') }}</label>
												</li>
											</ul>
										</div>
									</div>


									<div class="showbox">
										<div class="row">
											<div class="col-lg-12">
												<div class="left-area">
													<h4 class="heading">{{ __('Product Preorder') }}*</h4>
												</div>
											</div>
											<div class="col-lg-12">
												<select name="preordered">
													<option value="1">{{ __('Sale') }}</option>
													<option value="2">{{ __('Preordered') }}</option>
												</select>
											</div>
										</div>
									</div>


									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">

											</div>
										</div>
										<div class="col-lg-12">
											<ul class="list">
												<li>
													<input class="checkclick1" name="minimum_qty_check" type="checkbox" id="check111" value="1">
													<label for="check111">{{ __('Allow Minimum Order Qty') }}</label>
												</li>
											</ul>
										</div>
									</div>


									<div class="showbox">
										<div class="row">
											<div class="col-lg-12">
												<div class="left-area">
													<h4 class="heading">{{ __('Product Minimum Order Qty') }}* </h4>
												</div>
											</div>
											<div class="col-lg-12">
												<input type="number" class="input-field" min="1"
													placeholder="{{ __('Minimum Order Qty') }}" name="minimum_qty">
											</div>
										</div>

									</div>


									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">

											</div>
										</div>
										<div class="col-lg-12">
											<ul class="list">
												<li>
													<input class="checkclick1" name="shipping_time_check" type="checkbox" id="check1" value="1">
													<label for="check1">{{ __('Allow Estimated Shipping Time') }}</label>
												</li>
											</ul>
										</div>
									</div>



									<div class="showbox">
										<div class="row">
											<div class="col-lg-12">
												<div class="left-area">
													<h4 class="heading">{{ __('Product Estimated Shipping Time') }}* </h4>
												</div>
											</div>
											<div class="col-lg-12">
												<input type="text" class="input-field" placeholder="{{ __('Estimated Shipping Time') }}" name="ship">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">

											</div>
										</div>
										<div class="col-lg-12">
											<ul class="list">
												<li>
													<input class="checkclickc" name="color_check" type="checkbox" id="check3" value="1">
													<label for="check3">{{ __('Allow Product Colors') }}</label>
												</li>
											</ul>
										</div>
									</div>

									<div class="showbox">
										<div id="color-section">
											<div class="row">

												<div class="col-md-4">
													<div class="form-group">

														<label for="color_name">Color Name</label>
														<input type="text" name="color_name[]" id="color_name" class="form-control tcolor" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">

														<label for="color_img">Color Image</label>
														<input type="file" name="color_img[]" id="color_img" class="form-control" accept="image/*" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">

														<label for="product_images">Product Images</label>
														<input type="file" name="product_images[0][]" id="product_images" class="form-control" accept="image/*" multiple required>


													</div>
												</div>
											</div>
										</div>
										<a href="javascript:;" id="color-btn" class="add-more mt-4 mb-3"><i class="fas fa-plus"></i>{{ __('Add More Color') }} </a>

									</div>

									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">

											</div>
										</div>
										<div class="col-lg-12">
											<ul class="list">
												<li>
													<input class="checkclickst" name="size_check" type="checkbox" id="tcheck" value="1">
													<label for="tcheck">{{ __('Allow Product Sizes') }}</label>
												</li>
											</ul>
										</div>
									</div>

									<div class="showbox">
										<div class="row">
											<div class="col-lg-4">
												<div class="left-area">
													<h4 class="heading">
														{{ __('Product Size') }}*
													</h4>
													<p class="sub-heading">
														{{ __('(eg. S,M,L,XL,XXL,3XL,4XL)') }}
													</p>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="select-input-tsize" id="tsize-section">
													<div class="tsize-area">
														<span class="remove tsize-remove"><i class="fas fa-times"></i></span>
														<input type="text" name="size_all[]" class="input-field tsize" placeholder="{{ __('Enter Product Size') }}">

													</div>
												</div>
												<a href="javascript:;" id="tsize-btn" class="add-more mt-4 mb-3"><i class="fas fa-plus"></i>{{ __('Add More Size') }} </a>
											</div>
										</div>

									</div>

									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">

											</div>
										</div>
										<div class="col-lg-12">
											<ul class="list">
												<li>
													<input class="checkclick1" name="whole_check" type="checkbox" id="whole_check" value="1">
													<label for="whole_check">{{ __('Allow Product Whole Sell') }}</label>
												</li>
											</ul>
										</div>
									</div>

									<div class="showbox">
										<div class="row">
											<div class="col-lg-12">
												<div class="left-area">

												</div>
											</div>
											<div class="col-lg-12">
												<div class="featured-keyword-area">
													<div class="feature-tag-top-filds" id="whole-section">
														<div class="feature-area">
															<span class="remove whole-remove"><i class="fas fa-times"></i></span>
															<div class="row">
																<div class="col-lg-6">
																	<input type="number" name="whole_sell_qty[]" class="input-field" placeholder="{{ __('Enter Quantity') }}" min="0">
																</div>

																<div class="col-lg-6">
																	<input type="number" name="whole_sell_discount[]" class="input-field" placeholder="{{ __('Enter Price') }}" min="0" />
																</div>
															</div>
														</div>
													</div>

													<a href="javascript:;" id="whole-btn" class="add-fild-btn"><i class="icofont-plus"></i> {{ __('Add More Field') }}</a>
												</div>
											</div>
										</div>
									</div>


									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">

											</div>
										</div>
										<div class="col-lg-12">
											<ul class="list">
												<li>
													<input class="checkclick1" name="measure_check" type="checkbox" id="measure_check" value="1">
													<label for="measure_check">{{ __('Allow Product Measurement') }}</label>
												</li>
											</ul>
										</div>
									</div>


									<div class="showbox">
										<div class="row">
											<div class="col-lg-6">
												<div class="left-area">
													<h4 class="heading">{{ __('Product Measurement') }}*</h4>
												</div>
											</div>
											<div class="col-lg-12">
												<select id="product_measure">
													<option value="">{{ __('None') }}</option>
													<option value="Gram">{{ __('Gram') }}</option>
													<option value="Kilogram">{{ __('Kilogram') }}</option>
													<option value="Litre">{{ __('Litre') }}</option>
													<option value="Pound">{{ __('Pound') }}</option>
													<option value="Custom">{{ __('Custom') }}</option>
												</select>
											</div>
											{{-- <div class="col-lg-1"></div> --}}
											<div class="col-lg-12 hidden" id="measure">
												<input name="measure" type="text" id="measurement" class="input-field" placeholder="{{ __('Enter Unit') }}">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">

											</div>
										</div>
										
									</div>


									<div class="showbox" id="size-display">
										<div class="row">
											<div class="col-lg-12">
											</div>
											<div class="col-lg-12">
												<div class="product-size-details" id="size-section">
													<div class="size-area">
														<span class="remove size-remove"><i class="fas fa-times"></i></span>
														<div class="row">
															<div class="col-md-6 col-sm-6">
																<label>
																	{{ __('Size Name') }} :
																	<span>
																		{{ __('(eg. S,M,L,XL,3XL,4XL)') }}
																	</span>
																</label>
																<select name="size[]"  class="input-field size-name"></select>
															</div>


															<div class="col-md-6 col-sm-6">
																<label>
																	{{ __('Size Color') }} :
																	<span>
																		{{ __('(Select color of this size)') }}
																	</span>
																</label>
																<select name="color[]" class="input-field color-name"></select>
															</div>



														</div>
													</div>
												</div>

												<a href="javascript:;" id="size-btn" class="add-more"><i class="fas fa-plus"></i>{{ __('Add More') }} </a>
											</div>
										</div>
									</div>

									<div class="row" id="default_stock">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Product Stock') }}*</h4>
												<p class="sub-heading">{{ __('(Leave Empty will Show Always Available)') }}</p>
											</div>
										</div>
										<div class="col-lg-12">
											<input name="stock" type="number" class="input-field" placeholder="e.g 20" value="" min="0">
										</div>
									</div>

									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">
													{{ __('Product Description') }}*
												</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="text-editor">
												<textarea class="nic-edit-p" name="details"></textarea>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">
													{{ __('Product Buy/Return Policy') }}*
												</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="text-editor">
												<textarea class="nic-edit-p" name="policy"></textarea>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-12">
											<div class="checkbox-wrapper">
												<input type="checkbox" name="seo_check" value="1" class="checkclick" id="allowProductSEO" value="1">
												<label for="allowProductSEO">{{ __('Allow Product SEO') }}</label>
											</div>
										</div>
									</div>



									<div class="showbox">
										<div class="row">
											<div class="col-lg-12">
												<div class="left-area">
													<h4 class="heading">{{ __('Meta Tags') }} *</h4>
												</div>
											</div>
											<div class="col-lg-12">
												<ul id="metatags" class="myTags">
												</ul>
											</div>
										</div>

										<div class="row">
											<div class="col-lg-12">
												<div class="left-area">
													<h4 class="heading">
														{{ __('Meta Description') }} *
													</h4>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="text-editor">
													<textarea name="meta_description" class="input-field" placeholder="{{ __('Meta Description') }}"></textarea>
												</div>
											</div>
										</div>
									</div>

									<input type="hidden" name="type" value="Physical">

								</div>
							</div>
						</div>
					</div>
					<div class="add-product-content">
						<div class="row">
							<div class="col-lg-12">
								<div class="product-description">
									<div class="body-area">



										<div class="row">
											<div class="col-lg-12">
												<div class="left-area">
													<h4 class="heading">
														{{ __('Product Blank Price') }}*
													</h4>
													<p class="sub-heading">
														({{ __('In') }} {{$sign->name}})
													</p>
												</div>
											</div>
											<div class="col-lg-12">
												<input name="blank_price" type="number" class="input-field" placeholder="{{ __('e.g 20') }}" >
											</div>
										</div>

										<div class="row">
											<div class="col-lg-12">
												<div class="left-area">
													<h4 class="heading">{{ __('Product Weight') }}*</h4>

												</div>
											</div>
											<div class="col-lg-12">
												<input name="weight"  type="number" class="input-field" placeholder="{{ __('e.g 20') }}">
											</div>
										</div>

										<div class="row">
											<div class="col-lg-12">
												<div class="left-area">
													<h4 class="heading">{{ __('Youtube Video URL') }}*</h4>
													<p class="sub-heading">{{ __('(Optional)') }}</p>
												</div>
											</div>
											<div class="col-lg-12">
												<input name="youtube" type="text" class="input-field" placeholder="{{ __('Enter Youtube Video URL') }}">
											</div>
										</div>

										<div class="row">
											<div class="col-lg-12">
												<div class="left-area">

												</div>
											</div>
											<div class="col-lg-12">
												<div class="featured-keyword-area">
													<div class="heading-area">
														<h4 class="title">{{ __('Feature Tags') }}</h4>
													</div>

													<div class="feature-tag-top-filds" id="feature-section">
														<div class="feature-area">
															<span class="remove feature-remove"><i class="fas fa-times"></i></span>
															<div class="row">
																<div class="col-lg-6">
																	<input type="text" name="features[]" class="input-field" placeholder="{{ __('Enter Your Keyword') }}">
																</div>

																<div class="col-lg-6">
																	<div class="input-group colorpicker-component cp">
																		<input type="text" name="colors[]" value="#000000" class="input-field cp" />
																		<span class="input-group-addon"><i></i></span>
																	</div>
																</div>
															</div>
														</div>
													</div>

													<a href="javascript:;" id="feature-btn" class="add-fild-btn"><i class="icofont-plus"></i> {{ __('Add More Field') }}</a>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-lg-12">
												<div class="left-area">
													<h4 class="heading">{{ __('Tags') }} *</h4>
												</div>
											</div>
											<div class="col-lg-12">
												<ul id="tags" class="myTags">
												</ul>
											</div>
										</div>

										<div class="row text-center">
											<div class="col-6 offset-3">
												<button class="addProductSubmit-btn" type="submit">{{ __('Create Product') }}</button>
											</div>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>

		</div>
	</form>
</div>

<div class="modal fade" id="setgallery" tabindex="-1" role="dialog" aria-labelledby="setgallery" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">{{ __('Image Gallery') }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="top-area">
					<div class="row">
						<div class="col-sm-6 text-right">
							<div class="upload-img-btn">
								<label for="image-upload" id="prod_gallery"><i class="icofont-upload-alt"></i>{{ __('Upload File') }}</label>
							</div>
						</div>
						<div class="col-sm-6">
							<a href="javascript:;" class="upload-done" data-dismiss="modal"> <i class="fas fa-check"></i> {{ __('Done') }}</a>
						</div>
						<div class="col-sm-12 text-center">( <small>{{ __('You can upload multiple Images.') }}</small> )</div>
					</div>
				</div>
				<div class="gallery-images">
					<div class="selected-image">
						<div class="row">


						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')

<script src="{{asset('assets/admin/js/jquery.Jcrop.js')}}"></script>
<script src="{{asset('assets/admin/js/jquery.SimpleCropper.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script type="text/javascript">
	(function($) {
		"use strict";

		// Gallery Section Insert

		$(document).on('click', '.remove-img', function() {
			var id = $(this).find('input[type=hidden]').val();
			$('#galval' + id).remove();
			$(this).parent().parent().remove();
		});

		$(document).on('click', '#prod_gallery', function() {
			$('#uploadgallery').click();
			$('.selected-image .row').html('');
			$('#geniusform').find('.removegal').val(0);
		});


		$("#uploadgallery").change(function() {
			var total_file = document.getElementById("uploadgallery").files.length;
			for (var i = 0; i < total_file; i++) {
				$('.selected-image .row').append('<div class="col-sm-6">' +
					'<div class="img gallery-img">' +
					'<span class="remove-img"><i class="fas fa-times"></i>' +
					'<input type="hidden" value="' + i + '">' +
					'</span>' +
					'<a href="' + URL.createObjectURL(event.target.files[i]) + '" target="_blank">' +
					'<img src="' + URL.createObjectURL(event.target.files[i]) + '" alt="gallery image">' +
					'</a>' +
					'</div>' +
					'</div> '
				);
				$('#geniusform').append('<input type="hidden" name="galval[]" id="galval' + i + '" class="removegal" value="' + i + '">')
			}

		});

		// Gallery Section Insert Ends

	})(jQuery);
</script>

<script type="text/javascript">
	(function($) {
		"use strict";

		$('.cropme').simpleCropper();

	})(jQuery);


	$(document).on('click', '#size-check', function() {
		if ($(this).is(':checked')) {
			$('#default_stock').addClass('d-none')
		} else {
			$('#default_stock').removeClass('d-none');
		}
	})
</script>


@include('partials.admin.product.product-scripts')
@endsection