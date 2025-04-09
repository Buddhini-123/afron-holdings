
@extends('layouts.app')
{{-- @section('title', __('lang_v1.login')) --}}

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
    padding: 0px 20px;
    border-radius: 0px 20px 0px 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    text-align: center;
    width: 150px;
    height: 60px;
    text-decoration: none;
}

.custom-tab.active-tab {
    background-color: #0F2B46; /* Darker shade for active */
    color: white; /* Highlight text */
}

th {
  background-color: #a6b3d6 !important; /* Light green */
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

<!-- Include Handsontable CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.css">
<!-- Include SweetAlert2 CSS (if needed) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@section('content')
<div class="p-3 mb-5 col-md-12">

    <!-- Round Buttons with Icons -->
    <div class="row mt-2">
        <div class="col-md-2 mt-3"> <!-- Align to top-right -->
            <a href="{{ route('docs.index') }}" class="custom-tab {{ request()->routeIs('docs.index') ? 'active-tab' : '' }}">RE</a>
        </div>
        <div class="col-md-6">
        </div>
        <div class="col-4">
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
                    <button class="btn-round purple" data-toggle="modal" data-target="#selectedModal">
                        <i class="fas fa-check"></i> <!-- Tick Icon -->
                    </button>
                </div>
            </div>
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
                            <label for="branch_id">Branch</label>
                            <select class="form-control" id="branch_id" name="branch_id" disabled>
                                    <option value="{{ $branch->id }}">{{ $branch->branch }}</option>
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
                            <label for="branch_id_customer">Branch</label>
                            <select class="form-control" id="branch_id_customer" name="branch_id_customer" disabled>
                                    <option value="{{ $branch->id }}">{{ $branch->branch }}</option>
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
                            <label for="branch_id_selected">Branch</label>
                            <select class="form-control" id="branch_id_selected" name="branch_id_selected" disabled>
                                    <option value="{{ $branch->id }}">{{ $branch->branch }}</option>
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
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            confirmButtonText: 'Ok'
        });
    </script>
    @endif
    <!-- Success message container -->
    <div id="success-message" class="alert alert-success d-none mt-4">
        Changes saved successfully!
    </div>
    <!-- Error message container -->
    <div id="error-message" class="alert alert-danger d-none mt-4">
        Failed to save changes.
    </div>
    <div id="excel-grid" class="p-3 mb-5 col-md-12 mt-4"></div>
</div>


@endsection
<!-- Include SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const excelData = @json($excelData); // Pass PHP data to JavaScript

        const container = document.getElementById('excel-grid');
        if (container) {
            const hot = new Handsontable(container, {
                data: excelData,
                rowHeaders: true,
                colHeaders: true,
                contextMenu: true,
                stretchH: 'all',
                height: 'auto',
                licenseKey: 'non-commercial-and-evaluation', // Get a license for production
                afterChange: (changes, source) => {
                    if (source === 'edit') {
                        saveChanges();
                    }
                }
            });

            function saveChanges() {
                const updatedData = hot.getData(); // Get all data from the grid

                fetch('{{ route("save.re") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ data: updatedData })
                }).then(response => response.json())
                  .then(data => {
                    const successMessage = document.getElementById('success-message');
                    const errorMessage = document.getElementById('error-message');
                      if (data.success) {
                        successMessage.textContent = 'Changes saved successfully!';
                        successMessage.classList.remove('d-none'); // Show the message
                        setTimeout(() => {
                            successMessage.classList.add('d-none'); // Hide the message after 3 seconds
                        }, 3000);
                      } else {
                        errorMessage.textContent = 'Failed to save changes.';
                              errorMessage.classList.remove('d-none'); // Show error message
                              successMessage.classList.add('d-none'); // Hide success message
                              setTimeout(() => {
                                  errorMessage.classList.add('d-none'); // Hide error message after 3 seconds
                              }, 3000);
                      }
                  });
            }
        } else {
            console.error('Container element not found');
        }
    });
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
            const branchId = $('#branch_id_customer').val();
            console.log(branchId);

            // Send an AJAX request to increment the call count
            $.ajax({
                url: "{{ route('metrics.incrementCustomerVisited') }}",
                method: 'POST',
                data: {
                    branch_id: branchId,
                    _token: "{{ csrf_token() }}" // Include CSRF token for security
                },
                success: function (response) {
                    console.log(response);

                    if (response.success) {
                        Swal.fire({
                        icon: "success",
                        title: "Customer Visited count updated successfully!",
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                        });
                    } else {
                        alert('Failed to update call count.');
                    }
                },
                error: function () {
                    alert('An error occurred while updating the customer visited count.');
                }
            });
        });

        $('#submitSelected').click(function () {

            // Get the selected branch ID
            const branchId = $('#branch_id_selected').val();

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
