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
            <p class="mb-0 fw-medium" style="font-family: Poppins; font-size: 20px; color: #073b3a">Excel Data for RE</p>
        </div>
        <div class="col-md-4 d-flex justify-content-end align-items-center gap-2">
            <a class="btn btn-sm btn-success collapsed" data-bs-toggle="modal" data-bs-target="#filterModal" href="#multiCollapseExample1" role="button"
            aria-expanded="false" aria-controls="multiCollapseExample1" data-bs-toggle="tooltip" title="{{ __('Filter') }}">
            <i class="fas fa-filter"></i>
            </a>
            <a href="{{ route('docs.index') }}" class="btn btn-success">Add RE</a>
        </div>
    </div>

    @if($sheetData && $sheetData->count())
        @php
            // Remove the first row (usually header if unwanted) and get clean data
            $cleanData = $sheetData->slice(1);

            // Filter out # column from headers if present
            $headers = collect($sheetData->first())->filter(function($value, $key) {
                return strtolower($value) !== '#' && strtolower($value) !== 'no' && strtolower($value) !== 'index';
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
                            // Remove empty rows and ignore unwanted index column
                            $filteredRow = $row->filter(function($cell) {
                                return !is_null($cell) && $cell !== '';
                            });

                            $rowWithoutIndex = $row->slice(1); // remove first column (index/#)
                        @endphp

                        @if($filteredRow->isNotEmpty())
                            <tr>
                                @foreach($rowWithoutIndex as $cell)
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
        <form action="{{ route('docs.show') }}" method="get" id="filter-form">
            <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="filterModalLabel">{{ __('Filter Leaves') }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                    <div class="row">
                                            <div class="col-md-6">
                                                {{-- Passport Number Filter --}}
                                                <div class="form-group">
                                                    <label for="passport_number">{{ __('Passport Number') }}</label>
                                                    <input type="text" id="passport_number" name="passport_number" class="form-control"
                                                        value="{{ request('passport_number') }}"/>
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
                                        <div class="col-md-6">
                                            {{-- Handover Date Filter --}}
                                            <div class="form-group">
                                                <label for="handover_date_index">{{ __('Handover Date') }}</label>
                                                <input type="date" name="handover_date" id="handover_date_index" class="form-control"
                                                    value="{{ request('handover_date') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            {{-- Status Filter --}}
                                            <div class="form-group">
                                                <label for="status">{{ __('Status') }}</label>
                                                <select name="status" id="status" class="form-control choice-select">
                                                    <option value="">{{ __('All Statuses') }}</option>
                                                    <option value="Complete" {{ request('status') == 'Complete' ? 'selected' : '' }}>
                                                        {{ __('Complete') }}
                                                    </option>
                                                    <option value="Incomplete" {{ request('status') == 'Incomplete' ? 'selected' : '' }}>
                                                        {{ __('Incomplete') }}
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
                                <a href="{{route('docs.show')}}" class="btn btn-danger">{{ __('Reset') }}</a>
                                <button type="submit" class="btn btn-primary">{{ __('Apply') }}</button>
                            </div>
                        </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
