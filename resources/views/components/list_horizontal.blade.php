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

<div class="col">
    <div id="{{$id}}" class="product_slider_container">
        <div id="{{$id}}" class="owl-carousel product_slider">
            @foreach($products as $item)
                <div class="card">
                    <a href="{{ $base_url . $item['product_id'] }}">
                        <img class="card-img-top" src="{{$item['image_thumbnail']}}" alt="Card image cap">
                        <div class="card-body">
                            <p align="center"
                               style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap;"> {{$item['name']}}</p>
                            <p align="center" style="color: #FF0000">پیشنهاد طلایی</p>
                            @if($item['old_price'] == 0)
                                <p align="center" style="color: #FF0000" hidden>
                                    <del> {{$item['old_price']}} </del>
                                </p>
                            @else
                                <p align="center" style="color: #FF0000">
                                    <del> {{$item['old_price']}} </del>
                                </p>
                            @endif

                            <p align="center" style="color: #34ce57"> {{$item['price']}} </p>

                            @if(isset($number) && $number === "true")
                                <p align="center" style="direction: rtl;">تعداد انتخاب شده : {{$item['number']}}</p>
                            @endif
                        </div>
                    </a>
                </div>
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



