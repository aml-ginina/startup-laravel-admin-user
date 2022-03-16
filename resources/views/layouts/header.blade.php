<!-- ============================================================== -->
<!-- Topbar header - style you can find in pages.scss -->
<!-- ============================================================== -->
<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        
        @include('layouts.header.logo')

        <div class="navbar-collapse">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav mr-auto">
                <!-- This is  -->
                <li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                <li class="nav-item"> <a class="nav-link sidebartoggler d-none waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
                
                @include('layouts.header.search')

            </ul>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
            <ul class="navbar-nav my-lg-0">

                @include('layouts.header.notifications')
                
                @include('layouts.header.messages')

                @include('layouts.header.mega_menu')
                
                @include('layouts.header.user_dropdown')
                
            </ul>
        </div>
    </nav>
</header>
<!-- ============================================================== -->
<!-- End Topbar header -->
<!-- ============================================================== -->