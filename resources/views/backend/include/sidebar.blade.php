<!-- ========== Left Sidebar Start ========== -->

<style>

    #sidebar-menu > ul > li
    {
        margin-bottom: 10px;
        border-bottom: 1px solid #d2d2e0;
    }
</style>

<div class="vertical-menu">

    <div data-simplebar class="h-100">
        
     

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                    <li></li>
                <li class=""> 
                    <a href="{{route('admin.dashboard.index')}}">
                        <i class="fa-solid fa-home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="fa-solid fa-user-secret"></i>
                        <span data-key="t-apps">Admins</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('admin.admin.index') }}">
                                <span data-key="t-calendar">Admin List</span>
                            </a>
                        </li>
                        
{{--                        <li>--}}
{{--                            <a href="{{route('admin.admin.create')}}">--}}
{{--                                <span data-key="t-calendar">Admin Create</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="fa-solid fa-user-alt"></i>
                        <span data-key="t-apps">Teachers</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('admin.teacher.index') }}">
                                <span data-key="t-calendar">Teacher List</span>
                            </a>
                        </li>
                        
                    </ul>
                </li>
                
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="fa-solid fa-user-alt-slash"></i>
                        <span data-key="t-apps">Students</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('admin.student.index') }}">
                                <span data-key="t-calendar">Student List</span>
                            </a>
                        </li>
                        
                    </ul>
                </li>
                
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="fa-solid fa-user-tie"></i>
                        <span data-key="t-apps">Role and Permission</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('admin.role.index') }}">
                                <span data-key="t-calendar">Roles List</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{route('admin.permission.index')}}">
                                <span data-key="t-calendar">Permission List</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="fa-solid fa-comment-alt"></i>
                        <span data-key="t-apps">Course Content</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('admin.class.index') }}">
                                <span data-key="t-calendar">Class Management</span>
                            </a>
                        </li>
                        
                        <li>
                            <a href="{{route('admin.course.index')}}">
                                <span data-key="t-calendar">Course Management</span>
                            </a>
                        </li>
                        
                        
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="fa-solid fa-truck"></i>
                        <span data-key="t-apps">Orders</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('admin.order.index') }}">
                                <span data-key="t-calendar">Order Management</span>
                            </a>
                        </li>
                        
                    </ul>
                </li>
                
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="fa-solid fa-toolbox"></i>
                        <span data-key="t-apps">Website</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        
                        <li>
                            <a href="{{ route('admin.herobanner.index') }}">
                                <span data-key="t-calendar">Hero Banner</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{route('admin.about.index')}}">
                                <span data-key="t-calendar">About</span>
                            </a>
                        </li>
                        

                        <li>
                            <a href="{{route('admin.testimonial.index')}}">
                                <span data-key="t-calendar">Testimonials</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{route('admin.testimonial-settings.index')}}">
                                <span data-key="t-calendar">Testimonial Settings</span>
                            </a>
                        </li>
                    

                        <li>
                            <a href="{{route('admin.blog.index')}}">
                                <span data-key="t-calendar">Blog</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{route('admin.page.index')}}">
                                <span data-key="t-calendar">Pages</span>
                            </a>
                        </li>
                        

                        <li>
                            <a href="{{route('admin.basicinfo.index')}}">
                                <span data-key="t-calendar">Settings</span>
                            </a>
                        </li>
                    </ul>
                </li>
                
                
                
            </ul>
               


        
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->