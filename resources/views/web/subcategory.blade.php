@extends('layout.main')

@section('content')
    <div align="center">
        @foreach($subcategory as $item)
            <a href="{{ route('web_subcategory_product',['product_category' => $item->category , 'page_number' => 1 ]) }}">
                <img src="{{ $item->image }}" style="width: 100%; height: 25vh;">
            </a>
        @endforeach
    </div>
@endsection
