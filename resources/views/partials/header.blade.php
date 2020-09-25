<style>
    .main-container {
        max-width: 1950px;
        width: 100%;
        margin: 0 auto;
        overflow: hidden;
    }

    .inside-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
        width: 100%;
    }

    .row-spc {
        margin: 0 auto !important;
        font-family: 'Roboto Slab', serif;
        font-size: 18px;

    }

    i:hover {
        color: #f65aa7;
        cursor: pointer;
    }

    .icon-scp {
        font-size: 12px;
        color: white;
        margin: 5px 5px;

    }

    .icon-scp .left-side {
        display: flex;
    }

    .icon-scp .left-side .link-head {
        margin: 0 5px;
    }

    .icon-scp .left-side .link-head i {
        margin: 0 5px 0 0;
    }

    .contact-color {
        background-color: #232323;
        min-height: 50px;
    }

    .col-disp {
        margin: 10px;
        display: flex;
    }

    .link-head {
        color: white;
    }

    .link-head:hover {
        text-decoration: none;
        color: #f65aa7;
        cursor: pointer;
    }

    .nav-bg-color {

        background-color: white;

    }

    .nav-contain {
        margin-top: 35px;
        margin-bottom: 35px;

    }

    .navbar img {
        width: 100px;
        height: 100px;
    }

    .nav-list .menu {
        color: #333333;
        font-family: 'Roboto Slab', serif;
        font-size: 13px;
        line-height: 26px;
        padding: 0 20px;
        text-decoration: none;
    }

    .nav-list .menu:hover {
        color: #f65aa7;
    }

    .color-line {
        color: #999999 !important;
    }

    .last-spc {
        padding: 0 10px;
    }

    .carousel-height img {
        max-height: 800px;
    }

    .icon-color {
        color: #f65aa7 !important;
        margin: 1px auto
    }

    @media (max-width: 1200px) {
        .nav-list .menu, .menu-last {
            text-align: center;
            padding: 0px 16px;
        }

        .last-spc {
            padding: 0 10px !important;
        }
    }

    @media (max-width: 992px) {
        .nav-list .menu, .menu-last {
            text-align: center;
            padding: 10px 10px !important;
        }

        .navbar-nav .color-line {
            display: none;
        }


    }

    @media (max-width: 575.98px) {
        .icon-scp .left-side {
            display: grid;
        }

        .icon-scp .left-side .link-head {
            margin: 3px 0;
        }

        .icon-scp .left-side span {
            display: none;
        }

        .col-disp {
            margin: 5px;
            display: unset;
            text-align: center;
        }
    }

    .text-carousel {
        color: white;
    }

    .first-slider {
        min-height: 800px;

        background-image: url('../max-image/bussines-2.jpg');
        background-size: cover;
    }

    .first-slider-1 {
        min-height: 800px;

        background-image: url('../max-image/bussines-1.jpg');
        background-size: cover;
    }

    .second {
        color: #9fd7ef !important;
    }

    .bs-card {
        color: #f65aa7 !important;
    }

    @media (max-width: 991.98px) {
        .carousel-control-prev,
        .carousel-control-next {
            display: none;
        }

    }

    @media (max-width: 576px ) {
        .carousel-inner {
            max-height: 700px;
        }

        .carousel-text {
            padding-top: 200px !important;
        }

        .carousel-text span {
            font-size: 20px !important;

        }

        .carousel-text h1 {
            font-size: 20px !important;
        }
    }

    .carousel-text h1 {
        font-family: 'Roboto Slab', serif;
        font-size: 42px;
        text-transform: uppercase;
        text-align: center;
        color: #ffffff;
        font-weight: bold;
        text-shadow: 3px 3px 5px #000;
    }

    .carousel-text span {
        font-family: 'Roboto Slab', serif;
        font-size: 42px;
        text-transform: uppercase;
        text-align: center;
        color: #ffffff;
        font-weight: bold;
        text-shadow: 3px 3px 5px #000;
    }

    .carousel-text {

        padding-top: 260px;
        text-align: center;
    }

    .carousel-text p {
        font-family: 'Open Sans', sans-serif;
        padding-top: 40px;
        font-size: 14px;
        color: #ffffff;
        text-shadow: 3px 3px 5px #000;

    }

    .butns {
        margin-top: 45px;
    }

    .about-btn {
        color: #333333;
        border-radius: 8px;
        margin: 20px;
        padding: 15px 40px;
        background-color: #9fd7ef;
        text-transform: uppercase;
        text-decoration: none;
        font-size: 12px;
        font-family: 'Open Sans', sans-serif;
        font-weight: bolder;
        border: none;

    }

    .about-btn:hover {
        background-color: #f65aa7;
        color: #ffffff;
        text-decoration: none;
    }

    .work-btn:hover {
        background-color: #f65aa7;
        color: #ffffff;
        text-decoration: none;
    }

    .work-btn {
        border-radius: 8px;
        padding: 15px 40px;
        background-color: #9fd7ef;
        text-transform: uppercase;
        text-decoration: none;
        font-size: 12px;
        font-family: 'Open Sans', sans-serif;
        font-weight: bolder;
        color: #333333;
        border: none;
    }

    .arrow {
        font-size: 32px;
        border: 1px solid white;
        padding: 12px 18px;
        font-weight: 600;
    }

    .arrow:hover {
        color: #777777;
        background-color: white;
    }

    .our-header h2 {
        text-transform: uppercase;
        text-decoration: none;
        font-size: 32px;
        font-weight: bold;
        text-align: center;
        font-family: 'Roboto Slab', serif;
        margin-top: 140px;
    }

    .our-header hr {
        height: 5px;
        border-color: #c0bfbf;
        margin-left: 15px;
        display: inline-flex;
        margin-right: 15px;
        width: 65px;
    }

    .row-pad {
        padding: 35px;
    }

    .rotate-45 {
        transform: rotate(45deg);
        margin-right: -5px;
        margin-left: -5px;
        margin-top: 10px;
    }

    .our-header i {
        color: #c0bfbf;
    }

    .our-header i:hover {
        color: #c0bfbf;
    }

    .our-spec h3 {
        font-size: 16px;
        text-align: center;
        font-family: 'Roboto Slab', serif;
        font-weight: bold;
        margin-bottom: 25px;
        max-height: 19px;
    }

    .our-spec p {
        color: #777777;
        font-size: 14px;
        text-align: center;
        font-family: 'Open Sans';
        min-height: 84px;
    }

    .our-spec i {
        width: 115px;
        height: 117px;
        text-align: center;
    }

    .rounded-circle {
        border: 1px dashed #f65aa7;
        margin-bottom: 25px;
        color: #f65aa7;
        padding: 35px 0;
        font-size: 45px;
    }

    .rounded-circle:hover {
        background-color: #f65aa7;
        color: #ffffff;
    }

    .money-back i {
        padding: 35px 29px;
    }

    .read-more {
        background-color: #9fd7ef;
        text-transform: uppercase;
        padding: 10px 25px;
        text-decoration: none;
        color: white;
        text-align: center;
        font-size: 13px;
        font-family: 'Open Sans', sans-serif;
        border-radius: 6px;
        border: none;
    }

    .rd-btn {
        margin: 38px auto;
        text-align: center;
    }

    .read-more:hover {
        text-decoration: none;
        color: white;
        background-color: #0698d7;
        cursor: pointer;
    }

    .promotion-bg {
        background-color: #f9f9f9;
        padding-bottom: 145px;
    }

    .overlay {
        text-align: center;
        display: block;
        background-color: rgba(51, 51, 51, 0.6);
        padding: 40% 0;
        opacity: 0;
    }

    .overlay span {
        text-align: center;
        font-size: 14px;
        font-family: 'Open Sans';
        color: white;
        padding-top: 10px;
        padding-bottom: 20px;
    }

    .overlay button {
        text-transform: uppercase;
        font-weight: bold;
        background-color: white;
        font-size: 13px;
        font-family: 'Open Sans', sans-serif;
        border: none;
        border-radius: 5px;
        padding: 10px 15px;
    }

    .overlay button:hover {
        cursor: pointer;
    }

    .stars {
        color: #fbc725;
        font-size: 13px;
    }

    .stars:hover {
        color: #fbc725;

    }

    .prom-padd {
        padding-bottom: 60px;
    }

    .product-top:hover .overlay {
        opacity: 1;
        transition: 0.5s;
        cursor: pointer;
    }

    .product-top:hover {
        background-color: #f65aa7;
        z-index: 999;
    }

    .product-top {
        min-width: 100%;
        min-height: 300px;

    }

    .product-top-1 {
        background-image: url('../max-image/post-card.jpg');
        background-size: cover;
    }

    .product-top-2 {
        background-image: url('../max-image/bussines-card.jpg');
        background-size: cover;
    }

    .product-top-3 {
        background-image: url('../max-image/post-card-2.jpg');
        background-size: cover;
    }

    .product-top-4 {
        background-image: url('../max-image/bussines-card-2.jpg');
        background-size: cover;
    }

    .product-top button {
        margin: 5px;
    }

    .heart {
        font-size: 14px;
    }

    .heart:hover {
        color: #333333;
    }

    .product-text {
        margin: 20px auto;
    }

    .product-text span {
        text-align: center;
        font-size: 16px;
        font-family: 'Roboto Slab', serif;
    }

    .product-text p {
        text-align: center;
        font-size: 16px;
        font-family: 'Open Sans', sans-serif;
        color: #f65aa7;
        font-weight: bold;
    }

    .capa-bg {
        padding-bottom: 100px;
        background-color: #111111;
    }

    .capa-head {
        color: white;
        padding-top: 130px;
    }

    .capa-head .vr-line h2 {
        text-transform: uppercase;
        font-size: 32px;

    }

    @media (max-width: 991.98px) {
        .capa-head {
            text-align: center;
        }

        .vr-line {
            display: block !important;
        }
    }

    .capa {
        font-size: 32px;
        font-weight: bold;
        font-family: 'Roboto Slab', serif;
        color: #9fd7ef;

    }

    .kat-icon {
        margin: 10px;
        margin-top: -10px;
    }

    .print-shop {

        font-size: 32px;
        font-weight: bold;
        font-family: 'Roboto Slab', serif;
        color: #f65aa7;
    }

    .vr-line {
        display: flex;
    }

    .vr-line1 {
        margin-top: 10px;
        border-right: 1px solid white;
        height: 55px;
    }

    .linker-work {
        padding-top: 60px;
        text-align: center;
    }

    .linker-work button {
        padding-left: 45px;
        text-align: center;
        text-decoration: none;
        color: #777777;
        font-size: 15px;
        font-family: 'Roboto Slab', serif;
        background-color: #ffffff;
        border: none;
    }

    .linker-work button:hover {
        color: #f65aa7;
        text-decoration: none;
    }

    @media (max-width: 576px ) {
        .linker-work button {
            padding: 10px 22px;
            text-align: left;
            width: 160px;
        }
    }

    .gallery-height {
        min-height: 600px;

    }

    .col1-height {
        min-height: 600px;
        background-image: url('../max-image/brochures.jpg');
        background-size: cover;
        z-index: 2;
    }

    .col1-2-height {
        min-height: 600px;
        background-image: url('../max-image/brochures-2.jpg');
        background-size: cover;
    }

    .col2-height {
        min-height: 300px;
        background-image: url('../max-image/bussines-card-5.jpg');
        background-size: cover;
    }

    .col2-1-height {
        min-height: 300px;
        background-image: url('../max-image/bussines-card-4.jpg');
        background-size: cover;
    }

    .col3-height {
        min-height: 300px;
        background-image: url('../max-image/bussines-card-3.jpg');
        background-size: cover;
    }

    .r3-height {
        min-height: 300px;
        background-color: #747272;
    }

    .r3-col {
        min-height: 300px;
        background-color: #747272;
    }

    .r3-col-1 {
        background-image: url('../max-image/post-card-3.jpg');
        background-size: cover;
    }

    .r3-col-2 {
        background-image: url('../max-image/post-card-4.jpg');
        background-size: cover;
    }

    .r3-col-3 {
        background-image: url('../max-image/post-card-5.jpg');
        background-size: cover;
    }

    .r3-col-4 {
        background-image: url('../max-image/post-card-6.jpg');
        background-size: cover;
    }

    .padd-col {
        margin: auto;
    }

    .padd1-col {
        margin: auto;
    }

    .col-over:hover {
        background-color: #f65aa7;
        z-index: 999;
        width: 100%;
        height: 50%;
        padding: 0;

    }

    .col-overlay {
        padding-top: 50px;
        color: #ffffff;
        text-align: center;
        display: block;
        margin-left: 0;
        opacity: 0;

    }

    .col-overlay p {
        font-size: 14px;
        font-family: 'Roboto Slab', serif;
    }

    .col-over:hover .col-overlay {
        opacity: 1;
        transition: 0.5s;
        margin: auto;
        background-color: rgba(246, 90, 167, 0.7);
        width: 100%;
        height: 100%;
    }

    .icon-overlay {
        text-align: center;
        margin: 15px auto;
    }

    .icon-overlay i {
        font-size: 13px;
        color: #f65aa7;
    }

    .icon-overlay a {
        background-color: #f9f9f9;
        padding: 10px 15px;
        margin-left: 5px;

    }

    .icon-overlay a:hover {
        background-color: #9fd7ef;
        color: #ffffff;
    }

    .icon-overlay a:hover i {
        color: #ffffff;
    }

    .owl-carousel .owl-next,
    .owl-carousel .owl-prev {
        width: 60px;
        height: 40px;
        line-height: 50px;
        position: absolute;
        top: 40%;
        font-size: 20px;
        color: #fff;
        border: 1px solid #333333 !important;
        text-align: center;
    }

    .owl-carousel .owl-prev {
        left: -90px;
    }

    @media (max-width: 1400px) {

        .owl-theme .owl-nav [class*='owl-'] {
            background: rgba(0, 0, 0, 0.1) !important;
        }
    }

    .owl-carousel .owl-next {
        right: -90px;
    }

    .owl-seci {
        margin-top: 80px;
        margin-bottom: 145px;
    }

    .owl-seci .owl-theme .owl-dots .owl-dot span {
        background: #9fd7ef !important;
        width: 10px !important;
        height: 10px !important;
        border-radius: 0;
    }

    .owl-theme .owl-dots .owl-dot.active {
        background: #ffffff !important;
        border: 2px solid #9fd7ef;
    }

    .owl-theme .owl-nav [class*='owl-next']:hover {
        background-color: #232323 !important;
    }

    .owl-theme .owl-nav [class*='owl-'] {
        border-radius: 0 !important;
    }

    .owl-theme .owl-nav [class*='owl-prev']:hover {
        background-color: #232323 !important;
    }

    .owl-nav i:hover {
        color: #f9f9f9;
    }

    .screan-hover {
        width: auto;
        height: auto;
        padding: 0;
        position: relative;
        overflow: hidden;
        margin: auto;
    }

    .over-image {
        z-index: 999;
        width: 100%;
        height: 100%;
        position: absolute;


    }

    .over-image span {
        font-size: 16px;
        font-family: 'Roboto Slab', serif;
        position: absolute;
        background-color: #9fd7ef;
        left: 0%;
        top: 0%;
        padding: 15px 35px;
    }

    .over-image .social-icon {
        font-size: 13px;
        margin-right: 0;
        position: absolute;
        background-color: #9fd7ef;
        bottom: 0;
        right: 0;
        padding: 5px 10px;
    }

    .over-image .social-icon i {
        padding: 10px;
    }

    .item-bg {
        min-height: 450px;
        background-color: #f9f9f9;
    }

    .item-bg-1 {
        background-image: url('../max-image/our-team.jpg');
        background-size: cover;
    }

    .item-bg-2 {
        background-image: url('../max-image/our-team-1.jpg');
        background-size: cover;
    }

    .item-bg-3 {
        background-image: url('../max-image/our-team-3.jpg');
        background-size: cover;
    }

    .item-bg-4 {
        background-image: url('../max-image/our-team-2.jpg');
        background-size: cover;
    }

    .item-bg-5 {
        background-image: url('../max-image/our-team-4.jpg');
        background-size: cover;
    }

    .item-bg-6 {
        background-image: url('../max-image/our-team-5.jpg');
        background-size: cover;
    }

    .details-link {
        position: absolute;
        top: 45%;
        left: 35%;
        color: #9fd7ef;
        text-decoration: underline;
        font-size: 15px;
        font-family: "Open Sans";
        font-weight: bold;
        opacity: 0;
        transition-timing-function: ease-in-out;
    }

    .item-bg:hover .over-image {
        opacity: 1;
        background-color: rgba(51, 51, 51, 0.6);
    }

    .item-bg:hover .social-icon {
        background-color: #f65aa7;
        color: #ffffff;

    }

    .item-bg:hover .over-image h3 {
        background-color: #f65aa7;
        color: #ffffff;

    }

    .item-bg:hover .details-link {
        opacity: 1;
        transition: 1s;
        margin: 5% auto;

    }

    .contact-bg {
        background-image: url('../image/background.jpg');
        background-repeat: no-repeat;
        background-size: cover;
    }

    .contact-con {
        padding-top: 80px;
        padding-bottom: 80px;
    }

    @media (max-width: 991.98px) {
        .contact-con {
            text-align: center;
        }

        .partner-bg {
            min-height: 0px !important;
        }

        .owl-seci {
            margin-top: 80px;
            margin-bottom: 80px;
        }
    }

    .contact-con p {
        padding: 25px 0;
        font-size: 14px;
        font-weight: bold;
        font-family: 'Open Sans';
        color: #777777;
    }

    .contact-con h2 {
        font-size: 32px;
        font-weight: bold;
        font-family: 'Roboto Slab', serif;
        text-transform: uppercase;
    }

    .tel-number {
        color: #f3bed0;
        text-decoration: none;
        font-size: 26px;
        font-weight: bold;
        font-family: 'Roboto Slab', serif;
    }

    .tel-number:hover {
        color: #f3bed0;
        text-decoration: none;
    }

    .contact-btn {
        margin: 40px 0;
    }

    .contact {
        font-size: 14px;
        font-weight: bold;
        font-family: 'Open Sans';
        padding: 15px 40px;
        background-color: #f65aa7;
        text-align: center;
        border-radius: 8px;
        color: #f1efe5;
    }

    .contact:hover {
        text-decoration: none;
        color: #f1efe5;
    }

    .img-box {
        width: 90px !important;
        max-height: 90px;
        border-radius: 50%;
        margin: auto;
    }

    .all-testimonial {
        padding: 30px 0;
        border: 1px solid #ececec;
    }

    .testimonial {
        text-align: center;
        font-family: 'Open sans';
        font-size: 14px;
        color: #777777;
    }

    .testimonial p i {
        color: #f65aa7;
        padding-top: 20px;
    }

    .stars-icon i {
        color: #fbc725;
    }

    .all-testimonial::after {
        content: "";
        width: 15px;
        height: 15px;
        display: block;
        background: #fff;
        border: 1px solid #ececec;
        border-width: 0 0 1px 1px;
        position: absolute;
        bottom: 113px;
        left: 49%;
        transform: rotateZ(-45deg);
    }

    .author {
        text-align: center;
        padding: 30px;
    }

    .author span {
        font-size: 14px;
        font-weight: bold;
        font-family: 'Roboto Slab', serif;
        color: #9fd7ef;
        text-transform: uppercase;
    }

    .author p {
        font-size: 14px;
        font-weight: bold;
        font-family: 'Open sans';
        color: #747272
    }

    .partner-logo {
        max-width: 250px;
        max-height: 120px;
        margin-left: auto;
        margin-right: auto;
    }

    .partner-bg {
        background-color: #f9f9f9;
        min-height: 300px;
    }

    @media (max-width: 575.98px) {
        .partner-bg {
            min-height: 0px;
        }
    }

    .footer-bg {
        background-color: #232323;
        color: #f9f9f9;
    }

    .footer-padd {
        padding: 75px 0;
    }

    .foot-logo {
        max-width: 145px;
        max-height: 50px;
        margin-bottom: 30px;
    }

    .foot-col-padd {
        padding: 0 20px;
    }

    .dream-text p {
        font-size: 14px;
        font-family: 'Open sans';
        color: #dedede;
        padding-top: 20px;
    }

    .foot-icon {
        margin-top: 25px;
        font-size: 13px;
        color: #ececec;
        margin-right: 18px;
    }

    .foot-icon:hover {
        color: #9fd7ef;
    }

    @media (max-width: 768px) {
        .pop-col {
            margin: 20px 0;

        }
    }

    .pop-col span {
        font-size: 16px;
        font-weight: bold;
        font-family: 'Roboto Slab', serif;
        color: #ffffff;
        text-transform: uppercase;
    }

    .pop-col hr {
        border: 1px solid #f65aa7;
        width: 65px;
        margin-left: 0;
        margin-right: 0;
    }

    .pop-link a {
        margin-bottom: 20px;
        text-transform: uppercase;
        font-size: 13px;
        font-family: 'Open Sans';
        color: #dedede;
        display: flex;
    }

    .ltl-blog {
        display: inline-flex;
    }

    .blog-img {
        width: 75px;
        max-height: 75px;
    }

    .max-award {
        padding-left: 30px;
        font-size: 14px;
        font-family: 'Roboto Slab', serif;
    }

    .blog-vl {
        color: #777777;
        margin: 0 5px;
    }

    .blog-icon {
        margin-right: 5px;
        font-size: 13px;
        color: #f65aa7;
    }

    .recent-hr {
        border: 0.5px solid #777777 !important;
        width: 95% !important;
    }

    .view-blog {
        text-decoration: underline;
        text-transform: uppercase;
        font-size: 13px;
        font-family: 'Roboto Slab', serif;
        color: #9fd7ef;
        font-weight: bold;
    }

    .view-blog:hover {
        color: #9fd7ef;

    }

    .contact-icon {
        border: 1px solid #9fd7ef;
        border-radius: 50%;
        padding: 10px;
        width: 38px;
        height: 38px;
        text-align: center;
        margin: 0 20px;
    }

    .contact-row-margin {
        margin-top: 20px;
    }

    .contact-row-margin p {
        margin: auto 0;
    }

    .copyright-text {
        margin: auto;
        background-color: #242424;
    }

    .copyright-text a {
        color: #fff;
    }

    .copyright-text a:hover {
        color: #f65aa7;
        text-decoration: none;
    }

    /*===== The CSS =====*/
    #wrapper svg {
        margin-right: auto;
        margin-left: auto;
    }

    svg i:hover {
        color: #232323;
    }

    .progres-icon {
        font-size: 35px;
        transform: rotate(180deg);
        background-color: #9fd7ef;
        border-radius: 50%;
        padding: 10px;
    }

    .progres-div1 {
        margin-right: 34.5px;
        background-color: #57727e;
        padding: 10.5px;
        border-radius: 50%;
    }

    .progres-div1 i {
        font-size: 20px;
        padding: 12.5px;
        width: 45px;
        height: 45px;
        text-align: center;
    }

    .progres-div2 {
        margin-right: 34.5px;
        background-color: #57727e;
        padding: 10.5px;
        border-radius: 50%;
    }

    .progres-div2 i {
        font-size: 20px;
        padding: 12.5px;
    }

    .progres-div3 {
        margin-right: 34.5px;
        background-color: #57727e;
        padding: 10.5px;
        border-radius: 50%;
    }

    .progres-div3 i {
        font-size: 20px;
        padding: 12.5px;
    }

    .progres-div4 {
        margin-right: 34.5px;
        background-color: #57727e;
        padding: 11px;
        border-radius: 50%;
    }

    .progres-icon4 {
        text-align: center;
        width: 45px;
        height: 45px;
        font-size: 20px;
        transform: rotate(180deg);
        background-color: #9fd7ef;
        border-radius: 50%;
        padding: 15px;

    }

    .progress {
        width: 245px;
        height: 280px;
        margin-top: 50px;
        background-color: transparent;
        transform: rotate(180deg);
    }

    .progress .track, .progress .fill {
        fill: rgba(0, 0, 0, 0);
        stroke-width: 4;
        transform: rotate(90deg) translate(0px, -80px);
    }

    .progress .track {
        stroke: rgb(56, 71, 83);
    }

    .fill {
        transform: rotate(90deg) translate(0px, -80px);
    }

    .progress .fill {
        stroke: rgb(255, 255, 255);
        stroke-dasharray: 219.99078369140625;
        stroke-dashoffset: -219.99078369140625;
        transition: stroke-dashoffset 2s;
    }

    .progress.blue .fill {
        stroke: #f65aa7;
    }

    .progress.green .fill {
        stroke: rgb(186, 223, 172);
    }

    .progress .value, .progress .text {

        fill: rgb(255, 255, 255);
        text-anchor: middle;
    }

    .progress .text {
        font-size: 9px;
        font-family: 'Roboto Slab', serif;
        transform: rotate(180deg) translate(-40px, -10px);
    }

    .progress .value {
        transform: rotate(180deg) translate(-40px, -10px);
        font-size: 9px;
        font-family: 'Roboto Slab', serif;
        fill: #f65aa7;
    }

    .noselect {
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        cursor: default;
    }

</style>
<div class="main-container contact-color">
    <div class="inside-container ">
        <div class="row row-spc">
            <div class="col-md-12  col-disp">
                <div class="icon-scp">
                    <div class="left-side">
                        <a class="link-head"><i class="far fa-envelope "> </i> info@cheemarket.com </a>
                    </div>
                </div>
                <div class="ml-auto icon-scp">
                    <a href="https://www.instagram.com/cheemarket/"> <i class="fab fa-instagram icon-scp">instagram_cheemarket</i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="main-container nav-bg-color">
    <div class="inside-container nav-contain">
        <nav class="navbar navbar-expand-lg navbar-light ">
            <img src="{{ asset('/icon.png') }}" class="img-fluid" alt="" width="100" height="100">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav nav-list ml-auto">
                    <a class="menu" style="font-size: 15px;" href="{{ route('web_firstpage') }}">خانه</a>
                    <a class="menu" style="font-size: 15px;" href="{{ route('web_about_us') }}">درباره ما</a>
                    <a class="menu" style="font-size: 15px;" href="{{ route('web_rules') }}">قوانین</a>
                    <a class="menu" style="font-size: 15px;" href="{{ route('web_category') }}">دسته بندی محصولات</a>
                    <a class="menu" style="font-size: 15px;"
                       href="{{ (session()->has('token'))? route('web_address') : route('web_login') }}">آدرس های
                        شما</a>
                    <a class="menu" style="font-size: 15px;"
                       href="{{ (session()->has('token'))? route('web_Favorites') : route('web_login') }}">علاقه مندی
                        ها</a>
                    <a class="menu" style="font-size: 15px;"
                       href="{{ (session()->has('token'))? route('web_orders') : route('web_login') }}">سفارش های
                        شما</a>
                    <a class="menu  last-spc" style="font-size: 15px; direction: rtl;"
                       href="{{ route('web_login') }}"> {{ (session()->has('token'))? session()->get('username') . "/خروج": "واردشوید/ثبت نام کنید" }}</a>
                    <span class="menu last-spc color-line"> | </span>
                    <a class="menu icon-color last-spc"
                       href="{{ (session()->has('token'))? route('web_card') : route('web_login') }}"><i
                            class="fas fa-shopping-cart"></i></a>
                    <a class="menu icon-color  last-spc" href="{{ route('web_search') }}"><i class="fas fa-search"></i></a>

                </div>
            </div>
        </nav>
    </div>
</div>
