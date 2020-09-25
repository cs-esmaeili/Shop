@section('head')
    <link rel="stylesheet" type="text/css" href="/resources/plugins/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="/resources/styles/main_styles.css">
    <style>
        .col {
            padding: 0;
            margin: 0;
        }
    </style>
@endsection

@section('script')
    <script src="/resources/plugins/owl.carousel.js"></script>
    <script id="custom_js_data" data-name="{{ $id }}" src="/resources/js/custom.js"></script>
@endsection

<div class="col" >
    <div id="{{$id}}" class="product_slider_container">
        <div id="{{$id}}" class="owl-carousel product_slider">
            @foreach($category as $item)
                <a href="{{ route('web_subcategory',['main_category_id' => $item['main_category_id']]) }}">
                    <img src="{{ $item['image'] }}"
                         style="width: 270px; height: 180px;  border-radius: 50%; border-color: #1d2124; border-style: solid;">
                </a>
            @endforeach

        </div>

        <div id="{{$id}}"
             class="product_slider_nav_left product_slider_nav d-flex align-items-center justify-content-center flex-column">
            <i id="{{$id}}" class="fa fa-chevron-left" aria-hidden="true"></i>
        </div>

        <div id="{{$id}}"
             class="product_slider_nav_right product_slider_nav d-flex align-items-center justify-content-center flex-column">
            <i id="{{$id}}" class="fa fa-chevron-right" aria-hidden="true"></i>
        </div>

    </div>
</div>



