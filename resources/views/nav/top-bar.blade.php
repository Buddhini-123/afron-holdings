<div class="row">
    <div class="col-md-2"> <!-- Align to top-right -->
        <img src="{{ asset('/landing_page_bg/logo.png') }}" style="height: 70px; width: 160px;" alt="First slide">
    </div>
    <div class="col-md-2 mt-3"> <!-- Align to top-right -->
        <a href="{{ route('docs.index') }}" class="custom-tab {{ request()->routeIs('docs.index') ? 'active-tab' : '' }}">Docs Handover</a>

    </div>
    <div class="col-md-2 mt-3"> <!-- Align to top-right -->
        <a href="{{ route('mobilization.index') }}" class="custom-tab {{ request()->routeIs('mobilization.index') ? 'active-tab' : '' }}">Project Status Overview</a>

    </div>
    <div class="col-md-2 mt-3"> <!-- Align to top-right -->
        <a href="{{ route('masterlist.index') }}" class="custom-tab {{ request()->routeIs('masterlist.index') ? 'active-tab' : '' }}">Master List</a>

    </div>
    <div class="col-md-2 mt-3"> <!-- Align to top-right -->
        <a href="{{ route('status.index') }}" class="custom-tab {{ request()->routeIs('status.index') ? 'active-tab' : '' }}">Project Status Summary</a>

    </div>
    <div class="col-md-2 mt-3"> <!-- Align to top-right -->
        <a href="{{ route('brief.index') }}" class="custom-tab {{ request()->routeIs('brief.index') ? 'active-tab' : '' }}">Project Brief</a>

    </div>

</div>
