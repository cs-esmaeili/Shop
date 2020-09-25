@extends('layout.main')

@section('content')

    @component('components.slider')
        @slot('id', 'slider')
        @slot('class' , 'carousel slide')
        @slot('images' , $slider)
        @slot('height' , '360vh')
    @endcomponent

    <div style="margin: 10px;">
        @component('components.maincategory_circle')
            @slot('id', 'main_category')
            @slot('category' , $category)
        @endcomponent
    </div>

    <style>

        .timer_text {
            font-size: 3vw;
        }

        @media (min-width: 1258px) {
            .timer_position {
                top: 1vh;
                left: 5vw;
            }

        }

        @media (max-width: 1258px) {
            .timer_position {
                top: 2vh;
                left: 5vw;
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
             style="width: 100%;height: 90px;  margin-top: 10px; margin-bottom: 10px;">
        <div class="position-absolute timer_position">
            @component('components.timer')
                @slot("time", $time)
                @slot("color", "white")
            @endcomponent
        </div>
    </div>
    @component('components.list_horizontal')
        @slot('id', 'gold_products')
        @slot('products' , $gold)
        @slot('base_url' , "https://www.cheemarket.com/product/?productid=")
    @endcomponent
    <img src="{{ asset('/images/web/porforoshtarinmahsolat.png') }}"
         style="width: 100%;height: 90px;  margin-top: 10px; margin-bottom: 10px;">
    @component('components.list_horizontal')
        @slot('id', 'sales_products')
        @slot('products' , $many)
        @slot('base_url' , "https://www.cheemarket.com/product/?productid=")
    @endcomponent
    <img src="{{ asset('/images/web/mahbodtarinmahsolat.png') }}"
         style="width: 100%;height: 90px; margin-top: 10px; margin-bottom: 10px;">
    @component('components.list_horizontal')
        @slot('id', 'new_products')
        @slot('products' , $new)
        @slot('base_url' , "https://www.cheemarket.com/product/?productid=")
    @endcomponent

@endsection

