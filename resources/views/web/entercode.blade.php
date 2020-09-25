@extends('layout.main')

@section('content')
    <div align="center" style="margin: 20px;">
        <div>
            <h3>کد تایید ارسال شده را وارد کنید</h3>
            <div>
                @component('components.timer')
                    @slot("time", $remaining_time)
                    @slot("color", "#32383e")
                @endcomponent
            </div>
            <form class="login100-form validate-form" action="{{ $url }}" target="_self"
                  method="POST">
                @csrf
                <input name="username" value="{{ $username }}" hidden>
                <div>
                    <input style="text-align: center;" type="text" name="code1" maxLength="1" size="1" min="0" max="9"
                           pattern="[0-9]{1}"/>
                    <input style="text-align: center;" type="text" name="code2" maxLength="1" size="1" min="0" max="9"
                           pattern="[0-9]{1}"/>
                    <input style="text-align: center;" type="text" name="code3" maxLength="1" size="1" min="0" max="9"
                           pattern="[0-9]{1}"/>
                    <input style="text-align: center;" type="text" name="code4" maxLength="1" size="1" min="0" max="9"
                           pattern="[0-9]{1}"/>
                    <input style="text-align: center;" type="text" name="code5" maxLength="1" size="1" min="0" max="9"
                           pattern="[0-9]{1}"/>

                </div>
                <div>
                    <button class="btn btn-primary btn-embossed" type="submit" style="margin: 10px;">تایید</button>
                </div>
            </form>

            <div>
                کد تایید را دریافت نکردید؟<br/>
                <a href="{{ route('web_sign_up') }}">ارسال دوباره</a><br/>
                <a href="{{ route('web_sign_up') }}">تعویض شماره تلفن / ایمیل</a>
            </div>
        </div>
    </div>
@endsection
