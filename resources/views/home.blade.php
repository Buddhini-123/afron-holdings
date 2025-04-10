@extends('layouts.app')

<style>
    .logo {
        height: 100px;
        width: 50px;
        position: absolute;
        top: 10px;
        right: 10px;
    }

    .custom-tab {
        background-color: #6FA84F; /* Green shade */
        color: #0F2B46; /* Dark text color */
        font-weight: bold;
        padding: 0px 20px; /* Remove vertical padding */
        border-radius: 0px 20px 0px 20px; /* Flat bottom-left, rounded top-right */
        display: flex;
        align-items: center; /* Vertical centering */
        justify-content: center; /* Horizontal centering */
        font-size: 16px;
        text-align: center;
        width: 250px; /* Adjust width to match proportion */
        height: 40px; /* Adjust height */
    }
    canvas {
        cursor: pointer;
    }
</style>

@section('content')
<div class="p-3 mb-5 col-md-12">
    <div class="row">
        <div class="col-md-4"> <!-- Align to top-right -->
            <img src="{{ asset('/landing_page_bg/logo.png') }}" style="height: 70px; width: 160px;" alt="First slide">
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-2 mt-3"> <!-- Align to top-right -->
            <div class="custom-tab" id="currentMonth">February</div>
        </div>
        <div class="col-md-2 mt-3">
            <a href="{{ route('summary.navigation') }}" class="custom-tab">Overview</a>
        </div>
    </div>
</div>

<div class="container">
    <div class="row mt-5">
        <div class="col-md-4">
            <canvas id="houseChart"></canvas>
        </div>
        <div class="col-md-4">
            <canvas id="houseChart2"></canvas>
        </div>
        <div class="col-md-4">
            <canvas id="houseChart3"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var ctx = document.getElementById('houseChart').getContext('2d');
    var data = {
        labels: ['Calls', 'Customer-Visited'],
        datasets: [{
            data: [@json($call_metric), @json($customer_visited_metric)],
            backgroundColor: ['#7AC142', '#154360']
        }]
    };

    var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: data
    });

    var ctx2 = document.getElementById('houseChart2').getContext('2d');
    var data = {
        labels: ['Customer-visited', 'Approved'],
        datasets: [{
            data: [@json($customer_visited_metric), @json($approved_metric)],
            backgroundColor: ['#154360', '#196f3d']
        }]
    };

    var myPieChart = new Chart(ctx2, {
        type: 'doughnut',
        data: data
    });

    var ctx3 = document.getElementById('houseChart3').getContext('2d');
    var data = {
        labels: ['Selected', 'Approved'],
        datasets: [{
            data: [@json($selected_metric), @json($approved_metric)],
            backgroundColor: ['#196f3d', '#1c2833']
        }]
    };

    var myPieChart = new Chart(ctx3, {
        type: 'doughnut',
        data: data
    });

    document.getElementById("currentMonth").innerText = new Date().toLocaleString('default', { month: 'long' });
</script>

<script>
    document.getElementById('houseChart').addEventListener('click', function () {
        window.location.href = '/docs'; // replace with your desired URL
    });

    document.getElementById('houseChart2').addEventListener('click', function () {
        window.location.href = '/mobilization';
    });

    document.getElementById('houseChart3').addEventListener('click', function () {
        window.location.href = '/masterlist';
    });
</script>

@endsection
