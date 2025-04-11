@extends('layouts.app')

@section('content')
<style>
    .btn-custom {
        border-radius: 10px;
        padding: 10px 20px;
        font-weight: 600;
        color: white;
        text-align: center;
        width: 180px;
    }
    .green-btn {
        background-color: #8DC63F;
        border: none;
    }
    .form-section {
        background: white;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    input[type="text"], input[type="date"], select {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 6px;
        margin-bottom: 20px;
    }
    .position-table input {
        width: 100%;
        padding: 6px;
        text-align: center;
    }
    .position-table th, .position-table td {
        padding: 8px;
    }
    .add-btn {
        font-size: 24px;
        cursor: pointer;
        display: inline-block;
        margin-top: 10px;
    }
    .logo {
        height: 160px;
        width: 280px;
    }
</style>

<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- Toastr CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>

<div class="container my-5">
    <!-- Top Buttons and Logo -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('home.index') }}" class="btn btn-custom green-btn">Go Back</a>
        <div class="col-md-4 text-center">
            <img src="{{ asset('/landing_page_bg/new_logo.png') }}" alt="Logo" class="logo mb-2">
        </div>
        <a href="#" class="btn btn-custom green-btn">Mobilization Form</a>
    </div>

    <!-- Form Section -->
    <div class="form-section">
        <!-- Success Message Using SweetAlert2 -->
        @if(session('success'))
        <script>
            // Wait for the document to be fully loaded
            document.addEventListener('DOMContentLoaded', function() {
                // Check if Swal is available
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: '{{ session('success') }}',
                        confirmButtonText: 'Ok'
                    });
                } else {
                    console.error('SweetAlert2 is not loaded');
                }
            });
        </script>
        @endif

        <div id="success-message" class="alert alert-success d-none mt-4">
            Changes saved successfully!
        </div>

        <!-- Error Messages Using Toastr -->
        @if ($errors->any())
            <script>
                $(document).ready(function () {
                    @foreach ($errors->all() as $error)
                        toastr.error("{{ $error }}");
                    @endforeach
                });
            </script>
        @endif

        <form method="POST" action="{{ route('mobilization.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <label>Date</label>
                    <input type="date" name="date" placeholder="Enter Date">
                    @error('date')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label>Number</label>
                    <input type="text" name="number" placeholder="Enter Number">
                    @error('number')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label>Job Order No.</label>
                    <input type="text" name="job_order_no" placeholder="Enter Job Order No">
                    @error('job_order_no')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label>Company Name</label>
                    <input type="text" name="company_name" placeholder="Enter Company Name">
                    @error('company_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label>Handled By</label>
                    <input type="text" name="handled_by" placeholder="Enter Handled By">
                    @error('handled_by')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label>Deadline</label>
                    <input type="date" name="deadline" placeholder="Enter Deadline">
                    @error('deadline')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label>Country</label>
                    <input type="text" name="country" placeholder="Enter Country">
                    @error('country')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label>Status</label>
                    <select name="status">
                        <option value="completed" selected>Completed</option>
                        <option value="incompleted">InCompleted</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                    @error('status')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- Table Section for Positions -->
            <div class="table-responsive mt-4">
                <table class="table position-table border">
                    <thead class="table-light">
                        <tr>
                            <th>Position</th>
                            <th>Req No.</th>
                            <th>Total CV</th>
                            <th>Bal Req Cv</th>
                        </tr>
                    </thead>
                    <tbody id="positionTableBody">
                        @php
                            $positions = old('positions', ['']);
                            $req_nos = old('req_nos', ['']);
                            $total_cvs = old('total_cvs', ['']);
                            $bal_req_cvs = old('bal_req_cvs', ['']);
                        @endphp

                        @foreach ($positions as $i => $position)
                        <tr>
                            <td>
                                <input type="text" name="positions[]" value="{{ $position }}" placeholder="Enter Position">
                                @error('positions.' . $i)
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </td>
                            <td>
                                <input type="text" name="req_nos[]" class="form-control req_no" value="{{ $req_nos[$i] ?? '' }}" placeholder="Enter Req No">
                                @error('req_nos.' . $i)
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </td>
                            <td>
                                <input type="text" name="total_cvs[]" class="form-control total_cv" value="{{ $total_cvs[$i] ?? '' }}" placeholder="Enter Total CV">
                                @error('total_cvs.' . $i)
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </td>
                            <td>
                                <input type="text" name="bal_req_cvs[]" class="form-control bal_cv" value="{{ $bal_req_cvs[$i] ?? '' }}" placeholder="Enter Balance">
                                @error('bal_req_cvs.' . $i)
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>

                <div class="text-center">
                    <span class="add-btn" id="addRowBtn">＋</span>
                </div>

                <table class="table mt-3">
                    <tr>
                        <th style="text-align: right;">Total</th>
                        <td><input type="text" id="total_req" name="total_req" readonly class="form-control"></td>
                        <td><input type="text" id="total_cv" name="total_cv" readonly class="form-control"></td>
                        <td><input type="text" id="total_bal" name="total_bal" readonly class="form-control"></td>
                    </tr>
                </table>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between mt-4">
                <button type="reset" class="btn btn-custom green-btn">Reset</button>
                <button type="submit" class="btn btn-custom green-btn">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- Include jQuery (required for SweetAlert2 and Toastr) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Include Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    // Function to recalculate totals
    function calculateTotals() {
        let totalReq = 0, totalCV = 0, totalBal = 0;

        document.querySelectorAll('.req_no').forEach(el => {
            totalReq += parseInt(el.value) || 0;
        });
        document.querySelectorAll('.total_cv').forEach(el => {
            totalCV += parseInt(el.value) || 0;
        });
        document.querySelectorAll('.bal_cv').forEach(el => {
            totalBal += parseInt(el.value) || 0;
        });

        document.getElementById('total_req').value = totalReq;
        document.getElementById('total_cv').value = totalCV;
        document.getElementById('total_bal').value = totalBal;
    }

    // Function to bind event listener to an input
    function bindTotalEvents(input) {
        input.addEventListener('input', calculateTotals);
    }

    // Initial event binding for existing inputs
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.req_no, .total_cv, .bal_cv').forEach(bindTotalEvents);
        calculateTotals();
    });

    // Dynamic row addition
    document.getElementById('addRowBtn').addEventListener('click', function () {
        const tbody = document.getElementById('positionTableBody');
        const row = document.createElement('tr');
        row.innerHTML = `
            <td><input type="text" name="positions[]" placeholder="Position"></td>
            <td><input type="text" name="req_nos[]" class="req_no" placeholder="Req No"></td>
            <td><input type="text" name="total_cvs[]" class="total_cv" placeholder="Total CVs"></td>
            <td><input type="text" name="bal_req_cvs[]" class="bal_cv" placeholder="Balance CVs"></td>
        `;
        tbody.appendChild(row);

        // Bind total calculation events to new inputs
        row.querySelectorAll('.req_no, .total_cv, .bal_cv').forEach(bindTotalEvents);
    });
</script>


@endsection
