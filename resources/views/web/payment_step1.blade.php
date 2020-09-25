@extends('layout.main')

@section('content')

    <div class="card" style="width: 100%; margin-bottom: 20px;">
        <div class="card-body">
            @component('components.list_horizontal')
                @slot('id', 'products')
                @slot('products' , $products)
                @slot('number' , 'true')
                @slot('base_url' , "https://www.cheemarket.com/product/?productid=")
            @endcomponent
        </div>
    </div>

    <form action="{{ route('web_payment') }}" target="_self" method="POST">
        @csrf

        <div class="card" style="width: 100%; margin-bottom: 20px;">
            <div class="card-body">
                <div class="form-group" style="direction:  rtl;">
                    <label for="exampleFormControlSelect1" style="width: 100%; text-align: center; font-size: 30px;">انتخاب
                        آدرس</label>
                    <select class="form-control"  name="address" id="exampleFormControlSelect1" style="direction:  rtl;">
                        @foreach($address as $item)
                            <option>{{ $item['address'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="card" style="width: 100%; margin-bottom: 20px;">
            <div class="card-body">

                <div align="right" style="width: 100%">

                    <input type="radio" @if($fast == 'no') checked="checked" @endif name="time_radio" value="time"> تعیین
                    زمان تحویل سفارش<br>
                    <input type="radio" @if($fast == 'yes') checked="checked" @endif name="time_radio" value="fast"
                           @if($fast == 'no') disabled @endif > تحویل فوری (2 ساعت پس از ثبت سفارش)<br>

                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group" style="direction:  rtl;">
                            <label for="exampleFormControlSelect1"
                                   style="width: 100%; text-align: center; font-size: 30px;">زمان تحویل</label>
                            <select class="form-control" id="exampleFormControlSelect1"  name="time" style="direction:  rtl;">
                                @foreach($times as $item)
                                    @foreach($item as $inner_item)
                                        <option>{{ $inner_item }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="card" style="width: 100%;">
            <div class="card-body" style="direction: rtl;">
                <div class="card" style="width: 100%;">
                    <div class="card-body" style="direction: rtl;">
                        <div class="row">
                            <div class="col-6">
                                قیمت بدون تخفیف
                            </div>
                            <div class="col-6" align="right">
                                <del style="color: red;">{{$price_whitout_off}} تومان</del>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" style="width: 100%;">
                    <div class="card-body" style="direction: rtl;">
                        <div class="row">
                            <div class="col-6">
                                مقدار تخفیف
                            </div>
                            <div class="col-6" align="right">
                                {{$off}} تومان
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" style="width: 100%;">
                    <div class="card-body" style="direction: rtl;">
                        <div class="row">
                            <div class="col-6">
                                قیمت با تخفیف
                            </div>
                            <div class="col-6" align="right">
                                {{$price_whit_off}} تومان
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" style="width: 100%;">
                    <div class="card-body" style="direction: rtl;">
                        <div class="row">
                            <div class="col-6">
                                هزینه پیک
                            </div>
                            <div class="col-6" align="right">
                                {{$price_cour}}{{($price_cour == "رایگان")? "" : " تومان "}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" style="width: 100%;">
                    <div class="card-body" style="direction: rtl;">
                        <div class="row">
                            <div class="col-6">
                                قیمت نهایی
                            </div>
                            <div class="col-6" align="right">
                                {{$price_final}} تومان
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div style="width: 100%; text-align: center; font-size: 30px; margin: 15px; color: #34ce57">
            {{$max_price_text}}
        </div>

        <div class="card" style="width: 100%; margin-bottom: 20px;">
            <div class="card-body">

                <div class="form-check" style="direction: rtl;">
                    <input class="form-check-input" type="radio" name="payment" id="exampleRadios1"
                           value="online" checked>
                    <label class="form-check-label" for="exampleRadios1"
                           style="width: 100%; text-align: right; margin-right: 20px;">
                        پرداخت آنلاین
                    </label>
                </div>
                <div class="form-check" style="direction: rtl;">
                    <input class="form-check-input" type="radio" name="payment" id="exampleRadios2"
                           value="offline">
                    <label class="form-check-label" for="exampleRadios2"
                           style="width: 100%; text-align: right; margin-right: 20px;">
                        پرداخت درب منزل با کارت بانکی
                    </label>
                </div>
                <div class="form-check disabled" hidden>
                    <input class="form-check-input" type="radio" name="payment" id="exampleRadios3"
                           value="option3" disabled>
                    <label class="form-check-label" for="exampleRadios3">
                        Disabled radio
                    </label>
                </div>

                <button type="submit" class="btn btn-success" style="width: 100%; margin-top: 15px;">ثبت سفارش</button>
            </div>
        </div>
    </form>


@endsection
