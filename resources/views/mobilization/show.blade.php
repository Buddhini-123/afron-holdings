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
            <a href="{{ route('summary.navigation') }}">
            <img src="{{ asset('/landing_page_bg/new_logo.png') }}" class="logo-style" alt="Logo">
            </a>
        </div>

        <div class="col-md-4 text-center mt-4">
            <p class="mb-0 fw-medium" style="font-family: Poppins; font-size: 20px; color: #073b3a">Excel Data for Mobilization</p>
        </div>
        <div class="col-md-4 d-flex justify-content-end align-items-center gap-2">
            <a class="btn btn-sm btn-success collapsed" data-bs-toggle="modal" data-bs-target="#filterModal" href="#multiCollapseExample1" role="button"
            aria-expanded="false" aria-controls="multiCollapseExample1" data-bs-toggle="tooltip" title="{{ __('Filter') }}">
            <i class="fas fa-filter"></i>
            </a>
            <a href="{{ route('mobilization.index') }}" class="btn btn-success">Add Mobilization</a>
        </div>
    </div>

    @if($mobilizations->count())
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Number</th>
                    <th>Date</th>
                    <th>Job Order No</th>
                    <th>Company Name</th>
                    <th>Country</th>
                    <th>Position</th>
                    <th>Req No</th>
                    <th>Total CV</th>
                    <th>Balnce Req CV</th>
                    <th>Handled By</th>
                    <th>Deadline</th>
                    <th>Remarks</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mobilizations as $mob)
                <tr>
                    <td> 0{{ $mob->id }}</td>
                    <td>{{ $mob->date }}</td>
                    <td>{{ $mob->job_order_no }}</td>
                    <td>{{ $mob->company_name }}</td>
                    <td>{{ $mob->country }}</td>
                    <td>
                        <ul class="mb-0 ps-3">
                            @foreach($mob->positions as $pos)
                                <li>{{ $pos->position }} ({{ $pos->req_no }} req, {{ $pos->total_cv }} CVs, {{ $pos->bal_req_cv}} Balance Req CV)</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $mob->positions->sum('req_no') }}
                    </td>
                    <td>{{ $mob->positions->sum('total_cv') }}</td>
                    <td>{{ $mob->positions->sum('bal_req_cv') }}</td>
                    <td>{{ $mob->handlers?->name ?? 'N/A' }}</td>
                    <td>{{ $mob->deadline }}</td>
                    <td>{{ $mob->remarks }}</td>
                    <td>{{ ucfirst($mob->status) }}</td>

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

    <!-- Filter Modal -->
        <form action="{{ route('mobilization.show') }}" method="get" id="filter-form">
            <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="filterModalLabel">{{ __('Filter Mobilization') }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                    <div class="row">
                                            <div class="col-md-6">
                                                {{-- Comapny Name Filter --}}
                                                <div class="form-group">
                                                    <label for="company_name">{{ __('Company Name') }}</label>
                                                    <input type="text" id="company_name" name="company_name" class="form-control"
                                                        value="{{ request('company_name') }}"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                {{-- Job Order Number Filter --}}
                                                <div class="form-group">
                                                    <label for="job_order_no_index">{{ __('Job Order Number') }}</label>
                                                    <input type="text" name="job_order_no" id="job_order_no_index" class="form-control"
                                                        value="{{ request('job_order_no') }}">
                                                </div>
                                            </div>
                                    </div>

                                    <div class="row">
                                        {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="date_index">{{ __('Date') }}</label>
                                                <input type="date" name="date" id="date_index" class="form-control"
                                                    value="{{ request('date') }}">
                                            </div>
                                        </div> --}}
                                        <div class="col-md-6">
                                            {{-- Status Filter --}}
                                            <div class="form-group">
                                                <label for="status">{{ __('Status') }}</label>
                                                <select name="status" id="status" class="form-control choice-select">
                                                    <option value="">{{ __('All Statuses') }}</option>
                                                    <option value="Completed" {{ request('status') == 'Complete' ? 'selected' : '' }}>
                                                        {{ __('Completed') }}
                                                    </option>
                                                    <option value="Incompleted" {{ request('status') == 'Incomplete' ? 'selected' : '' }}>
                                                        {{ __('Incompleted') }}
                                                    </option>
                                                    <option value="Cancel" {{ request('status') == 'Cancel' ? 'selected' : '' }}>
                                                        {{ __('Canceled') }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <a href="{{route('mobilization.show')}}" class="btn btn-danger">{{ __('Reset') }}</a>
                                <button type="submit" class="btn btn-primary">{{ __('Apply') }}</button>
                            </div>
                        </div>
                </div>
            </div>
        </form>
</div>

<script>
    function filterByStatus(status) {
        const baseUrl = "{{ url('/mobilizations/show') }}";
        window.location.href = status ? `${baseUrl}/${status}` : baseUrl;
    }
</script>
@endsection
