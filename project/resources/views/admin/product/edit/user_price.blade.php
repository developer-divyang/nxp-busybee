@extends('layouts.admin')
@section('styles')

<link href="{{asset('assets/admin/css/product.css')}}" rel="stylesheet" />
<link href="{{asset('assets/admin/css/jquery.Jcrop.css')}}" rel="stylesheet" />
<link href="{{asset('assets/admin/css/Jcrop-style.css')}}" rel="stylesheet" />

@endsection
@section('content')

<div class="content-area">
    <div class="mr-breadcrumb">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="heading"> {{ __('Check User Price') }}<a class="add-btn" href="{{ url()->previous() }}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h4>
                <ul class="links">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                    </li>
                    <li>
                        <a href="{{ route('admin-prod-index') }}">{{ __('Products') }} </a>
                    </li>
                    <li>
                        <a href="javascript:;">{{ __('Check User Price') }}</a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    <form id="geniusform" action="{{route('admin-prod-constant-update',$data->id)}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        @include('alerts.admin.form-both')
        <div class="row">
            <div class="col-lg-12">
                <div class="add-product-content">
                    <div class="product-description">
                        <div class="body-area">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="product-description">
                                        <div class="heading-area">
                                            <h4 class="title">
                                                {{ __('Check User Price') }}
                                            </h4>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-2">
                                    <label for="size">{{ __('Garment') }} </label>
                                    <select id="product_id" class="form-control" name="product_id" required="">
                                        <option value="">{{ __('Select Product') }}</option>
                                        @foreach($products as $product)
                                        <option {{ ($product->id == $id)? 'selected':'' }} value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-2">
                                    <label for="size">{{ __('Color') }} </label>
                                    <select id="color" name="color" class="form-control" required="">
                                        <option value="">{{ __('Select Color') }}</option>
                                        @if($id > 0)
                                        @foreach (App\Models\Color::groupBy('color_group')->get() as $k => $color)
                                        <option value="{{ $color->id}}">{{ $color->color_group }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="col-lg-2">
                                    <label for="size">{{ __('Blank Price') }} </label>
                                    <input type="text" class="form-control" id="d3" value="{{ ($id)?$data->blank_price : 0 }}" name="d3" value="" readonly>
                                </div>


                                <div class="col-lg-2">
                                    <label for="size">{{ __('Weight') }} </label>
                                    <input type="text" class="form-control" id="e3" value="{{ ($id)?$data->weight : 0 }}" name="e3" value="" readonly>
                                </div>


                                <div class="col-lg-2">
                                    <label for="size">{{ __('Quantity') }} </label>
                                    <input type="number" class="form-control" id="f3" value="1" name="f3" value="">
                                </div>


                                <div class="col-lg-2">
                                    <label for="g3">{{ __('Embroidery Type') }} </label>
                                    <select id="g3" name="g3" class="form-control" required="">
                                        <option selected value="regular">Regular</option>
                                        <option value="3D">3D</option>
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <label for="g5">{{ __('Artwork Setup(Dropdown)') }} </label>
                                    <select id="g5" name="g5" class="form-control" required="">
                                        <option selected value="standard">Standard</option>
                                        <option value="premium">Premium</option>
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <label for="h3">{{ __('Front Embroidery') }} </label>
                                    <select id="h3" name="h3" class="form-control" required="">

                                        <option selected value="front-center">Front Center</option>
                                        <option value="front-left">Front Left Panel</option>
                                        <option value="front-right">Front Right Panel</option>
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <label for="size">{{ __('Side Embroidery') }} </label>
                                    <select id="i3" name="i3" class="form-control" required="">

                                        <option value="yes">Yes</option>
                                        <option selected value="no">No</option>
                                    </select>
                                </div>

                                <div class="col-lg-2">
                                    <label for="size">{{ __('Side Embroidery Locations') }} </label>
                                    <select id="j3" name="j3" class="form-control" required="">
                                        <option value="">{{ __('Select Side Embroidery Locations') }}</option>
                                        <option value="right">Right</option>
                                        <option value="left">Left</option>
                                        <option value="both">Both</option>
                                        <option value="na">NA (No side embroidery)</option>
                                    </select>
                                </div>

                                <div class="col-lg-2">
                                    <label for="size">{{ __('Back Embroidery') }} </label>
                                    <select id="k3" name="k3" class="form-control" required="">

                                        <option value="yes">Yes</option>
                                        <option selected value="no">No</option>
                                    </select>
                                </div>

                                <div class="col-lg-2">
                                    <label for="size">{{ __('Back Embroidery Locations') }} </label>
                                    <select id="l3" name="l3" class="form-control" required="">
                                        <option value="">{{ __('Select Back Embroidery Locations') }}</option>
                                        <option value="center">Center</option>
                                        <option value="left">Left</option>
                                        <option value="right">Right</option>
                                        <option value="na">NA (No back embroidery)</option>
                                    </select>
                                </div>


                                <div class="col-lg-2">
                                    <label for="size">{{ __('Inventory On Hand') }} </label>
                                    <select readonly id="m3" name="m3" class="form-control" required="">

                                        <option selected value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>


                                <div class="col-lg-2">
                                    <label for="size">{{ __('Shipping From Supplier') }} </label>
                                    <input type="text" class="form-control" id="n3" name="n3" value="" readonly>
                                </div>

                                <div class="col-lg-2">
                                    <label for="size">{{ __('Artwork Setup') }} </label>
                                    <input type="text" class="form-control" id="o3" name="o3" value="" readonly>
                                </div>

                                <div class="col-lg-2">
                                    <label for="size">{{ __('Designer Labor') }} </label>
                                    <input type="text" class="form-control" id="p3" name="p3" value="" readonly>
                                </div>

                                <div class="col-lg-2">
                                    <label for="size">{{ __('Digitizing') }} </label>
                                    <input type="text" class="form-control" id="q3" name="q3" value="" readonly>
                                </div>

                                <div class="col-lg-2">
                                    <label for="size">{{ __('Materials') }} </label>
                                    <input type="text" class="form-control" id="r3" name="r3" value="" readonly>
                                </div>
                                <div class="col-lg-2">
                                    <label for="size">{{ __('Electricity') }} </label>
                                    <input type="text" class="form-control" id="s3" name="s3" value="" readonly>
                                </div>

                                <div class="col-lg-2">
                                    <label for="size">{{ __('Stitch Test (Minutes)') }} </label>
                                    <input type="text" class="form-control" id="t3" name="t3" value="" readonly>
                                </div>

                                <div class="col-lg-2">
                                    <label for="size">{{ __('Hooping Time ') }} </label>
                                    <input type="text" class="form-control" id="u3" name="u3" value="" readonly>
                                </div>


                                <div class="col-lg-2">
                                    <label for="size">{{ __('Set Up Time (Minutes)') }} </label>
                                    <input type="text" class="form-control" id="v3" name="v3" value="" readonly>
                                </div>


                                <div class="col-lg-2">
                                    <label for="size">{{ __('RunTime (Minutes)') }} </label>
                                    <input type="text" class="form-control" id="w3" name="w3" value="" readonly>
                                </div>


                                <div class="col-lg-2">
                                    <label for="size">{{ __('DownTime (Minutes)') }} </label>
                                    <input type="text" class="form-control" id="x3" name="x3" value="" readonly>
                                </div>


                                <div class="col-lg-2">
                                    <label for="size">{{ __('QA/QCTime (Minutes)') }} </label>
                                    <input type="text" class="form-control" id="y3" name="y3" value="" readonly>
                                </div>


                                <div class="col-lg-2">
                                    <label for="size">{{ __('Total Embroidery Production ') }} </label>
                                    <input type="text" class="form-control" id="z3" name="z3" value="" readonly>
                                </div>
                                <div class="col-lg-2">
                                    <label for="size">{{ __('Embroidery Labor') }} </label>
                                    <input type="text" class="form-control" id="aa3" name="aa3" value="" readonly>
                                </div>

                                <div class="col-lg-2">
                                    <label for="size">{{ __('Shipping and Handling') }} </label>
                                    <select id="ab3" name="ab3" class="form-control" required="">
                                        <option value="yes">Yes</option>
                                        <option selected value="no">No (Local)</option>
                                    </select>

                                </div>


                                <div class="col-lg-2">
                                    <label for="size">{{ __('Cost Per Cap (Only Embroidery)') }} </label>
                                    <input type="text" class="form-control" id="ac3" name="ac3" value="" readonly>
                                </div>

                                <div class="col-lg-2">
                                    <label for="size">{{ __('Cost Per Order (Only Artwork)') }} </label>
                                    <input type="text" class="form-control" id="ad3" name="ad3" value="" readonly>
                                </div>


                                <div class="col-lg-2">
                                    <label for="size">{{ __('Total Cost') }} </label>
                                    <input type="text" class="form-control" id="ae3" name="ae3" value="" readonly>
                                </div>


                                <div class="col-lg-2">
                                    <label for="size">{{ __('Profit per order (Embroidery Only)') }} </label>
                                    <input type="text" class="form-control" id="af3" name="af3" value="" readonly>
                                </div>

                                <div class="col-lg-2">
                                    <label for="size">{{ __('Cost+Profit (Artwork and Embroidery)') }} </label>
                                    <input type="text" class="form-control" id="ag3" name="ag3" value="" readonly>
                                </div>


                                <div class="col-lg-2">
                                    <label for="size">{{ __('Order Profit') }} </label>
                                    <input type="text" class="form-control" id="ah3" name="ah3" value="" readonly>
                                </div>

                                <div class="col-lg-2">
                                    <label for="size">{{ __('Sale Price Per Cap(Including Artwork)') }} </label>
                                    <input type="text" class="form-control" id="ai3" name="ai3" value="" readonly>
                                </div>


                                <div class="col-lg-2">
                                    <label for="size">{{ __('Shipping and Handling Cost') }} </label>
                                    <input type="text" class="form-control" id="aj3" name="aj3" value="" readonly>
                                </div>


                                <div class="col-lg-2">
                                    <label for="size">{{ __('Tax') }} </label>
                                    <input type="text" class="form-control" id="ak3" name="ak3" value="" readonly>
                                </div>


                                <div class="col-lg-12 text-center">
                                    <div class="col-lg-12">
                                        <h3 class="bg-success text-light p-3">
                                            Customer Total : $<span id="al3">0</span>
                                        </h3>
                                    </div>
                                </div>





















                            </div>

                        </div>
                    </div>


                </div>
            </div>
    </form>
</div>


@endsection

@section('scripts')
@php
$const = $data->constant;
@endphp
<script type="text/javascript">
    //set all table imput only nmber can input 
    var constant = @php echo $const;
    @endphp;
    $(document).ready(function() {



        constantCalculation();

        $('input[type="text"]').on('input', function() {
            this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
        });
    });


    function getvalue(id) {
        return parseFloat($('#' + id).val());
    }

    //foreachInputFieldSetVariable
    function foreachInputFieldSetVariable() {
        //get all input field value
        //foreach input field set variable using id
        $('input[type="text"]').each(function() {
            var id = $(this).attr('id');
            window[id] = getvalue(id);
        });

        //number field value
        $('input[type="number"]').each(function() {
            var id = $(this).attr('id');
            window[id] = getvalue(id);
        });

        //select field value
        $('select').each(function() {
            var id = $(this).attr('id');
            window[id] = $(this).val();
        });
    }

    //set claculation fro customer total
    function constantCalculation() {
        foreachInputFieldSetVariable();

        //n3 = =IF(M3="Yes",0,IF(M3="No",10))
        n3 = (m3 == 'yes') ? 0 : 10;
        $('#n3').val(n3);

        //here bseries value in cosntant like constant.b11 to constant.b163


        //o3 =IF(G5="standard",B61,IF(G5="premium",B62))/60

        o3 = (g5 == 'standard') ? parseFloat(constant.b61) : parseFloat(constant.b62);
        o3 = o3 / 60;
        $('#o3').val(o3);

        //p3 =O3*30
        p3 = parseFloat(o3) * 30;
        $('#p3').val(p3);

        //q3 =IF(G3="regular",B14,IF(G3="3D",B15))
        q3 = (g3 == 'regular') ? parseFloat(constant.b14) : parseFloat(constant.b15);
        $('#q3').val(q3);

        //r3 =IF(G3="3D",B13+(F3*0.1)-0.1,IF(G3="regular",B12+(F3*0.1)-0.1,""))
        r3 = (g3 == '3D') ? (parseFloat(constant.b13) + (f3 * 0.1) - 0.1) : (g3 == 'regular') ? (parseFloat(constant.b12) + (f3 * 0.1) - 0.1) : '';
        $('#r3').val(r3);

        //s3 =B11+(F3*0.1)-0.1
        s3 = parseFloat(constant.b11) + (f3 * 0.1) - 0.1;
        $('#s3').val(s3);

        //t3 =IF(AND(OR(H3="front center", H3="front left panel", H3="front right panel"), I3="No", K3="No"),B19, "0")
        t3 = (['front-center', 'front-left', 'front-right'].includes(h3) && i3 == 'no' && k3 == 'no') ? parseFloat(constant.b19) : 0;
        $('#t3').val(t3);

        //u3 =IF(AND(OR(H3="front center",H3="front left panel",H3="front right panel"),G3="regular",I3="No",K3="No"),B27*F3,IF(AND(OR(H3="front center",H3="front left panel",H3="front right panel"),G3="3D",I3="No",K3="No"),B35*F3,"0"))
        //console log all variable

        u3 = ((['front-center', 'front-left', 'front-right'].includes(h3) && g3 == 'regular' && i3 == 'no' && k3 == 'no') ? (parseFloat(constant.b27) * f3) : (['front-center', 'front-left', 'front-right'].includes(h3) && g3 == '3D' && i3 == 'no' && k3 == 'no') ? (parseFloat(constant.b35) * f3) : 0);
        $('#u3').val(u3);

        v3 = (f3 < parseFloat(constant.b137) ? parseFloat(constant.b46) * f3 : parseFloat(constant.b46) * parseFloat(constant.b137)) +
            (f3 < parseFloat(constant.b317) ? parseFloat(constant.b47) * f3 : parseFloat(constant.b47) * parseFloat(constant.b137)) +
            (f3 < parseFloat(constant.b317) ? parseFloat(constant.b48) * f3 : parseFloat(constant.b48) * parseFloat(constant.b137)) +
            (f3 < parseFloat(constant.b317) ? parseFloat(constant.b49) * f3 : parseFloat(constant.b49) * parseFloat(constant.b137)) +
            (f3 >= 1 ? parseFloat(constant.b50) : 0);
        $('#v3').val(v3);


        //w3 = IF(AND(OR(H3 = "front center", H3 = "front left panel", H3 = "front right panel"), I3 = "No", K3 = "No"), B53 * INT((F3 - 1) / B137) + B53, "0")
        w3 = (['front-center', 'front-left', 'front-right'].includes(h3) && i3 == 'no' && k3 == 'no') ? (parseFloat(constant.b53) * parseInt((f3 - 1) / constant.b137) + parseFloat(constant.b53)) : 0;
        $('#w3').val(w3);

        //x3 =IF(AND(OR(H3="front center",H3="front left panel",H3="front right panel"),I3="No",K3="No"),IF(F3>0,((F3*B120)+(B81+(INT((F3-1)/6)*B81))+(B102+(INT((F3-1)/6)*B102))+(F3*B70)+(B75*F3))),"0")
        x3 = (['front-center', 'front-left', 'front-right'].includes(h3) && i3 == 'no' && k3 == 'no') ? (f3 > 0 ? ((f3 * parseFloat(constant.b120)) + (parseFloat(constant.b81) + (parseInt((f3 - 1) / 6) * parseFloat(constant.b81))) + (parseFloat(constant.b102) + (parseInt((f3 - 1) / 6) * parseFloat(constant.b102))) + (f3 * parseFloat(constant.b70)) + (parseFloat(constant.b75) * f3)) : 0) : 0;

        $('#x3').val(x3);

        //y3 =IF(G3="regular",B131*F3,IF(G3="3D",B132*F3))
        y3 = (g3 == 'regular') ? (parseFloat(constant.b131) * f3) : (g3 == '3D') ? (parseFloat(constant.b132) * f3) : 0;
        //round to 2 decimal
        // z3 = z3.toFixed(4);
        $('#y3').val(y3);



        //t5 = IF(AND(I3 = "yes", K3 = "NO", OR(J3 = "right side", J3 = "left side"), OR(H3 = "front center", H3 = "front right panel", H3 = "front left panel")), B20, "0")
        let t5 = (i3 == 'yes' && k3 == 'no' && ['right', 'left'].includes(j3) && ['front-center', 'front-right', 'front-left'].includes(h3)) ? parseFloat(constant.b20) : 0;

        //t7 =IF(AND(I3="yes",K3="NO",OR(J3="BOTH"),OR(H3="front center",H3="front right panel",H3="front left panel")),B21,"0")
        let t7 = (i3 == 'yes' && k3 == 'no' && j3 == 'both' && ['front-center', 'front-right', 'front-left'].includes(h3)) ? parseFloat(constant.b21) : 0;

        //t9 =IF(AND(I3="yes",K3="yes",OR(J3="BOTH"),OR(H3="front center",H3="front right panel",H3="front left panel")),B22,"0")
        let t9 = (i3 == 'yes' && k3 == 'yes' && j3 == 'both' && ['front-center', 'front-right', 'front-left'].includes(h3)) ? parseFloat(constant.b22) : 0;

        //t11 =IF(AND(I3="yes",K3="yes", OR(J3="right side", J3="left side"), OR(H3="front center", H3="front right panel", H3="front left panel")), B23, "0")
        let t11 = (i3 == 'yes' && k3 == 'yes' && ['right', 'left'].includes(j3) && ['front-center', 'front-right', 'front-left'].includes(h3)) ? parseFloat(constant.b23) : 0;

        //t13 =IF(AND(I3="no",K3="yes", OR(H3="front center", H3="front right panel", H3="front left panel")), B24, "0")
        let t13 = (i3 == 'no' && k3 == 'yes' && ['front-center', 'front-right', 'front-left'].includes(h3)) ? parseFloat(constant.b24) : 0;

        //u5 =IF(AND(I3="yes",K3="NO",OR(J3="right side",J3="left side"),OR(H3="front center",H3="front right panel",H3="front left panel"),G3="regular"),B28*F3,IF(AND(I3="yes",K3="NO",OR(J3="right side",J3="left side"),OR(H3="front center",H3="front right panel",H3="front left panel"),G3="3D"),F3*B36,"0"))
        let u5 = (i3 == 'yes' && k3 == 'no' && ['right', 'left'].includes(j3) && ['front-center', 'front-right', 'front-left'].includes(h3) && g3 == 'regular') ? parseFloat(constant.b28) * f3 : (i3 == 'yes' && k3 == 'no' && ['right', 'left'].includes(j3) && ['front-center', 'front-right', 'front-left'].includes(h3) && g3 == '3D') ? f3 * parseFloat(constant.b36) : 0;

        //u7 =IF(AND(I3="yes",K3="NO",OR(J3="BOTH"),OR(H3="front center",H3="front right panel",H3="front left panel"),G3="regular"),B29*F3,IF(AND(I3="yes",K3="NO",OR(J3="BOTH"),OR(H3="front center",H3="front right panel",H3="front left panel"),G3="3D"),B37*F3,"0"))
        let u7 = (i3 == 'yes' && k3 == 'no' && j3 == 'both' && ['front-center', 'front-right', 'front-left'].includes(h3) && g3 == 'regular') ? parseFloat(constant.b29) * f3 : (i3 == 'yes' && k3 == 'no' && j3 == 'both' && ['front-center', 'front-right', 'front-left'].includes(h3) && g3 == '3D') ? parseFloat(constant.b37) * f3 : 0;

        //u9 =IF(AND(I3="yes",K3="yes",OR(J3="BOTH"),OR(H3="front center",H3="front right panel",H3="front left panel"),G3="regular"),B30*F3,IF(AND(I3="yes",K3="yes",OR(J3="BOTH"),OR(H3="front center",H3="front right panel",H3="front left panel"),G3="3D"),B38*F3,"0"))
        let u9 = (i3 == 'yes' && k3 == 'yes' && j3 == 'both' && ['front-center', 'front-right', 'front-left'].includes(h3) && g3 == 'regular') ? parseFloat(constant.b30) * f3 : (i3 == 'yes' && k3 == 'yes' && j3 == 'both' && ['front-center', 'front-right', 'front-left'].includes(h3) && g3 == '3D') ? parseFloat(constant.b38) * f3 : 0;

        //u11 =IF(AND(I3="yes",K3="yes",OR(J3="right side",J3="left side"),OR(H3="front center",H3="front right panel",H3="front left panel"),G3="regular"),B31*F3,IF(AND(I3="yes",K3="yes",OR(J3="right side",J3="left side"),OR(H3="front center",H3="front right panel",H3="front left panel"),G3="3D"),B39*F3,"0"))
        let u11 = (i3 == 'yes' && k3 == 'yes' && ['right', 'left'].includes(j3) && ['front-center', 'front-right', 'front-left'].includes(h3) && g3 == 'regular') ? parseFloat(constant.b31) * f3 : (i3 == 'yes' && k3 == 'yes' && ['right', 'left'].includes(j3) && ['front-center', 'front-right', 'front-left'].includes(h3) && g3 == '3D') ? parseFloat(constant.b39) * f3 : 0;

        //u13 =IF(AND(OR(H3="front center",H3="front left panel",H3="front right panel"),G3="regular",I3="No",K3="Yes"),B32*F3,IF(AND(OR(H3="front center",H3="front left panel",H3="front right panel"),G3="3D",I3="No",K3="Yes"),B40*F3,"0"))
        let u13 = (['front-center', 'front-left', 'front-right'].includes(h3) && g3 == 'regular' && i3 == 'no' && k3 == 'yes') ? parseFloat(constant.b32) * f3 : (['front-center', 'front-left', 'front-right'].includes(h3) && g3 == '3D' && i3 == 'no' && k3 == 'yes') ? parseFloat(constant.b40) * f3 : 0;

        //w5 =IF(AND(I3="yes",K3="NO", OR(J3="right side", J3="left side"), OR(H3="front center", H3="front right panel", H3="front left panel")),B54*INT((F3-1)/B137)+B54, "0")
        let w5 = (i3 == 'yes' && k3 == 'no' && ['right', 'left'].includes(j3) && ['front-center', 'front-right', 'front-left'].includes(h3)) ? (parseFloat(constant.b54) * parseInt((f3 - 1) / constant.b137) + parseFloat(constant.b54)) : 0;

        //w7 =IF(AND(I3="yes",K3="NO",OR(J3="BOTH"),OR(H3="front center",H3="front right panel",H3="front left panel")),B55*INT((F3-1)/B137)+B55,"0")
        let w7 = (i3 == 'yes' && k3 == 'no' && j3 == 'both' && ['front-center', 'front-right', 'front-left'].includes(h3)) ? (parseFloat(constant.b55) * parseInt((f3 - 1) / constant.b137) + parseFloat(constant.b55)) : 0;

        //w9 =IF(AND(I3="yes",K3="yes",OR(J3="BOTH"),OR(H3="front center",H3="front right panel",H3="front left panel")),B57*INT((F3-1)/B137)+B57,"0")
        let w9 = (i3 == 'yes' && k3 == 'yes' && j3 == 'both' && ['front-center', 'front-right', 'front-left'].includes(h3)) ? (parseFloat(constant.b57) * parseInt((f3 - 1) / constant.b137) + parseFloat(constant.b57)) : 0;

        //w11 =IF(AND(I3="yes",K3="yes", OR(J3="right side", J3="left side"), OR(H3="front center", H3="front right panel", H3="front left panel")),B56*INT((F3-1)/B137)+B56,"0")
        let w11 = (i3 == 'yes' && k3 == 'yes' && ['right', 'left'].includes(j3) && ['front-center', 'front-right', 'front-left'].includes(h3)) ? (parseFloat(constant.b56) * parseInt((f3 - 1) / constant.b137) + parseFloat(constant.b56)) : 0;

        //w13 =IF(AND(I3="no",K3="yes", OR(H3="front center", H3="front right panel", H3="front left panel")),B58*INT((F3-1)/B137)+B58,"0")
        let w13 = (i3 == 'no' && k3 == 'yes' && ['front-center', 'front-right', 'front-left'].includes(h3)) ? (parseFloat(constant.b58) * parseInt((f3 - 1) / constant.b137) + parseFloat(constant.b58)) : 0;

        //x5 =IF(AND(I3="yes",K3="NO", OR(J3="right side", J3="left side"), OR(H3="front center", H3="front right panel", H3="front left panel")),IF(F3>0,((F3*B120)+(B81+(INT((F3-1)/B137)*B81))+(B102+(INT((F3-1)/B137)*B102))+(F3*B70)+(B75*F3))+(F3*B86)+(F3*B107)), "0")
        let x5 = (i3 == 'yes' && k3 == 'no' && ['right', 'left'].includes(j3) && ['front-center', 'front-right', 'front-left'].includes(h3)) ? (f3 > 0 ? (((f3 * parseFloat(constant.b120)) + (parseFloat(constant.b81) + (parseInt((f3 - 1) / constant.b137) * parseFloat(constant.b81))) + (parseFloat(constant.b102) + (parseInt((f3 - 1) / constant.b137) * parseFloat(constant.b102))) + (f3 * parseFloat(constant.b70)) + (parseFloat(constant.b75) * f3)) + (f3 * parseFloat(constant.b86)) + (f3 * parseFloat(constant.b107))) : 0) : 0;

        //x7 =IF(AND(I3="yes",K3="NO",OR(J3="BOTH"),OR(H3="front center",H3="front right panel",H3="front left panel")),IF(F3>0,((F3*B120)+(B81+(INT((F3-1)/B137)*B81))+(B102+(INT((F3-1)/B137)*B102))+(F3*B70)+(B75*F3))+(F3*B86)+(F3*B107)+(F3*B91)+(F3*B111)),"0")
        let x7 = (i3 == 'yes' && k3 == 'no' && j3 == 'both' && ['front-center', 'front-right', 'front-left'].includes(h3)) ? (f3 > 0 ? (((f3 * parseFloat(constant.b120)) + (parseFloat(constant.b81) + (parseInt((f3 - 1) / constant.b137) * parseFloat(constant.b81))) + (parseFloat(constant.b102) + (parseInt((f3 - 1) / constant.b137) * parseFloat(constant.b102))) + (f3 * parseFloat(constant.b70)) + (parseFloat(constant.b75) * f3)) + (f3 * parseFloat(constant.b86)) + (f3 * parseFloat(constant.b107)) + (f3 * parseFloat(constant.b91)) + (f3 * parseFloat(constant.b111))) : 0) : 0;

        //x9 =IF(AND(I3="yes",K3="yes",OR(J3="BOTH"),OR(H3="front center",H3="front right panel",H3="front left panel")),IF(F3>0,((F3*B120)+(B81+(INT((F3-1)/B137)*B81))+(B102+(INT((F3-1)/B137)*B102))+(F3*B70)+(B75*F3))+(F3*B86)+(F3*B107)+(F3*B96)+(F3*B115)+(F3*B91)+(F3*B111)),"0")
        let x9 = (i3 == 'yes' && k3 == 'yes' && j3 == 'both' && ['front-center', 'front-right', 'front-left'].includes(h3)) ? (f3 > 0 ? (((f3 * parseFloat(constant.b120)) + (parseFloat(constant.b81) + (parseInt((f3 - 1) / constant.b137) * parseFloat(constant.b81))) + (parseFloat(constant.b102) + (parseInt((f3 - 1) / constant.b137) * parseFloat(constant.b102))) + (f3 * parseFloat(constant.b70)) + (parseFloat(constant.b75) * f3)) + (f3 * parseFloat(constant.b86)) + (f3 * parseFloat(constant.b107)) + (f3 * parseFloat(constant.b96)) + (f3 * parseFloat(constant.b115)) + (f3 * parseFloat(constant.b91)) + (f3 * parseFloat(constant.b111))) : 0) : 0;

        //x11 =IF(AND(I3="yes",K3="yes", OR(J3="right side", J3="left side"), OR(H3="front center", H3="front right panel", H3="front left panel")),IF(F3>0,((F3*B120)+(B81+(INT((F3-1)/B137)*B81))+(B102+(INT((F3-1)/B137)*B102))+(F3*B70)+(B75*F3))+(F3*B91)+(F3*B111)+(F3*B96)+(F3*B115)),"0")
        let x11 = (i3 == 'yes' && k3 == 'yes' && ['right', 'left'].includes(j3) && ['front-center', 'front-right', 'front-left'].includes(h3)) ? (f3 > 0 ? (((f3 * parseFloat(constant.b120)) + (parseFloat(constant.b81) + (parseInt((f3 - 1) / constant.b137) * parseFloat(constant.b81))) + (parseFloat(constant.b102) + (parseInt((f3 - 1) / constant.b137) * parseFloat(constant.b102))) + (f3 * parseFloat(constant.b70)) + (parseFloat(constant.b75) * f3)) + (f3 * parseFloat(constant.b91)) + (f3 * parseFloat(constant.b111)) + (f3 * parseFloat(constant.b96)) + (f3 * parseFloat(constant.b115))) : 0) : 0;

        //x13 =IF(AND(I3="no",K3="yes", OR(H3="front center", H3="front right panel", H3="front left panel")),IF(F3>0,((F3*B120)+(B81+(INT((F3-1)/B137)*B81))+(B102+(INT((F3-1)/B137)*B102))+(F3*B70)+(B75*F3))+(F3*B96)+(F3*B115)),"0")
        let x13 = (i3 == 'no' && k3 == 'yes' && ['front-center', 'front-right', 'front-left'].includes(h3)) ? (f3 > 0 ? (((f3 * parseFloat(constant.b120)) + (parseFloat(constant.b81) + (parseInt((f3 - 1) / constant.b137) * parseFloat(constant.b81))) + (parseFloat(constant.b102) + (parseInt((f3 - 1) / constant.b137) * parseFloat(constant.b102))) + (f3 * parseFloat(constant.b70)) + (parseFloat(constant.b75) * f3)) + (f3 * parseFloat(constant.b96)) + (f3 * parseFloat(constant.b115))) : 0) : 0;



        //z3 =(T3+T5+T7+T9+T11+T13+U3+U5+U7+U9+U11+U13+V3+W3+W5+W7+W9+W11+W13+X3+X5+X7+X9+X11+X13+Y3-(U3/2))/60
        z3 = (t3 + t5 + t7 + t9 + t11 + t13 + u3 + u5 + u7 + u9 + u11 + u13 + v3 + w3 + w5 + w7 + w9 + w11 + w13 + x3 + x5 + x7 + x9 + x11 + x13 + y3 - (u3 / 2)) / 60;
        z3 = z3.toFixed(4);
        $('#z3').val(z3);

        //aa3 =Z3*15
        aa3 = parseFloat(z3) * 15;
        //round with 2 decimal
        //math round with 2 decimal
        // alert(aa3);
        aa3 = aa3.toFixed(2);

        $('#aa3').val(aa3);

        //ac3 =(AA3+R3+N3+S3+(D3*F3))/F3

        ac3 = (parseFloat(aa3) + parseFloat(r3) + parseFloat(n3) + parseFloat(s3) + (parseFloat(d3) * parseFloat(f3))) / parseFloat(f3);
        //round with 2 decimal
        ac3 = ac3.toFixed(2);
        $('#ac3').val(ac3);

        //ad3 =P3+Q3
        ad3 = parseFloat(p3) + parseFloat(q3);
        //round with 2 decimal
        ad3 = ad3.toFixed(2);
        $('#ad3').val(ad3);

        //ae3 =(D3*F3)+N3+P3+Q3+AA53+R3+S3+AA3
        ae3 = (parseFloat(d3) * parseFloat(f3)) + parseFloat(n3) + parseFloat(p3) + parseFloat(q3) + parseFloat(aa3) + parseFloat(r3) + parseFloat(s3);
        //2 decimal only
        ae3 = ae3.toFixed(2);
        $('#ae3').val(ae3);


        //af3 =IF(F3<11,F3*10%,110%)
        af3 = (f3 < 11) ? (f3 * 0.1) : 1.1;
        //round with 2 decimal
        af3 = af3.toFixed(2);
        $('#af3').val(af3);

        //ag3 =AE3+(AE3*AF3)
        ag3 = parseFloat(ae3) + (parseFloat(ae3) * parseFloat(af3));
        //round with 2 decimal
        ag3 = ag3.toFixed(2);
        $('#ag3').val(ag3);

        //ah3 =AG3-AE3
        ah3 = ag3 - ae3;
        //round with 2 decimal
        ah3 = ah3.toFixed(2);
        $('#ah3').val(ah3);

        //al3 =AG3/F3
        ai3 = ag3 / f3;
        //round with 2 decimal
        ai3 = ai3.toFixed(2);
        $('#ai3').val(ai3);

        //aj3 =IF(AB3="Yes",5,IF(AB3="No (Local Pickup)",0))
        aj3 = (ab3 == 'yes') ? 5 : 0;
        $('#aj3').val(aj3);

        //ak3 =AG3*8.25%
        ak3 = ag3 * 0.0825;
        //round with 2 decimal
        ak3 = ak3.toFixed(2);
        $('#ak3').val(ak3);

        //al3 =AG3+AK3+AJ3

        al3 = parseFloat(ag3) + parseFloat(ak3) + parseFloat(aj3);
        //round with 2 decimal
        al3 = al3.toFixed(2);
        $('#al3').text(al3);























    }


    //call constantCalculation on change of input field
    $('input[type="text"]').on('input', function() {
        constantCalculation();
    });

    //on select field change call constantCalculation
    $('select').on('change', function() {
        constantCalculation();
    });

    //number field chnage call constantCalculation
    $('input[type="number"]').on('change', function() {
        constantCalculation();
    });
</script>


@include('partials.admin.product.product-scripts')
@endsection