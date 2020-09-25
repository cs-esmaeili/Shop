@extends('layout.main')

@section('content')

    <div class="row align-items-center" style="direction: rtl;" style="padding: 10px">

        <div class="col-sm-12 col-md-12 col-lg-6">
            @component('components.slider')
                @slot('id', 'slider')
                @slot('class' , 'carousel slide')
                @slot('images' , $images)
                @slot('height' , '360')
            @endcomponent
        </div>
        <div align="right" class="col-sm-12 col-md-12 col-lg-6" style="padding-bottom: 10px;">
            <div>
                <span>نام کالا: {{ $product['name'] }}</span>
            </div>
            <div>
                <span>کد کالا: {{ $product['product_id'] }}</span>
            </div>
            <div>
                <a href="{{ route('web_addFavorites', ['product_id' =>  $product['product_id'] ]) }}" target="_blank">
                    <img src="{{ asset('/images/web/iconlikeok.png') }}" width="50px" height="30">
                </a>
            </div>
            @if($product['status'] == 2)
                <div>
                    <style>
                        .timer_text {
                            font-size: 2vw;
                        }

                        @media (min-width: 1258px) {
                            .timer_position {
                                top: 2vh;
                                left: 3vw;
                            }

                        }

                        @media (max-width: 1258px) {
                            .timer_position {
                                top: 5vh;
                                left: 3vw;
                            }
                        }

                        @media (max-width: 700px) {
                            .timer_position {
                                top: 2vh;
                                left: 5vw;
                            }

                            .timer_text {
                                font-size: 5vw;
                            }
                        }

                        @media (max-width: 600px) {
                            .timer_position {
                                top: 2vh;
                                left: 7vw;
                            }

                            .timer_text {
                                font-size: 5vw;
                            }
                        }

                        @media (max-width: 400px) {
                            .timer_position {
                                top: 4vh;
                                left: 4vw;
                            }

                            .timer_text {
                                font-size: 7vw;
                            }
                        }
                    </style>

                    <div class="position-relative ">

                        <img src=" {{ asset('/images/web/pishnahadvizhtitle.png') }}"
                             style="width: 100%;height: 70px;  margin-top: 10px; margin-bottom: 10px;">
                        <div class="position-absolute timer_position">
                            @component('components.timer')
                                @slot("time", $time)
                                @slot("color", "white")
                            @endcomponent
                        </div>
                    </div>
                </div>
            @endif
            <div align="center">
                @if( $product['old_price'] != 0)
                    <div style="color: #FF0000; padding-top: 10px"><span> <del> {{ $product['old_price'] . " تومان" }} </del></span>
                    </div>
                @endif
                <div style="color: #34ce57; padding: 10px;"><span>  {{ $product['price'] . " تومان" }} </span></div>
                @php
                    $btn_class = "btn-success";
                if($product['status'] == 3){
                    $btn_class = "btn-danger";
                }else if ($product['status'] == 4){
                    $btn_class = "btn-danger";
                }
                @endphp
                <a href="{{ route('web_add_card' , ['product_id' =>  $product['product_id'] ]) }}" target="_self">
                    <button type="button" class="btn {{$btn_class}}" style="width: 100%; padding-bottom: 10px;"> افزودن
                        به
                        سبد
                        خرید
                    </button>
                </a>

            </div>

        </div>
    </div>



@endsection
