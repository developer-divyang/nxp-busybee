@extends('layouts.load')

@section('content')
            <div class="content-area">
              <div class="add-product-content1">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="product-description">
                      <div class="body-area">
                        @include('alerts.admin.form-error')  
                        <form id="geniusformdata" action="{{route('admin.model.create')}}" method="POST" enctype="multipart/form-data">
                          {{csrf_field()}}


                          <div class="row">
                            <div class="col-lg-4">
                              <div class="left-area">
                                  <h4 class="heading">{{ __('Model Number') }} *</h4>
                              </div>
                            </div>
                            <div class="col-lg-7">
                              <input type="text" class="input-field" name="model_number" placeholder="{{ __('Model Number') }}" required="" value="">
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-lg-4">
                              <div class="left-area">
                                
                              </div>
                            </div>
                            <div class="col-lg-7">
                              <button class="addProductSubmit-btn" type="submit">{{ __('Save') }}</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

@endsection