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
        background-color: #073b3a;
    }

    thead th {
        background-color: #073b3a !important;
        color: white !important;
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
            <p class="mb-0 fw-medium" style="font-family: Poppins; font-size: 20px; color: #1e3f66">Excel Data for Project Status</p>
        </div>

        <div class="col-md-4 d-flex justify-content-end align-items-center gap-2">
            <a class="btn btn-sm btn-success collapsed" data-bs-toggle="modal" data-bs-target="#filterModal" href="#multiCollapseExample1" role="button"
            aria-expanded="false" aria-controls="multiCollapseExample1" data-bs-toggle="tooltip" title="{{ __('Filter') }}">
            <i class="fas fa-filter"></i>
            </a>
            <a href="{{ route('status.index') }}" class="btn btn-success">Add Project Status</a>
        </div>
    </div>

    @if($sheetData && $sheetData->count())
        @php
        $headerRow = $sheetData->first();
        $cleanData = $sheetData->slice(1);

        // Find column indices to ignore
        $ignoreKeys = collect($headerRow)->filter(function($value) {
            return in_array(strtolower($value), ['#', 'no', 'index']);
        })->keys();

        // Filter headers using their keys
        $headers = collect($headerRow)->filter(function($value, $key) use ($ignoreKeys) {
            return !$ignoreKeys->contains($key);
        });
    @endphp

    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle">
            <thead>
                <tr>
                    @foreach($headers as $header)
                        <th>{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($cleanData as $row)
                    @php
                        // Filter the same columns from the data row
                        $rowData = collect($row)->filter(function($value, $key) use ($ignoreKeys) {
                            return !$ignoreKeys->contains($key);
                        });
                    @endphp

                    @if($rowData->filter()->isNotEmpty())
                        <tr>
                            @foreach($rowData as $cell)
                                <td>{{ $cell }}</td>
                            @endforeach
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    @else
        <div class="alert alert-warning">
            No data found in the Excel file.
        </div>
    @endif

     <!-- Filter Modal -->
        <form action="{{ route('status.show') }}" method="get" id="filter-form">
            <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="filterModalLabel">{{ __('Filter Project Status') }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                    <div class="row">
                                            <div class="col-md-6">
                                                {{-- Comapny Name Filter --}}
                                                <div class="form-group">
                                                    <label for="handle_by">{{ __('Handle By') }}</label>
                                                    <select id="handle_by" name="handle_by" class="form-control">
                                                        <option value="">{{ __('All') }}</option>
                                                        @foreach ($handlers as $handler)
                                                            <option value="{{ $handler->name }}" {{ request('handle_by') == $handler->name ? 'selected' : '' }}>
                                                                {{ $handler->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
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
                            </div>
                            <div class="modal-footer">
                                <a href="{{route('status.show')}}" class="btn btn-danger">{{ __('Reset') }}</a>
                                <button type="submit" class="btn btn-primary">{{ __('Apply') }}</button>
                            </div>
                        </div>
                </div>
            </div>
        </form>
</div>
@endsection
