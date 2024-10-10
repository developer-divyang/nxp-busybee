@extends('layouts.admin')
@section('styles')

<link href="{{asset('assets/admin/css/product.css')}}" rel="stylesheet" />
<link href="{{asset('assets/admin/css/jquery.Jcrop.css')}}" rel="stylesheet" />
<link href="{{asset('assets/admin/css/Jcrop-style.css')}}" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet">




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


		<div class="card mb-3">
			<div class="card-header">
				<strong>{{ __('General setup') }}</strong>
			</div>
			<div class="card-body">
				<div class="row p-3">
					<div class="col-md-6">
						<div class="form-group">
							<label for="productPrice">{{ __('Product Name') }}</label>
							<input type="text" class="form-control" readonly class="input-field" placeholder="" id="product_name" name="name" required="">
							<input type="hidden" value="1" name="language_id">
							<input type="hidden" name="type" value="Physical">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="productDiscount">{{ __('Product Sku') }}</label>
							<input type="text" class="input-field" placeholder="{{ __('Enter Product Sku') }}" name="sku" required="" value="{{ Str::random(3).substr(time(), 6,8).Str::random(3) }}">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="productDiscount">{{ __('Select Category') }}</label>
							<select id="cat" class="form-control" name="category_id" required="">
								<option value="">{{ __('Select Category') }}</option>
								@foreach($cats as $cat)
								<option value="{{ $cat->id }}">{{$cat->name}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="productDiscount">{{ __('Select Fit') }}</label>
							<select name="fit" class="form-control" id="fit" required>
								<option value="stretch">{{ __('Stretch Fit') }}</option>
								<option value="adjustable">{{ __('Adjustable') }}</option>
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="productDiscount">{{ __('Select Style') }}</label>
							<select name="style" class="form-control" id="style" required>
								<option value="structured">{{ __('Structured (Hard Front)') }}</option>
								<option value="unstructured">{{ __('Unstructured(Floppy Front)') }}</option>
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="productDiscount">{{ __('Select Bill') }}</label>
							<select name="bill" class="form-control" id="bill" required>
								<option value="curved">{{ __('Curved') }}</option>
								<option value="flat">{{ __('Flat') }}</option>
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="productDiscount">{{ __('Select Profile') }}</label>
							<select name="profile" class="form-control" id="profile" required>
								<option value="high">{{ __('High Profile') }}</option>
								<option value="mid">{{ __('Mid Profile') }}</option>
								<option value="low">{{ __('Low Profile') }}</option>
								<option value="pro">{{ __('Pro Style') }}</option>
							</select>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="productDiscount">{{ __('Cap Closure') }}</label>
							<select name="closure" class="form-control" id="closure" required>
								<option value="snapback">{{ __('Snapback') }}</option>
								<option value="buckle">{{ __('Buckle') }}</option>
								<option value="velcro">{{ __('Velcro') }}</option>
								<option value="n/a">{{ __('N/A') }}</option>
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label for="productDiscount">{{ __('Panel') }}</label>
							<select name="panel" class="form-control" id="panel" required>
								<option value="5">{{ __('5 Panel') }}</option>
								<option value="6">{{ __('6 Panel') }}</option>
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label for="productDiscount">{{ __('Model Number') }}</label>
							<select name="model_number" id="model_number" class="select2 form-control" required style="width: 100%;">

								@foreach (App\Models\ModelNumber::all() as $model)
								<option value="{{$model->id}}">{{$model->model_number}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label for="productDiscount">{{ __('Brand') }}</label>
							<select name="brand_id" id="brand_id" class="select2 form-control" required style="width: 100%;">

								@foreach (App\Models\Brand::all() as $brand)
								<option value="{{$brand->id}}">{{$brand->brand}}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="card mb-3">
			<div class="card-header ">
				<strong>{{ __('Pricing & Others') }}</strong>
			</div>
			<div class="card-body">
				<div class="row p-3">
					<div class="col-md-6">
						<div class="form-group">
							<label class="text-center" for="productPrice">{{ __('Product Price Range') }}</label>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="productPrice">{{ __('Minimum Price') }}</label>
									<input type="number" class="form-control" placeholder="{{ __('Enter Minimum Price') }}" name="min_price" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="productPrice">{{ __('Maximum Price') }}</label>
									<input type="number" class="form-control" placeholder="{{ __('Enter Maximum Price') }}" name="max_price" required="">
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="text-center" for="productPrice">{{ __('Others') }}</label>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="productPrice">{{ __('Blank Price') }}</label>
									<input name="blank_price" type="number" class="input-field" placeholder="{{ __('e.g 20') }}">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="productPrice">{{ __('Weight') }}</label>
									<input name="weight" type="number" class="input-field" placeholder="{{ __('e.g 20') }}">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="productPrice">{{ __('Shipping Cost') }}</label>
									<input name="shipping_cost" type="number" class="input-field" placeholder="{{ __('e.g 20') }}">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="card mb-3">
			<div class="card-header">
				<strong>{{ __('Product variation setup') }}</strong>
			</div>
			<div class="card-body">
				<div class="row p-3 social-links-area">
					<div class="col-lg-12 d-flex justify-content-between">
						<label class="control-label">{{ __('Allow Product Colors') }} *</label>
						<label class="switch">
							<input type="checkbox" data-type="color" class="checkclickc" name="color_check" id="check3" value="1">
							<span class="slider round"></span>
						</label>
					</div>


					<div class="showbox color-selector">
						<div id="color-section">
							<div class="row">

								<div class="col-md-3">
									<div class="form-group">

										<label for="color_group">Color Group</label>
										<input type="text" name="color_group[]" id="color_group_0" class="form-control " required>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">

										<label for="color_name">Color Name</label>
										<input type="text" name="color_name[]" id="color_name_0" class="form-control tcolor color_value" required>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">

										<div id="preview_0" class="image-preview text-center"></div>
										<label for="color_img">Color Image</label>
										<input type="file" name="color_img[]" id="color_img_0" data-id="0" class="form-control" accept="image/*" required>

									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<div id="product_preview_0" class="image-preview"></div>

										<label for="product_images">Product Images</label>
										<input type="file" name="product_images[0][]" data-id="0" id="product_images_0" class="form-control" accept="image/*" multiple required>


									</div>
								</div>
							</div>
						</div>
						<a href="javascript:;" id="color-btn" class="add-more mt-4 mb-3"><i class="fas fa-plus"></i>{{ __('Add More Color') }} </a>

					</div>

					<div class="col-lg-12 d-flex justify-content-between">
						<label class="control-label">{{ __('Allow Product Size') }} *</label>
						<label class="switch">
							<input type="checkbox" data-type="size" class="checkclickc" name="size_check" id="tcheck" value="1">
							<span class="slider round"></span>
						</label>
					</div>


					<div class="showbox size-selector col-md-12">
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group">

									<label for="color_name">Size</label>
									<div class="select-input-tsize" id="tsize-section">
										<div class="tsize-area">
											<div class="col-lg-12">
												<ul id="tags" class="myTags">
												</ul>
											</div>

										</div>
									</div>
								</div>

							</div>

							<div class="col-md-12 mt-2 mb-2">
								<div class="form-group sku_combination" id="sku_combination" ></div>
							</div>

						</div>

					</div>
				</div>

			</div>
		</div>

		<div class="card mb-3">
			<div class="card-header ">
				<strong>{{ __('Details') }}</strong>
			</div>
			<div class="card-body">
				<div class="row p-3">
					<div class="col-md-6">
						<div class="form-group">
							<label for="productPrice">{{ __('Product Description') }}</label>
							<textarea name="details" class="form-control nic-edit-p" id="details" rows="5" ></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="productPrice">{{ __('Meta Description') }}</label>
							<textarea name="meta_description" class="form-control input-field" id="meta_description" rows="5" ></textarea>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row text-center ">
			<div class="col-6 offset-3 ">
				<button class="addProductSubmit-btn btn btn-primary" type="submit">{{ __('Create Product') }}</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.min.js"></script>

<script type="text/javascript">
	(function($) {
		"use strict";

		// Gallery Section Insert


		//check value of fit for disable cap closure
		if ($('#fit').val() === 'stretch') {
			$('#closure').prop('disabled', true);
		}

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


		$('#fit').change(function() {
			if ($(this).val() === 'stretch') {
				$('#closure').prop('disabled', true);
			} else {
				$('#closure').prop('disabled', false);
			}
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