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
                <h4 class="heading"> {{ __('Edit Constant') }}<a class="add-btn" href="{{ url()->previous() }}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h4>
                <ul class="links">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                    </li>
                    <li>
                        <a href="{{ route('admin-prod-index') }}">{{ __('Products') }} </a>
                    </li>
                    <li>
                        <a href="javascript:;">{{ __('Product Constant') }}</a>
                    </li>
                    <li>
                        <a href="javascript:;">{{ __('Edit') }}</a>
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




                    <table border="2" class="text-center w-100" id="repeater-table">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>Constants (Regular Embroidery) 1 Head Basis </th>
                                <th>Value</th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr>
                                <td>Electricity</td>
                                <td>
                                    <input id="b11" type="text" name="b11" value="{{ $constant->b11 }}" class="form-control text-center">
                                </td>
                            </tr>

                            <tr>
                                <td> materials (regular) (thread, bobbin, stabalizer, needles) </td>
                                <td>
                                    <input id="b12" type="text" name="b12" class="form-control text-center" value="{{ $constant->b12 }}">
                                </td>
                            </tr>

                            <tr>
                                <td> materials (3D) (thread, bobbin, stabalizer, foam, needles) </td>
                                <td>
                                    <input id="b13" type="text" name="b13" class="form-control text-center" value="{{ $constant->b13 }}">
                                </td>

                            </tr>

                            <tr>
                                <td> Digititizing (Regular) </td>
                                <td>
                                    <input id="b14" type="text" name="b14" class="form-control text-center" value="{{ $constant->b14 }}">
                                </td>
                            </tr>

                            <tr>
                                <td> Digititizing (3D) </td>
                                <td>
                                    <input id="b15" type="text" name="b15" class="form-control text-center" value="{{ $constant->b15 }}">
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2"> <strong> Run Time</strong> </td>
                            </tr>

                            <tr>
                                <td> Machine Run Time (Minutes) Front Logo Only (Same Design) </td>
                                <td>
                                    <input id="b53" type="text" readonly="readonly" name="b53" class="form-control text-center" value="{{ $constant->b53 }}">
                                </td>
                            </tr>

                            <tr>
                                <td> Machine Run Time (Minutes) Front and 1 side (Same Design) </td>
                                <td>
                                    <input id="b54" type="text" readonly="readonly" name="b54" class="form-control text-center" value="{{ $constant->b54 }}">
                                </td>
                            </tr>

                            <tr>
                                <td> Machine Run Time (Minutes) Front and 2 sides (Same Design) </td>
                                <td>
                                    <input id="b55" type="text" readonly="readonly" name="b55" class="form-control text-center" value="{{ $constant->b55 }}">
                                </td>
                            </tr>

                            <tr>
                                <td> Machine Run Time (Minutes) Front and 1 side and back (Same Design) </td>
                                <td>
                                    <input id="b56" type="text" readonly="readonly" name="b56" class="form-control text-center" value="{{ $constant->b56 }}">
                                </td>
                            </tr>


                            <tr>
                                <td> Machine Run Time (Minutes) Front and 2 side and back (Same Design) </td>
                                <td>
                                    <input id="b57" type="text" readonly="readonly" name="b57" class="form-control text-center" value="{{ $constant->b57 }}">
                                </td>
                            </tr>

                            <tr>
                                <td> Machine Run Time (Minutes) Front and back (Same Design) </td>
                                <td>
                                    <input id="b58" type="text" readonly="readonly" name="b58" class="form-control text-center" value="{{ $constant->b58 }}">
                                </td>

                            </tr>
                            <tr>
                                <td colspan="2"> <strong> Production Time(in minutes)</strong> </td>
                            </tr>
                            <tr>
                                <td colspan="2"> <strong>Stitch Test Time</strong> </td>
                            </tr>
                            <tr>
                                <td>Stitch Test Time (Front)</td>
                                <td><input id="b19" type="text" name="b19" readonly="readonly" class="form-control text-center" value="{{ $constant->b19 }}"></td>
                            </tr>
                            <tr>
                                <td>Stitch Test Time Front and 1 Side</td>
                                <td><input id="b20" type="text" name="b20" readonly="readonly" class="form-control text-center" value="{{ $constant->b20 }}"></td>
                            </tr>
                            <tr>
                                <td>Stitch Test Time Front and 2 Sides</td>
                                <td><input id="b21" type="text" name="b21" readonly="readonly" class="form-control text-center" value="{{ $constant->b21 }}"></td>
                            </tr>
                            <tr>
                                <td>Stitch Test Time Front and 2 sides and Back</td>
                                <td><input id="b22" type="text" name="b22" class="form-control text-center" value="{{ $constant->b22 }}"></td>
                            </tr>
                            <tr>
                                <td>Stitch Test Time Front and 1 sides and Back</td>
                                <td><input id="b23" type="text" name="b23" class="form-control text-center" value="{{ $constant->b23 }}"></td>
                            </tr>
                            <tr>
                                <td>Stitch Test Time Front and Back</td>
                                <td><input id="b24" type="text" name="b24" readonly="readonly" class="form-control text-center" value="{{ $constant->b24 }}"></td>
                            </tr>
                            <tr>
                                <td colspan="2"> <strong>Hooping Time Regular</strong> </td>
                            </tr>

                            <tr>
                                <td>Hooping Time (Minutes) Front Only Regular</td>
                                <td><input id="b27" type="text" name="b27" class="form-control text-center" value="{{ $constant->b27 }}"></td>
                            </tr>
                            <tr>
                                <td>Hooping Time (Minutes) Front and 1 side Regular</td>
                                <td><input id="b28" type="text" name="b28" class="form-control text-center" value="{{ $constant->b28 }}"></td>
                            </tr>
                            <tr>
                                <td>Hooping Time (Minutes) Front and 2 Sides Regular</td>
                                <td><input id="b29" type="text" name="b29" class="form-control text-center" value="{{ $constant->b29 }}"></td>
                            </tr>
                            <tr>
                                <td>Hooping Time (Minutes) Front and 2 side and Back Regular</td>
                                <td><input id="b30" type="text" name="b30" class="form-control text-center" value="{{ $constant->b30 }}"></td>
                            </tr>
                            <tr>
                                <td>Hooping Time (Minutes) Front and 1 side and Back Regular</td>
                                <td><input id="b31" type="text" name="b31" class="form-control text-center" value="{{ $constant->b31 }}"></td>
                            </tr>
                            <tr>
                                <td>Hooping Time (Minutes) Front and Back Regular</td>
                                <td><input id="b32" type="text" name="b32" class="form-control text-center" value="{{ $constant->b32 }}"></td>
                            </tr>
                            <tr>
                                <td colspan="2"> <strong>Hooping Time 3D</strong> </td>
                            </tr>
                            <tr>
                                <td>Hooping Time (Minutes) Front Only</td>
                                <td><input id="b35" type="text" name="b35" class="form-control text-center" value="{{ $constant->b35 }}"></td>
                            </tr>
                            <tr>
                                <td>Hooping Time (Minutes) Front and 1 side</td>
                                <td><input id="b36" type="text" name="b36" class="form-control text-center" value="{{ $constant->b36 }}"></td>
                            </tr>
                            <tr>
                                <td>Hooping Time (Minutes) Front and 2 Sides</td>
                                <td><input id="b37" type="text" name="b37" class="form-control text-center" value="{{ $constant->b37 }}"></td>
                            </tr>
                            <tr>
                                <td>Hooping Time (Minutes) Front and 2 side and Back</td>
                                <td><input id="b38" type="text" name="b38" class="form-control text-center" value="{{ $constant->b38 }}"></td>
                            </tr>
                            <tr>
                                <td>Hooping Time (Minutes) Front and 1 side and Back</td>
                                <td><input id="b39" type="text" name="b39" class="form-control text-center" value="{{ $constant->b39 }}"></td>
                            </tr>
                            <tr>
                                <td>Hooping Time (Minutes) Front and Back</td>
                                <td><input id="b40" type="text" name="b40" class="form-control text-center" value="{{ $constant->b40 }}"></td>
                            </tr>
                            <tr>
                                <td colspan="2"> <strong>Detailed Machine Set Up Time</strong> </td>
                            </tr>


                            <td>Cap Driver Check Time (per head)</td>
                            <td><input id="b46" type="text" name="b46" class="form-control text-center" value="{{ $constant->b46 }}"></td>
                            </tr>
                            <tr>
                                <td>Cone Change Time (per head)</td>
                                <td><input id="b47" type="text" name="b47" class="form-control text-center" value="{{ $constant->b47 }}"></td>
                            </tr>
                            <tr>
                                <td>Needle Change Time (per head)</td>
                                <td><input id="b48" type="text" name="b48" class="form-control text-center" value="{{ $constant->b48 }}"></td>
                            </tr>
                            <tr>
                                <td>Bobbin Change Time (per head)</td>
                                <td><input id="b49" type="text" name="b49" class="form-control text-center" value="{{ $constant->b49 }}"></td>
                            </tr>
                            <tr>
                                <td>Design Programming on Machine</td>
                                <td><input id="b50" type="text" name="b50" class="form-control text-center" value="{{ $constant->b50 }}"></td>
                            </tr>

                            <tr>
                                <td colspan="2"> <strong>Machine Set Up</strong> </td>
                            </tr>

                            <tr>
                                <td>Machine Set Up Time (Minutes) 1 head</td>
                                <td><input id="b43" type="text" name="b43" readonly="readonly" class="form-control text-center" value="{{ $constant->b43 }}"></td>
                            </tr>

                            <tr>
                                <td colspan="2"> <strong>Artwork Setup</strong> </td>
                            </tr>
                            <tr>
                                <td>Standard</td>
                                <td><input id="b61" type="text" name="b61" class="form-control text-center" value="{{ $constant->b61 }}"></td>
                            </tr>
                            <tr>
                                <td>Premium</td>
                                <td><input id="b62" type="text" name="b62" class="form-control text-center" value="{{ $constant->b62 }}"></td>
                            </tr>

                            <tr>
                                <td colspan="2"> <strong>Detailed Down Time (per head)</strong> </td>
                            </tr>


                            <tr>
                                <td># of Trimmer Errorrs per head (average)</td>
                                <td><input id="b128" type="text" name="b128" class="form-control text-center" value="{{ $constant->b128 }}"></td>
                            </tr>


                            <tr>
                                <td colspan="2"> <strong>QA/QC</strong> </td>
                            </tr>

                            <tr>
                                <td>QA/QC Time (Regular Embroidery) (trimming, burning thread ends, tearing out stabilizer)</td>
                                <td><input id="b131" type="text" name="b131" class="form-control text-center" value="{{ $constant->b131 }}"></td>
                            </tr>
                            <tr>
                                <td>QA/QC Time (3D Embroidery) (trimming, burning thread ends, tearing out stabilizer, heat gun, pushing in foam)</td>
                                <td><input id="b132" type="text" name="b132" class="form-control text-center" value="{{ $constant->b132 }}"></td>
                            </tr>

                            <tr>
                                <td>Profit</td>
                                <td><input id="b134" type="text" name="b134" class="form-control text-center" value="{{ $constant->b134 }}"></td>
                            </tr>
                            <tr>
                                <td>Tax</td>
                                <td><input id="b135" type="text" name="b135" class="form-control text-center" value="{{ $constant->b135 }}"></td>
                            </tr>

                            <tr>
                                <td colspan="2"> <strong>Embroidery Machine</strong> </td>
                            </tr>

                            <tr>
                                <td>Heads</td>
                                <td><input id="b137" type="text" name="b137" class="form-control text-center" value="{{ $constant->b137 }}"></td>
                            </tr>
                            <tr>
                                <td>SPM</td>
                                <td><input id="b138" type="text" name="b138" class="form-control text-center" value="{{ $constant->b138 }}"></td>
                            </tr>
                            <tr>
                                <td colspan="2"> <strong>Design Information</strong> </td>
                            </tr>

                            <tr>
                                <td>Stitches per design (Front Logo)</td>
                                <td><input id="b141" type="text" name="b141" class="form-control text-center" value="{{ $constant->b141 }}"></td>
                            </tr>
                            <tr>
                                <td>Colors per Design</td>
                                <td><input id="b142" type="text" name="b142" class="form-control text-center" value="{{ $constant->b142 }}"></td>
                            </tr>
                            <tr>
                                <td># of Color Changes</td>
                                <td><input id="b143" readonly="readonly" type="text" name="b143" class="form-control text-center" value="{{ $constant->b143 }}"></td>
                            </tr>
                            <tr>
                                <td># of Cone Changes</td>
                                <td><input id="b144" type="text" name="b144" class="form-control text-center" value="{{ $constant->b144 }}"></td>
                            </tr>
                            <tr>
                                <td>Trims per design</td>
                                <td><input id="b145" type="text" name="b145" class="form-control text-center" value="{{ $constant->b145 }}"></td>
                            </tr>
                            <tr>
                                <td>Stitches per design (Left Side Logo 1)</td>
                                <td><input id="b147" type="text" name="b147" class="form-control text-center" value="{{ $constant->b147 }}"></td>
                            </tr>
                            <tr>
                                <td>Colors per Design</td>
                                <td><input id="b148" type="text" name="b148" class="form-control text-center" value="{{ $constant->b148 }}"></td>
                            </tr>
                            <tr>
                                <td># of Color Changes</td>
                                <td><input id="b149" type="text" name="b149" class="form-control text-center" value="{{ $constant->b149 }}"></td>
                            </tr>
                            <tr>
                                <td># of Cone Changes</td>
                                <td><input id="b150" type="text" name="b150" class="form-control text-center" value="{{ $constant->b150 }}"></td>
                            </tr>
                            <tr>
                                <td>Trims per design</td>
                                <td><input id="b151" type="text" name="b151" class="form-control text-center" value="{{ $constant->b151 }}"></td>
                            </tr>
                            <tr>
                                <td>Stitches per design (RightSide Logo 2)</td>
                                <td><input id="b153" type="text" name="b153" class="form-control text-center" value="{{ $constant->b153 }}"></td>
                            </tr>
                            <tr>
                                <td>Colors per Design</td>
                                <td><input id="b154" type="text" name="b154" class="form-control text-center" value="{{ $constant->b154 }}"></td>
                            </tr>
                            <tr>
                                <td># of Color Changes</td>
                                <td><input id="b155" type="text" name="b155" class="form-control text-center" value="{{ $constant->b155 }}"></td>
                            </tr>
                            <tr>
                                <td># of Cone Changes</td>
                                <td><input id="b156" type="text" name="b156" class="form-control text-center" value="{{ $constant->b156 }}"></td>
                            </tr>
                            <tr>
                                <td>Trims per design</td>
                                <td><input id="b157" type="text" name="b157" class="form-control text-center" value="{{ $constant->b157 }}"></td>
                            </tr>
                            <tr>
                                <td>Stitches per Design (Back Logo)</td>
                                <td><input id="b159" type="text" name="b159" class="form-control text-center" value="{{ $constant->b159 }}"></td>
                            </tr>
                            <tr>
                                <td>Colors per Design</td>
                                <td><input id="b160" type="text" name="b160" class="form-control text-center" value="{{ $constant->b160 }}"></td>
                            </tr>
                            <tr>
                                <td># of Color Changes</td>
                                <td><input id="b161" type="text" name="b161" class="form-control text-center" value="{{ $constant->b161 }}"></td>
                            </tr>
                            <tr>
                                <td># of Cone Changes</td>
                                <td><input id="b162" type="text" name="b162" class="form-control text-center" value="{{ $constant->b162 }}"></td>
                            </tr>
                            <tr>
                                <td>Trims per design</td>
                                <td><input id="b163" type="text" name="b163" class="form-control text-center" value="{{ $constant->b163 }}"></td>
                            </tr>

                            <tr>
                                <td colspan="2"> <strong>Trimming</strong> </td>
                            </tr>
                            <tr>
                                <td colspan="2"> <strong>Front Logo Trim Time</strong> </td>
                            </tr>


                            <tr>
                                <td>Total Trimming Time</td>
                                <td><input id="b102" readonly="readonly" type="text" name="b102" class="form-control text-center" value="{{ $constant->b102 }}"></td>
                            </tr>
                            <tr>
                                <td>Trimming Time (based off number of colors in design)</td>
                                <td><input id="b103" type="text" name="b103" class="form-control text-center" value="{{ $constant->b103 }}"></td>
                            </tr>
                            <tr>
                                <td># of Trims (from Design Information Section)</td>
                                <td><input id="b104" type="text" name="b104" class="form-control text-center" value="{{ $constant->b104 }}"></td>
                            </tr>

                            <tr>
                                <td colspan="2"> <strong>Right Side Logo Trim Time</strong> </td>
                            </tr>


                            <tr>
                                <td>Total Trimming Time</td>
                                <td><input id="b107" readonly="readonly" type="text" name="b107" class="form-control text-center" value="{{ $constant->b107 }}"></td>
                            </tr>
                            <tr>
                                <td>Trimming Time (based off number of colors in design)</td>
                                <td><input id="b108" type="text" name="b108" class="form-control text-center" value="{{ $constant->b108 }}"></td>
                            </tr>
                            <tr>
                                <td># of Trims (from Design Information Section)</td>
                                <td><input id="b109" readonly="readonly" type="text" name="b109" class="form-control text-center" value="{{ $constant->b109 }}"></td>
                            </tr>

                            <tr>
                                <td colspan="2"> <strong>Left Side Logo Trim Time</strong> </td>
                            </tr>



                            <tr>
                                <td>Total Trimming Time</td>
                                <td><input id="b111" readonly="readonly" type="text" name="b111" class="form-control text-center" value="{{ $constant->b111 }}"></td>
                            </tr>
                            <tr>
                                <td>Trimming Time (based off number of colors in design)</td>
                                <td><input id="b112" type="text" name="b112" class="form-control text-center" value="{{ $constant->b112 }}"></td>
                            </tr>
                            <tr>
                                <td># of Trims (from Design Information Section)</td>
                                <td><input id="b113" readonly="readonly" type="text" name="b113" class="form-control text-center" value="{{ $constant->b113 }}"></td>
                            </tr>

                            <tr>
                                <td colspan="2"> <strong>Back Logo Trim Time</strong> </td>
                            </tr>



                            <tr>
                                <td>Total Trimming Time</td>
                                <td><input id="b115" readonly="readonly" type="text" name="b115" class="form-control text-center" value="{{ $constant->b115 }}"></td>
                            </tr>
                            <tr>
                                <td>Trimming Time (based off number of colors in design)</td>
                                <td><input id="b116" type="text" name="b116" class="form-control text-center" value="{{ $constant->b116 }}"></td>
                            </tr>
                            <tr>
                                <td># of Trims (from Design Information Section)</td>
                                <td><input id="b117" readonly="readonly" type="text" name="b117" class="form-control text-center" value="{{ $constant->b117 }}"></td>
                            </tr>

                            <tr>
                                <td colspan="2"> <strong>Hoop Change</strong> </td>
                            </tr>

                            <tr>
                                <td>Hoop Change Time</td>
                                <td><input id="b120" type="text" name="b120" class="form-control text-center" value="{{ $constant->b120 }}"></td>
                            </tr>

                            <tr>
                                <td>Trimmer Error Time</td>
                                <td><input id="b122" type="text" name="b122" class="form-control text-center" value="{{ $constant->b122 }}"></td>
                            </tr>

                            <tr>
                                <td colspan="2"> <strong> Color Change (Trim time, Color Change, Ramp up Time)</strong> </td>
                            </tr>
                            <tr>
                                <td colspan="2"> <strong> Front Logo Color Change</strong> </td>
                            </tr>


                            <tr>
                                <td>Total Color Change Time</td>
                                <td><input id="b81" readonly="readonly" type="text" name="b81" class="form-control text-center" value="{{ $constant->b81 }}"></td>
                            </tr>
                            <tr>
                                <td># of Color Changes (average)</td>
                                <td><input id="b82" type="text" name="b82" readonly="readonly" class="form-control text-center" value="{{ $constant->b82 }}"></td>
                            </tr>
                            <tr>
                                <td>Color Change Time (moving from needle 15 to 1) minutes</td>
                                <td><input id="b83" type="text" name="b83" class="form-control text-center" value="{{ $constant->b83 }}"></td>
                            </tr>

                            <tr>
                                <td><strong>Right Side Logo Color Change</strong></td>
                            </tr>


                            <tr>
                                <td>Total Color Change Time</td>
                                <td><input id="b86" readonly="readonly" type="text" name="b86" class="form-control text-center" value="{{ $constant->b86 }}"></td>
                            </tr>
                            <tr>
                                <td># of Color Changes (average)</td>
                                <td><input id="b87" type="text" readonly="readonly" name="b87" class="form-control text-center" value="{{ $constant->b87 }}"></td>
                            </tr>
                            <tr>
                                <td>Color Change Time (moving from needle 15 to 1) minutes</td>
                                <td><input id="b88" type="text" name="b88" class="form-control text-center" value="{{ $constant->b88 }}"></td>
                            </tr>

                            <tr>
                                <td><strong>Left Side Logo Color Change</strong></td>
                            </tr>



                            <tr>
                                <td>Total Color Change Time</td>
                                <td><input id="b91" readonly="readonly" type="text" name="b91" class="form-control text-center" value="{{ $constant->b91 }}"></td>
                            </tr>
                            <tr>
                                <td># of Color Changes (average)</td>
                                <td><input id="b92" type="text" name="b92" readonly="readonly" class="form-control text-center" value="{{ $constant->b92 }}"></td>
                            </tr>
                            <tr>
                                <td>Color Change Time (moving from needle 15 to 1) minutes</td>
                                <td><input id="b93" type="text" name="b93" class="form-control text-center" value="{{ $constant->b93 }}"></td>
                            </tr>

                            <tr>
                                <td><strong>Back Logo Color Change</strong></td>
                            </tr>


                            <tr>
                                <td>Total Color Change Time</td>
                                <td><input id="b96" readonly="readonly" type="text" name="b96" class="form-control text-center" value="{{ $constant->b96 }}"></td>
                            </tr>
                            <tr>
                                <td># of Color Changes (average)</td>
                                <td><input id="b97" type="text" name="b97" readonly="readonly" class="form-control text-center" value="{{ $constant->b97 }}"></td>
                            </tr>
                            <tr>
                                <td>Color Change Time (moving from needle 15 to 1) minutes</td>
                                <td><input id="b98" type="text" name="b98" class="form-control text-center" value="{{ $constant->b98 }}"></td>
                            </tr>

                            <tr>
                                <td colspan="2"> <strong>Detailed Down Time(per head)</strong> </td>
                            </tr>

                            <tr>
                                <td><strong>Thread Break</strong></td>
                            </tr>


                            <tr>
                                <td>Total Thread Break Time</td>
                                <td><input id="b70" readonly="readonly" type="text" name="b70" class="form-control text-center" value="{{ $constant->b70 }}"></td>
                            </tr>
                            <tr>
                                <td>Thread Break Time (time to repair)</td>
                                <td><input id="b71" type="text" name="b71" class="form-control text-center" value="{{ $constant->b71 }}"></td>
                            </tr>
                            <tr>
                                <td># of Thead Breaks per head (average)</td>
                                <td><input id="b72" type="text" name="b72" class="form-control text-center" value="{{ $constant->b72 }}"></td>
                            </tr>

                            <tr>
                                <td><strong>Bobbin Change</strong></td>
                            </tr>


                            <tr>
                                <td>Total Bobbin Change Time</td>
                                <td><input id="b75" readonly="readonly" type="text" name="b75" class="form-control text-center" value="{{ $constant->b75 }}"></td>
                            </tr>
                            <tr>
                                <td>Bobbin Change Time (time to repair)</td>
                                <td><input id="b76" type="text" name="b76" class="form-control text-center" value="{{ $constant->b76 }}"></td>
                            </tr>
                            <tr>
                                <td># of Bobbin Changes per head (average)</td>
                                <td><input id="b77" type="text" name="b77" class="form-control text-center" value="{{ $constant->b77 }}"></td>
                            </tr>

                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-lg-12 text-right mt-3 mb-3">
                            <button class="add-more btn btn-success" type="submit">Save</button>
                        </div>
                    </div>


                </div>
            </div>
    </form>
</div>


@endsection

@section('scripts')

<script type="text/javascript">
    //set all table imput only nmber can input 
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
    }

    //set calculation for all input field
    function constantCalculation() {


        //get all input field value
        //foreach input field set variable using id
        foreachInputFieldSetVariable();


        // var b11 = $('#b11').val();
        // var b12 = $('#b12').val();
        // var b13 = $('#b13').val();
        // var b14 = $('#b14').val();
        // var b15 = $('#b15').val();
        // var b53 = $('#b53').val();
        // var b54 = $('#b54').val();
        // var b55 = $('#b55').val();
        // var b56 = $('#b56').val();
        // var b57 = $('#b57').val();
        // var b58 = $('#b58').val();
        // var b19 = $('#b19').val();
        // var b20 = $('#b20').val();
        // var b21 = $('#b21').val();
        // var b22 = $('#b22').val();
        // var b23 = $('#b23').val();
        // var b24 = $('#b24').val();
        // var b27 = $('#b27').val();
        // var b28 = $('#b28').val();
        // var b29 = $('#b29').val();
        // var b30 = $('#b30').val();
        // var b31 = $('#b31').val();
        // var b32 = $('#b32').val();
        // var b35 = $('#b35').val();
        // var b36 = $('#b36').val();
        // var b37 = $('#b37').val();
        // var b38 = $('#b38').val();
        // var b39 = $('#b39').val();
        // var b40 = $('#b40').val();
        // var b43 = $('#b43').val();
        // var b46 = $('#b46').val();
        // var b47 = $('#b47').val();
        // var b48 = $('#b48').val();
        // var b49 = $('#b49').val();
        // var b50 = $('#b50').val();
        // var b61 = $('#b61').val();
        // var b62 = $('#b62').val();
        // var b128 = $('#b128').val();
        // var b131 = $('#b131').val();
        // var b132 = $('#b132').val();
        // var b134 = $('#b134').val();
        // var b135 = $('#b135').val();
        // var b137 = $('#b137').val();
        // var b138 = $('#b138').val();
        // var b141 = $('#b141').val();
        // var b142 = $('#b142').val();
        // var b143 = $('#b143').val();
        // var b144 = $('#b144').val();
        // var b145 = $('#b145').val();
        // var b147 = $('#b147').val();
        // var b148 = $('#b148').val();
        // var b149 = $('#b149').val();
        // var b150 = $('#b150').val();
        // var b151 = $('#b151').val();
        // var b153 = $('#b153').val();
        // var b154 = $('#b154').val();
        // var b155 = $('#b155').val();
        // var b156 = $('#b156').val();
        // var b157 = $('#b157').val();
        // var b159 = $('#b159').val();
        // var b160 = $('#b160').val();
        // var b161 = $('#b161').val();
        // var b162 = $('#b162').val();
        // var b163 = $('#b163').val();
        // var b102 = $('#b102').val();
        // var b103 = $('#b103').val();
        // var b104 = $('#b104').val();
        // var b107 = $('#b107').val();
        // var b108 = $('#b108').val();
        // var b109 = $('#b109').val();
        // var b111 = $('#b111').val();
        // var b112 = $('#b112').val();
        // var b113 = $('#b113').val();
        // var b115 = $('#b115').val();
        // var b116 = $('#b116').val();
        // var b117 = $('#b117').val();
        // var b120 = $('#b120').val();
        // var b122 = $('#b122').val();
        // var b83 = $('#b83').val();
        // var b81 = $('#b81').val();
        // var b82 = $('#b82').val();

        // var b86 = $('#b86').val();
        // var b87 = $('#b87').val();
        // var b88 = $('#b88').val();

        // var b91 = $('#b91').val();
        // var b92 = $('#b92').val();
        // var b93 = $('#b93').val();

        // var b96 = $('#b96').val();
        // var b97 = $('#b97').val();
        // var b98 = $('#b98').val();

        // var b70 = $('#b70').val();
        // var b71 = $('#b71').val();
        // var b72 = $('#b72').val();

        // var b75 = $('#b75').val();
        // var b76 = $('#b76').val();
        // var b77 = $('#b77').val();







        //b53 value logic B141/B138
        if (b141 != '' && b141 != null && b138 != '' && b138 != null) {
            $('#b53').val(getvalue('b141') / getvalue('b138'));
        }

        //b54 value logic B141/B138+(B147/B138)
        if (b141 != '' && b141 != null && b138 != '' && b138 != null && b147 != '' && b147 != null) {
            $('#b54').val(getvalue('b141') / getvalue('b138') + (getvalue('b147') / getvalue('b138')));
        }

        //b55 value logic B141/B138+(B147/B138)
        if (b141 != '' && b141 != null && b138 != '' && b138 != null && b147 != '' && b147 != null) {
            $('#b55').val(getvalue('b141') / getvalue('b138') + (getvalue('b147') / getvalue('b138')));
        }

        //b56 value logic B141/B138+(B147/B138)+(B153/B138)
        if (b141 != '' && b141 != null && b138 != '' && b138 != null && b147 != '' && b147 != null && b153 != '' && b153 != null) {
            $('#b56').val(getvalue('b141') / getvalue('b138') + (getvalue('b147') / getvalue('b138') + (getvalue('b153') / getvalue('b138'))));
        }

        //b57 value logic B141/B138+(B147/B138)+(B153/B138)+(B159/B138)
        if (b141 != '' && b141 != null && b138 != '' && b138 != null && b147 != '' && b147 != null && b153 != '' && b153 != null && b159 != '' && b159 != null) {
            $('#b57').val(getvalue('b141') / getvalue('b138') + (getvalue('b147') / getvalue('b138') + (getvalue('b153') / getvalue('b138') + (getvalue('b159') / getvalue('b138')))));
        }

        //b58 value logic B141/B138+(B159/B138)
        if (b141 != '' && b141 != null && b138 != '' && b138 != null && b159 != '' && b159 != null) {
            $('#b58').val(getvalue('b141') / getvalue('b138') + (getvalue('b159') / getvalue('b138')));
        }



        //b19 value logic B53+2
        if (b53 != '' && b53 != null) {
            $('#b19').val(getvalue('b53') + 2);
        }

        //b20 value logic B54+2
        if (b54 != '' && b54 != null) {
            $('#b20').val(getvalue('b54') + 2);
        }

        //b21 value logic B55+2
        if (b55 != '' && b55 != null) {
            $('#b21').val(getvalue('b55') + 2);
        }

        //b24 value logic =B58+2
        if (b58 != '' && b58 != null) {
            $('#b24').val(getvalue('b58') + 2);
        }

        //b43 value logic B46+B47+B48+B49+B50
        if (b46 != '' && b46 != null && b47 != '' && b47 != null && b48 != '' && b48 != null && b49 != '' && b49 != null && b50 != '' && b50 != null) {
            $('#b43').val(getvalue('b46') + getvalue('b47') + getvalue('b48') + getvalue('b49') + getvalue('b50'));
        }



        //b102 == B103*B104
        if (b103 != '' && b103 != null && b104 != '' && b104 != null) {
            $('#b102').val(getvalue('b103') * getvalue('b104'));
        }

        //b109 == B157
        // alert(getvalue('b157));

        if (b157 != '' && b157 != null) {
            $('#b109').val(getvalue('b157'));
        }



        //b107 == B108*B109
        // alert(getvalue('b108));
        // alert(getvalue('b157));
        if (b108 != '' && b108 != null && b157 != '' && b157 != null) {
            $('#b107').val(getvalue('b108') * getvalue('b157'));
        }

        //b113 == b151
        if (b151 != '' && b151 != null) {
            $('#b113').val(getvalue('b151'));
        }

        //b111 == B112*B113
        if (b112 != '' && b112 != null && b151 != '' && b151 != null) {
            $('#b111').val(getvalue('b112') * getvalue('b151'));
        }

        //b117 == B163
        if (b163 != '' && b163 != null) {
            $('#b117').val(getvalue('b163'));
        }

        //b115 == B116*B117
        if (b116 != '' && b116 != null && b163 != '' && b163 != null) {
            $('#b115').val(getvalue('b116') * getvalue('b163'));
        }

        //b143 == B142*2
        if (b142 != '' && b142 != null) {
            $('#b143').val(getvalue('b142') * 2);
        }


        //b87 == B149
        if (b149 != '' && b149 != null) {
            $('#b87').val(getvalue('b149'));
        }

        //b92 == B155


        //b97 == B161
        if (b161 != '' && b161 != null) {
            $('#b97').val(getvalue('b161'));
        }

        if (b142 != '' && b142 != null) {
            $('#b143').val(getvalue('b142') * 2);
        }

        //b82 == B143
        if (b142 != '' && b142 != null) {
            $('#b82').val(getvalue('b142'));
        }



        //b81 == B82*B83
        if (b143 != '' && b143 != null && b83 != '' && b83 != null) {
            $('#b81').val(getvalue('b143') * getvalue('b83'));
        }

        //b86 == B87*B88
        if (b87 != '' && b87 != null && b88 != '' && b88 != null) {
            $('#b86').val(getvalue('b87') * getvalue('b88'));
        }

        if (b155 != '' && b155 != null) {
            $('#b92').val(getvalue('b155'));
        }

        //b91 == B92*B93
        if (b92 != '' && b92 != null && b93 != '' && b93 != null) {
            $('#b91').val(getvalue('b92') * getvalue('b93'));
        }

        //b96 == B97*B98
        if (b97 != '' && b97 != null && b98 != '' && b98 != null) {
            $('#b96').val(getvalue('b97') * getvalue('b98'));
        }

        //b70 == B71*B72
        if (b71 != '' && b71 != null && b72 != '' && b72 != null) {
            $('#b70').val(getvalue('b71') * getvalue('b72'));
        }

        //b75 == B76*B77
        if (b76 != '' && b76 != null && b77 != '' && b77 != null) {
            $('#b75').val(getvalue('b76') * getvalue('b77'));
        }






















    }

    //call constantCalculation on change of input field
    $('input[type="text"]').on('input', function() {
        constantCalculation();
    });
</script>


@include('partials.admin.product.product-scripts')
@endsection