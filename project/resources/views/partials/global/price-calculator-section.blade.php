<div class="select-quantity">
    <h5 class='hiddenToggle'>Items Price Calculator</h5>
    <div class="quantityBox">
        <div class="optFilter">

            <div style="display: flex;flex-wrap: wrap; gap:8px; margin-bottom: 10px;">

                <!----------------------------->
                <div>
                    <p style="font-size: 12px; margin-bottom: 4px;">Select Quantity</p>
                    <div class="quantity-container QuanCont">
                        <span class="quantity-label">Quantity</span>
                        <div class="quantity-controls">
                            <button class="quantity-btn minus-btn">−</button>
                            @php
                            $quantity = 1;
                            if(isset($products)){
                            $quantity = ($products->totalQty)?? 1;
                            }
                            @endphp
                            <input type="text" class="quantity-input qty" name="f3" id="f3" value="{{ $quantity }}" readonly>
                            <button class="quantity-btn plus-btn">+</button>
                        </div>
                        <input type="hidden" id="d3" name="d3" class="d3" value="{{ ($productt->blank_price)? $productt->blank_price : 0 }}">
                        <input type="hidden" id="d3" name="d3" class="d3" value="{{ ($productt->blank_price)? $productt->blank_price : 0 }}">
                        <input type="hidden" id="constant-{{ $productt->id }}" name="constant" class="customize_constant-{{ $productt->id }}" value="{{ ($productt->constant)? $productt->constant : '' }}">
                        <input type="hidden" id="customize_product_id" name="product_id" class="customize_product_id" value="{{ $productt->id }}">
                        <input type="hidden" id="customize_color_id" name="color_ids" class="selected-colors" value="">
                    </div>
                </div>
                <!------------------------------->
                <div>
                    <p style="font-size: 12px; margin-bottom: 4px;">Select side Embroidery</p>
                    <div class="custom-select">
                        <select id="i3" name="i3" class="i3">
                            <option value="">Select Side Embroidery </option>
                            <option value="yes">Yes</option>
                            <option selected value="no">No</option>
                        </select>
                    </div>
                </div>
                <!------------------------------------->
                <div class=" side_location" style="display:none">
                    <p style="font-size: 12px; margin-bottom: 4px;">Select side Embroidery Location</p>
                    <div class="custom-select ">
                        <select id="j3" name="j3" class="j3">
                            <option value="">Select Side Embroidery Locations </option>
                            <option value="right">Right</option>
                            <option value="left">Left</option>
                            <option value="both">Both</option>
                            <option value="na">NA (No side embroidery)</option>
                        </select>
                    </div>
                </div>

                <div>
                    <p style="font-size: 12px; margin-bottom: 4px;">Select Embroidery Type</p>
                    <div class="custom-select">
                        <select id="g3" name="g3" class="g3">
                            <option value="">Select Embroidery Type</option>
                            <option selected value="regular">Regular</option>
                            <option value="3D">3D</option>

                        </select>
                    </div>

                </div>

                <div style="display: flex;flex-wrap: wrap; gap:8px; ">
                    <div>
                        <p style="font-size: 12px; margin-bottom: 4px;">Select front Embroidery</p>
                        <div class="custom-select">
                            <select id="h3" name="h3" class="h3">
                                <option value="">Select Front Embroidery</option>
                                <option selected value="front-center">Front Center</option>
                                <option value="front-left">Front Left Panel</option>
                                <option value="front-right">Front Right Panel</option>
                            </select>
                        </div>
                    </div>
                    <!-- ----------------------- -->
                    <div>
                        <p style="font-size: 12px; margin-bottom: 4px;">Select back Embroidery</p>
                        <div class="custom-select">
                            <select id="k3" name="k3" class="k3">
                                <option value="">Select Back Embroidery </option>
                                <option value="yes">Yes</option>
                                <option selected value="no">No</option>
                            </select>
                        </div>
                    </div>

                    <div class=" back_location" style="display:none">
                        <p style="font-size: 12px; margin-bottom: 4px;">Select back Embroidery Location</p>
                        <div class="custom-select">
                            <select id="l3" name="l3" class="l3">
                                <option value="">Select Back Embroidery Locations </option>
                                <option value="center">Center</option>
                            </select>
                        </div>
                    </div>



                </div>
                <div style="display: flex;flex-wrap: wrap; gap:8px; margin-top: 10px;">
                    <!--<div>-->
                    <!--    <p style="font-size: 12px; margin-bottom: 4px;">Select Embroidery Type</p>-->
                    <!--    <div class="custom-select">-->
                    <!--    <select id="g3" name="g3" class="g3" onchange="constantCalculation()">-->
                    <!--        <option value="">Select Embroidery Type</option>-->
                    <!--        <option selected value="regular">Regular</option>-->
                    <!--        <option value="3D">3D</option>-->

                    <!--    </select>-->
                    <!--</div>-->
                </div>

            </div>

        </div>
        <div class="estPrice price" style="max-height:90px;margin-top: 20px;">

            <p>Estimated price</p>
            <h3>$19/ <span>per cap</span></h3>
        </div>
    </div>
</div>