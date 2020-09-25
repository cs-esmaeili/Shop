<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>چی مارکت</title>
    <link href="{{ asset('/resources/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel = "icon" href ="https://www.cheemarket.com/logotmb.png" type = "image/x-icon">

</head>
<style>


    html, body, .container{
        height: 100%;
    }
    body {
        height: 100%;
        background-image: url('back.jpg');

    }

    .container{
        display: table;
        vertical-align: middle;
    }
    .vertical-center-row{
        display: table-cell;
        vertical-align: middle;
    }

</style>
<body>



<div class="container">

    <div class="row vertical-center-row">
        <div class="row">
            <div class="col-xl-12 col-lg-12  col-md-12 col-sm-12" align="center">
                <img src="logo.png" class="img-fluid" alt="Responsive image" width="500dip"/>
            </div>
        </div>
        <br>
        <div class="row  justify-content-center">
            <div class="col" align="center">
                <a href=<?php echo $link ?> id="downloadlink" class="btn btn-danger" type="button">دانلود اپلیکیشن چی
                    مارکت</a>
            </div>
        </div>
    </div>

</div>

</body>
</html>
