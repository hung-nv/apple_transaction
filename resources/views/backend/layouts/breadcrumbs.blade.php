<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            @yield('breadcrumbs')
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>@yield('title')</span>
        </li>
    </ul>
</div>