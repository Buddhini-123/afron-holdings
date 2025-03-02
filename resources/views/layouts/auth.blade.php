<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Afron') }}</title>

    {{-- @include('layouts.partials.css') --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!--[if lt IE 9]>

    <![endif]-->

    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Muli', sans-serif;
            font-size: 90%;
            height: 100vh;
            margin: 0;
{{--            background: url('{{asset('/landing_page_bg/delivery.jpg')}}');--}}
            background-repeat: no-repeat;
            background-size: cover;

        }
        .carousel-indicators li {
            width: 10px;
            height: 10px;
            border-radius: 100%;
        }
        img {
            /*width:940px;*/
            /*height:788px;*/
            width:100%;
            height: 100%;
        }
        #company_name {
            color:#2196F3;
        }
        #login_panel{
            /*padding-top: 50px;*/
            padding-right: 50px;
            /*padding-bottom: 50px;*/
            padding-left: 50px;
        }
        #parallax_icon{
            width: 30px;
            height: 30px;
        }

        .carousel .carousel-indicators li {
            background-color: rgba(68,68,68,0.86);
            /*background-color: rgba(70, 70, 70, 0.25);*/
        }

        .carousel .carousel-indicators .active {
            background-color: #000000;
        }


        .carousel-control-next-icon,
        .carousel-control-prev-icon {
            filter: invert(40%);
            height: 50px;
            width: 50px;
            /*background-size: 100%, 100%;*/
        }

        .fa{
            padding: 10px;
            font-size: 30px;
            width:50px;
            text-align: center;
            text-decoration: none;
            border-radius: 50%;
        }

        /* Add a hover effect if you want */
        .fa:hover {
            opacity: 0.7;
        }

        /* Set a specific color for each brand */

        /* Facebook */
        .fa-facebook {
            background: #3B5998;
            color: white;
        }
        /* Twitter */
        .fa-instagram {
            background: #125688;
            color: white;
        }
        /* Twitter */
        .fa-youtube {
            background: #bb0000;
            color: white;
        }
        .btn-parallax{
            padding:10px;
            margin-bottom: 15px;
            height: 50px;
            width: 50px;
            background-color: #ffffff;
            border-radius: 50%;
            display: inline-block;
        }
        .fa-user {
            padding:0;
            font-size: 100%;
            width:10%;
        }

        @media all and (max-width: 479px) {
            body {
                background: none;
            }
        }
        .position-ref {
            position: relative;
        }
        .text-bg-grey {
            background-color: #EDF0FF; /* Changing background color */
            font-weight: bold; /* Making font bold */
            border-radius: 20px; /* Making border radius */
            width: auto; /* Making auto-sizable width */
            height: auto; /* Making auto-sizable height */
            padding: 5px 30px 5px 30px; /* Making space around letters */
            color: #5D616B;
        }
    </style>
</head>

<body>
<div class="container-fluid">
    <div class="row" style="padding-top:0px">
        <div class="col-md-7 col-sm col-xs" style="padding-left:0px">
            <div class="row">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" >

                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img  src="{{asset('/landing_page_bg/afron.png')}}" alt="First slide">
                        </div>
                    </div>

                </div>
            </div>
        </div>
            <div class="col-md-5 col-sm-12 col-xs-12">
                @yield('content')
            </div>
    </div>
</div>


{{-- @include('layouts.partials.javascripts') --}}

<!-- Scripts -->
{{-- <script src="{{ asset('js/login.js?v=' . $asset_v) }}"></script> --}}

@yield('javascript')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.carousel').carousel({
            interval: 5000,
            cycle: true
        })

        $('.select2_register').select2();

        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>

</html>
