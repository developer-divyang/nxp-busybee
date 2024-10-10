@if(count($combinations[0]) > 0)
<table class="table physical_product_show table-borderless">
    <thead class="thead-light thead-50 text-capitalize">
        <tr>
            <th class="text-center">
                <label for="" class="control-label">
                    {{ __('SL') }}
                </label>
            </th>
            <th class="text-center">
                <label for="" class="control-label">
                    {{ __('attribute_Variation') }}
                </label>
            </th>
            
            
            <th class="text-center">
                <label for="" class="control-label">{{ __('Variation_Wise_Stock') }}</label>
            </th>
        </tr>
    </thead>
    <tbody>

        @php
        $serial = 1;
        @endphp

        @foreach ($combinations as $key => $combination)
        @php
        $sku = '';
        foreach (explode(' ', $productName) as $value) {
        $sku .= substr($value, 0, 1);
        }

        $str = '';
        foreach ($combination as $index => $item){
        if($index > 0 ){
        $str .= '-'.str_replace(' ', '', $item);
        $sku .='-'.str_replace(' ', '', $item);
        }
        else{
        if($colorsActive == 1){
        $color_name = \App\Models\Color::where('color_name', $item)->first()?->name ?? $item;
        $str .= $color_name;
        $sku .='-'.$color_name;
        }
        else{
        $str .= str_replace(' ', '', $item);
        $sku .='-'.str_replace(' ', '', $item);
        }
        }
        }
        @endphp

        @if(strlen($str) > 0)
        <tr>
            <td class="text-center">
                {{ $serial++ }}
            </td>
            <td>
                <label for="" class="control-label">{{ $str }}</label>
            </td>
           
           
            <td>
                <input type="number" name="qty_{{ $str }}" value="1" min="1"
                    max="1000000" step="1" class="form-control remove-symbol" required
                    placeholder="{{ __('ex') }}: 5">
            </td>
        </tr>
        @endif
        @endforeach
    </tbody>
</table>
@endif