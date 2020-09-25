@extends('layout.main')

@section('content')

    @foreach($orders as $item)
        <a href="{{ route('web_order_information', ['factor_id' => $item['factor_id']]) }}" target="_self">
            <div class="card" style="width: 100%; direction: rtl; margin-bottom: 20px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6" align="right">
                            کد سفارش
                        </div>
                        <div class="col-6">
                            {{$item['factor_id']}}
                        </div>
                    </div>
                    <hr style="background: red; height: 5px;">
                    <div align="center">
                        اطلاعات سفارش
                    </div>
                    <hr style="background: red; height: 5px;">
                    <div class="row">
                        <div class="col-6" align="right">
                            مبلغ کل
                        </div>
                        <div class="col-6" style="color: green;">
                            {{$item['sum']}} تومان
                        </div>
                    </div>
                </div>
            </div>
        </a>
    @endforeach

@endsection
