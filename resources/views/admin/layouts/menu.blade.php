<li class="user-pro"> 
    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
        <img src="{{ asset('images/admins/'.Auth::guard('admin')->user()->image) }}" alt="" class="img-circle">
        <span class="hide-menu">{{ Auth::guard('admin')->user()->name }}</span>
    </a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{ route('admin.profile.index') }}"><i class="ti-user"></i> @lang('msg.profile')</a></li>
        <li><a href="{{ route('admin.profile.index', ['active' => 'settings']) }}"><i class="ti-settings"></i> @lang('msg.settings')</a></li>
        <li>
            <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-power-off"></i> @lang('auth.sign_out')
            </a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</li>
<li> 
    <a class="waves-effect waves-dark" href="{{ route('admin.home') }}" aria-expanded="false">
        <i class="icon-speedometer"></i>
        <span class="hide-menu">
            @lang('msg.dashboard') 
            {{-- <span class="badge badge-pill badge-cyan ml-auto">4</span> --}}
        </span>
    </a>
</li>
<li class="nav-small-cap">--- @lang('msg.app_users')</li>
<li class="@if(Request::is('admin/admins*')) active @endif"> 
    <a class="waves-effect waves-dark" href="{{ route('admin.admins.index') }}" aria-expanded="false">
        <i class="icon-shield"></i>
        <span class="hide-menu">
            @lang('models/admins.plural')
            {{-- <span class="badge badge-pill badge-cyan ml-auto">4</span> --}}
        </span>
    </a>
</li>

<li class="@if(Request::is('admin/providers*')) active @endif"> 
    <a class="waves-effect waves-dark" href="{{ route('admin.providers.index') }}" aria-expanded="false">
        <i class="icon-user"></i>
        <span class="hide-menu">
            @lang('models/providers.plural')
            @if(($menu_providers_count = App\Models\Provider::where('approve', 0)->count()) > 0)
            <span class="badge badge-pill badge-warning ml-auto">{{ $menu_providers_count }}</span>
            @endif
        </span>
    </a>
</li>

<li class="@if(Request::is('admin/users*')) active @endif"> 
    <a class="waves-effect waves-dark" href="{{ route('admin.users.index') }}" aria-expanded="false">
        <i class="icon-people"></i>
        <span class="hide-menu">
            @lang('models/users.plural')
            {{-- <span class="badge badge-pill badge-cyan ml-auto">4</span> --}}
        </span>
    </a>
</li>

<li class="nav-small-cap">--- @lang('msg.messages')</li>

<li class="@if(Request::is('admin/notifications*')) active @endif"> 
    <a class="waves-effect waves-dark" href="{{ route('admin.notifications.index') }}" aria-expanded="false">
        <i class="icon-bell"></i>
        <span class="hide-menu">
            @lang('models/notifications.plural')
            @if(($menu_notifications_count = Auth::guard('admin')->user()->getNotifications(0)->count()) > 0)
            <span class="badge badge-pill badge-cyan ml-auto">{{ $menu_notifications_count }}</span>
            @endif
        </span>
    </a>
</li>

<li class="@if(Request::is('admin/contacts*')) active @endif"> 
    <a class="waves-effect waves-dark" href="{{ route('admin.contacts.index') }}" aria-expanded="false">
        <i class="icon-envelope"></i>
        <span class="hide-menu">
            @lang('models/contacts.plural')
            @if(($menu_contacts_count = App\Models\Contact::where('read_at', null)->count()) > 0)
            <span class="badge badge-pill badge-cyan ml-auto">{{ $menu_contacts_count }}</span>
            @endif
        </span>
    </a>
</li>

<li class="nav-small-cap">--- @lang('msg.settings')</li>

<li class="@if(Request::is('admin/translation*')) active @endif"> 
    <a class="waves-effect waves-dark" href="{{ route('admin.translation') }}" aria-expanded="false">
        <i class="icon-globe"></i>
        <span class="hide-menu">
            @lang('msg.translation')
            @if(($menu_notifications_count = Auth::guard('admin')->user()->getNotifications(0)->count()) > 0)
            <span class="badge badge-pill badge-cyan ml-auto">{{ $menu_notifications_count }}</span>
            @endif
        </span>
    </a>
</li>


