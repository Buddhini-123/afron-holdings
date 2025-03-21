
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


</style>

@section('content')
<div class="p-3 mb-5 col-md-12">
    @include('nav.top-bar')
    <div class="row mt-4">
        <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Handover Date</th>
                <th >passport Number</th>
                <th >Possition of Work</th>
                <th >Job Order No.</th>
                <th >Country</th>
                <th >Contact</th>
                <th >Sub agent</th>
                <th >RE Coordinator</th>
                <th >Mobi - Handover</th>
                <th >Jeevan Application</th>
                <th >CV</th>
                <th >PP</th>
                <th>PP Size Pic</th>
                <th>BCC</th>
                <th >PPT Copy</th>
                <th >License Copy</th>
                <th >Police Reporter</th>
                <th >Working Video</th>
                <th >Myself Video</th>
                <th >Edu Cert</th>
                <th >Other Cert</th>
                <th >Status</th>
                <th >Remarks</th>
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
              </tr>
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
              </tr>
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
              </tr>
            </tbody>
        </table>
    </div>
</div>


@endsection
