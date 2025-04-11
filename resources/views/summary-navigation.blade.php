@extends('layouts.app') {{-- Or your main layout --}}

@section('content')
<style>
    .btn-custom {
        border-radius: 25px;
        padding: 10px 20px;
        font-weight: 600;
        color: white;
        display: inline-block;
        text-align: center;
        width: 300px;
        margin: 10px auto;
    }

    .green-btn {
        background-color: #76b947;
    }

    .dark-btn {
        background-color: #073b3a;
    }

    .blue-btn {
        background-color: #1e3f66;
    }

    .navy-btn {
        background-color: #2e3b8c;
    }

    .logo {
        height: 160px;
        width: 280px;
    }

    .text-center {
        text-align: center;
    }
</style>

<div class="container text-center mt-4">
    {{-- Top Buttons --}}
    <div class="row justify-content-between">
        <div class="col-md-4 text-center">
        </div>
        <div class="col-md-4 text-center">
            <img src="{{ asset('/landing_page_bg/new_logo.png') }}" alt="Logo" class="logo mb-2">
        </div>
        <div class="col-md-4 text-center">
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ url('/home') }}" class="btn btn-custom green-btn">Go To Homepage</a>
        <div class="row justify-content-between">
            <div class="col-md-1 text-start"></div>
            <div class="col-md-3 text-start">
                <a href="{{ url('/docs') }}" class="btn btn-custom green-btn">Docs. Handover</a>
            </div>
            <div class="col-md-3 text-end">
                <a href="{{ url('/masterlist') }}" class="btn btn-custom green-btn">Master List</a>
            </div>
            <div class="col-md-1 text-start"></div>

        </div>
    </div>
    {{-- Project Status Overview --}}
    <div class="mt-4">
        <a href="{{ url('/mobilization') }}" class="btn btn-custom dark-btn">Project Status Overview</a>
        <div class="row justify-content-between">
            <div class="col-md-4 text-start">
                <a href="{{ url('/mobilization/completed') }}" class="btn btn-custom dark-btn">Completed</a>
            </div>
            <div class="col-md-4 text-center">
                <a href="{{ url('/mobilization/incompleted') }}" class="btn btn-custom dark-btn">Incompleted</a>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ url('/mobilization/cancelled') }}" class="btn btn-custom dark-btn">Cancelled</a>
            </div>
        </div>
    </div>

    {{-- Project Status Summary --}}
    <div class="mt-4">
        <a href="{{ url('/status') }}" class="btn btn-custom navy-btn">Project Status Summary</a>
        <div class="mt-2">
            <a href="{{ url('/brief') }}" class="btn btn-custom blue-btn">Project Brief</a>
        </div>
        <div class="row justify-content-between">
            <div class="col-md-4 text-start">
                <a href="{{ url('/brief/completed') }}" class="btn btn-custom blue-btn">Completed</a>
            </div>
            <div class="col-md-4 text-center">
                <a href="{{ url('/brief/incompleted') }}" class="btn btn-custom blue-btn">Incompleted</a>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ url('/brief/cancelled') }}" class="btn btn-custom blue-btn">Cancelled</a>
            </div>
        </div>
    </div>
</div>
@endsection
