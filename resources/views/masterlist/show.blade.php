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
            <p class="mb-0 fw-medium" style="font-family: Poppins; font-size: 20px; color: #76b947">Excel Data for MasterList</p>
        </div>

        <div class="col-md-4 d-flex justify-content-end align-items-center gap-2">
            <a href="{{ route('masterlist.index') }}" class="btn btn-success">Add MasterList</a>
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
</div>
@endsection
