@extends('layouts.app')

<style>
    .logo-style {
        height: 100px;
        width: 220px;
    }

    .container.custom-container {
        padding-left: 0px;
        padding-right: 0px;
    }

    .green-btn {
        background-color: #76b947;
    }

    thead th {
        background-color: #76b947 !important;
        color: white;
    }

</style>

@section('content')
<div class="container-fluid mt-4 px-2">
    <div class="row mb-3">
        <div class="col-md-4">
            <img src="{{ asset('/landing_page_bg/new_logo.png') }}" class="logo-style" alt="Logo">
        </div>

        <div class="col-md-4 text-center mt-4">
            <p class="mb-0 fw-medium" style="font-family: Poppins; font-size: 20px; color: #073b3a">Excel Data for Mobilization</p>
        </div>

        <div class="col-md-4 d-flex justify-content-end align-items-center gap-2">
            <a href="{{ route('mobilization.index') }}" class="btn btn-success">Add Mobilization</a>
        </div>
    </div>

    @if($mobilizations->count())
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Date</th>
                    <th>Job Order No</th>
                    <th>Company</th>
                    <th>Handled By</th>
                    <th>Deadline</th>
                    <th>Country</th>
                    <th>Status</th>
                    <th>Positions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mobilizations as $mob)
                <tr>
                    <td>{{ $mob->date }}</td>
                    <td>{{ $mob->job_order_no }}</td>
                    <td>{{ $mob->company_name }}</td>
                    <td>{{ $mob->handled_by }}</td>
                    <td>{{ $mob->deadline }}</td>
                    <td>{{ $mob->country }}</td>
                    <td>{{ ucfirst($mob->status) }}</td>
                    <td>
                        <ul class="mb-0 ps-3">
                            @foreach($mob->positions as $pos)
                                <li>{{ $pos->position }} ({{ $pos->req_no }} req, {{ $pos->total_cv }} CVs)</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-3 d-flex justify-content-end">
        @if ($mobilizations->lastPage() > 1)
            {!! $mobilizations->withQueryString()->links() !!}
        @else
            <ul class="pagination">
                <li class="page-item disabled"><span class="page-link">1</span></li>
            </ul>
        @endif
    </div>





    @else
    <div class="alert alert-warning">
        No mobilization data found.
    </div>
    @endif
</div>

<script>
    function filterByStatus(status) {
        const baseUrl = "{{ url('/mobilizations/show') }}";
        window.location.href = status ? `${baseUrl}/${status}` : baseUrl;
    }
</script>
@endsection
