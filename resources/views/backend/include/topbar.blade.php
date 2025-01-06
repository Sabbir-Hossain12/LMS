<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="" class="logo logo-dark">
                                <span class="logo-sm">
                                    
                                    <img src="{{asset($basicInfo->dark_logo)}}" alt="" width="80%" height="24">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{asset($basicInfo->dark_logo)}}" alt="" width="160px" height="60px"> 
                                </span>
                </a>

{{--                <a href="" class="logo logo-light">--}}
{{--                                <span class="logo-sm">--}}
{{--                                    <img src="{{asset($basicInfo->dark_logo)}}" alt="" height="24">--}}
{{--                                </span>--}}
{{--                    --}}
{{--                                <span class="logo-lg">--}}
{{--                                    <img src="{{asset($basicInfo->dark_logo)}}" alt="" height="24"> <span class="logo-txt"></span>--}}
{{--                                </span>--}}
{{--                </a>--}}
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <!-- App Search-->
            <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search...">
                    <button class="btn btn-primary" type="button"><i class="bx bx-search-alt align-middle"></i></button>
                </div>
            </form>
        </div>

        <div class="d-flex">
            
          

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item bg-soft-light border-start border-end" id="page-header-user-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{asset('backend')}}/assets/images/users/avatar-1.jpg"
                         alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1 fw-medium">{{Auth::user()->name}}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href=""><i class="fa-solid fa-user  font-size-16 align-middle me-1"></i> Profile</a>
                    <div class="dropdown-divider"></div>
                    <form method="post" action="{{url('admin/logout')}}">
                        @csrf
                    <button type="submit" class="dropdown-item" ><i class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</header>