@extends('layouts.auth')
{{-- @section('title', __('lang_v1.login')) --}}

<style>
    .rounded{
        border-start-end-radius: 10rem;
    }
    .btns-group .button {
        border-radius: 0;
    }
    .btns-group .button:first-child {
        border-radius: 50px 0 0 50px;
    }
    .btns-group .button:last-child {
        border-radius: 0 50px 50px 0;
        margin-left: 0;
    }

    .special-tiles{
      background:linear-gradient(86deg, #196f3d(0,105,226,1) 41%, #196f3d(0,51,147,1) 95%)!important;
      border-radius: 30px !important;
      height: 50px!important;
      min-height: 0px !important;
      margin-bottom: 2px!important;

    }


     .new-tile-rounded{
      border-radius: 0!important;
    }

    .no-padding{
       padding: 0px !important;


    }
    .icon-center{
        margin-top: 19%!important;
        font-size: 1.3vw !important;
    }

    .icon-rounded{
    border-radius:0rem 9.75rem 12rem 0rem!important;
      padding: 0px!important;
      margin-top: -6px;;
    }

    .white-font{
      color: white !important;
      font-size: 12% !important;
    }
    .icon-color{
      color: white !important;
      border-radius: 20px!important;
      padding: 7px !important;
      border: 2px white solid !important;
    }

    .icon-box-size{
        height: 67px !important;
        width: 56px !important;
        font-size: 22px !important;
    }

    .text-content-boxsize{
        padding: 11px 9px !important;
        margin-left: 96px !important;
        margin-top: 5px !important;
    }

    .text-content-boxsize span{
        margin: 0px !important;
        padding: 0px !important;
        font-size: 11.5px !important;
        margin-left: -40px !important;
    }

    .zoom{
        transition: transform .2s;
    }

    .zoom:hover{
        transform: scale(1.1);
    }

    /* Gradient Color  */
    .gradient-color{
      background: linear-gradient(86deg, #196f3d(1,92,210,1) 7%, #2e4053(0,58,142,1) 61%)!important;
    }

    .login-label{
        font-weight: bolder!important;
        font-size: 25px !important;
        color: #196f3d !important;
    }
    input:focus,
    button:focus,
    textarea:focus,
    select:focus {
        outline: none !important;
        box-shadow: none !important;
        border: 1px solid #ccc !important; /* Optional: Adjust border color */
    }


</style>

@section('content')
    <div class="row">
        <div class="login-form col-md-10 col-xs-10 right-col-content position-absolute top-50 start-50 translate-middle " >
            {{-- <form method="POST" action="{{ route('login') }}" id="login-form"> --}}
                {{ csrf_field() }}

                    <div class="panel panel-body shadow-lg p-3 mb-5 bg-white rounded-login-panel">
                    <div id="login_panel">
                        <div class="d-flex flex-column align-items-start mb-4">
                            <h3 class="m-0 p-0 fs-2" style="color: #293A4C">Welcome back !</h3>
                            <div class="d-flex align-items-center mt-1">
                            <p class="m-0 p-0">AFRON HOLDINGS Pvt Ltd!</p>
                            </div>
                        </div>
                        <div class="text-center">
                            @if(file_exists(public_path('uploads_new/logo.png')))
                                <img src="{{asset('/uploads_new/logo.png')}}" class="img-rounded" alt="Logo" width="150">
                            @endif
                                <h5 class=" content-group login-label">LOG IN</h5>
                        </div>
                        <br/>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input id="username" type="text" class="form-control" name="username" required autofocus placeholder="Username">
                            </div>
                        </div>
                        <br/>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input id="password" type="password" class="form-control" name="password" required placeholder="Password">
                            </div>
                        </div>
                        <br/>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary btn-block rounded-pill" style="background-color:#196f3d;">login</button>
                        </div>

                    </div>

                </div>
            {{-- </form> --}}
        </div>
    </div>



@stop
<style>
    .log-in{
        font-size:30px;
        color:#196f3d;
        font-weight: 900;
    }
    .rounded-login-panel{
        border-radius: 2.5rem !important;
    }
</style>
