@extends('layouts.app')

<style>
    .custom-tab {
        background-color: #6FA84F;
        color: #0F2B46;
        font-weight: bold;
        padding: 0px 20px;
        border-radius: 0px 20px 0px 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        text-align: center;
        width: 250px;
        height: 40px;
    }

    canvas {
        width: 100% !important;
        height: 300px !important;
        cursor: pointer;
    }

    .badge {
        font-size: 14px;
        padding: 6px 12px;
        margin: 0 4px;
    }

    .btn-success {
        background-color: #7AC142 !important;
        border-color: #7AC142 !important;
    }

    .btn-success:hover {
        background-color: #6FA84F;
    }
    .logo-style{
        height: 100px;
        width: 220px;
    }
</style>

@section('content')
<div class="container mt-4">
    <div class="row mb-3">
        <div class="col-md-4">
            <img src="{{ asset('/landing_page_bg/new_logo.png') }}" class="logo-style" alt="Logo">
        </div>

        <div class="col-md-4 text-center">
        </div>
        <div class="col-md-4 d-flex justify-content-end align-items-center gap-2">
            <a href="{{ route('summary.navigation') }}" class="btn btn-success">View Dashboard</a>
            <div class="btn btn-success" id="currentMonth">Month</div>
            <i class="fas fa-sign-out-alt fa-lg text-dark"></i>
        </div>
    </div>
    <p class="mb-0 fw-medium" style="font-family: Poppins; font-size: 20px">You have currently logged into the Colombo Branch</p>

    <div class="row text-center mt-5">
        <div class="col-md-4">
            <div class="mb-2">
                <span class="badge bg-success">Calls</span>
                <span class="badge bg-dark">Customer Visited</span>
            </div>
            <canvas id="houseChart"></canvas>
            <a href="/docs" class="btn btn-success mt-3">Go to RE Sheet</a>
        </div>

        <div class="col-md-4">
            <div class="mb-2">
                <span class="badge bg-success">Calls</span>
                <span class="badge bg-dark">Approved</span>
            </div>
            <canvas id="houseChart2"></canvas>
            <a href="/mobilization" class="btn btn-success mt-3">Go to Mobilization</a>
        </div>

        <div class="col-md-4">
            <div class="mb-2">
                <span class="badge bg-success">Selected</span>
                <span class="badge bg-dark">Approved</span>
            </div>
            <canvas id="houseChart3"></canvas>
            <a href="/masterlist" class="btn btn-success mt-3">Go to Master List</a>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Plugin to display text in center of doughnut chart
    const centerText = {
        id: 'centerText',
        beforeDraw(chart, args, options) {
            const {width} = chart;
            const {height} = chart;
            const ctx = chart.ctx;
            ctx.restore();

            const text = options.text;
            const fontSize = (height / 114).toFixed(2);
            ctx.font = `${fontSize}em sans-serif`;
            ctx.textBaseline = 'middle';

            const textX = Math.round((width - ctx.measureText(text).width) / 2);
            const textY = height / 2;

            ctx.fillStyle = '#196f3d';
            ctx.fillText(text, textX, textY);
            ctx.save();
        }
    };

    const ctx1 = document.getElementById('houseChart').getContext('2d');
    const ctx2 = document.getElementById('houseChart2').getContext('2d');
    const ctx3 = document.getElementById('houseChart3').getContext('2d');

    new Chart(ctx1, {
        type: 'doughnut',
        data: {
            labels: ['Calls', 'Customer Visited'],
            datasets: [{
                data: [@json($call_metric), @json($customer_visited_metric)],
                backgroundColor: ['#7AC142', '#154360']
            }]
        },
        options: {
            cutout: '70%',
            plugins: {
                centerText: {
                    text: '{{ $call_metric }}/{{ $customer_visited_metric }}'
                }
            }
        },
        plugins: [centerText]
    });

    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['Customer Visited', 'Approved'],
            datasets: [{
                data: [@json($customer_visited_metric), @json($approved_metric)],
                backgroundColor: ['#154360', '#196f3d']
            }]
        },
        options: {
            cutout: '70%',
            plugins: {
                centerText: {
                    text: '{{ $customer_visited_metric }}/{{ $approved_metric }}'
                }
            }
        },
        plugins: [centerText]
    });

    new Chart(ctx3, {
        type: 'doughnut',
        data: {
            labels: ['Selected', 'Approved'],
            datasets: [{
                data: [@json($selected_metric), @json($approved_metric)],
                backgroundColor: ['#196f3d', '#1c2833']
            }]
        },
        options: {
            cutout: '70%',
            plugins: {
                centerText: {
                    text: '{{ $selected_metric }}/{{ $approved_metric }}'
                }
            }
        },
        plugins: [centerText]
    });
</script>


@endsection
