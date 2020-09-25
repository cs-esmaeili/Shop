@extends('layout.main')

@section('content')
    @foreach($address as $item)
        <div class="card" style="margin: 10px;">
            <div class="card-body">
                <p style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap;"
                   align="right"> {{$item['name']}}</p>
                <p align="right"> استان : {{$item['state']}} شهر : {{$item['city']}}</p>
                <p style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap;"
                   align="right"> {{$item['address']}}</p>
                <p align="right">شماره تماس ثابت : {{$item['home_number']}}</p>
                <p align="right">شماره تماس ضروری : {{$item['phone_number']}}</p>
                <div class="row">
                    <div class="col-6">
                        <a href="{{route('web_address_delete' , ['user_address_id' => $item['user_address_id']])}}">
                            <button type="button" class="btn btn-danger" style="width: 100%">حذف</button>
                        </a>
                    </div>
                    <div class="col-6">
                        <form action="{{ route('web_address_edit') }}" target="_self" method="POST">
                            @csrf
                            <input type="text" value="{{ $item['user_address_id'] }}" name="user_address_id" hidden>
                            <button type="submit" class="btn btn-dark" style="width: 100%">ویرایش</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="card" style="margin: 10px;">
        <div class="card-body">
            <a href="{{ route('web_address_edit') }}" target="_self">
                <button type="button" class="btn btn-success" style=" width: 100%;">افزودن آدرس</button>
            </a>
        </div>
    </div>

@endsection
