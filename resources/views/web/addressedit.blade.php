@extends('layout.main')

@section('content')

    <form action="{{ route('web_address_edit') }}" target="_self" method="POST">
        @csrf
        @if(isset($data))
            <input hidden value="{{$data['user_address_id']}}" name="user_address_id">
        @endif
        <div class="form-group" style="direction:  rtl;">
            <label for="exampleFormControlInput1" style="width: 100%; text-align: right;">نام و نام خانوادگی</label>
            <input type="text" class="form-control" value="{{ (isset($data))? $data['name'] : "" }}"
                   name="name" id="exampleFormControlInput1">
        </div>
        <div class="form-group" style="direction:  rtl;">
            <label for="exampleFormControlInput1" style="width: 100%; text-align: right;">شماره ثابت به همراه کد
                شهرستان</label>
            <input type="text" class="form-control" value="{{ (isset($data))? $data['home_number'] : "" }}"
                   name="home_number" id="exampleFormControlInput1">
        </div>
        <div class="form-group" style="direction:  rtl;">
            <label for="exampleFormControlInput1" style="width: 100%; text-align: right;">شماره همراه</label>
            <input type="text" class="form-control" value="{{ (isset($data))? $data['phone_number'] : "" }}"
                   name="phone_number" id="exampleFormControlInput1">
        </div>
        <div class="form-group" style="direction:  rtl;">
            <label for="exampleFormControlInput1" style="width: 100%; text-align: right;">کد پستی (اختیاری)</label>
            <input type="text" class="form-control" value="{{ (isset($data))? $data['postal_code'] : "" }}"
                   name="postal_code" id="exampleFormControlInput1">
        </div>
        <div class="row">
            <div class="col-6">
                <select class="form-control">
                    <option>اصفهان</option>
                </select>
            </div>
            <div class="col-6">
                <select class="form-control">
                    <option>اصفهان</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1" style="width: 100%; text-align: right;">آدرس</label>
            <textarea class="form-control" style="direction: rtl;"
                      name="address" id="exampleFormControlTextarea1"
                      rows="3">{{ (isset($data))? $data['address'] : "" }}</textarea>
        </div>

        <button type="Submit" class="btn btn-success" style=" width: 100%; margin-bottom: 15px;">ثبت</button>
    </form>
@endsection
