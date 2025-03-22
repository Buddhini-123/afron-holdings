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

    .btn-round {
        width: 60px; /* Adjust size of the round button */
        height: 60px; /* Adjust size of the round button */
        border-radius: 50%; /* Make it round */
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px; /* Adjust icon size */
        color: white; /* Icon color */
        border: none; /* Remove border */
        margin: 10px; /* Add some spacing */
    }

    .btn-round.green {
        background-color: green; /* Green button */
    }

    .btn-round.blue {
        background-color: blue; /* Blue button */
    }

    .btn-round.purple {
        background-color: purple; /* Purple button */
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
            <a href="{{ route('docs.index') }}" class="custom-tab">Overview</a>
        </div>
    </div>
</div>

<div class="container">
    <!-- Round Buttons with Icons -->
    <div class="row mt-2">
        <div class="col-7">
            <!-- Left content (if any) -->
        </div>

        <div class="col-5">
            <div class="row justify-content-center">
                <div class="col-auto text-center">
                    <button class="btn-round green" data-toggle="modal" data-target="#callModal">
                        <i class="fas fa-phone"></i> <!-- Call Icon -->
                    </button>
                </div>
                <div class="col-auto text-center">
                    <button class="btn-round blue" data-toggle="modal" data-target="#customerVisitedModal">
                        <i class="fas fa-users"></i> <!-- Users Icon -->
                    </button>
                </div>
                <div class="col-auto text-center">
                    <button class="btn-round green" data-toggle="modal" data-target="#approvedModal">
                        <i class="fas fa-check"></i> <!-- Tick Icon -->
                    </button>
                </div>
                <div class="col-auto text-center">
                    <button class="btn-round purple" data-toggle="modal" data-target="#selectedModal">
                        <i class="fas fa-check"></i> <!-- Tick Icon -->
                    </button>
                </div>
            </div>
        </div>
    </div>
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

    <!-- Modal for Calls -->
    <div class="modal fade" id="callModal" tabindex="-1" role="dialog" aria-labelledby="customerVisitedModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="callModalLabel">Increment Call Count</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Branch Selection Form -->
                    <form id="callForm">
                        @csrf
                        <div class="form-group">
                            <label for="branch_id">Select Branch</label>
                            <select class="form-control" id="branch_id" name="branch_id" required>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->branch }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitCall">Increment Call Count</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Customer Visited -->
    <div class="modal fade" id="customerVisitedModal" tabindex="-1" role="dialog" aria-labelledby="customerVisitedModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="customerVisitedModalLabel">Increment Call Count</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Branch Selection Form -->
                    <form id="callForm">
                        @csrf
                        <div class="form-group">
                            <label for="branch_id">Select Branch</label>
                            <select class="form-control" id="branch_id" name="branch_id" required>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->branch }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitCustomerVisited">Increment Customer Visited Count</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Approved -->
    <div class="modal fade" id="approvedModal" tabindex="-1" role="dialog" aria-labelledby="approvedModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="approvedModalLabel">Increment Call Count</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Branch Selection Form -->
                    <form id="callForm">
                        @csrf
                        <div class="form-group">
                            <label for="branch_id">Select Branch</label>
                            <select class="form-control" id="branch_id" name="branch_id" required>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->branch }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitApproved">Increment Approved Count</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Selected -->
    <div class="modal fade" id="selectedModal" tabindex="-1" role="dialog" aria-labelledby="selectedModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="selectedModalLabel">Increment Call Count</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Branch Selection Form -->
                    <form id="callForm">
                        @csrf
                        <div class="form-group">
                            <label for="branch_id">Select Branch</label>
                            <select class="form-control" id="branch_id" name="branch_id" required>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->branch }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitSelected">Increment Selected Count</button>
                </div>
            </div>
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
    $(document).ready(function () {
        // Handle click event for the submit button
        $('#submitCall').click(function () {

            // Get the selected branch ID
            const branchId = $('#branch_id').val();

            // Send an AJAX request to increment the call count
            $.ajax({
                url: "{{ route('metrics.incrementCalls') }}",
                method: 'POST',
                data: {
                    branch_id: branchId,
                    _token: "{{ csrf_token() }}" // Include CSRF token for security
                },
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                        icon: "success",
                        title: "Call count updated successfully!",
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                        });
                        $('#callModal').modal('hide'); // Close the modal
                    } else {
                        alert('Failed to update call count.');
                    }
                },
                error: function () {
                    alert('An error occurred while updating the call count.');
                }
            });
        });

        $('#submitCustomerVisited').click(function () {

            // Get the selected branch ID
            const branchId = $('#branch_id').val();

            // Send an AJAX request to increment the call count
            $.ajax({
                url: "{{ route('metrics.incrementCustomerVisited') }}",
                method: 'POST',
                data: {
                    branch_id: branchId,
                    _token: "{{ csrf_token() }}" // Include CSRF token for security
                },
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                        icon: "success",
                        title: "Customer Visited count updated successfully!",
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                        });
                        $('#callModal').modal('hide'); // Close the modal
                    } else {
                        alert('Failed to update call count.');
                    }
                },
                error: function () {
                    alert('An error occurred while updating the customer visited count.');
                }
            });
        });

        $('#submitApproved').click(function () {

            // Get the selected branch ID
            const branchId = $('#branch_id').val();

            // Send an AJAX request to increment the call count
            $.ajax({
                url: "{{ route('metrics.incrementApproved') }}",
                method: 'POST',
                data: {
                    branch_id: branchId,
                    _token: "{{ csrf_token() }}" // Include CSRF token for security
                },
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                        icon: "success",
                        title: "Approved count updated successfully!",
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                        });
                        $('#callModal').modal('hide'); // Close the modal
                    } else {
                        alert('Failed to update approved count.');
                    }
                },
                error: function () {
                    alert('An error occurred while updating the approved count.');
                }
            });
        });

        $('#submitSelected').click(function () {

            // Get the selected branch ID
            const branchId = $('#branch_id').val();

            // Send an AJAX request to increment the call count
            $.ajax({
                url: "{{ route('metrics.incrementSelecetd') }}",
                method: 'POST',
                data: {
                    branch_id: branchId,
                    _token: "{{ csrf_token() }}" // Include CSRF token for security
                },
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                        icon: "success",
                        title: "Selected count updated successfully!",
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                        });
                        $('#callModal').modal('hide'); // Close the modal
                    } else {
                        alert('Failed to update selected count.');
                    }
                },
                error: function () {
                    alert('An error occurred while updating the selected count.');
                }
            });
            });
    });
</script>
@endsection
