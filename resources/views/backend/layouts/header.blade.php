<div class="page-header navbar navbar-fixed-top">
    <div class="page-header-inner ">
        <div class="page-logo">
            <a href="{{ route('admin.dashboard') }}" style="line-height: 50px;font-size: 18px;color: #333;">
                Administrator
            </a>
            <div class="menu-toggler sidebar-toggler">
                <span></span>
            </div>
        </div>
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
            <span></span>
        </a>
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                @if(Auth::user()->role == 2)
                    <li>
                        <span style="display: inline-block; line-height: 50px; margin-right: 10px;"><span class="font-red-mint" id="current-coint">{{ Auth::user()->coint }}</span> coint</span>
                    </li>
                @endif
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <img alt="" class="img-circle" src="{{ asset('/admin/assets/img/photo3.jpg') }}" />
                        <span class="username username-hide-on-mobile"> {{ Auth::user()->name }} </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="{{ route('user.updateAccount') }}">
                                <i class="icon-user"></i> Update Account </a>
                        </li>
                        <li class="divider"> </li>
                        <li>
                            <a href="{{ route('logout') }}">
                                <i class="icon-key"></i> Log Out </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>