@extends('layout.main')

@section('script')
    @if(isset($alert))
        <script>
            alert("{{$alert}}");
        </script>
    @endif
@endsection

@section('content')
    <style>


        /*//////////////////////////////////////////////////////////////////
      [ FONT ]*/

        @font-face {
            font-family: OpenSans-Regular;
            src: url('../fonts/OpenSans/OpenSans-Regular.ttf');
        }


        /*//////////////////////////////////////////////////////////////////
      [ RESTYLE TAG ]*/

        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
            font-family: OpenSans-Regular, sans-serif;
        }

        /*---------------------------------------------*/
        a {
            font-family: OpenSans-Regular;
            font-size: 14px;
            line-height: 1.7;
            color: #666666;
            margin: 0px;
            transition: all 0.4s;
            -webkit-transition: all 0.4s;
            -o-transition: all 0.4s;
            -moz-transition: all 0.4s;
        }

        a:focus {
            outline: none !important;
        }

        a:hover {
            text-decoration: none;
        }

        /*---------------------------------------------*/
        h1, h2, h3, h4, h5, h6 {
            margin: 0px;
        }

        p {
            font-family: OpenSans-Regular;
            font-size: 14px;
            line-height: 1.7;
            color: #666666;
            margin: 0px;
        }

        ul, li {
            margin: 0px;
            list-style-type: none;
        }


        /*---------------------------------------------*/
        input {
            outline: none;
            border: none;
        }

        textarea {
            outline: none;
            border: none;
        }

        textarea:focus, input:focus {
            border-color: transparent !important;
        }

        input::-webkit-input-placeholder {
            color: #666666;
        }

        input:-moz-placeholder {
            color: #666666;
        }

        input::-moz-placeholder {
            color: #666666;
        }

        input:-ms-input-placeholder {
            color: #666666;
        }

        textarea::-webkit-input-placeholder {
            color: #666666;
        }

        textarea:-moz-placeholder {
            color: #666666;
        }

        textarea::-moz-placeholder {
            color: #666666;
        }

        textarea:-ms-input-placeholder {
            color: #666666;
        }

        /*---------------------------------------------*/
        button {
            outline: none !important;
            border: none;
            background: transparent;
        }

        button:hover {
            cursor: pointer;
        }

        iframe {
            border: none !important;
        }

        /*//////////////////////////////////////////////////////////////////
      [ Utility ]*/
        .txt1 {
            font-family: OpenSans-Regular;
            font-size: 15px;
            line-height: 1.4;
            color: #999999;
        }

        .txt2 {
            font-family: OpenSans-Regular;
            font-size: 15px;
            line-height: 1.4;
            color: #4272d7;
        }

        .hov1:hover {
            text-decoration: underline;
        }


        /*//////////////////////////////////////////////////////////////////
      [ login ]*/

        .limiter {
            width: 100%;
        }

        .container-login100 {
            width: 100%;
            min-height: 100vh;
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            padding: 15px;
            background: #e9faff;
        }

        .wrap-login100 {
            width: 500px;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;

            box-shadow: 0 3px 20px 0px rgba(0, 0, 0, 0.1);
            -moz-box-shadow: 0 3px 20px 0px rgba(0, 0, 0, 0.1);
            -webkit-box-shadow: 0 3px 20px 0px rgba(0, 0, 0, 0.1);
            -o-box-shadow: 0 3px 20px 0px rgba(0, 0, 0, 0.1);
            -ms-box-shadow: 0 3px 20px 0px rgba(0, 0, 0, 0.1);
        }


        /*==================================================================
      [ Form ]*/

        .login100-form {
            width: 100%;
        }

        .login100-form-title {
            display: block;
            font-family: OpenSans-Regular;
            font-size: 30px;
            color: #555555;
            line-height: 1.2;
            text-align: center;
        }

        /*------------------------------------------------------------------
      [ Input ]*/

        .wrap-input100 {
            width: 100%;
            position: relative;
            background-color: #fff;
            border: 1px solid #e6e6e6;
        }

        .wrap-input100.rs1 {
            border-top: none;
        }

        .input100 {
            display: block;
            width: 100%;
            background: transparent;
            font-family: OpenSans-Regular;
            font-size: 15px;
            color: #666666;
            line-height: 1.2;
        }


        /*---------------------------------------------*/
        input.input100 {
            height: 68px;
            padding: 0 25px 0 25px;
        }

        /*------------------------------------------------------------------
      [ Focus Input ]*/

        .focus-input100-1,
        .focus-input100-2 {
            display: block;
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
        }

        .focus-input100-1::before,
        .focus-input100-2::before {
            content: "";
            display: block;
            position: absolute;
            width: 0;
            height: 1px;
            background-color: #4272d7;
        }

        .focus-input100-1::before {
            top: -1px;
            left: 0;
        }

        .focus-input100-2::before {
            bottom: -1px;
            right: 0;
        }

        .focus-input100-1::after,
        .focus-input100-2::after {
            content: "";
            display: block;
            position: absolute;
            width: 1px;
            height: 0;
            background-color: #4272d7;
        }

        .focus-input100-1::after {
            top: 0;
            right: -1px;
        }

        .focus-input100-2::after {
            bottom: 0;
            left: -1px;
        }

        .input100:focus + .focus-input100-1::before {
            -webkit-animation: full-w 0.2s linear 0s;
            animation: full-w 0.2s linear 0s;
            animation-fill-mode: both;
            -webkit-animation-fill-mode: both;
        }

        .input100:focus + .focus-input100-1::after {
            -webkit-animation: full-h 0.1s linear 0.2s;
            animation: full-h 0.1s linear 0.2s;
            animation-fill-mode: both;
            -webkit-animation-fill-mode: both;
        }

        .input100:focus + .focus-input100-1 + .focus-input100-2::before {
            -webkit-animation: full-w 0.2s linear 0.3s;
            animation: full-w 0.2s linear 0.3s;
            animation-fill-mode: both;
            -webkit-animation-fill-mode: both;
        }

        .input100:focus + .focus-input100-1 + .focus-input100-2::after {
            -webkit-animation: full-h 0.1s linear 0.5s;
            animation: full-h 0.1s linear 0.5s;
            animation-fill-mode: both;
            -webkit-animation-fill-mode: both;
        }


        @keyframes full-w {
            to {
                width: calc(100% + 1px);
            }
        }

        @keyframes full-h {
            to {
                height: calc(100% + 1px);
            }
        }


        /*------------------------------------------------------------------
      [ Button ]*/
        .container-login100-form-btn {
            width: 100%;
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            flex-wrap: wrap;
        }

        .login100-form-btn {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0 20px;
            width: 100%;
            height: 60px;
            background-color: #4272d7;

            font-family: OpenSans-Regular;
            font-size: 14px;
            color: #fff;
            line-height: 1.2;
            text-transform: uppercase;

            -webkit-transition: all 0.4s;
            -o-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }

        .login100-form-btn:hover {
            background-color: #333333;
        }


        /*------------------------------------------------------------------
      [ Alert validate ]*/

        .validate-input {
            position: relative;
        }

        .alert-validate::before {
            content: attr(data-validate);
            position: absolute;
            max-width: 70%;
            background-color: #fff;
            border: 1px solid #c80000;
            border-radius: 2px;
            padding: 4px 25px 4px 10px;
            top: 50%;
            -webkit-transform: translateY(-50%);
            -moz-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            -o-transform: translateY(-50%);
            transform: translateY(-50%);
            right: 12px;
            pointer-events: none;

            font-family: OpenSans-Regular;
            color: #c80000;
            font-size: 13px;
            line-height: 1.4;
            text-align: left;

            visibility: hidden;
            opacity: 0;

            -webkit-transition: opacity 0.4s;
            -o-transition: opacity 0.4s;
            -moz-transition: opacity 0.4s;
            transition: opacity 0.4s;
        }

        .alert-validate::after {
            content: "\f12a";
            font-family: FontAwesome;
            display: block;
            position: absolute;
            color: #c80000;
            font-size: 16px;
            top: 50%;
            -webkit-transform: translateY(-50%);
            -moz-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            -o-transform: translateY(-50%);
            transform: translateY(-50%);
            right: 18px;
        }

        .alert-validate:hover:before {
            visibility: visible;
            opacity: 1;
        }

        @media (max-width: 992px) {
            .alert-validate::before {
                visibility: visible;
                opacity: 1;
            }
        }

        /*[ FONT SIZE ]
///////////////////////////////////////////////////////////
*/
        .fs-1 {
            font-size: 1px;
        }

        .fs-2 {
            font-size: 2px;
        }

        .fs-3 {
            font-size: 3px;
        }

        .fs-4 {
            font-size: 4px;
        }

        .fs-5 {
            font-size: 5px;
        }

        .fs-6 {
            font-size: 6px;
        }

        .fs-7 {
            font-size: 7px;
        }

        .fs-8 {
            font-size: 8px;
        }

        .fs-9 {
            font-size: 9px;
        }

        .fs-10 {
            font-size: 10px;
        }

        .fs-11 {
            font-size: 11px;
        }

        .fs-12 {
            font-size: 12px;
        }

        .fs-13 {
            font-size: 13px;
        }

        .fs-14 {
            font-size: 14px;
        }

        .fs-15 {
            font-size: 15px;
        }

        .fs-16 {
            font-size: 16px;
        }

        .fs-17 {
            font-size: 17px;
        }

        .fs-18 {
            font-size: 18px;
        }

        .fs-19 {
            font-size: 19px;
        }

        .fs-20 {
            font-size: 20px;
        }

        .fs-21 {
            font-size: 21px;
        }

        .fs-22 {
            font-size: 22px;
        }

        .fs-23 {
            font-size: 23px;
        }

        .fs-24 {
            font-size: 24px;
        }

        .fs-25 {
            font-size: 25px;
        }

        .fs-26 {
            font-size: 26px;
        }

        .fs-27 {
            font-size: 27px;
        }

        .fs-28 {
            font-size: 28px;
        }

        .fs-29 {
            font-size: 29px;
        }

        .fs-30 {
            font-size: 30px;
        }

        .fs-31 {
            font-size: 31px;
        }

        .fs-32 {
            font-size: 32px;
        }

        .fs-33 {
            font-size: 33px;
        }

        .fs-34 {
            font-size: 34px;
        }

        .fs-35 {
            font-size: 35px;
        }

        .fs-36 {
            font-size: 36px;
        }

        .fs-37 {
            font-size: 37px;
        }

        .fs-38 {
            font-size: 38px;
        }

        .fs-39 {
            font-size: 39px;
        }

        .fs-40 {
            font-size: 40px;
        }

        .fs-41 {
            font-size: 41px;
        }

        .fs-42 {
            font-size: 42px;
        }

        .fs-43 {
            font-size: 43px;
        }

        .fs-44 {
            font-size: 44px;
        }

        .fs-45 {
            font-size: 45px;
        }

        .fs-46 {
            font-size: 46px;
        }

        .fs-47 {
            font-size: 47px;
        }

        .fs-48 {
            font-size: 48px;
        }

        .fs-49 {
            font-size: 49px;
        }

        .fs-50 {
            font-size: 50px;
        }

        .fs-51 {
            font-size: 51px;
        }

        .fs-52 {
            font-size: 52px;
        }

        .fs-53 {
            font-size: 53px;
        }

        .fs-54 {
            font-size: 54px;
        }

        .fs-55 {
            font-size: 55px;
        }

        .fs-56 {
            font-size: 56px;
        }

        .fs-57 {
            font-size: 57px;
        }

        .fs-58 {
            font-size: 58px;
        }

        .fs-59 {
            font-size: 59px;
        }

        .fs-60 {
            font-size: 60px;
        }

        .fs-61 {
            font-size: 61px;
        }

        .fs-62 {
            font-size: 62px;
        }

        .fs-63 {
            font-size: 63px;
        }

        .fs-64 {
            font-size: 64px;
        }

        .fs-65 {
            font-size: 65px;
        }

        .fs-66 {
            font-size: 66px;
        }

        .fs-67 {
            font-size: 67px;
        }

        .fs-68 {
            font-size: 68px;
        }

        .fs-69 {
            font-size: 69px;
        }

        .fs-70 {
            font-size: 70px;
        }

        .fs-71 {
            font-size: 71px;
        }

        .fs-72 {
            font-size: 72px;
        }

        .fs-73 {
            font-size: 73px;
        }

        .fs-74 {
            font-size: 74px;
        }

        .fs-75 {
            font-size: 75px;
        }

        .fs-76 {
            font-size: 76px;
        }

        .fs-77 {
            font-size: 77px;
        }

        .fs-78 {
            font-size: 78px;
        }

        .fs-79 {
            font-size: 79px;
        }

        .fs-80 {
            font-size: 80px;
        }

        .fs-81 {
            font-size: 81px;
        }

        .fs-82 {
            font-size: 82px;
        }

        .fs-83 {
            font-size: 83px;
        }

        .fs-84 {
            font-size: 84px;
        }

        .fs-85 {
            font-size: 85px;
        }

        .fs-86 {
            font-size: 86px;
        }

        .fs-87 {
            font-size: 87px;
        }

        .fs-88 {
            font-size: 88px;
        }

        .fs-89 {
            font-size: 89px;
        }

        .fs-90 {
            font-size: 90px;
        }

        .fs-91 {
            font-size: 91px;
        }

        .fs-92 {
            font-size: 92px;
        }

        .fs-93 {
            font-size: 93px;
        }

        .fs-94 {
            font-size: 94px;
        }

        .fs-95 {
            font-size: 95px;
        }

        .fs-96 {
            font-size: 96px;
        }

        .fs-97 {
            font-size: 97px;
        }

        .fs-98 {
            font-size: 98px;
        }

        .fs-99 {
            font-size: 99px;
        }

        .fs-100 {
            font-size: 100px;
        }

        .fs-101 {
            font-size: 101px;
        }

        .fs-102 {
            font-size: 102px;
        }

        .fs-103 {
            font-size: 103px;
        }

        .fs-104 {
            font-size: 104px;
        }

        .fs-105 {
            font-size: 105px;
        }

        .fs-106 {
            font-size: 106px;
        }

        .fs-107 {
            font-size: 107px;
        }

        .fs-108 {
            font-size: 108px;
        }

        .fs-109 {
            font-size: 109px;
        }

        .fs-110 {
            font-size: 110px;
        }

        .fs-111 {
            font-size: 111px;
        }

        .fs-112 {
            font-size: 112px;
        }

        .fs-113 {
            font-size: 113px;
        }

        .fs-114 {
            font-size: 114px;
        }

        .fs-115 {
            font-size: 115px;
        }

        .fs-116 {
            font-size: 116px;
        }

        .fs-117 {
            font-size: 117px;
        }

        .fs-118 {
            font-size: 118px;
        }

        .fs-119 {
            font-size: 119px;
        }

        .fs-120 {
            font-size: 120px;
        }

        .fs-121 {
            font-size: 121px;
        }

        .fs-122 {
            font-size: 122px;
        }

        .fs-123 {
            font-size: 123px;
        }

        .fs-124 {
            font-size: 124px;
        }

        .fs-125 {
            font-size: 125px;
        }

        .fs-126 {
            font-size: 126px;
        }

        .fs-127 {
            font-size: 127px;
        }

        .fs-128 {
            font-size: 128px;
        }

        .fs-129 {
            font-size: 129px;
        }

        .fs-130 {
            font-size: 130px;
        }

        .fs-131 {
            font-size: 131px;
        }

        .fs-132 {
            font-size: 132px;
        }

        .fs-133 {
            font-size: 133px;
        }

        .fs-134 {
            font-size: 134px;
        }

        .fs-135 {
            font-size: 135px;
        }

        .fs-136 {
            font-size: 136px;
        }

        .fs-137 {
            font-size: 137px;
        }

        .fs-138 {
            font-size: 138px;
        }

        .fs-139 {
            font-size: 139px;
        }

        .fs-140 {
            font-size: 140px;
        }

        .fs-141 {
            font-size: 141px;
        }

        .fs-142 {
            font-size: 142px;
        }

        .fs-143 {
            font-size: 143px;
        }

        .fs-144 {
            font-size: 144px;
        }

        .fs-145 {
            font-size: 145px;
        }

        .fs-146 {
            font-size: 146px;
        }

        .fs-147 {
            font-size: 147px;
        }

        .fs-148 {
            font-size: 148px;
        }

        .fs-149 {
            font-size: 149px;
        }

        .fs-150 {
            font-size: 150px;
        }

        .fs-151 {
            font-size: 151px;
        }

        .fs-152 {
            font-size: 152px;
        }

        .fs-153 {
            font-size: 153px;
        }

        .fs-154 {
            font-size: 154px;
        }

        .fs-155 {
            font-size: 155px;
        }

        .fs-156 {
            font-size: 156px;
        }

        .fs-157 {
            font-size: 157px;
        }

        .fs-158 {
            font-size: 158px;
        }

        .fs-159 {
            font-size: 159px;
        }

        .fs-160 {
            font-size: 160px;
        }

        .fs-161 {
            font-size: 161px;
        }

        .fs-162 {
            font-size: 162px;
        }

        .fs-163 {
            font-size: 163px;
        }

        .fs-164 {
            font-size: 164px;
        }

        .fs-165 {
            font-size: 165px;
        }

        .fs-166 {
            font-size: 166px;
        }

        .fs-167 {
            font-size: 167px;
        }

        .fs-168 {
            font-size: 168px;
        }

        .fs-169 {
            font-size: 169px;
        }

        .fs-170 {
            font-size: 170px;
        }

        .fs-171 {
            font-size: 171px;
        }

        .fs-172 {
            font-size: 172px;
        }

        .fs-173 {
            font-size: 173px;
        }

        .fs-174 {
            font-size: 174px;
        }

        .fs-175 {
            font-size: 175px;
        }

        .fs-176 {
            font-size: 176px;
        }

        .fs-177 {
            font-size: 177px;
        }

        .fs-178 {
            font-size: 178px;
        }

        .fs-179 {
            font-size: 179px;
        }

        .fs-180 {
            font-size: 180px;
        }

        .fs-181 {
            font-size: 181px;
        }

        .fs-182 {
            font-size: 182px;
        }

        .fs-183 {
            font-size: 183px;
        }

        .fs-184 {
            font-size: 184px;
        }

        .fs-185 {
            font-size: 185px;
        }

        .fs-186 {
            font-size: 186px;
        }

        .fs-187 {
            font-size: 187px;
        }

        .fs-188 {
            font-size: 188px;
        }

        .fs-189 {
            font-size: 189px;
        }

        .fs-190 {
            font-size: 190px;
        }

        .fs-191 {
            font-size: 191px;
        }

        .fs-192 {
            font-size: 192px;
        }

        .fs-193 {
            font-size: 193px;
        }

        .fs-194 {
            font-size: 194px;
        }

        .fs-195 {
            font-size: 195px;
        }

        .fs-196 {
            font-size: 196px;
        }

        .fs-197 {
            font-size: 197px;
        }

        .fs-198 {
            font-size: 198px;
        }

        .fs-199 {
            font-size: 199px;
        }

        .fs-200 {
            font-size: 200px;
        }

        /*[ PADDING ]
      ///////////////////////////////////////////////////////////
      */
        .p-t-0 {
            padding-top: 0px;
        }

        .p-t-1 {
            padding-top: 1px;
        }

        .p-t-2 {
            padding-top: 2px;
        }

        .p-t-3 {
            padding-top: 3px;
        }

        .p-t-4 {
            padding-top: 4px;
        }

        .p-t-5 {
            padding-top: 5px;
        }

        .p-t-6 {
            padding-top: 6px;
        }

        .p-t-7 {
            padding-top: 7px;
        }

        .p-t-8 {
            padding-top: 8px;
        }

        .p-t-9 {
            padding-top: 9px;
        }

        .p-t-10 {
            padding-top: 10px;
        }

        .p-t-11 {
            padding-top: 11px;
        }

        .p-t-12 {
            padding-top: 12px;
        }

        .p-t-13 {
            padding-top: 13px;
        }

        .p-t-14 {
            padding-top: 14px;
        }

        .p-t-15 {
            padding-top: 15px;
        }

        .p-t-16 {
            padding-top: 16px;
        }

        .p-t-17 {
            padding-top: 17px;
        }

        .p-t-18 {
            padding-top: 18px;
        }

        .p-t-19 {
            padding-top: 19px;
        }

        .p-t-20 {
            padding-top: 20px;
        }

        .p-t-21 {
            padding-top: 21px;
        }

        .p-t-22 {
            padding-top: 22px;
        }

        .p-t-23 {
            padding-top: 23px;
        }

        .p-t-24 {
            padding-top: 24px;
        }

        .p-t-25 {
            padding-top: 25px;
        }

        .p-t-26 {
            padding-top: 26px;
        }

        .p-t-27 {
            padding-top: 27px;
        }

        .p-t-28 {
            padding-top: 28px;
        }

        .p-t-29 {
            padding-top: 29px;
        }

        .p-t-30 {
            padding-top: 30px;
        }

        .p-t-31 {
            padding-top: 31px;
        }

        .p-t-32 {
            padding-top: 32px;
        }

        .p-t-33 {
            padding-top: 33px;
        }

        .p-t-34 {
            padding-top: 34px;
        }

        .p-t-35 {
            padding-top: 35px;
        }

        .p-t-36 {
            padding-top: 36px;
        }

        .p-t-37 {
            padding-top: 37px;
        }

        .p-t-38 {
            padding-top: 38px;
        }

        .p-t-39 {
            padding-top: 39px;
        }

        .p-t-40 {
            padding-top: 40px;
        }

        .p-t-41 {
            padding-top: 41px;
        }

        .p-t-42 {
            padding-top: 42px;
        }

        .p-t-43 {
            padding-top: 43px;
        }

        .p-t-44 {
            padding-top: 44px;
        }

        .p-t-45 {
            padding-top: 45px;
        }

        .p-t-46 {
            padding-top: 46px;
        }

        .p-t-47 {
            padding-top: 47px;
        }

        .p-t-48 {
            padding-top: 48px;
        }

        .p-t-49 {
            padding-top: 49px;
        }

        .p-t-50 {
            padding-top: 50px;
        }

        .p-t-51 {
            padding-top: 51px;
        }

        .p-t-52 {
            padding-top: 52px;
        }

        .p-t-53 {
            padding-top: 53px;
        }

        .p-t-54 {
            padding-top: 54px;
        }

        .p-t-55 {
            padding-top: 55px;
        }

        .p-t-56 {
            padding-top: 56px;
        }

        .p-t-57 {
            padding-top: 57px;
        }

        .p-t-58 {
            padding-top: 58px;
        }

        .p-t-59 {
            padding-top: 59px;
        }

        .p-t-60 {
            padding-top: 60px;
        }

        .p-t-61 {
            padding-top: 61px;
        }

        .p-t-62 {
            padding-top: 62px;
        }

        .p-t-63 {
            padding-top: 63px;
        }

        .p-t-64 {
            padding-top: 64px;
        }

        .p-t-65 {
            padding-top: 65px;
        }

        .p-t-66 {
            padding-top: 66px;
        }

        .p-t-67 {
            padding-top: 67px;
        }

        .p-t-68 {
            padding-top: 68px;
        }

        .p-t-69 {
            padding-top: 69px;
        }

        .p-t-70 {
            padding-top: 70px;
        }

        .p-t-71 {
            padding-top: 71px;
        }

        .p-t-72 {
            padding-top: 72px;
        }

        .p-t-73 {
            padding-top: 73px;
        }

        .p-t-74 {
            padding-top: 74px;
        }

        .p-t-75 {
            padding-top: 75px;
        }

        .p-t-76 {
            padding-top: 76px;
        }

        .p-t-77 {
            padding-top: 77px;
        }

        .p-t-78 {
            padding-top: 78px;
        }

        .p-t-79 {
            padding-top: 79px;
        }

        .p-t-80 {
            padding-top: 80px;
        }

        .p-t-81 {
            padding-top: 81px;
        }

        .p-t-82 {
            padding-top: 82px;
        }

        .p-t-83 {
            padding-top: 83px;
        }

        .p-t-84 {
            padding-top: 84px;
        }

        .p-t-85 {
            padding-top: 85px;
        }

        .p-t-86 {
            padding-top: 86px;
        }

        .p-t-87 {
            padding-top: 87px;
        }

        .p-t-88 {
            padding-top: 88px;
        }

        .p-t-89 {
            padding-top: 89px;
        }

        .p-t-90 {
            padding-top: 90px;
        }

        .p-t-91 {
            padding-top: 91px;
        }

        .p-t-92 {
            padding-top: 92px;
        }

        .p-t-93 {
            padding-top: 93px;
        }

        .p-t-94 {
            padding-top: 94px;
        }

        .p-t-95 {
            padding-top: 95px;
        }

        .p-t-96 {
            padding-top: 96px;
        }

        .p-t-97 {
            padding-top: 97px;
        }

        .p-t-98 {
            padding-top: 98px;
        }

        .p-t-99 {
            padding-top: 99px;
        }

        .p-t-100 {
            padding-top: 100px;
        }

        .p-t-101 {
            padding-top: 101px;
        }

        .p-t-102 {
            padding-top: 102px;
        }

        .p-t-103 {
            padding-top: 103px;
        }

        .p-t-104 {
            padding-top: 104px;
        }

        .p-t-105 {
            padding-top: 105px;
        }

        .p-t-106 {
            padding-top: 106px;
        }

        .p-t-107 {
            padding-top: 107px;
        }

        .p-t-108 {
            padding-top: 108px;
        }

        .p-t-109 {
            padding-top: 109px;
        }

        .p-t-110 {
            padding-top: 110px;
        }

        .p-t-111 {
            padding-top: 111px;
        }

        .p-t-112 {
            padding-top: 112px;
        }

        .p-t-113 {
            padding-top: 113px;
        }

        .p-t-114 {
            padding-top: 114px;
        }

        .p-t-115 {
            padding-top: 115px;
        }

        .p-t-116 {
            padding-top: 116px;
        }

        .p-t-117 {
            padding-top: 117px;
        }

        .p-t-118 {
            padding-top: 118px;
        }

        .p-t-119 {
            padding-top: 119px;
        }

        .p-t-120 {
            padding-top: 120px;
        }

        .p-t-121 {
            padding-top: 121px;
        }

        .p-t-122 {
            padding-top: 122px;
        }

        .p-t-123 {
            padding-top: 123px;
        }

        .p-t-124 {
            padding-top: 124px;
        }

        .p-t-125 {
            padding-top: 125px;
        }

        .p-t-126 {
            padding-top: 126px;
        }

        .p-t-127 {
            padding-top: 127px;
        }

        .p-t-128 {
            padding-top: 128px;
        }

        .p-t-129 {
            padding-top: 129px;
        }

        .p-t-130 {
            padding-top: 130px;
        }

        .p-t-131 {
            padding-top: 131px;
        }

        .p-t-132 {
            padding-top: 132px;
        }

        .p-t-133 {
            padding-top: 133px;
        }

        .p-t-134 {
            padding-top: 134px;
        }

        .p-t-135 {
            padding-top: 135px;
        }

        .p-t-136 {
            padding-top: 136px;
        }

        .p-t-137 {
            padding-top: 137px;
        }

        .p-t-138 {
            padding-top: 138px;
        }

        .p-t-139 {
            padding-top: 139px;
        }

        .p-t-140 {
            padding-top: 140px;
        }

        .p-t-141 {
            padding-top: 141px;
        }

        .p-t-142 {
            padding-top: 142px;
        }

        .p-t-143 {
            padding-top: 143px;
        }

        .p-t-144 {
            padding-top: 144px;
        }

        .p-t-145 {
            padding-top: 145px;
        }

        .p-t-146 {
            padding-top: 146px;
        }

        .p-t-147 {
            padding-top: 147px;
        }

        .p-t-148 {
            padding-top: 148px;
        }

        .p-t-149 {
            padding-top: 149px;
        }

        .p-t-150 {
            padding-top: 150px;
        }

        .p-t-151 {
            padding-top: 151px;
        }

        .p-t-152 {
            padding-top: 152px;
        }

        .p-t-153 {
            padding-top: 153px;
        }

        .p-t-154 {
            padding-top: 154px;
        }

        .p-t-155 {
            padding-top: 155px;
        }

        .p-t-156 {
            padding-top: 156px;
        }

        .p-t-157 {
            padding-top: 157px;
        }

        .p-t-158 {
            padding-top: 158px;
        }

        .p-t-159 {
            padding-top: 159px;
        }

        .p-t-160 {
            padding-top: 160px;
        }

        .p-t-161 {
            padding-top: 161px;
        }

        .p-t-162 {
            padding-top: 162px;
        }

        .p-t-163 {
            padding-top: 163px;
        }

        .p-t-164 {
            padding-top: 164px;
        }

        .p-t-165 {
            padding-top: 165px;
        }

        .p-t-166 {
            padding-top: 166px;
        }

        .p-t-167 {
            padding-top: 167px;
        }

        .p-t-168 {
            padding-top: 168px;
        }

        .p-t-169 {
            padding-top: 169px;
        }

        .p-t-170 {
            padding-top: 170px;
        }

        .p-t-171 {
            padding-top: 171px;
        }

        .p-t-172 {
            padding-top: 172px;
        }

        .p-t-173 {
            padding-top: 173px;
        }

        .p-t-174 {
            padding-top: 174px;
        }

        .p-t-175 {
            padding-top: 175px;
        }

        .p-t-176 {
            padding-top: 176px;
        }

        .p-t-177 {
            padding-top: 177px;
        }

        .p-t-178 {
            padding-top: 178px;
        }

        .p-t-179 {
            padding-top: 179px;
        }

        .p-t-180 {
            padding-top: 180px;
        }

        .p-t-181 {
            padding-top: 181px;
        }

        .p-t-182 {
            padding-top: 182px;
        }

        .p-t-183 {
            padding-top: 183px;
        }

        .p-t-184 {
            padding-top: 184px;
        }

        .p-t-185 {
            padding-top: 185px;
        }

        .p-t-186 {
            padding-top: 186px;
        }

        .p-t-187 {
            padding-top: 187px;
        }

        .p-t-188 {
            padding-top: 188px;
        }

        .p-t-189 {
            padding-top: 189px;
        }

        .p-t-190 {
            padding-top: 190px;
        }

        .p-t-191 {
            padding-top: 191px;
        }

        .p-t-192 {
            padding-top: 192px;
        }

        .p-t-193 {
            padding-top: 193px;
        }

        .p-t-194 {
            padding-top: 194px;
        }

        .p-t-195 {
            padding-top: 195px;
        }

        .p-t-196 {
            padding-top: 196px;
        }

        .p-t-197 {
            padding-top: 197px;
        }

        .p-t-198 {
            padding-top: 198px;
        }

        .p-t-199 {
            padding-top: 199px;
        }

        .p-t-200 {
            padding-top: 200px;
        }

        .p-t-201 {
            padding-top: 201px;
        }

        .p-t-202 {
            padding-top: 202px;
        }

        .p-t-203 {
            padding-top: 203px;
        }

        .p-t-204 {
            padding-top: 204px;
        }

        .p-t-205 {
            padding-top: 205px;
        }

        .p-t-206 {
            padding-top: 206px;
        }

        .p-t-207 {
            padding-top: 207px;
        }

        .p-t-208 {
            padding-top: 208px;
        }

        .p-t-209 {
            padding-top: 209px;
        }

        .p-t-210 {
            padding-top: 210px;
        }

        .p-t-211 {
            padding-top: 211px;
        }

        .p-t-212 {
            padding-top: 212px;
        }

        .p-t-213 {
            padding-top: 213px;
        }

        .p-t-214 {
            padding-top: 214px;
        }

        .p-t-215 {
            padding-top: 215px;
        }

        .p-t-216 {
            padding-top: 216px;
        }

        .p-t-217 {
            padding-top: 217px;
        }

        .p-t-218 {
            padding-top: 218px;
        }

        .p-t-219 {
            padding-top: 219px;
        }

        .p-t-220 {
            padding-top: 220px;
        }

        .p-t-221 {
            padding-top: 221px;
        }

        .p-t-222 {
            padding-top: 222px;
        }

        .p-t-223 {
            padding-top: 223px;
        }

        .p-t-224 {
            padding-top: 224px;
        }

        .p-t-225 {
            padding-top: 225px;
        }

        .p-t-226 {
            padding-top: 226px;
        }

        .p-t-227 {
            padding-top: 227px;
        }

        .p-t-228 {
            padding-top: 228px;
        }

        .p-t-229 {
            padding-top: 229px;
        }

        .p-t-230 {
            padding-top: 230px;
        }

        .p-t-231 {
            padding-top: 231px;
        }

        .p-t-232 {
            padding-top: 232px;
        }

        .p-t-233 {
            padding-top: 233px;
        }

        .p-t-234 {
            padding-top: 234px;
        }

        .p-t-235 {
            padding-top: 235px;
        }

        .p-t-236 {
            padding-top: 236px;
        }

        .p-t-237 {
            padding-top: 237px;
        }

        .p-t-238 {
            padding-top: 238px;
        }

        .p-t-239 {
            padding-top: 239px;
        }

        .p-t-240 {
            padding-top: 240px;
        }

        .p-t-241 {
            padding-top: 241px;
        }

        .p-t-242 {
            padding-top: 242px;
        }

        .p-t-243 {
            padding-top: 243px;
        }

        .p-t-244 {
            padding-top: 244px;
        }

        .p-t-245 {
            padding-top: 245px;
        }

        .p-t-246 {
            padding-top: 246px;
        }

        .p-t-247 {
            padding-top: 247px;
        }

        .p-t-248 {
            padding-top: 248px;
        }

        .p-t-249 {
            padding-top: 249px;
        }

        .p-t-250 {
            padding-top: 250px;
        }

        .p-b-0 {
            padding-bottom: 0px;
        }

        .p-b-1 {
            padding-bottom: 1px;
        }

        .p-b-2 {
            padding-bottom: 2px;
        }

        .p-b-3 {
            padding-bottom: 3px;
        }

        .p-b-4 {
            padding-bottom: 4px;
        }

        .p-b-5 {
            padding-bottom: 5px;
        }

        .p-b-6 {
            padding-bottom: 6px;
        }

        .p-b-7 {
            padding-bottom: 7px;
        }

        .p-b-8 {
            padding-bottom: 8px;
        }

        .p-b-9 {
            padding-bottom: 9px;
        }

        .p-b-10 {
            padding-bottom: 10px;
        }

        .p-b-11 {
            padding-bottom: 11px;
        }

        .p-b-12 {
            padding-bottom: 12px;
        }

        .p-b-13 {
            padding-bottom: 13px;
        }

        .p-b-14 {
            padding-bottom: 14px;
        }

        .p-b-15 {
            padding-bottom: 15px;
        }

        .p-b-16 {
            padding-bottom: 16px;
        }

        .p-b-17 {
            padding-bottom: 17px;
        }

        .p-b-18 {
            padding-bottom: 18px;
        }

        .p-b-19 {
            padding-bottom: 19px;
        }

        .p-b-20 {
            padding-bottom: 20px;
        }

        .p-b-21 {
            padding-bottom: 21px;
        }

        .p-b-22 {
            padding-bottom: 22px;
        }

        .p-b-23 {
            padding-bottom: 23px;
        }

        .p-b-24 {
            padding-bottom: 24px;
        }

        .p-b-25 {
            padding-bottom: 25px;
        }

        .p-b-26 {
            padding-bottom: 26px;
        }

        .p-b-27 {
            padding-bottom: 27px;
        }

        .p-b-28 {
            padding-bottom: 28px;
        }

        .p-b-29 {
            padding-bottom: 29px;
        }

        .p-b-30 {
            padding-bottom: 30px;
        }

        .p-b-31 {
            padding-bottom: 31px;
        }

        .p-b-32 {
            padding-bottom: 32px;
        }

        .p-b-33 {
            padding-bottom: 33px;
        }

        .p-b-34 {
            padding-bottom: 34px;
        }

        .p-b-35 {
            padding-bottom: 35px;
        }

        .p-b-36 {
            padding-bottom: 36px;
        }

        .p-b-37 {
            padding-bottom: 37px;
        }

        .p-b-38 {
            padding-bottom: 38px;
        }

        .p-b-39 {
            padding-bottom: 39px;
        }

        .p-b-40 {
            padding-bottom: 40px;
        }

        .p-b-41 {
            padding-bottom: 41px;
        }

        .p-b-42 {
            padding-bottom: 42px;
        }

        .p-b-43 {
            padding-bottom: 43px;
        }

        .p-b-44 {
            padding-bottom: 44px;
        }

        .p-b-45 {
            padding-bottom: 45px;
        }

        .p-b-46 {
            padding-bottom: 46px;
        }

        .p-b-47 {
            padding-bottom: 47px;
        }

        .p-b-48 {
            padding-bottom: 48px;
        }

        .p-b-49 {
            padding-bottom: 49px;
        }

        .p-b-50 {
            padding-bottom: 50px;
        }

        .p-b-51 {
            padding-bottom: 51px;
        }

        .p-b-52 {
            padding-bottom: 52px;
        }

        .p-b-53 {
            padding-bottom: 53px;
        }

        .p-b-54 {
            padding-bottom: 54px;
        }

        .p-b-55 {
            padding-bottom: 55px;
        }

        .p-b-56 {
            padding-bottom: 56px;
        }

        .p-b-57 {
            padding-bottom: 57px;
        }

        .p-b-58 {
            padding-bottom: 58px;
        }

        .p-b-59 {
            padding-bottom: 59px;
        }

        .p-b-60 {
            padding-bottom: 60px;
        }

        .p-b-61 {
            padding-bottom: 61px;
        }

        .p-b-62 {
            padding-bottom: 62px;
        }

        .p-b-63 {
            padding-bottom: 63px;
        }

        .p-b-64 {
            padding-bottom: 64px;
        }

        .p-b-65 {
            padding-bottom: 65px;
        }

        .p-b-66 {
            padding-bottom: 66px;
        }

        .p-b-67 {
            padding-bottom: 67px;
        }

        .p-b-68 {
            padding-bottom: 68px;
        }

        .p-b-69 {
            padding-bottom: 69px;
        }

        .p-b-70 {
            padding-bottom: 70px;
        }

        .p-b-71 {
            padding-bottom: 71px;
        }

        .p-b-72 {
            padding-bottom: 72px;
        }

        .p-b-73 {
            padding-bottom: 73px;
        }

        .p-b-74 {
            padding-bottom: 74px;
        }

        .p-b-75 {
            padding-bottom: 75px;
        }

        .p-b-76 {
            padding-bottom: 76px;
        }

        .p-b-77 {
            padding-bottom: 77px;
        }

        .p-b-78 {
            padding-bottom: 78px;
        }

        .p-b-79 {
            padding-bottom: 79px;
        }

        .p-b-80 {
            padding-bottom: 80px;
        }

        .p-b-81 {
            padding-bottom: 81px;
        }

        .p-b-82 {
            padding-bottom: 82px;
        }

        .p-b-83 {
            padding-bottom: 83px;
        }

        .p-b-84 {
            padding-bottom: 84px;
        }

        .p-b-85 {
            padding-bottom: 85px;
        }

        .p-b-86 {
            padding-bottom: 86px;
        }

        .p-b-87 {
            padding-bottom: 87px;
        }

        .p-b-88 {
            padding-bottom: 88px;
        }

        .p-b-89 {
            padding-bottom: 89px;
        }

        .p-b-90 {
            padding-bottom: 90px;
        }

        .p-b-91 {
            padding-bottom: 91px;
        }

        .p-b-92 {
            padding-bottom: 92px;
        }

        .p-b-93 {
            padding-bottom: 93px;
        }

        .p-b-94 {
            padding-bottom: 94px;
        }

        .p-b-95 {
            padding-bottom: 95px;
        }

        .p-b-96 {
            padding-bottom: 96px;
        }

        .p-b-97 {
            padding-bottom: 97px;
        }

        .p-b-98 {
            padding-bottom: 98px;
        }

        .p-b-99 {
            padding-bottom: 99px;
        }

        .p-b-100 {
            padding-bottom: 100px;
        }

        .p-b-101 {
            padding-bottom: 101px;
        }

        .p-b-102 {
            padding-bottom: 102px;
        }

        .p-b-103 {
            padding-bottom: 103px;
        }

        .p-b-104 {
            padding-bottom: 104px;
        }

        .p-b-105 {
            padding-bottom: 105px;
        }

        .p-b-106 {
            padding-bottom: 106px;
        }

        .p-b-107 {
            padding-bottom: 107px;
        }

        .p-b-108 {
            padding-bottom: 108px;
        }

        .p-b-109 {
            padding-bottom: 109px;
        }

        .p-b-110 {
            padding-bottom: 110px;
        }

        .p-b-111 {
            padding-bottom: 111px;
        }

        .p-b-112 {
            padding-bottom: 112px;
        }

        .p-b-113 {
            padding-bottom: 113px;
        }

        .p-b-114 {
            padding-bottom: 114px;
        }

        .p-b-115 {
            padding-bottom: 115px;
        }

        .p-b-116 {
            padding-bottom: 116px;
        }

        .p-b-117 {
            padding-bottom: 117px;
        }

        .p-b-118 {
            padding-bottom: 118px;
        }

        .p-b-119 {
            padding-bottom: 119px;
        }

        .p-b-120 {
            padding-bottom: 120px;
        }

        .p-b-121 {
            padding-bottom: 121px;
        }

        .p-b-122 {
            padding-bottom: 122px;
        }

        .p-b-123 {
            padding-bottom: 123px;
        }

        .p-b-124 {
            padding-bottom: 124px;
        }

        .p-b-125 {
            padding-bottom: 125px;
        }

        .p-b-126 {
            padding-bottom: 126px;
        }

        .p-b-127 {
            padding-bottom: 127px;
        }

        .p-b-128 {
            padding-bottom: 128px;
        }

        .p-b-129 {
            padding-bottom: 129px;
        }

        .p-b-130 {
            padding-bottom: 130px;
        }

        .p-b-131 {
            padding-bottom: 131px;
        }

        .p-b-132 {
            padding-bottom: 132px;
        }

        .p-b-133 {
            padding-bottom: 133px;
        }

        .p-b-134 {
            padding-bottom: 134px;
        }

        .p-b-135 {
            padding-bottom: 135px;
        }

        .p-b-136 {
            padding-bottom: 136px;
        }

        .p-b-137 {
            padding-bottom: 137px;
        }

        .p-b-138 {
            padding-bottom: 138px;
        }

        .p-b-139 {
            padding-bottom: 139px;
        }

        .p-b-140 {
            padding-bottom: 140px;
        }

        .p-b-141 {
            padding-bottom: 141px;
        }

        .p-b-142 {
            padding-bottom: 142px;
        }

        .p-b-143 {
            padding-bottom: 143px;
        }

        .p-b-144 {
            padding-bottom: 144px;
        }

        .p-b-145 {
            padding-bottom: 145px;
        }

        .p-b-146 {
            padding-bottom: 146px;
        }

        .p-b-147 {
            padding-bottom: 147px;
        }

        .p-b-148 {
            padding-bottom: 148px;
        }

        .p-b-149 {
            padding-bottom: 149px;
        }

        .p-b-150 {
            padding-bottom: 150px;
        }

        .p-b-151 {
            padding-bottom: 151px;
        }

        .p-b-152 {
            padding-bottom: 152px;
        }

        .p-b-153 {
            padding-bottom: 153px;
        }

        .p-b-154 {
            padding-bottom: 154px;
        }

        .p-b-155 {
            padding-bottom: 155px;
        }

        .p-b-156 {
            padding-bottom: 156px;
        }

        .p-b-157 {
            padding-bottom: 157px;
        }

        .p-b-158 {
            padding-bottom: 158px;
        }

        .p-b-159 {
            padding-bottom: 159px;
        }

        .p-b-160 {
            padding-bottom: 160px;
        }

        .p-b-161 {
            padding-bottom: 161px;
        }

        .p-b-162 {
            padding-bottom: 162px;
        }

        .p-b-163 {
            padding-bottom: 163px;
        }

        .p-b-164 {
            padding-bottom: 164px;
        }

        .p-b-165 {
            padding-bottom: 165px;
        }

        .p-b-166 {
            padding-bottom: 166px;
        }

        .p-b-167 {
            padding-bottom: 167px;
        }

        .p-b-168 {
            padding-bottom: 168px;
        }

        .p-b-169 {
            padding-bottom: 169px;
        }

        .p-b-170 {
            padding-bottom: 170px;
        }

        .p-b-171 {
            padding-bottom: 171px;
        }

        .p-b-172 {
            padding-bottom: 172px;
        }

        .p-b-173 {
            padding-bottom: 173px;
        }

        .p-b-174 {
            padding-bottom: 174px;
        }

        .p-b-175 {
            padding-bottom: 175px;
        }

        .p-b-176 {
            padding-bottom: 176px;
        }

        .p-b-177 {
            padding-bottom: 177px;
        }

        .p-b-178 {
            padding-bottom: 178px;
        }

        .p-b-179 {
            padding-bottom: 179px;
        }

        .p-b-180 {
            padding-bottom: 180px;
        }

        .p-b-181 {
            padding-bottom: 181px;
        }

        .p-b-182 {
            padding-bottom: 182px;
        }

        .p-b-183 {
            padding-bottom: 183px;
        }

        .p-b-184 {
            padding-bottom: 184px;
        }

        .p-b-185 {
            padding-bottom: 185px;
        }

        .p-b-186 {
            padding-bottom: 186px;
        }

        .p-b-187 {
            padding-bottom: 187px;
        }

        .p-b-188 {
            padding-bottom: 188px;
        }

        .p-b-189 {
            padding-bottom: 189px;
        }

        .p-b-190 {
            padding-bottom: 190px;
        }

        .p-b-191 {
            padding-bottom: 191px;
        }

        .p-b-192 {
            padding-bottom: 192px;
        }

        .p-b-193 {
            padding-bottom: 193px;
        }

        .p-b-194 {
            padding-bottom: 194px;
        }

        .p-b-195 {
            padding-bottom: 195px;
        }

        .p-b-196 {
            padding-bottom: 196px;
        }

        .p-b-197 {
            padding-bottom: 197px;
        }

        .p-b-198 {
            padding-bottom: 198px;
        }

        .p-b-199 {
            padding-bottom: 199px;
        }

        .p-b-200 {
            padding-bottom: 200px;
        }

        .p-b-201 {
            padding-bottom: 201px;
        }

        .p-b-202 {
            padding-bottom: 202px;
        }

        .p-b-203 {
            padding-bottom: 203px;
        }

        .p-b-204 {
            padding-bottom: 204px;
        }

        .p-b-205 {
            padding-bottom: 205px;
        }

        .p-b-206 {
            padding-bottom: 206px;
        }

        .p-b-207 {
            padding-bottom: 207px;
        }

        .p-b-208 {
            padding-bottom: 208px;
        }

        .p-b-209 {
            padding-bottom: 209px;
        }

        .p-b-210 {
            padding-bottom: 210px;
        }

        .p-b-211 {
            padding-bottom: 211px;
        }

        .p-b-212 {
            padding-bottom: 212px;
        }

        .p-b-213 {
            padding-bottom: 213px;
        }

        .p-b-214 {
            padding-bottom: 214px;
        }

        .p-b-215 {
            padding-bottom: 215px;
        }

        .p-b-216 {
            padding-bottom: 216px;
        }

        .p-b-217 {
            padding-bottom: 217px;
        }

        .p-b-218 {
            padding-bottom: 218px;
        }

        .p-b-219 {
            padding-bottom: 219px;
        }

        .p-b-220 {
            padding-bottom: 220px;
        }

        .p-b-221 {
            padding-bottom: 221px;
        }

        .p-b-222 {
            padding-bottom: 222px;
        }

        .p-b-223 {
            padding-bottom: 223px;
        }

        .p-b-224 {
            padding-bottom: 224px;
        }

        .p-b-225 {
            padding-bottom: 225px;
        }

        .p-b-226 {
            padding-bottom: 226px;
        }

        .p-b-227 {
            padding-bottom: 227px;
        }

        .p-b-228 {
            padding-bottom: 228px;
        }

        .p-b-229 {
            padding-bottom: 229px;
        }

        .p-b-230 {
            padding-bottom: 230px;
        }

        .p-b-231 {
            padding-bottom: 231px;
        }

        .p-b-232 {
            padding-bottom: 232px;
        }

        .p-b-233 {
            padding-bottom: 233px;
        }

        .p-b-234 {
            padding-bottom: 234px;
        }

        .p-b-235 {
            padding-bottom: 235px;
        }

        .p-b-236 {
            padding-bottom: 236px;
        }

        .p-b-237 {
            padding-bottom: 237px;
        }

        .p-b-238 {
            padding-bottom: 238px;
        }

        .p-b-239 {
            padding-bottom: 239px;
        }

        .p-b-240 {
            padding-bottom: 240px;
        }

        .p-b-241 {
            padding-bottom: 241px;
        }

        .p-b-242 {
            padding-bottom: 242px;
        }

        .p-b-243 {
            padding-bottom: 243px;
        }

        .p-b-244 {
            padding-bottom: 244px;
        }

        .p-b-245 {
            padding-bottom: 245px;
        }

        .p-b-246 {
            padding-bottom: 246px;
        }

        .p-b-247 {
            padding-bottom: 247px;
        }

        .p-b-248 {
            padding-bottom: 248px;
        }

        .p-b-249 {
            padding-bottom: 249px;
        }

        .p-b-250 {
            padding-bottom: 250px;
        }

        .p-l-0 {
            padding-left: 0px;
        }

        .p-l-1 {
            padding-left: 1px;
        }

        .p-l-2 {
            padding-left: 2px;
        }

        .p-l-3 {
            padding-left: 3px;
        }

        .p-l-4 {
            padding-left: 4px;
        }

        .p-l-5 {
            padding-left: 5px;
        }

        .p-l-6 {
            padding-left: 6px;
        }

        .p-l-7 {
            padding-left: 7px;
        }

        .p-l-8 {
            padding-left: 8px;
        }

        .p-l-9 {
            padding-left: 9px;
        }

        .p-l-10 {
            padding-left: 10px;
        }

        .p-l-11 {
            padding-left: 11px;
        }

        .p-l-12 {
            padding-left: 12px;
        }

        .p-l-13 {
            padding-left: 13px;
        }

        .p-l-14 {
            padding-left: 14px;
        }

        .p-l-15 {
            padding-left: 15px;
        }

        .p-l-16 {
            padding-left: 16px;
        }

        .p-l-17 {
            padding-left: 17px;
        }

        .p-l-18 {
            padding-left: 18px;
        }

        .p-l-19 {
            padding-left: 19px;
        }

        .p-l-20 {
            padding-left: 20px;
        }

        .p-l-21 {
            padding-left: 21px;
        }

        .p-l-22 {
            padding-left: 22px;
        }

        .p-l-23 {
            padding-left: 23px;
        }

        .p-l-24 {
            padding-left: 24px;
        }

        .p-l-25 {
            padding-left: 25px;
        }

        .p-l-26 {
            padding-left: 26px;
        }

        .p-l-27 {
            padding-left: 27px;
        }

        .p-l-28 {
            padding-left: 28px;
        }

        .p-l-29 {
            padding-left: 29px;
        }

        .p-l-30 {
            padding-left: 30px;
        }

        .p-l-31 {
            padding-left: 31px;
        }

        .p-l-32 {
            padding-left: 32px;
        }

        .p-l-33 {
            padding-left: 33px;
        }

        .p-l-34 {
            padding-left: 34px;
        }

        .p-l-35 {
            padding-left: 35px;
        }

        .p-l-36 {
            padding-left: 36px;
        }

        .p-l-37 {
            padding-left: 37px;
        }

        .p-l-38 {
            padding-left: 38px;
        }

        .p-l-39 {
            padding-left: 39px;
        }

        .p-l-40 {
            padding-left: 40px;
        }

        .p-l-41 {
            padding-left: 41px;
        }

        .p-l-42 {
            padding-left: 42px;
        }

        .p-l-43 {
            padding-left: 43px;
        }

        .p-l-44 {
            padding-left: 44px;
        }

        .p-l-45 {
            padding-left: 45px;
        }

        .p-l-46 {
            padding-left: 46px;
        }

        .p-l-47 {
            padding-left: 47px;
        }

        .p-l-48 {
            padding-left: 48px;
        }

        .p-l-49 {
            padding-left: 49px;
        }

        .p-l-50 {
            padding-left: 50px;
        }

        .p-l-51 {
            padding-left: 51px;
        }

        .p-l-52 {
            padding-left: 52px;
        }

        .p-l-53 {
            padding-left: 53px;
        }

        .p-l-54 {
            padding-left: 54px;
        }

        .p-l-55 {
            padding-left: 55px;
        }

        .p-l-56 {
            padding-left: 56px;
        }

        .p-l-57 {
            padding-left: 57px;
        }

        .p-l-58 {
            padding-left: 58px;
        }

        .p-l-59 {
            padding-left: 59px;
        }

        .p-l-60 {
            padding-left: 60px;
        }

        .p-l-61 {
            padding-left: 61px;
        }

        .p-l-62 {
            padding-left: 62px;
        }

        .p-l-63 {
            padding-left: 63px;
        }

        .p-l-64 {
            padding-left: 64px;
        }

        .p-l-65 {
            padding-left: 65px;
        }

        .p-l-66 {
            padding-left: 66px;
        }

        .p-l-67 {
            padding-left: 67px;
        }

        .p-l-68 {
            padding-left: 68px;
        }

        .p-l-69 {
            padding-left: 69px;
        }

        .p-l-70 {
            padding-left: 70px;
        }

        .p-l-71 {
            padding-left: 71px;
        }

        .p-l-72 {
            padding-left: 72px;
        }

        .p-l-73 {
            padding-left: 73px;
        }

        .p-l-74 {
            padding-left: 74px;
        }

        .p-l-75 {
            padding-left: 75px;
        }

        .p-l-76 {
            padding-left: 76px;
        }

        .p-l-77 {
            padding-left: 77px;
        }

        .p-l-78 {
            padding-left: 78px;
        }

        .p-l-79 {
            padding-left: 79px;
        }

        .p-l-80 {
            padding-left: 80px;
        }

        .p-l-81 {
            padding-left: 81px;
        }

        .p-l-82 {
            padding-left: 82px;
        }

        .p-l-83 {
            padding-left: 83px;
        }

        .p-l-84 {
            padding-left: 84px;
        }

        .p-l-85 {
            padding-left: 85px;
        }

        .p-l-86 {
            padding-left: 86px;
        }

        .p-l-87 {
            padding-left: 87px;
        }

        .p-l-88 {
            padding-left: 88px;
        }

        .p-l-89 {
            padding-left: 89px;
        }

        .p-l-90 {
            padding-left: 90px;
        }

        .p-l-91 {
            padding-left: 91px;
        }

        .p-l-92 {
            padding-left: 92px;
        }

        .p-l-93 {
            padding-left: 93px;
        }

        .p-l-94 {
            padding-left: 94px;
        }

        .p-l-95 {
            padding-left: 95px;
        }

        .p-l-96 {
            padding-left: 96px;
        }

        .p-l-97 {
            padding-left: 97px;
        }

        .p-l-98 {
            padding-left: 98px;
        }

        .p-l-99 {
            padding-left: 99px;
        }

        .p-l-100 {
            padding-left: 100px;
        }

        .p-l-101 {
            padding-left: 101px;
        }

        .p-l-102 {
            padding-left: 102px;
        }

        .p-l-103 {
            padding-left: 103px;
        }

        .p-l-104 {
            padding-left: 104px;
        }

        .p-l-105 {
            padding-left: 105px;
        }

        .p-l-106 {
            padding-left: 106px;
        }

        .p-l-107 {
            padding-left: 107px;
        }

        .p-l-108 {
            padding-left: 108px;
        }

        .p-l-109 {
            padding-left: 109px;
        }

        .p-l-110 {
            padding-left: 110px;
        }

        .p-l-111 {
            padding-left: 111px;
        }

        .p-l-112 {
            padding-left: 112px;
        }

        .p-l-113 {
            padding-left: 113px;
        }

        .p-l-114 {
            padding-left: 114px;
        }

        .p-l-115 {
            padding-left: 115px;
        }

        .p-l-116 {
            padding-left: 116px;
        }

        .p-l-117 {
            padding-left: 117px;
        }

        .p-l-118 {
            padding-left: 118px;
        }

        .p-l-119 {
            padding-left: 119px;
        }

        .p-l-120 {
            padding-left: 120px;
        }

        .p-l-121 {
            padding-left: 121px;
        }

        .p-l-122 {
            padding-left: 122px;
        }

        .p-l-123 {
            padding-left: 123px;
        }

        .p-l-124 {
            padding-left: 124px;
        }

        .p-l-125 {
            padding-left: 125px;
        }

        .p-l-126 {
            padding-left: 126px;
        }

        .p-l-127 {
            padding-left: 127px;
        }

        .p-l-128 {
            padding-left: 128px;
        }

        .p-l-129 {
            padding-left: 129px;
        }

        .p-l-130 {
            padding-left: 130px;
        }

        .p-l-131 {
            padding-left: 131px;
        }

        .p-l-132 {
            padding-left: 132px;
        }

        .p-l-133 {
            padding-left: 133px;
        }

        .p-l-134 {
            padding-left: 134px;
        }

        .p-l-135 {
            padding-left: 135px;
        }

        .p-l-136 {
            padding-left: 136px;
        }

        .p-l-137 {
            padding-left: 137px;
        }

        .p-l-138 {
            padding-left: 138px;
        }

        .p-l-139 {
            padding-left: 139px;
        }

        .p-l-140 {
            padding-left: 140px;
        }

        .p-l-141 {
            padding-left: 141px;
        }

        .p-l-142 {
            padding-left: 142px;
        }

        .p-l-143 {
            padding-left: 143px;
        }

        .p-l-144 {
            padding-left: 144px;
        }

        .p-l-145 {
            padding-left: 145px;
        }

        .p-l-146 {
            padding-left: 146px;
        }

        .p-l-147 {
            padding-left: 147px;
        }

        .p-l-148 {
            padding-left: 148px;
        }

        .p-l-149 {
            padding-left: 149px;
        }

        .p-l-150 {
            padding-left: 150px;
        }

        .p-l-151 {
            padding-left: 151px;
        }

        .p-l-152 {
            padding-left: 152px;
        }

        .p-l-153 {
            padding-left: 153px;
        }

        .p-l-154 {
            padding-left: 154px;
        }

        .p-l-155 {
            padding-left: 155px;
        }

        .p-l-156 {
            padding-left: 156px;
        }

        .p-l-157 {
            padding-left: 157px;
        }

        .p-l-158 {
            padding-left: 158px;
        }

        .p-l-159 {
            padding-left: 159px;
        }

        .p-l-160 {
            padding-left: 160px;
        }

        .p-l-161 {
            padding-left: 161px;
        }

        .p-l-162 {
            padding-left: 162px;
        }

        .p-l-163 {
            padding-left: 163px;
        }

        .p-l-164 {
            padding-left: 164px;
        }

        .p-l-165 {
            padding-left: 165px;
        }

        .p-l-166 {
            padding-left: 166px;
        }

        .p-l-167 {
            padding-left: 167px;
        }

        .p-l-168 {
            padding-left: 168px;
        }

        .p-l-169 {
            padding-left: 169px;
        }

        .p-l-170 {
            padding-left: 170px;
        }

        .p-l-171 {
            padding-left: 171px;
        }

        .p-l-172 {
            padding-left: 172px;
        }

        .p-l-173 {
            padding-left: 173px;
        }

        .p-l-174 {
            padding-left: 174px;
        }

        .p-l-175 {
            padding-left: 175px;
        }

        .p-l-176 {
            padding-left: 176px;
        }

        .p-l-177 {
            padding-left: 177px;
        }

        .p-l-178 {
            padding-left: 178px;
        }

        .p-l-179 {
            padding-left: 179px;
        }

        .p-l-180 {
            padding-left: 180px;
        }

        .p-l-181 {
            padding-left: 181px;
        }

        .p-l-182 {
            padding-left: 182px;
        }

        .p-l-183 {
            padding-left: 183px;
        }

        .p-l-184 {
            padding-left: 184px;
        }

        .p-l-185 {
            padding-left: 185px;
        }

        .p-l-186 {
            padding-left: 186px;
        }

        .p-l-187 {
            padding-left: 187px;
        }

        .p-l-188 {
            padding-left: 188px;
        }

        .p-l-189 {
            padding-left: 189px;
        }

        .p-l-190 {
            padding-left: 190px;
        }

        .p-l-191 {
            padding-left: 191px;
        }

        .p-l-192 {
            padding-left: 192px;
        }

        .p-l-193 {
            padding-left: 193px;
        }

        .p-l-194 {
            padding-left: 194px;
        }

        .p-l-195 {
            padding-left: 195px;
        }

        .p-l-196 {
            padding-left: 196px;
        }

        .p-l-197 {
            padding-left: 197px;
        }

        .p-l-198 {
            padding-left: 198px;
        }

        .p-l-199 {
            padding-left: 199px;
        }

        .p-l-200 {
            padding-left: 200px;
        }

        .p-l-201 {
            padding-left: 201px;
        }

        .p-l-202 {
            padding-left: 202px;
        }

        .p-l-203 {
            padding-left: 203px;
        }

        .p-l-204 {
            padding-left: 204px;
        }

        .p-l-205 {
            padding-left: 205px;
        }

        .p-l-206 {
            padding-left: 206px;
        }

        .p-l-207 {
            padding-left: 207px;
        }

        .p-l-208 {
            padding-left: 208px;
        }

        .p-l-209 {
            padding-left: 209px;
        }

        .p-l-210 {
            padding-left: 210px;
        }

        .p-l-211 {
            padding-left: 211px;
        }

        .p-l-212 {
            padding-left: 212px;
        }

        .p-l-213 {
            padding-left: 213px;
        }

        .p-l-214 {
            padding-left: 214px;
        }

        .p-l-215 {
            padding-left: 215px;
        }

        .p-l-216 {
            padding-left: 216px;
        }

        .p-l-217 {
            padding-left: 217px;
        }

        .p-l-218 {
            padding-left: 218px;
        }

        .p-l-219 {
            padding-left: 219px;
        }

        .p-l-220 {
            padding-left: 220px;
        }

        .p-l-221 {
            padding-left: 221px;
        }

        .p-l-222 {
            padding-left: 222px;
        }

        .p-l-223 {
            padding-left: 223px;
        }

        .p-l-224 {
            padding-left: 224px;
        }

        .p-l-225 {
            padding-left: 225px;
        }

        .p-l-226 {
            padding-left: 226px;
        }

        .p-l-227 {
            padding-left: 227px;
        }

        .p-l-228 {
            padding-left: 228px;
        }

        .p-l-229 {
            padding-left: 229px;
        }

        .p-l-230 {
            padding-left: 230px;
        }

        .p-l-231 {
            padding-left: 231px;
        }

        .p-l-232 {
            padding-left: 232px;
        }

        .p-l-233 {
            padding-left: 233px;
        }

        .p-l-234 {
            padding-left: 234px;
        }

        .p-l-235 {
            padding-left: 235px;
        }

        .p-l-236 {
            padding-left: 236px;
        }

        .p-l-237 {
            padding-left: 237px;
        }

        .p-l-238 {
            padding-left: 238px;
        }

        .p-l-239 {
            padding-left: 239px;
        }

        .p-l-240 {
            padding-left: 240px;
        }

        .p-l-241 {
            padding-left: 241px;
        }

        .p-l-242 {
            padding-left: 242px;
        }

        .p-l-243 {
            padding-left: 243px;
        }

        .p-l-244 {
            padding-left: 244px;
        }

        .p-l-245 {
            padding-left: 245px;
        }

        .p-l-246 {
            padding-left: 246px;
        }

        .p-l-247 {
            padding-left: 247px;
        }

        .p-l-248 {
            padding-left: 248px;
        }

        .p-l-249 {
            padding-left: 249px;
        }

        .p-l-250 {
            padding-left: 250px;
        }

        .p-r-0 {
            padding-right: 0px;
        }

        .p-r-1 {
            padding-right: 1px;
        }

        .p-r-2 {
            padding-right: 2px;
        }

        .p-r-3 {
            padding-right: 3px;
        }

        .p-r-4 {
            padding-right: 4px;
        }

        .p-r-5 {
            padding-right: 5px;
        }

        .p-r-6 {
            padding-right: 6px;
        }

        .p-r-7 {
            padding-right: 7px;
        }

        .p-r-8 {
            padding-right: 8px;
        }

        .p-r-9 {
            padding-right: 9px;
        }

        .p-r-10 {
            padding-right: 10px;
        }

        .p-r-11 {
            padding-right: 11px;
        }

        .p-r-12 {
            padding-right: 12px;
        }

        .p-r-13 {
            padding-right: 13px;
        }

        .p-r-14 {
            padding-right: 14px;
        }

        .p-r-15 {
            padding-right: 15px;
        }

        .p-r-16 {
            padding-right: 16px;
        }

        .p-r-17 {
            padding-right: 17px;
        }

        .p-r-18 {
            padding-right: 18px;
        }

        .p-r-19 {
            padding-right: 19px;
        }

        .p-r-20 {
            padding-right: 20px;
        }

        .p-r-21 {
            padding-right: 21px;
        }

        .p-r-22 {
            padding-right: 22px;
        }

        .p-r-23 {
            padding-right: 23px;
        }

        .p-r-24 {
            padding-right: 24px;
        }

        .p-r-25 {
            padding-right: 25px;
        }

        .p-r-26 {
            padding-right: 26px;
        }

        .p-r-27 {
            padding-right: 27px;
        }

        .p-r-28 {
            padding-right: 28px;
        }

        .p-r-29 {
            padding-right: 29px;
        }

        .p-r-30 {
            padding-right: 30px;
        }

        .p-r-31 {
            padding-right: 31px;
        }

        .p-r-32 {
            padding-right: 32px;
        }

        .p-r-33 {
            padding-right: 33px;
        }

        .p-r-34 {
            padding-right: 34px;
        }

        .p-r-35 {
            padding-right: 35px;
        }

        .p-r-36 {
            padding-right: 36px;
        }

        .p-r-37 {
            padding-right: 37px;
        }

        .p-r-38 {
            padding-right: 38px;
        }

        .p-r-39 {
            padding-right: 39px;
        }

        .p-r-40 {
            padding-right: 40px;
        }

        .p-r-41 {
            padding-right: 41px;
        }

        .p-r-42 {
            padding-right: 42px;
        }

        .p-r-43 {
            padding-right: 43px;
        }

        .p-r-44 {
            padding-right: 44px;
        }

        .p-r-45 {
            padding-right: 45px;
        }

        .p-r-46 {
            padding-right: 46px;
        }

        .p-r-47 {
            padding-right: 47px;
        }

        .p-r-48 {
            padding-right: 48px;
        }

        .p-r-49 {
            padding-right: 49px;
        }

        .p-r-50 {
            padding-right: 50px;
        }

        .p-r-51 {
            padding-right: 51px;
        }

        .p-r-52 {
            padding-right: 52px;
        }

        .p-r-53 {
            padding-right: 53px;
        }

        .p-r-54 {
            padding-right: 54px;
        }

        .p-r-55 {
            padding-right: 55px;
        }

        .p-r-56 {
            padding-right: 56px;
        }

        .p-r-57 {
            padding-right: 57px;
        }

        .p-r-58 {
            padding-right: 58px;
        }

        .p-r-59 {
            padding-right: 59px;
        }

        .p-r-60 {
            padding-right: 60px;
        }

        .p-r-61 {
            padding-right: 61px;
        }

        .p-r-62 {
            padding-right: 62px;
        }

        .p-r-63 {
            padding-right: 63px;
        }

        .p-r-64 {
            padding-right: 64px;
        }

        .p-r-65 {
            padding-right: 65px;
        }

        .p-r-66 {
            padding-right: 66px;
        }

        .p-r-67 {
            padding-right: 67px;
        }

        .p-r-68 {
            padding-right: 68px;
        }

        .p-r-69 {
            padding-right: 69px;
        }

        .p-r-70 {
            padding-right: 70px;
        }

        .p-r-71 {
            padding-right: 71px;
        }

        .p-r-72 {
            padding-right: 72px;
        }

        .p-r-73 {
            padding-right: 73px;
        }

        .p-r-74 {
            padding-right: 74px;
        }

        .p-r-75 {
            padding-right: 75px;
        }

        .p-r-76 {
            padding-right: 76px;
        }

        .p-r-77 {
            padding-right: 77px;
        }

        .p-r-78 {
            padding-right: 78px;
        }

        .p-r-79 {
            padding-right: 79px;
        }

        .p-r-80 {
            padding-right: 80px;
        }

        .p-r-81 {
            padding-right: 81px;
        }

        .p-r-82 {
            padding-right: 82px;
        }

        .p-r-83 {
            padding-right: 83px;
        }

        .p-r-84 {
            padding-right: 84px;
        }

        .p-r-85 {
            padding-right: 85px;
        }

        .p-r-86 {
            padding-right: 86px;
        }

        .p-r-87 {
            padding-right: 87px;
        }

        .p-r-88 {
            padding-right: 88px;
        }

        .p-r-89 {
            padding-right: 89px;
        }

        .p-r-90 {
            padding-right: 90px;
        }

        .p-r-91 {
            padding-right: 91px;
        }

        .p-r-92 {
            padding-right: 92px;
        }

        .p-r-93 {
            padding-right: 93px;
        }

        .p-r-94 {
            padding-right: 94px;
        }

        .p-r-95 {
            padding-right: 95px;
        }

        .p-r-96 {
            padding-right: 96px;
        }

        .p-r-97 {
            padding-right: 97px;
        }

        .p-r-98 {
            padding-right: 98px;
        }

        .p-r-99 {
            padding-right: 99px;
        }

        .p-r-100 {
            padding-right: 100px;
        }

        .p-r-101 {
            padding-right: 101px;
        }

        .p-r-102 {
            padding-right: 102px;
        }

        .p-r-103 {
            padding-right: 103px;
        }

        .p-r-104 {
            padding-right: 104px;
        }

        .p-r-105 {
            padding-right: 105px;
        }

        .p-r-106 {
            padding-right: 106px;
        }

        .p-r-107 {
            padding-right: 107px;
        }

        .p-r-108 {
            padding-right: 108px;
        }

        .p-r-109 {
            padding-right: 109px;
        }

        .p-r-110 {
            padding-right: 110px;
        }

        .p-r-111 {
            padding-right: 111px;
        }

        .p-r-112 {
            padding-right: 112px;
        }

        .p-r-113 {
            padding-right: 113px;
        }

        .p-r-114 {
            padding-right: 114px;
        }

        .p-r-115 {
            padding-right: 115px;
        }

        .p-r-116 {
            padding-right: 116px;
        }

        .p-r-117 {
            padding-right: 117px;
        }

        .p-r-118 {
            padding-right: 118px;
        }

        .p-r-119 {
            padding-right: 119px;
        }

        .p-r-120 {
            padding-right: 120px;
        }

        .p-r-121 {
            padding-right: 121px;
        }

        .p-r-122 {
            padding-right: 122px;
        }

        .p-r-123 {
            padding-right: 123px;
        }

        .p-r-124 {
            padding-right: 124px;
        }

        .p-r-125 {
            padding-right: 125px;
        }

        .p-r-126 {
            padding-right: 126px;
        }

        .p-r-127 {
            padding-right: 127px;
        }

        .p-r-128 {
            padding-right: 128px;
        }

        .p-r-129 {
            padding-right: 129px;
        }

        .p-r-130 {
            padding-right: 130px;
        }

        .p-r-131 {
            padding-right: 131px;
        }

        .p-r-132 {
            padding-right: 132px;
        }

        .p-r-133 {
            padding-right: 133px;
        }

        .p-r-134 {
            padding-right: 134px;
        }

        .p-r-135 {
            padding-right: 135px;
        }

        .p-r-136 {
            padding-right: 136px;
        }

        .p-r-137 {
            padding-right: 137px;
        }

        .p-r-138 {
            padding-right: 138px;
        }

        .p-r-139 {
            padding-right: 139px;
        }

        .p-r-140 {
            padding-right: 140px;
        }

        .p-r-141 {
            padding-right: 141px;
        }

        .p-r-142 {
            padding-right: 142px;
        }

        .p-r-143 {
            padding-right: 143px;
        }

        .p-r-144 {
            padding-right: 144px;
        }

        .p-r-145 {
            padding-right: 145px;
        }

        .p-r-146 {
            padding-right: 146px;
        }

        .p-r-147 {
            padding-right: 147px;
        }

        .p-r-148 {
            padding-right: 148px;
        }

        .p-r-149 {
            padding-right: 149px;
        }

        .p-r-150 {
            padding-right: 150px;
        }

        .p-r-151 {
            padding-right: 151px;
        }

        .p-r-152 {
            padding-right: 152px;
        }

        .p-r-153 {
            padding-right: 153px;
        }

        .p-r-154 {
            padding-right: 154px;
        }

        .p-r-155 {
            padding-right: 155px;
        }

        .p-r-156 {
            padding-right: 156px;
        }

        .p-r-157 {
            padding-right: 157px;
        }

        .p-r-158 {
            padding-right: 158px;
        }

        .p-r-159 {
            padding-right: 159px;
        }

        .p-r-160 {
            padding-right: 160px;
        }

        .p-r-161 {
            padding-right: 161px;
        }

        .p-r-162 {
            padding-right: 162px;
        }

        .p-r-163 {
            padding-right: 163px;
        }

        .p-r-164 {
            padding-right: 164px;
        }

        .p-r-165 {
            padding-right: 165px;
        }

        .p-r-166 {
            padding-right: 166px;
        }

        .p-r-167 {
            padding-right: 167px;
        }

        .p-r-168 {
            padding-right: 168px;
        }

        .p-r-169 {
            padding-right: 169px;
        }

        .p-r-170 {
            padding-right: 170px;
        }

        .p-r-171 {
            padding-right: 171px;
        }

        .p-r-172 {
            padding-right: 172px;
        }

        .p-r-173 {
            padding-right: 173px;
        }

        .p-r-174 {
            padding-right: 174px;
        }

        .p-r-175 {
            padding-right: 175px;
        }

        .p-r-176 {
            padding-right: 176px;
        }

        .p-r-177 {
            padding-right: 177px;
        }

        .p-r-178 {
            padding-right: 178px;
        }

        .p-r-179 {
            padding-right: 179px;
        }

        .p-r-180 {
            padding-right: 180px;
        }

        .p-r-181 {
            padding-right: 181px;
        }

        .p-r-182 {
            padding-right: 182px;
        }

        .p-r-183 {
            padding-right: 183px;
        }

        .p-r-184 {
            padding-right: 184px;
        }

        .p-r-185 {
            padding-right: 185px;
        }

        .p-r-186 {
            padding-right: 186px;
        }

        .p-r-187 {
            padding-right: 187px;
        }

        .p-r-188 {
            padding-right: 188px;
        }

        .p-r-189 {
            padding-right: 189px;
        }

        .p-r-190 {
            padding-right: 190px;
        }

        .p-r-191 {
            padding-right: 191px;
        }

        .p-r-192 {
            padding-right: 192px;
        }

        .p-r-193 {
            padding-right: 193px;
        }

        .p-r-194 {
            padding-right: 194px;
        }

        .p-r-195 {
            padding-right: 195px;
        }

        .p-r-196 {
            padding-right: 196px;
        }

        .p-r-197 {
            padding-right: 197px;
        }

        .p-r-198 {
            padding-right: 198px;
        }

        .p-r-199 {
            padding-right: 199px;
        }

        .p-r-200 {
            padding-right: 200px;
        }

        .p-r-201 {
            padding-right: 201px;
        }

        .p-r-202 {
            padding-right: 202px;
        }

        .p-r-203 {
            padding-right: 203px;
        }

        .p-r-204 {
            padding-right: 204px;
        }

        .p-r-205 {
            padding-right: 205px;
        }

        .p-r-206 {
            padding-right: 206px;
        }

        .p-r-207 {
            padding-right: 207px;
        }

        .p-r-208 {
            padding-right: 208px;
        }

        .p-r-209 {
            padding-right: 209px;
        }

        .p-r-210 {
            padding-right: 210px;
        }

        .p-r-211 {
            padding-right: 211px;
        }

        .p-r-212 {
            padding-right: 212px;
        }

        .p-r-213 {
            padding-right: 213px;
        }

        .p-r-214 {
            padding-right: 214px;
        }

        .p-r-215 {
            padding-right: 215px;
        }

        .p-r-216 {
            padding-right: 216px;
        }

        .p-r-217 {
            padding-right: 217px;
        }

        .p-r-218 {
            padding-right: 218px;
        }

        .p-r-219 {
            padding-right: 219px;
        }

        .p-r-220 {
            padding-right: 220px;
        }

        .p-r-221 {
            padding-right: 221px;
        }

        .p-r-222 {
            padding-right: 222px;
        }

        .p-r-223 {
            padding-right: 223px;
        }

        .p-r-224 {
            padding-right: 224px;
        }

        .p-r-225 {
            padding-right: 225px;
        }

        .p-r-226 {
            padding-right: 226px;
        }

        .p-r-227 {
            padding-right: 227px;
        }

        .p-r-228 {
            padding-right: 228px;
        }

        .p-r-229 {
            padding-right: 229px;
        }

        .p-r-230 {
            padding-right: 230px;
        }

        .p-r-231 {
            padding-right: 231px;
        }

        .p-r-232 {
            padding-right: 232px;
        }

        .p-r-233 {
            padding-right: 233px;
        }

        .p-r-234 {
            padding-right: 234px;
        }

        .p-r-235 {
            padding-right: 235px;
        }

        .p-r-236 {
            padding-right: 236px;
        }

        .p-r-237 {
            padding-right: 237px;
        }

        .p-r-238 {
            padding-right: 238px;
        }

        .p-r-239 {
            padding-right: 239px;
        }

        .p-r-240 {
            padding-right: 240px;
        }

        .p-r-241 {
            padding-right: 241px;
        }

        .p-r-242 {
            padding-right: 242px;
        }

        .p-r-243 {
            padding-right: 243px;
        }

        .p-r-244 {
            padding-right: 244px;
        }

        .p-r-245 {
            padding-right: 245px;
        }

        .p-r-246 {
            padding-right: 246px;
        }

        .p-r-247 {
            padding-right: 247px;
        }

        .p-r-248 {
            padding-right: 248px;
        }

        .p-r-249 {
            padding-right: 249px;
        }

        .p-r-250 {
            padding-right: 250px;
        }


        /*[ TEXT ]
      ///////////////////////////////////////////////////////////
      */
        /* ------------------------------------ */
        .text-white {
            color: white;
        }

        .text-black {
            color: black;
        }

        .text-hov-white:hover {
            color: white;
        }

        /* ------------------------------------ */
        .text-up {
            text-transform: uppercase;
        }

        /* ------------------------------------ */
        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .text-middle {
            vertical-align: middle;
        }

        /* ------------------------------------ */
        .lh-1-0 {
            line-height: 1.0;
        }

        .lh-1-1 {
            line-height: 1.1;
        }

        .lh-1-2 {
            line-height: 1.2;
        }

        .lh-1-3 {
            line-height: 1.3;
        }

        .lh-1-4 {
            line-height: 1.4;
        }

        .lh-1-5 {
            line-height: 1.5;
        }

        .lh-1-6 {
            line-height: 1.6;
        }

        .lh-1-7 {
            line-height: 1.7;
        }

        .lh-1-8 {
            line-height: 1.8;
        }

        .lh-1-9 {
            line-height: 1.9;
        }

        .lh-2-0 {
            line-height: 2.0;
        }

        .lh-2-1 {
            line-height: 2.1;
        }

        .lh-2-2 {
            line-height: 2.2;
        }

        .lh-2-3 {
            line-height: 2.3;
        }

        .lh-2-4 {
            line-height: 2.4;
        }

        .lh-2-5 {
            line-height: 2.5;
        }

        .lh-2-6 {
            line-height: 2.6;
        }

        .lh-2-7 {
            line-height: 2.7;
        }

        .lh-2-8 {
            line-height: 2.8;
        }

        .lh-2-9 {
            line-height: 2.9;
        }


        /*[ SHAPE ]
      ///////////////////////////////////////////////////////////
      */

        /*[ Display ]
      -----------------------------------------------------------
      */
        .dis-none {
            display: none;
        }

        .dis-block {
            display: block;
        }

        .dis-inline {
            display: inline;
        }

        .dis-inline-block {
            display: inline-block;
        }

        .dis-flex {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
        }

        /*[ Position ]
      -----------------------------------------------------------
      */
        .pos-relative {
            position: relative;
        }

        .pos-absolute {
            position: absolute;
        }

        .pos-fixed {
            position: fixed;
        }

        /*[ float ]
      -----------------------------------------------------------
      */
        .float-l {
            float: left;
        }

        .float-r {
            float: right;
        }


        /*[ Width & Height ]
      -----------------------------------------------------------
      */
        .sizefull {
            width: 100%;
            height: 100%;
        }

        .w-full {
            width: 100%;
        }

        .h-full {
            height: 100%;
        }

        .max-w-full {
            max-width: 100%;
        }

        .max-h-full {
            max-height: 100%;
        }

        .min-w-full {
            min-width: 100%;
        }

        .min-h-full {
            min-height: 100%;
        }

        /*[ Top Bottom Left Right ]
      -----------------------------------------------------------
      */
        .top-0 {
            top: 0;
        }

        .bottom-0 {
            bottom: 0;
        }

        .left-0 {
            left: 0;
        }

        .right-0 {
            right: 0;
        }

        .top-auto {
            top: auto;
        }

        .bottom-auto {
            bottom: auto;
        }

        .left-auto {
            left: auto;
        }

        .right-auto {
            right: auto;
        }


        /*[ Opacity ]
      -----------------------------------------------------------
      */
        .op-0-0 {
            opacity: 0;
        }

        .op-0-1 {
            opacity: 0.1;
        }

        .op-0-2 {
            opacity: 0.2;
        }

        .op-0-3 {
            opacity: 0.3;
        }

        .op-0-4 {
            opacity: 0.4;
        }

        .op-0-5 {
            opacity: 0.5;
        }

        .op-0-6 {
            opacity: 0.6;
        }

        .op-0-7 {
            opacity: 0.7;
        }

        .op-0-8 {
            opacity: 0.8;
        }

        .op-0-9 {
            opacity: 0.9;
        }

        .op-1-0 {
            opacity: 1;
        }

        /*[ Background ]
      -----------------------------------------------------------
      */
        .bgwhite {
            background-color: white;
        }

        .bgblack {
            background-color: black;
        }


        /*[ Wrap Picture ]
      -----------------------------------------------------------
      */
        .wrap-pic-w img {
            width: 100%;
        }

        .wrap-pic-max-w img {
            max-width: 100%;
        }

        /* ------------------------------------ */
        .wrap-pic-h img {
            height: 100%;
        }

        .wrap-pic-max-h img {
            max-height: 100%;
        }

        /* ------------------------------------ */
        .wrap-pic-cir {
            border-radius: 50%;
            overflow: hidden;
        }

        .wrap-pic-cir img {
            width: 100%;
        }


        /*[ Hover ]
      -----------------------------------------------------------
      */
        .hov-pointer:hover {
            cursor: pointer;
        }

        /* ------------------------------------ */
        .hov-img-zoom {
            display: block;
            overflow: hidden;
        }

        .hov-img-zoom img {
            width: 100%;
            -webkit-transition: all 0.6s;
            -o-transition: all 0.6s;
            -moz-transition: all 0.6s;
            transition: all 0.6s;
        }

        .hov-img-zoom:hover img {
            -webkit-transform: scale(1.1);
            -moz-transform: scale(1.1);
            -ms-transform: scale(1.1);
            -o-transform: scale(1.1);
            transform: scale(1.1);
        }


        /*[  ]
      -----------------------------------------------------------
      */
        .bo-cir {
            border-radius: 50%;
        }

        .of-hidden {
            overflow: hidden;
        }

        .visible-false {
            visibility: hidden;
        }

        .visible-true {
            visibility: visible;
        }


        /*[ Transition ]
      -----------------------------------------------------------
      */
        .trans-0-1 {
            -webkit-transition: all 0.1s;
            -o-transition: all 0.1s;
            -moz-transition: all 0.1s;
            transition: all 0.1s;
        }

        .trans-0-2 {
            -webkit-transition: all 0.2s;
            -o-transition: all 0.2s;
            -moz-transition: all 0.2s;
            transition: all 0.2s;
        }

        .trans-0-3 {
            -webkit-transition: all 0.3s;
            -o-transition: all 0.3s;
            -moz-transition: all 0.3s;
            transition: all 0.3s;
        }

        .trans-0-4 {
            -webkit-transition: all 0.4s;
            -o-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }

        .trans-0-5 {
            -webkit-transition: all 0.5s;
            -o-transition: all 0.5s;
            -moz-transition: all 0.5s;
            transition: all 0.5s;
        }

        .trans-0-6 {
            -webkit-transition: all 0.6s;
            -o-transition: all 0.6s;
            -moz-transition: all 0.6s;
            transition: all 0.6s;
        }

        .trans-0-9 {
            -webkit-transition: all 0.9s;
            -o-transition: all 0.9s;
            -moz-transition: all 0.9s;
            transition: all 0.9s;
        }

        .trans-1-0 {
            -webkit-transition: all 1s;
            -o-transition: all 1s;
            -moz-transition: all 1s;
            transition: all 1s;
        }


        /*[ Layout ]
      ///////////////////////////////////////////////////////////
      */

        /*[ Flex ]
      -----------------------------------------------------------
      */
        /* ------------------------------------ */
        .flex-w {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-flex-wrap: wrap;
            -moz-flex-wrap: wrap;
            -ms-flex-wrap: wrap;
            -o-flex-wrap: wrap;
            flex-wrap: wrap;
        }

        /* ------------------------------------ */
        .flex-l {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            justify-content: flex-start;
        }

        .flex-r {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            justify-content: flex-end;
        }

        .flex-c {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            justify-content: center;
        }

        .flex-sa {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            justify-content: space-around;
        }

        .flex-sb {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            justify-content: space-between;
        }

        /* ------------------------------------ */
        .flex-t {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            -ms-align-items: flex-start;
            align-items: flex-start;
        }

        .flex-b {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            -ms-align-items: flex-end;
            align-items: flex-end;
        }

        .flex-m {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            -ms-align-items: center;
            align-items: center;
        }

        .flex-str {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            -ms-align-items: stretch;
            align-items: stretch;
        }

        /* ------------------------------------ */
        .flex-row {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-flex-direction: row;
            -moz-flex-direction: row;
            -ms-flex-direction: row;
            -o-flex-direction: row;
            flex-direction: row;
        }

        .flex-row-rev {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-flex-direction: row-reverse;
            -moz-flex-direction: row-reverse;
            -ms-flex-direction: row-reverse;
            -o-flex-direction: row-reverse;
            flex-direction: row-reverse;
        }

        .flex-col {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-flex-direction: column;
            -moz-flex-direction: column;
            -ms-flex-direction: column;
            -o-flex-direction: column;
            flex-direction: column;
        }

        .flex-col-rev {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-flex-direction: column-reverse;
            -moz-flex-direction: column-reverse;
            -ms-flex-direction: column-reverse;
            -o-flex-direction: column-reverse;
            flex-direction: column-reverse;
        }

        /* ------------------------------------ */
        .flex-c-m {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            justify-content: center;
            -ms-align-items: center;
            align-items: center;
        }

        .flex-c-t {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            justify-content: center;
            -ms-align-items: flex-start;
            align-items: flex-start;
        }

        .flex-c-b {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            justify-content: center;
            -ms-align-items: flex-end;
            align-items: flex-end;
        }

        .flex-c-str {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            justify-content: center;
            -ms-align-items: stretch;
            align-items: stretch;
        }

        .flex-l-m {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            justify-content: flex-start;
            -ms-align-items: center;
            align-items: center;
        }

        .flex-r-m {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            justify-content: flex-end;
            -ms-align-items: center;
            align-items: center;
        }

        .flex-sa-m {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            justify-content: space-around;
            -ms-align-items: center;
            align-items: center;
        }

        .flex-sb-m {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            justify-content: space-between;
            -ms-align-items: center;
            align-items: center;
        }

        /* ------------------------------------ */
        .flex-col-l {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-flex-direction: column;
            -moz-flex-direction: column;
            -ms-flex-direction: column;
            -o-flex-direction: column;
            flex-direction: column;
            -ms-align-items: flex-start;
            align-items: flex-start;
        }

        .flex-col-r {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-flex-direction: column;
            -moz-flex-direction: column;
            -ms-flex-direction: column;
            -o-flex-direction: column;
            flex-direction: column;
            -ms-align-items: flex-end;
            align-items: flex-end;
        }

        .flex-col-c {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-flex-direction: column;
            -moz-flex-direction: column;
            -ms-flex-direction: column;
            -o-flex-direction: column;
            flex-direction: column;
            -ms-align-items: center;
            align-items: center;
        }

        .flex-col-l-m {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-flex-direction: column;
            -moz-flex-direction: column;
            -ms-flex-direction: column;
            -o-flex-direction: column;
            flex-direction: column;
            -ms-align-items: flex-start;
            align-items: flex-start;
            justify-content: center;
        }

        .flex-col-r-m {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-flex-direction: column;
            -moz-flex-direction: column;
            -ms-flex-direction: column;
            -o-flex-direction: column;
            flex-direction: column;
            -ms-align-items: flex-end;
            align-items: flex-end;
            justify-content: center;
        }

        .flex-col-c-m {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-flex-direction: column;
            -moz-flex-direction: column;
            -ms-flex-direction: column;
            -o-flex-direction: column;
            flex-direction: column;
            -ms-align-items: center;
            align-items: center;
            justify-content: center;
        }

        .flex-col-str {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-flex-direction: column;
            -moz-flex-direction: column;
            -ms-flex-direction: column;
            -o-flex-direction: column;
            flex-direction: column;
            -ms-align-items: stretch;
            align-items: stretch;
        }

        .flex-col-sb {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-flex-direction: column;
            -moz-flex-direction: column;
            -ms-flex-direction: column;
            -o-flex-direction: column;
            flex-direction: column;
            justify-content: space-between;
        }

        /* ------------------------------------ */
        .flex-col-rev-l {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-flex-direction: column-reverse;
            -moz-flex-direction: column-reverse;
            -ms-flex-direction: column-reverse;
            -o-flex-direction: column-reverse;
            flex-direction: column-reverse;
            -ms-align-items: flex-start;
            align-items: flex-start;
        }

        .flex-col-rev-r {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-flex-direction: column-reverse;
            -moz-flex-direction: column-reverse;
            -ms-flex-direction: column-reverse;
            -o-flex-direction: column-reverse;
            flex-direction: column-reverse;
            -ms-align-items: flex-end;
            align-items: flex-end;
        }

        .flex-col-rev-c {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-flex-direction: column-reverse;
            -moz-flex-direction: column-reverse;
            -ms-flex-direction: column-reverse;
            -o-flex-direction: column-reverse;
            flex-direction: column-reverse;
            -ms-align-items: center;
            align-items: center;
        }

        .flex-col-rev-str {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-flex-direction: column-reverse;
            -moz-flex-direction: column-reverse;
            -ms-flex-direction: column-reverse;
            -o-flex-direction: column-reverse;
            flex-direction: column-reverse;
            -ms-align-items: stretch;
            align-items: stretch;
        }


        /*[ Absolute ]
      -----------------------------------------------------------
      */
        .ab-c-m {
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            -moz-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            -o-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }

        .ab-c-t {
            position: absolute;
            top: 0px;
            left: 50%;
            -webkit-transform: translateX(-50%);
            -moz-transform: translateX(-50%);
            -ms-transform: translateX(-50%);
            -o-transform: translateX(-50%);
            transform: translateX(-50%);
        }

        .ab-c-b {
            position: absolute;
            bottom: 0px;
            left: 50%;
            -webkit-transform: translateX(-50%);
            -moz-transform: translateX(-50%);
            -ms-transform: translateX(-50%);
            -o-transform: translateX(-50%);
            transform: translateX(-50%);
        }

        .ab-l-m {
            position: absolute;
            left: 0px;
            top: 50%;
            -webkit-transform: translateY(-50%);
            -moz-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            -o-transform: translateY(-50%);
            transform: translateY(-50%);
        }

        .ab-r-m {
            position: absolute;
            right: 0px;
            top: 50%;
            -webkit-transform: translateY(-50%);
            -moz-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            -o-transform: translateY(-50%);
            transform: translateY(-50%);
        }

        .ab-t-l {
            position: absolute;
            left: 0px;
            top: 0px;
        }

        .ab-t-r {
            position: absolute;
            right: 0px;
            top: 0px;
        }

        .ab-b-l {
            position: absolute;
            left: 0px;
            bottom: 0px;
        }

        .ab-b-r {
            position: absolute;
            right: 0px;
            bottom: 0px;
        }
    </style>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
                <form class="login100-form validate-form" action="{{ route('web_login') }}" target="_self"
                      method="POST">
                    @csrf
                    <span class="login100-form-title p-b-33">
						ورود به حساب کاربری
					</span>

                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="username" placeholder="ایمیل / شماره تلفن">
                        <span class="focus-input100-1"></span>
                        <span class="focus-input100-2"></span>
                    </div>

                    <div class="wrap-input100 rs1 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password" placeholder="رمز عبور">
                        <span class="focus-input100-1"></span>
                        <span class="focus-input100-2"></span>
                    </div>

                    <div class="container-login100-form-btn m-t-20">
                        <button class="login100-form-btn" type="submit">
                            ورود
                        </button>
                    </div>

                    @if(isset($text))
                        <div class="text-center p-t-45 p-b-4">
						<span class="txt1" style="color: #bd2130;">
						 @php
                             echo $text;
                         @endphp
						</span>
                        </div>
                    @endif
                    <div class="text-center p-t-45 p-b-4">
						<span class="txt1">
							فراموشی
						</span>

                        <a href="{{ route('web_reset_password') }}" class="txt2 hov1">
                            رمز عبور
                        </a>
                    </div>

                    <div class="text-center">
						<span class="txt1">
							ساخت حساب کاربری؟
						</span>

                        <a href="{{ route('web_sign_up') }}" class="txt2 hov1">
                            ثبت نام
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
