@extends('layout.main')

@section('content')
    @component('components.list')
        @slot('products', $products)
        @slot('active', $active)
        @slot('location', 'true')
        @slot('category', 'false')
        @slot('page_number', 'true')
        @slot('base_url' , "https://www.cheemarket.com/product/?productid=")
    @endcomponent
@endsection
