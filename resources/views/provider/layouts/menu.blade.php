<li class="user-pro"> 
    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
        <img src="{{ asset('images/providers/'.Auth::guard('provider')->user()->image) }}" alt="" class="img-circle">
        <span class="hide-menu">{{ Auth::guard('provider')->user()->name }}</span>
    </a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{ route('provider.profile.index') }}"><i class="ti-user"></i> @lang('msg.profile')</a></li>
        <li><a href="{{ route('provider.profile.index', ['active' => 'settings']) }}"><i class="ti-settings"></i> @lang('msg.settings')</a></li>
        <li>
            <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-power-off"></i> @lang('auth.sign_out')
            </a>
            <form id="logout-form" action="{{ route('provider.logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</li>
<li> 
    <a class="waves-effect waves-dark" href="{{ route('provider.home') }}" aria-expanded="false">
        <i class="icon-speedometer"></i>
        <span class="hide-menu">
            @lang('msg.dashboard') 
            {{-- <span class="badge badge-pill badge-cyan ml-auto">4</span> --}}
        </span>
    </a>
</li>

<li class="nav-small-cap">--- @lang('msg.messages')</li>

<li class="@if(Request::is('provider/notifications*')) active @endif"> 
    <a class="waves-effect waves-dark" href="{{ route('provider.notifications.index') }}" aria-expanded="false">
        <i class="icon-bell"></i>
        <span class="hide-menu">
            @lang('models/notifications.plural')
            @if(($menu_notifications_count = Auth::guard('provider')->user()->getNotifications(0)->count()) > 0)
            <span class="badge badge-pill badge-cyan ml-auto">{{ $menu_notifications_count }}</span>
            @endif
        </span>
    </a>
</li>
