<!-- ============================================================== -->
<!-- User Profile -->
<!-- ============================================================== -->
<li class="nav-item dropdown u-pro">
    <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img src="{{ asset('images/providers/'.Auth::guard('provider')->user()->image) }}" alt="" class=""> 
        <span class="hidden-md-down">{{ Auth::guard('provider')->user()->name }} &nbsp;<i class="fa fa-angle-down"></i></span> </a>
    <div class="dropdown-menu dropdown-menu-right animated flipInY">
        <!-- text-->
        <a href="{{ route('provider.profile.index') }}" class="dropdown-item"><i class="ti-user"></i> @lang('msg.profile')</a>

        <div class="dropdown-divider"></div>
        <!-- text-->
        <a href="{{ route('provider.profile.index', ['active' => 'settings']) }}" class="dropdown-item"><i class="ti-settings"></i> @lang('msg.settings')</a>
        <!-- text-->
        <div class="dropdown-divider"></div>
        <!-- text-->
        <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-power-off"></i> @lang('auth.sign_out')</a>
        <!-- text-->
        <form id="logout-form" action="{{ route('provider.logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</li>
<!-- ============================================================== -->
<!-- End User Profile -->
<!-- ============================================================== -->
