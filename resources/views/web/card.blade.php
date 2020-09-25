@extends('layout.main')
@section('head')
    <style>
        span {
            cursor: pointer;
        }

        .minus, .plus {
            -webkit-touch-callout: none; /* iOS Safari */
            -webkit-user-select: none; /* Safari */
            -khtml-user-select: none; /* Konqueror HTML */
            -moz-user-select: none; /* Firefox */
            -ms-user-select: none; /* Internet Explorer/Edge */
            user-select: none;
            /* Non-prefixed version, currently
                                               supported by Chrome and Opera */
        }

        .minus, .plus {
            width: 20px;
            height: 20px;
            background: #f2f2f2;
            border-radius: 4px;
            padding: 8px 5px 8px 5px;
            border: 1px solid #ddd;
            vertical-align: middle;
            text-align: center;
        }

        input {
            height: 34px;
            width: 100px;
            text-align: center;
            font-size: 26px;
            border: 1px solid #ddd;
            border-radius: 4px;
            display: inline-block;
            vertical-align: middle;
        }
    </style>
@endsection
{{--@section('script')--}}
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $('.minus').click(function () {--}}
{{--                var $input = $(this).parent().find('input');--}}
{{--                var count = parseInt($input.val()) - 1;--}}
{{--                count = count < 1 ? 1 : count;--}}
{{--                $input.val(count);--}}
{{--                $input.change();--}}
{{--                return false;--}}
{{--            });--}}
{{--            $('.plus').click(function () {--}}
{{--                var $input = $(this).parent().find('input');--}}
{{--                if (parseInt($input.val()) + 1 <= 10) {--}}
{{--                    $input.val(parseInt($input.val()) + 1);--}}
{{--                }--}}
{{--                $input.change();--}}
{{--                return false;--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--@endsection--}}
@section('content')

    @if($products == null)
        <div align="center" style="margin: 20px;">
            سبد خرید شما خالی است
        </div>
    @else
        @foreach($products as $item)
            <div class="card" style="margin: 10px;">
                <div class="card-body">
                    <div class="row align-items-center" style="direction: rtl;" style="padding: 10px">
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <img src="{{$item['image_thumbnail']}}" height="360">
                        </div>
                        <div align="right" class="col-sm-12 col-md-12 col-lg-6" style="padding-bottom: 10px;">
                            <div>
                                <span>نام کالا: {{ $item['name'] }}</span>
                            </div>
                            @if( $item['old_price'] != 0)
                                <div style="color: #FF0000; padding-top: 10px"><span> <del> {{ $item['old_price'] . " تومان" }} </del></span>
                                </div>
                            @endif
                            <div style="color: #34ce57; padding: 10px;"><span>  {{ $item['price'] . " تومان" }} </span>
                            </div>
                            <div>
                                <span id="{{ $item['product_id'] }}">کد کالا: {{ $item['product_id'] }}</span>
                            </div>

                            <div class="number" style="margin: 15px;">
                                <a href="{{route('web_card_mines' , ['product_id' =>  $item['product_id']])}}"
                                   target="_self"><span type="submit" class="minus">-</span></a>
                                <input type="text" value="{{ $item['number']  }}"/>
                                <a href="{{route('web_card_plus', ['product_id' =>  $item['product_id']])}}"
                                   target="_self"><span type="submit" class="plus">+</span></a>
                            </div>

                            <div align="center">
                                <a href="{{ route('web_delete_card' , ['product_id' =>  $item['product_id'] ]) }}"
                                   target="_self">
                                    <button type="button" class="btn btn-danger"
                                            style="width: 100%; padding-bottom: 10px;">
                                        حذف
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div>
            <a href="{{ route('web_payment_step1') }}"
               target="_self">
                <button type="button" class="btn btn-success" style="width: 100%; padding-bottom: 10px;">
                    مرحله بعدی خرید
                </button>
            </a>
        </div>
    @endif


@endsection
