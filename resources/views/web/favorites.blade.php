@extends('layout.main')

@section('content')


    @if(isset($products))
        @component('components.list')
            @slot('products', $products)
            @slot('location', 'false')
            @slot('category', 'false')
            @slot('page_number', 'false')
            @slot('Favorites', 'true')
            @slot('base_url' , "https://www.cheemarket.com/product/?productid=")
        @endcomponent
    @endif


@endsection
