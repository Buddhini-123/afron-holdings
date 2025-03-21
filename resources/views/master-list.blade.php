
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
  background-color: #b7d4b3 !important; /* Light green */
}


</style>

@section('content')
<div class="p-3 mb-5 col-md-12">
    @include('nav.top-bar')
    <div class="row mt-4">
        <table class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>JW No.</th>
                <th >Name</th>
                <th >Passport No.</th>
                <th >Contact No.</th>
                <th >Position 1</th>
                <th >Position 2</th>
                <th >Position 3</th>
                <th >CV</th>
                <th >Passport</th>
                <th >Jeevan Application</th>
                <th >Interviewer</th>
                <th >RE</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td></td>
                <td></td>
                <td></td>
                <td ></td>
                <td></td>
                <td></td>
                <td></td>
                <td>FALSE</td>
                <td>FALSE</td>
                <td>FALSE</td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td>1</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>FALSE</td>
                <td>FALSE</td>
                <td>FALSE</td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td>1</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>FALSE</td>
                <td>FALSE</td>
                <td>FALSE</td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
        </table>
    </div>
</div>


@endsection
