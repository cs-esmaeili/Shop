@extends('layout.main')

@section('content')
    <div class="card" style="width: 100%; margin-bottom: 20px;">
        <div class="card-body">
            @component('components.list_horizontal')
                @slot('id', 'products')
                @slot('products' , $info['products'])
                @slot('number' , 'true')
                @slot('base_url' , "https://www.cheemarket.com/product/?productid=")
            @endcomponent
        </div>
    </div>

    <div class="card" style="width: 100%; margin-bottom: 20px; direction: rtl;">
        <div class="card-body">
            <div class="card" style="width: 100%; margin-bottom: 20px; direction: rtl;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6" align="right">
                            نام و نام خانوادگی
                        </div>
                        <div class="col-6" align="right">
                            {{$info['name']}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="card" style="width: 100%; margin-bottom: 20px; direction: rtl;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6" align="right">
                            شماره تلفن همراه
                        </div>
                        <div class="col-6" align="right">
                            {{$info['phone_number']}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" style="width: 100%; margin-bottom: 20px; direction: rtl;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6" align="right">
                            شماره ثابت
                        </div>
                        <div class="col-6" align="right">
                            {{$info['home_number']}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" style="width: 100%; margin-bottom: 20px; direction: rtl;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6" align="right">
                            کد پستی
                        </div>
                        <div class="col-6" align="right">
                            {{$info['postal_code']}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" style="width: 100%; margin-bottom: 20px; direction: rtl;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6" align="right">
                            استان
                        </div>
                        <div class="col-6" align="right">
                            {{$info['state']}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" style="width: 100%; margin-bottom: 20px; direction: rtl;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6" align="right">
                            شهرستان
                        </div>
                        <div class="col-6" align="right">
                            {{$info['city']}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" style="width: 100%; margin-bottom: 20px; direction: rtl;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6" align="right">
                            قیمت تغییرات وزن
                        </div>
                        <div class="col-6" align="right">
                            {{$info['price_weight']}} تومان
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" style="width: 100%; margin-bottom: 20px; direction: rtl;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6" align="right">
                            آدرس
                        </div>
                        <div class="col-6" align="right">
                            {{$info['address']}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        body {
            margin-top: 40px;
        }

        .stepwizard-step p {
            margin-top: 10px;
        }

        .stepwizard-row {
            display: table-row;
        }

        .stepwizard {
            display: table;
            width: 50%;
            position: relative;
        }

        .stepwizard-step button[disabled] {
            opacity: 1 !important;
            filter: alpha(opacity=100) !important;
        }

        .stepwizard-row:before {
            top: 14px;
            bottom: 0;
            position: absolute;
            content: " ";
            width: 100%;
            height: 1px;
            background-color: #ccc;
            z-order: 0;
        }

        .stepwizard-step {
            display: table-cell;
            text-align: center;
            position: relative;
        }

        .btn-circle {
            width: 30px;
            height: 30px;
            text-align: center;
            padding: 6px 0;
            font-size: 12px;
            line-height: 1.428571429;
            border-radius: 15px;
        }
    </style>
    <div class="container" style="width: 100%;">

        <div class="stepwizard col-md-offset-3" style="width: 100%;">

            <div class="stepwizard-row setup-panel">

                <div class="stepwizard-step">
                    <a href="" type="button" class="btn btn-primary btn-circle">1</a>
                    <p>پردازش</p>
                </div>
                <div class="stepwizard-step">
                    <a href="" type="button" class="btn {{ ($status != 1)? "btn-primary": "btn-default" }} btn-circle" disabled="disabled">2</a>
                    <p>ارجاع به انبار</p>
                </div>
                <div class="stepwizard-step">
                    <a href="" type="button" class="btn {{ ($status == 7 ||$status == 8)? "btn-primary": "btn-default" }} btn-circle" disabled="disabled">3</a>
                    <p>تحویل به پیک</p>
                </div>
                <div class="stepwizard-step">
                    <a href="" type="button" class="btn  {{ ($status == 8)? "btn-primary": "btn-default" }} btn-circle" disabled="disabled">4</a>
                    <p>تحویل سفارش</p>
                </div>
            </div>
        </div>

    </div>
@endsection
