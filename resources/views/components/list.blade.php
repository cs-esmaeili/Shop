<style>

    /*
** Style Simple Ecommerce Theme for Bootstrap 4
** Created by T-PHP https://t-php.fr/43-theme-ecommerce-bootstrap-4.html
*/
    .bloc_left_price {
        color: #c01508;
        text-align: center;
        font-weight: bold;
        font-size: 150%;
    }

    .category_block li:hover {
        background-color: #007bff;
    }

    .category_block li:hover a {
        color: #ffffff;
    }

    .category_block li a {
        color: #343a40;
    }

    .add_to_cart_block .price {
        color: #c01508;
        text-align: center;
        font-weight: bold;
        font-size: 200%;
        margin-bottom: 0;
    }

    .add_to_cart_block .price_discounted {
        color: #343a40;
        text-align: center;
        text-decoration: line-through;
        font-size: 140%;
    }

    .product_rassurance {
        padding: 10px;
        margin-top: 15px;
        background: #ffffff;
        border: 1px solid #6c757d;
        color: #6c757d;
    }

    .product_rassurance .list-inline {
        margin-bottom: 0;
        text-transform: uppercase;
        text-align: center;
    }

    .product_rassurance .list-inline li:hover {
        color: #343a40;
    }

    .reviews_product .fa-star {
        color: gold;
    }

    .pagination {
        margin-top: 20px;
    }

    footer {
        background: #343a40;
        padding: 40px;
    }

    footer a {
        color: #f8f9fa !important
    }

</style>
<div align="center">
    @if($location === "true")
        <div class="container" style="direction: rtl; padding: 0px; margin: 0px;">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('web_firstpage') }}">خانه</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('web_category') }}">دسته بندی محصولات</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('web_subcategory' , ['main_category_id' => $products['main_category_id']]) }}">{{  $products['title_main'] }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{  $products['title_sub'] }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    @endif
    <div class="container" style="direction: rtl; padding: 0px; margin: 0px;">
        <div class="row">
            @if($category === "true")
                <div class="col-12 col-sm-3">

                    <div class="card-header bg-primary text-white text-uppercase"><i class="fa fa-list"></i> Categories
                    </div>
                    <ul class="list-group category_block" style="padding: 0;">
                        <li class="list-group-item"><a href="category.html">Cras justo odio</a></li>
                        <li class="list-group-item"><a href="category.html">Dapibus ac facilisis in</a></li>
                        <li class="list-group-item"><a href="category.html">Morbi leo risus</a></li>
                        <li class="list-group-item"><a href="category.html">Porta ac consectetur ac</a></li>
                        <li class="list-group-item"><a href="category.html">Vestibulum at eros</a></li>
                    </ul>

                </div>
            @endif
            <div class="col">
                <div class="row">
                    @foreach($products['products'] as $item)
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card" style="margin: 10px;">
                                <a href="{{ $base_url . $item['product_id'] }}">
                                    <img class="card-img-top" src="{{$item['image_thumbnail']}}" alt="Card image cap">
                                    <div class="card-body">
                                        <p style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap;"
                                           align="center"> {{$item['name']}}</p>
                                        <p align="center" style="color: #FF0000">پیشنهاد طلایی</p>
                                        @if($item['old_price'] == 0)
                                            <p align="center" style="color: #FF0000" hidden>
                                                <del> {{$item['old_price']}} </del>
                                            </p>
                                        @else
                                            <p align="center" style="color: #FF0000">
                                                <del> {{$item['old_price']}} </del>
                                            </p>
                                        @endif

                                        <p align="center" style="color: #34ce57"> {{$item['price']}} </p>

                                    </div>
                                </a>
                                @if(isset($Favorites) && $Favorites === "true")
                                    <a href="{{ route('web_deleteFavorites' , ['product_id' => $item['product_id']]) }}">
                                        <button class="btn btn-danger" style="width: 100%;">حذف</button>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    @if($page_number === "true")
                        <div class="col-12">
                            <nav aria-label="...">
                                <ul class="pagination">
                                    <li class="page-item {{ ($active == 1)? "disabled" : ""}}">
                                        <a class="page-link"
                                           href="{{ route('web_subcategory_product' ,  ['product_category' => $products['category']  , 'page_number' => $active -1]) }}"
                                           tabindex="-1">قبلی</a>
                                    </li>
                                    @php($index = 1)
                                    @for($i = 0 ; $i < $products['list']; $i++)
                                        <li class="page-item {{ ($active == $index)? "active" : "" }}">
                                            <a class="page-link"
                                               href="{{ route('web_subcategory_product' , ['product_category' =>  $products['category']  , 'page_number' => $i + 1]) }}">{{ $i + 1 }}
                                                <span
                                                    class="sr-only">(current)</span></a>
                                        </li>
                                        @php($index++)

                                    @endfor
                                    <li class="page-item {{ ($active == $index - 1)? "disabled" : ""}}">
                                        <a class="page-link"
                                           href="{{ route('web_subcategory_product' ,  ['product_category' => $products['category']  , 'page_number' => $active + 1]) }}">بعدی</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

