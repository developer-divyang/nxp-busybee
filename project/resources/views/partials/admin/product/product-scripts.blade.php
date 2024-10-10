<script>
    (function($) {
        "use strict";

        var tsize = "";
        var tsizeText = "";
        var tcolor = "";
        var tcolorText = "";



        $(document).ready(function() {

            if ($('.size-name option').length > 0) {
                getSize1();
            }

            if ($('.color-name option').length > 0) {
                getColor1();
                // $('.color-name').each(function() {
                //     $(this).css('background-color', $(this).val());
                // });
            }

            // Check Clicks :)
            $(".checkclickc").on("change", function() {
                var type = $(this).data('type');
                if (this.checked) {
                    $('.tsize').prop('required', true);
                    $('.' + type + '-selector').removeClass('showbox');
                } else {
                    $('.tsize').prop('required', false);
                    $('.' + type + '-selector').addClass('showbox');
                }
            });
            // Check Clicks Ends :)

            // Check Clickc :)


            // Check Clickc Ends :)


            // Product Measure :)

            $("#product_measure").on("change", function() {
                var val = $(this).val();
                $('#measurement').val(val);
                if (val == "Custom") {
                    $('#measurement').val('');
                    $('#measure').show();
                } else {
                    $('#measure').hide();
                }
            });

            // Product Measure Ends :)

        });

        // TAGIT

        $("#metatags").tagit({
            fieldName: "meta_tag[]",
            allowSpaces: true
        });

        $("#tags").tagit({
            fieldName: "tags[]",
            allowSpaces: true
        });
        // TAGIT ENDS


        // Remove White Space


        function isEmpty(el) {
            return !$.trim(el.html())
        }


        // Remove White Space Ends

        // Size Section

        $("#size-btn").on('click', function() {

            $("#size-section").append('' +
                '<div class="size-area">' +
                '<span class="remove size-remove"><i class="fas fa-times"></i></span>' +
                '<div  class="row">' +
                '<div class="col-md-6 col-sm-6">' +
                '<label>' +
                '{{ __("Size Name") }} :' +
                '<span>{{ __("(eg. S,M,L,XL,3XL,4XL)") }}</span>' +
                '</label>' +
                `<select name="size[]" class="input-field size-name">${tsizeText}</select>` +
                '</div>' +
                '<div class="col-md-6 col-sm-6">' +
                '<label>' +
                '{{ __("Size Color") }} :' +
                '<span>' +
                '{{ __("(Select color of this size)") }}' +
                '</span>' +
                '</label>' +
                `<select name="color[]" class="input-field color-name" >${tcolorText}</select>` +
                '</div>' +
                '</div>' +
                '</div>' +
                '');


        });

        //on change category if category = 8 then show fit and bill type field


        $(document).on('click', '.size-remove', function() {

            $(this.parentNode).remove();
            if (isEmpty($('#size-section'))) {

                $("#size-section").append('' +
                    '<div class="size-area">' +
                    '<span class="remove size-remove"><i class="fas fa-times"></i></span>' +
                    '<div  class="row">' +
                    '<div class="col-md-2 col-sm-6">' +
                    '<label>' +
                    '{{ __("Size Name") }} :' +
                    '<span>{{ __("(eg. S,M,L,XL,3XL,4XL)") }}</span>' +
                    '</label>' +
                    `<select name="size[]" class="input-field size-name">${tsizeText}</select>` +
                    '</div>' +
                    '<div class="col-md-2 col-sm-6">' +
                    '<label>' +
                    '{{ __("Size Qty") }} :' +
                    '<span>{{ __("(Quantity of this size)") }}</span>' +
                    '</label>' +
                    '<input type="number" name="size_qty[]" required class="input-field" placeholder="{{ __("Size Qty") }}" value="1" min="1">' +
                    '</div>' +
                    '<div class="col-md-2 col-sm-6">' +
                    '<label>' +
                    '{{ __("Size Price") }} :' +
                    '<span>{{ __("(Added with base price)") }}</span>' +
                    '</label>' +
                    '<input type="number" name="size_price[]" required class="input-field" placeholder="{{ __("Size Price") }}" value="0" min="0">' +
                    '</div>' +
                    '<div class="col-md-2 col-sm-6">' +
                    '<label>' +
                    '{{ __("Size Color") }} :' +
                    '<span>' +
                    '{{ __("(Select color of this size)") }}' +
                    '</span>' +
                    '</label>' +
                    `<input type="file" name="image[]" class="input-field image" >` +
                    '</div>' +
                    +
                    '<div class="col-md-4 col-sm-6">' +
                    '<label>' +
                    '{{ __("Image") }} :' +
                    '<span>' +
                    '{{ __("(Select image of this size & color)") }}' +
                    '</span>' +
                    '</label>' +
                    `<select name="color[]" class="input-field color-name">${tcolorText}</select>` +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '');


            }


        });

        // Size Section Ends


        // Color Section

        function getColor() {

            if ($('.tcolor').length > 0) {
                tcolor = $(".tcolor").map(function() {
                    return $(this).val();
                }).get();
            }
            tcolorText = '';
            tcolor.forEach(getColorText);

        }

        function getColorText(item, index) {
            tcolorText += `<option value="${item}" >` + item + `</option>`;
            $('.color-name').html(tcolorText);
            // $('.color-name').css('background-color', tcolor[0]);
        }


        function getColor1() {

            if ($('.tcolor').length > 0) {
                tcolor = $(".tcolor").map(function() {
                    return $(this).val();
                }).get();
            }
            tcolorText = '';
            tcolor.forEach(getColorText1);

        }

        function getColorText1(item, index) {
            tcolorText += `<option value="${item}">` + item + `</option>`;
        }

        // $(document).on('change', '.color-name', function() {
        //     $(this).css('background-color', $(this).val());
        // });


        setTimeout(function() {
            $(document).on('change', '.tcolor', function() {
                getColor();
            });
        }, 1000);


        let colorIndex = 1; // Track the color index

        $("#color-btn").on('click', function() {
            // Append new color row with dynamic index for product_images
            $("#color-section").append(`
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="color_name">Color Group</label>
                    <input type="text" name="color_group[]" id="color_group_` + colorIndex + `" class="form-control " required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="color_name">Color Name</label>
                    <input type="text" name="color_name[]" id="color_name_` + colorIndex + `" class="form-control tcolor color_value" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <div id="preview_` + colorIndex + `" class="image-preview text-center"></div> 
                    <label for="color_img">Color Image</label>
                    <input type="file" name="color_img[]" data-id="` + colorIndex + `" id="color_img_` + colorIndex + `" class="form-control" accept="image/*" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                <div id="product_preview_` + colorIndex + `" class="image-preview text-center"></div> 
                    <label for="product_images">Product Images</label>
                    <input type="file" data-id="` + colorIndex + `" name="product_images[` + colorIndex + `][]" id="product_images_` + colorIndex + `" class="form-control" accept="image/*" multiple required>
                </div>
            </div>
        </div>
    `);

            colorIndex++; // Increment the color index for the next row
        });



        $(document).on('blur', '#tags input', function() {
            // alert('hi');
            getUpdateSKUFunctionality();
        });

        $(document).on('blur', '.color_value', function() {
            // alert('hi');
            getUpdateSKUFunctionality();
        });


        function getUpdateSKUFunctionality() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ route('admin-products-sku-combination') }}",
                data: $('#geniusform').serialize(),
                success: function(data) {
                    $('#sku_combination').html(data.view);
                    // updateProductQuantity();
                    // updateProductQuantityByKeyUp()
                    // let productType = elementProductTypeByID.val();
                    // if (productType && productType.toString() === 'physical') {
                        // if (data.length > 1) {
                            // $('#quantity').hide();
                        // } else {
                            // $('#quantity').show();
                        // }
                    }
                    // generateSKUPlaceHolder();
                    // removeSymbol();
                
            });
        }



        $(document).on('change', 'input[type="file"][name^="product_images"]', function(event) {
            const files = event.target.files;
            const dataId = $(this).data('id');
            const previewDiv = $(`#product_preview_${dataId}`);
            previewDiv.html(''); // Clear previous previews

            if (files) {
                Array.from(files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewDiv.append(`<img src="${e.target.result}" alt="Image Preview" style="max-width: 100%; height: 50px; margin: 5px;">`);
                    };
                    reader.readAsDataURL(file);
                });
            }
        });


        $(document).on('change', 'input[type="file"][name="color_img[]"]', function(event) {

            const file = event.target.files[0];
            const dataId = $(this).data('id');
            // alert(dataId);
            const previewDiv = $(`#preview_${dataId}`);

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewDiv.html(`<img src="${e.target.result}" alt="Image Preview" style="max-width: 100%; height: 50px;">`);
                };
                reader.readAsDataURL(file);
            } else {
                previewDiv.html('');
            }
        });



        $(document).on('click', '.color-remove', function() {

            $(this.parentNode).remove();
            if (isEmpty($('#color-section'))) {

                $("#color-section").append('' +
                    '<div class="color-area">' +
                    '<span class="remove color-remove"><i class="fas fa-times"></i></span>' +
                    '<div class="input-group colorpicker-component cp">' +
                    '<input type="text" value="#000000" class="input-field cp tcolor"/>' +
                    '<span class="input-group-addon"><i></i></span>' +
                    '</div>' +
                    '</div>' +
                    '');
                $('.cp').colorpicker();
            }

            getColor();


        });

        // Color Section Ends


        // Tsize Section


        function getSize() {

            if ($('.tsize').length > 0) {
                tsize = $(".tsize").map(function() {
                    return $(this).val().replace(/,/g, '');
                }).get();
            }
            tsizeText = '';
            tsize.forEach(getSizeText);

        }

        function getSizeText(item, index) {
            tsizeText += `<option value="${item}">${item}</option>`;
            $('.size-name').html(tsizeText);
        }

        function getSize1() {

            if ($('.tsize').length > 0) {
                tsize = $(".tsize").map(function() {
                    return $(this).val().replace(/,/g, '');
                }).get();
            }
            tsizeText = '';
            tsize.forEach(getSizeText1);

        }

        function getSizeText1(item, index) {
            tsizeText += `<option value="${item}">${item}</option>`;
        }



        $(document).on('change', '.tsize', function() {
            getSize();
        });

        $("#tsize-btn").on('click', function() {

            $("#tsize-section").append(
                '<div class="tsize-area">' +
                '<span class="remove tsize-remove"><i class="fas fa-times"></i></span>' +
                '<input  type="text" class="input-field tsize" name="size_all[]" placeholder="{{ __("Enter Product Size") }}"  required="">' +
                '</div>'
            );

            getSize();

        });


        $(document).on('click', '.tsize-remove', function() {

            $(this.parentNode).remove();
            if (isEmpty($('#tsize-section'))) {

                $("#tsize-section").append(
                    '<div class="tsize-area">' +
                    '<span class="remove tsize-remove"><i class="fas fa-times"></i></span>' +
                    '<input  type="text" class="input-field tsize" placeholder="{{ __("Enter Product Size") }}"  required="">' +
                    '</div>'
                );

            }

            getSize();

        });

        // Tsize Section Ends


        // Feature Section

        $("#feature-btn").on('click', function() {

            $("#feature-section").append('' +
                '<div class="feature-area">' +
                '<span class="remove feature-remove"><i class="fas fa-times"></i></span>' +
                '<div  class="row">' +
                '<div class="col-lg-6">' +
                '<input type="text" name="features[]" class="input-field" placeholder="{{ __("Enter Your Keyword") }}">' +
                '</div>' +
                '<div class="col-lg-6">' +
                '<div class="input-group colorpicker-component cp">' +
                '<input type="text" name="colors[]" value="#000000" class="input-field cp"/>' +
                '<span class="input-group-addon"><i></i></span>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '');
            $('.cp').colorpicker();
        });

        $(document).on('click', '.feature-remove', function() {

            $(this.parentNode).remove();
            if (isEmpty($('#feature-section'))) {

                $("#feature-section").append('' +
                    '<div class="feature-area">' +
                    '<span class="remove feature-remove"><i class="fas fa-times"></i></span>' +
                    '<div  class="row">' +
                    '<div class="col-lg-6">' +
                    '<input type="text" name="features[]" class="input-field" placeholder="{{ __("Enter Your Keyword") }}">' +
                    '</div>' +
                    '<div class="col-lg-6">' +
                    '<div class="input-group colorpicker-component cp">' +
                    '<input type="text" name="colors[]" value="#000000" class="input-field cp"/>' +
                    '<span class="input-group-addon"><i></i></span>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '');
                $('.cp').colorpicker();
            }

        });

        // Feature Section Ends
        // Type Check

        $('#type_check').on('change', function() {
            var val = $(this).val();
            if (val == 1) {
                $('.row.file').css('display', 'flex');
                $('.row.file').find('input[type=file]').prop('required', true);
                $('.row.link').find('textarea').val('').prop('required', false);
                $('.row.link').hide();
            } else {
                $('.row.file').hide();
                $('.row.link').css('display', 'flex');
                $('.row.file').find('input[type=file]').prop('required', false);
                $('.row.link').find('textarea').prop('required', true);
            }

        });

        // Type Check Ends



        // License Section

        $("#license-btn").on('click', function() {

            $("#license-section").append('' +
                '<div class="license-area">' +
                '<span class="remove license-remove"><i class="fas fa-times"></i></span>' +
                '<div  class="row">' +
                '<div class="col-lg-6">' +
                '<input type="text" name="license[]" class="input-field" placeholder="{{ __("License Key") }}" required="">' +
                '</div>' +
                '<div class="col-lg-6">' +
                '<input type="number" name="license_qty[]" min="1" class="input-field" placeholder="{{ __("License Quantity") }}" value="1">' +
                '</div>' +
                '</div>' +
                '</div>' +
                '');
        });

        $(document).on('click', '.license-remove', function() {

            $(this.parentNode).remove();
            if (isEmpty($('#license-section'))) {

                $("#license-section").append('' +
                    '<div class="license-area">' +
                    '<span class="remove license-remove"><i class="fas fa-times"></i></span>' +
                    '<div  class="row">' +
                    '<div class="col-lg-6">' +
                    '<input type="text" name="license[]" class="input-field" placeholder="{{ __("License Key") }}" required="">' +
                    '</div>' +
                    '<div class="col-lg-6">' +
                    '<input type="number" name="license_qty[]" min="1" class="input-field" placeholder="{{ __("License Quantity") }}" value="1">' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '');
            }

        });

        // License Section Ends

        $("#size-check").change(function() {
            if (this.checked) {
                $("#size-display").show();
                $("#stckprod").hide();
            } else {
                $("#size-display").hide();
                $("#stckprod").show();

            }
        });

        $("#whole_check").change(function() {
            if (this.checked) {
                $("#whole-section input").prop('required', true);
            } else {
                $("#whole-section input").prop('required', false);
            }
        });


        // Whole Sell Section

        $("#whole-btn").on('click', function() {

            if (whole_sell > $("[name='whole_sell_qty[]']").length) {
                $("#whole-section").append('' +
                    '<div class="feature-area">' +
                    '<span class="remove whole-remove"><i class="fas fa-times"></i></span>' +
                    '<div  class="row">' +
                    '<div class="col-lg-6">' +
                    '<input type="number" name="whole_sell_qty[]" class="input-field" placeholder="{{ __("Enter Quantity") }}" min="0">' +
                    '</div>' +
                    '<div class="col-lg-6">' +
                    '<input type="number" name="whole_sell_discount[]" class="input-field" placeholder="{{ __("Enter Price") }}" min="0">' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '');
            }

        });

        $(document).on('click', '.whole-remove', function() {

            $(this.parentNode).remove();
            if (isEmpty($('#whole-section'))) {

                $("#whole-section").append('' +
                    '<div class="feature-area">' +
                    '<span class="remove whole-remove"><i class="fas fa-times"></i></span>' +
                    '<div  class="row">' +
                    '<div class="col-lg-6">' +
                    '<input type="number" name="whole_sell_qty[]" class="input-field" placeholder="{{ __("Enter Quantity") }}" min="0">' +
                    '</div>' +
                    '<div class="col-lg-6">' +
                    '<input type="number" name="whole_sell_discount[]" class="input-field" placeholder="{{ __("Enter Price") }}" min="0">' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '');
            }

        });

        // Whole Sell Section Ends


    })(jQuery);
</script>