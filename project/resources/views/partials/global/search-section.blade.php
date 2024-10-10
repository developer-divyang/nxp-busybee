<div class="search-section">
    <div class="category-menu">
        <div class="category-item active" data-category="caps">
            <img src="{{ asset('assets/front/images/one.png') }}" alt="Caps Icon">
            <span>CAPS</span>
        </div>
        <div class="category-item" data-category="shirts">
            <img src="{{ asset('assets/front/images/two.png') }}" alt="Shirts Icon">
            <span>SHIRTS</span>
        </div>
        <div class="category-item" data-category="polo">
            <img src="{{ asset('assets/front/images/three.png') }}" alt="Polo Icon">
            <span>POLO</span>
        </div>
        <div class="category-item" data-category="jackets">
            <img src="{{ asset('assets/front/images/four.png') }}" alt="Jackets Icon">
            <span>JACKETS</span>
        </div>
        <div class="category-item" data-category="bags">
            <img src="{{ asset('assets/front/images/five.png') }}" alt="Bags Icon">
            <span>BAGS</span>
        </div>
        <div class="underline"></div>
    </div>

    <div class="inputFields">
        <form action="{{ route('front.search.products') }}" method="POST" class="search-form">
            @csrf
            <div class="inputs">
                <div class="inputWrapper">
                    <div class="first">
                        <select name="fit" id="fit">
                            <option value="">Select fit</option>
                            <option {{ request()->fit == 'stretch' ? 'selected' : '' }} value="stretch">{{ __('Stretch Fit') }}</option>
                            <option {{ request()->fit == 'adjustable' ? 'selected' : '' }} value="adjustable">{{ __('Adjustable') }}</option>
                        </select>
                        <select name="bill" id="bill">
                            <option {{ request()->bill == 'flat' ? 'selected' : '' }} value="flat">Flat</option>
                            <option {{ request()->bill == 'curved' ? 'selected' : '' }} value="curved">Curved</option>
                        </select>
                    </div>
                    <div class="second">
                        <select name="closure" id="closure">
                            <option value="">Select Closure</option>
                            <option value="snapback">{{ __('Snapback') }}</option>
                            <option value="buckle">{{ __('Buckle') }}</option>
                            <option value="velcro">{{ __('Velcro') }}</option>
                            <option value="n/a">{{ __('N/A') }}</option>
                        </select>
                        <select name="color" class="select2"="color" style="width:100%;">
                            <option value="">Search by Color</option>
                            @foreach (App\Models\Color::groupBy('color_group')->get() as $color)
                            <option {{ request()->color == $color->id ? 'selected' : ''  }} value="{{ $color->id }}">{{ $color->color_group }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                

            </div>
            <button type="submit"><img src="{{ asset('assets/front/images/search.png') }}" alt=""> <br>Search</button>
        </form>
    </div>

    <div class="howItWorks">Not sure where to start? <img src="{{ asset('assets/front/images/howItWorks.png') }}" alt=""></div>
</div>