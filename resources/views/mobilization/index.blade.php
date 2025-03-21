
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
  background-color: #53679e !important; /* Light green */
  color: #fff
}
/* Style for "Total CV" and "Handle By" columns */
.table tbody tr td:nth-child(7),
.table thead tr th:nth-child(7),
.table tbody tr td:nth-child(9),
.table thead tr th:nth-child(9) {
    background-color: #a6b3d6 !important; /* Light Blue shade */
    color: #fff !important; /* White text for better contrast */
}
.table tbody tr td:nth-child(8),
.table thead tr th:nth-child(8) {
    background-color: #bedca3 !important; /* Light Blue shade */
    color: #fff !important; /* White text for better contrast */
}
.table thead tr th:nth-child(11),
.table thead tr th:nth-child(2) {
    background-color: #b7d4b3 !important; /* Light Blue shade */
    color: #fff !important; /* White text for better contrast */
}
.upload-form {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 15px;
    }

    .file-label {
        font-size: 16px;
        color: #333;
        margin-bottom: 8px;
        display: inline-block;
    }

    .file-input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        background-color: #fff;
        color: #333;
        font-size: 14px;
    }

    .file-input:focus {
        border-color: #0056b3;
        outline: none;
    }

    .submit-btn {
        width: 100%;
        padding: 12px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .submit-btn:hover {
        background-color: #0056b3;
    }

    .submit-btn:focus {
        outline: none;
    }

    .btnbackground{
        background-color: #0F2B46 !important;
    }

</style>

@section('content')
<div class="p-3 mb-5 col-md-12">
    @include('nav.top-bar')
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

    <form action="{{ route('import.mobilization') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="file" class="file-label">Upload File:</label>
        <div class="row form-group mt-4">
            <div class="col-4">
                <input type="file" name="file" id="file" required class="file-input">
            </div>
            <div class="col-2"><button type="submit" class="submit-btn btnbackground">Upload</button></div>
        </div>
    </form>
    <div class="row mt-4">
        <table class="table table-bordered">
            <thead>
              <tr>
                <th>Number</th>
                <th>date Date</th>
                <th >Job Order No.</th>
                <th >Company Name</th>
                <th >Country</th>
                <th >Position</th>
                <th >Req No</th>
                <th >Total CV</th>
                <th >Bal Req CV</th>
                <th >Handle By</th>
                <th >Deadline</th>
                <th >Remarks</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
                @foreach($mobilization as $data)
                <tr>
                    <td>{{ $data->id }}</td> <!-- Auto-increment row number -->
                    <td>{{ $data->date }}</td>
                    <td>{{ $data->job_order_no }}</td>
                    <td>{{ $data->company_name }}</td>
                    <td>{{ $data->country }}</td>
                    <td>{{ $data->position }}</td>
                    <td>{{ $data->req_no }}</td>
                    <td>{{ $data->total_cv }}</td>
                    <td>{{ $data->bal_req_cv }}</td>
                    <td>{{ $data->handle_by }}</td>
                    <td>{{ $data->deadline }}</td>
                    <td>{{ $data->remarks }}</td>
                    <td>{{ $data->status }}</td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>


@endsection
<!-- Include SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
