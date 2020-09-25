@extends('layout.main')

@section('content')

    <div align="center">
    @foreach($category as $item)
     <a href="{{ route('web_subcategory',['main_category_id' => $item['main_category_id']]) }}">
         <img src="{{ $item['image'] }}" style="width: 380px; height: 280px;">
     </a>
    @endforeach
    </div>
@endsection
