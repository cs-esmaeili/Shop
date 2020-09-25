@extends('layout.main')

@section('content')


    <style>

        button,
        input,
        optgroup,
        select,
        textarea {
            font-family: sans-serif;
            /* 1 */
            font-size: 100%;
            /* 1 */
            line-height: 1.15;
            /* 1 */
            margin: 0;
            /* 2 */
        }

        /**
         * Show the overflow in IE.
         * 1. Show the overflow in Edge.
         */
        button,
        input {
            /* 1 */
            overflow: visible;
        }

        /**
         * Remove the inheritance of text transform in Edge, Firefox, and IE.
         * 1. Remove the inheritance of text transform in Firefox.
         */
        button,
        select {
            /* 1 */
            text-transform: none;
        }

        /**
         * 1. Prevent a WebKit bug where (2) destroys native `audio` and `video`
         *    controls in Android 4.
         * 2. Correct the inability to style clickable types in iOS and Safari.
         */
        button,
        html [type="button"],
        [type="reset"],
        [type="submit"] {
            -webkit-appearance: button;
            /* 2 */
        }

        /**
         * Remove the inner border and padding in Firefox.
         */
        button::-moz-focus-inner,
        [type="button"]::-moz-focus-inner,
        [type="reset"]::-moz-focus-inner,
        [type="submit"]::-moz-focus-inner {
            border-style: none;
            padding: 0;
        }

        /**
         * Restore the focus styles unset by the previous rule.
         */
        button:-moz-focusring,
        [type="button"]:-moz-focusring,
        [type="reset"]:-moz-focusring,
        [type="submit"]:-moz-focusring {
            outline: 1px dotted ButtonText;
        }


        /**
         * Remove the inner padding and cancel buttons in Chrome and Safari on macOS.
         */
        [type="search"]::-webkit-search-cancel-button,
        [type="search"]::-webkit-search-decoration {
            -webkit-appearance: none;
        }

        .s003 {

            -ms-flex-pack: center;
            justify-content: center;
            -ms-flex-align: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
        }

        .s003 form {
            width: 100%;
            margin-bottom: 0;
        }

        .s003 form .inner-form {
            background: #fff;
            display: -ms-flexbox;
            display: flex;
            width: 100%;
            -ms-flex-pack: justify;
            justify-content: space-between;
            -ms-flex-align: center;
            align-items: center;
            box-shadow: 5px 5px 5px 5px rgba(0, 0, 0, 0.15);
            border-radius: 3px;
        }

        .s003 form .inner-form .input-field {
            height: 68px;
        }

        .s003 form .inner-form .input-field input {
            height: 100%;
            background: transparent;
            border: 0;
            display: block;
            width: 100%;
            padding: 10px 32px;
            font-size: 16px;
            color: #555;
        }

        .s003 form .inner-form .input-field input.placeholder {
            color: #888;
            font-size: 16px;
        }

        .s003 form .inner-form .input-field input:-moz-placeholder {
            color: #888;
            font-size: 16px;
        }

        .s003 form .inner-form .input-field input::-webkit-input-placeholder {
            color: #888;
            font-size: 16px;
        }

        .s003 form .inner-form .input-field input:hover, .s003 form .inner-form .input-field input:focus {
            box-shadow: none;
            outline: 0;
            border-color: #fff;
        }

        .s003 form .inner-form .input-field.first-wrap {
            width: 200px;
            border-right: 1px solid rgba(0, 0, 0, 0.1);
        }

        .s003 form .inner-form .input-field.first-wrap .choices__inner {
            background: transparent;
            border-radius: 0;
            border: 0;
            height: 100%;
            color: #fff;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding: 10px 30px;
        }

        .s003 form .inner-form .input-field.first-wrap .choices__inner .choices__list.choices__list--single {
            display: -ms-flexbox;
            display: flex;
            padding: 0;
            -ms-flex-align: center;
            align-items: center;
            height: 100%;
        }

        .s003 form .inner-form .input-field.first-wrap .choices__inner .choices__item.choices__item--selectable.choices__placeholder {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            height: 100%;
            opacity: 1;
            color: #888;
        }

        .s003 form .inner-form .input-field.first-wrap .choices__inner .choices__list--single .choices__item {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            height: 100%;
            color: #555;
        }

        .s003 form .inner-form .input-field.first-wrap .choices[data-type*="select-one"]:after {
            right: 30px;
            border-color: #e5e5e5 transparent transparent transparent;
        }

        .s003 form .inner-form .input-field.first-wrap .choices__list.choices__list--dropdown {
            border: 0;
            background: #fff;
            padding: 20px 30px;
            margin-top: 2px;
            border-radius: 4px;
            box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
        }

        .s003 form .inner-form .input-field.first-wrap .choices__list.choices__list--dropdown .choices__item--selectable {
            padding-right: 0;
        }

        .s003 form .inner-form .input-field.first-wrap .choices__list--dropdown .choices__item--selectable.is-highlighted {
            background: #fff;
            color: #63c76a;
        }

        .s003 form .inner-form .input-field.first-wrap .choices__list--dropdown .choices__item {
            color: #555;
            min-height: 24px;
        }

        .s003 form .inner-form .input-field.second-wrap {
            -ms-flex-positive: 1;
            flex-grow: 1;
        }

        .s003 form .inner-form .input-field.third-wrap {
            width: 74px;
        }

        .s003 form .inner-form .input-field.third-wrap .btn-search {
            height: 100%;
            width: 100%;
            white-space: nowrap;
            color: #fff;
            border: 0;
            cursor: pointer;
            background: #63c76a;
            transition: all .2s ease-out, color .2s ease-out;
        }

        .s003 form .inner-form .input-field.third-wrap .btn-search svg {
            width: 16px;
        }

        .s003 form .inner-form .input-field.third-wrap .btn-search:hover {
            background: #50c058;
        }

        .s003 form .inner-form .input-field.third-wrap .btn-search:focus {
            outline: 0;
            box-shadow: none;
        }

        @media screen and (max-width: 992px) {
            .s003 form .inner-form .input-field {
                height: 50px;
            }
        }

        @media screen and (max-width: 767px) {
            .s003 form .inner-form {
                -ms-flex-wrap: wrap;
                flex-wrap: wrap;
                padding: 20px;
            }

            .s003 form .inner-form .input-field {
                margin-bottom: 20px;
                border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            }

            .s003 form .inner-form .input-field input {
                padding: 10px 15px;
            }

            .s003 form .inner-form .input-field.first-wrap {
                width: 100%;
                border-right: 0;
            }

            .s003 form .inner-form .input-field.first-wrap .choices__inner {
                padding: 10px 15px;
            }

            .s003 form .inner-form .input-field.first-wrap .choices[data-type*="select-one"]:after {
                right: 11.5px;
                border-color: #e5e5e5 #e5e5e5 #e5e5e5 #e5e5e5;
            }

            .s003 form .inner-form .input-field.second-wrap {
                width: 100%;
                margin-bottom: 30px;
            }

            .s003 form .inner-form .input-field.second-wrap input {
                border: 1px solid rgba(255, 255, 255, 0.3);
            }

            .s003 form .inner-form .input-field.third-wrap {
                margin-bottom: 0;
                width: 100%;
            }
        }

    </style>
    <div align="center">
        <div class="s003" style="max-width: 1140px; padding: 0px;  margin: 0px;">
            <form action="{{ route('web_search') }}" target="_self" method="POST">

                @csrf
                <div class="inner-form" style="direction: rtl; padding: 0px;  margin: 0px; margin-bottom: 20px;">

                    <div class="input-field second-wrap">
                        <input name="text" type="text"  @if(isset($text)) value="{{$text}}" @endif placeholder="جستجو در چی مارکت..."/>
                    </div>
                    <div class="input-field third-wrap">
                        <button class="btn-search" type="Submit">
                            <svg class="svg-inline--fa fa-search fa-w-16" aria-hidden="true" data-prefix="fas"
                                 data-icon="search" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path fill="currentColor"
                                      d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>
    @if(isset($products))
        @component('components.list')
            @slot('products', $products)
            @slot('location', 'false')
            @slot('category', 'false')
            @slot('page_number', 'false')
            @slot('base_url' , "https://www.cheemarket.com/product/?productid=")
        @endcomponent
    @endif
@endsection
