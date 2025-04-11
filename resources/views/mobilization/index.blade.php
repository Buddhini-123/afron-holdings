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

<div class="container my-5">
    {{-- Top Buttons and Logo --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="#" class="btn btn-custom green-btn">Go Back</a>
        <div class="col-md-4 text-center">
            <img src="{{ asset('/landing_page_bg/new_logo.png') }}" alt="Logo" class="logo mb-2">
        </div>
        <a href="#" class="btn btn-custom green-btn">Mobilization Form</a>
    </div>

    {{-- Form --}}
    <div class="form-section">
        <form method="POST" action="">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <label>Date</label>
                    <input type="date" name="date" value="2000-12-12">
                </div>
                <div class="col-md-4">
                    <label>Number</label>
                    <input type="text" name="number" value="187">
                </div>
                <div class="col-md-4">
                    <label>Job Order No.</label>
                    <input type="text" name="job_order_no" value="182734">
                </div>

                <div class="col-md-4">
                    <label>Company Name</label>
                    <input type="text" name="company_name" value="ABC Tech">
                </div>
                <div class="col-md-4">
                    <label>Handled By</label>
                    <input type="text" name="handled_by" value="ABC Tech">
                </div>
                <div class="col-md-4">
                    <label>Deadline</label>
                    <input type="date" name="deadline" value="2000-12-12">
                </div>

                <div class="col-md-4">
                    <label>Country</label>
                    <input type="text" name="country" value="Belgium">
                </div>
                <div class="col-md-4">
                    <label>Status</label>
                    <select name="status">
                        <option value="completed" selected>Completed</option>
                        <option value="in_progress">InCompleted</option>
                        <option value="pending">Cancelled</option>
                    </select>
                </div>
            </div>

            {{-- Table Section --}}
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
                        <tr>
                            <td><input type="text" name="positions[]" value="Software Dev" readonly></td>
                            <td><input type="text" name="req_nos[]" value="3"></td>
                            <td><input type="text" name="total_cvs[]" value="4"></td>
                            <td><input type="text" name="bal_req_cvs[]" value="2"></td>
                        </tr>
                    </tbody>
                </table>

                <div class="text-center">
                    <span class="add-btn" id="addRowBtn">＋</span>
                </div>

                <table class="table mt-3">
                    <tr>
                        <th style="text-align: right;">Total</th>
                        <td><input type="text" name="total_req" value="8" readonly></td>
                        <td><input type="text" name="total_cv" value="10" readonly></td>
                        <td><input type="text" name="total_bal" value="3" readonly></td>
                    </tr>
                </table>
            </div>

            {{-- Action Buttons --}}
            <div class="d-flex justify-content-between mt-4">
                <button type="reset" class="btn btn-custom green-btn">Reset</button>
                <button type="submit" class="btn btn-custom green-btn">Save</button>
            </div>
        </form>
    </div>
</div>
<script>
    document.getElementById('addRowBtn').addEventListener('click', function () {
        const tbody = document.getElementById('positionTableBody');

        const row = document.createElement('tr');
        row.innerHTML = `
            <td><input type="text" name="positions[]" placeholder="Position"></td>
            <td><input type="text" name="req_nos[]" value="0"></td>
            <td><input type="text" name="total_cvs[]" value="0"></td>
            <td><input type="text" name="bal_req_cvs[]" value="0"></td>
        `;
        tbody.appendChild(row);
    });
</script>

@endsection
