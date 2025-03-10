
@extends('Frontend.layouts.master')



@section('content')

    <!-- dashboardarea__area__start  -->
    <div class="dashboardarea sp_bottom_100">
        <div class="container-fluid full__width__padding">
            <div class="row">
                <div class="col-xl-12">
                    <div class="dashboardarea__wraper">
                        <div class="dashboardarea__img">
                            <div class="dashboardarea__inner student__dashboard__inner">
                                <div class="dashboardarea__left">
                                    <div class="dashboardarea__left__img">
                                        <img loading="lazy" src="{{asset($student->profile_image ?? 'frontend/img/teacher/teacher__2.png')}}"
                                             alt="" height="109px" width="109px">
                                    </div>
                                    <div class="dashboardarea__left__content">
                                        <h4>{{Auth::user()->name}}</h4>
                                        <ul>
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                     class="feather feather-book-open">
                                                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                                                </svg>
                                                {{$enrollments_count ?? 0}} Courses Enrolled
                                            </li>
{{--                                            <li>--}}
{{--                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"--}}
{{--                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"--}}
{{--                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"--}}
{{--                                                     class="feather feather-award">--}}
{{--                                                    <circle cx="12" cy="8" r="7"></circle>--}}
{{--                                                    <polyline--}}
{{--                                                            points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>--}}
{{--                                                </svg>--}}
{{--                                                8 Certificate--}}
{{--                                            </li>--}}
                                        </ul>

                                    </div>
                                </div>
                                <div class="dashboardarea__right">
                                    <div class="dashboardarea__right__button">
                                        <a class="default__button" href="{{route('course-list')}}">Enroll A New Course
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-arrow-right">
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                                <polyline points="12 5 19 12 12 19"></polyline>
                                            </svg>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard">
            <div class="container-fluid full__width__padding">
                <div class="row">
                    
                    <div class="col-xl-3 col-lg-3 col-md-12">
                        <div class="dashboard__inner sticky-top">
                            <div class="dashboard__nav__title">
                                <h6>Welcome, {{Auth::user()->name}} </h6>
                            </div>
                            <div class="dashboard__nav">
                                <ul>
                                    <li>
                                        <a class="active" href="javascript:void(0);" id="dashSummeryTab">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-home">
                                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                            </svg>
                                            Dashboard
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <a href="javascript:void(0);" id="profileTab">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-user">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="12" cy="7" r="4"></circle>
                                            </svg>
                                            My Profile
                                        </a>
                                    </li>
                           
                                    <li>
                                        <a href="javascript:void(0);" id="courseTab">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-bookmark">
                                                <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                                            </svg>
                                            Enrolled Courses</a>
                                    </li>

                                    <li>
                                        <a href="javascript:void(0);" id="examTab">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-help-circle">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                                                <line x1="12" y1="17" x2="12.01" y2="17"></line>
                                            </svg>
                                            My Exam Attempts</a>
                                    </li>
                                    
                                    
                                    <li>
                                        <a href="javascript:void(0);" id="SettingsTab">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-settings">
                                                <circle cx="12" cy="12" r="3"></circle>
                                                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                                            </svg>
                                            Settings</a>
                                    </li>
                                    
                                    <li>
                                        <a id="logOut" href="javascript:void(0);">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-volume-1">
                                                <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon>
                                                <path d="M15.54 8.46a5 5 0 0 1 0 7.07"></path>
                                            </svg>
                                            Logout
                                        </a>
                                    </li>
                                   
                                </ul>
                            </div>
                            <form method="POST" action="{{ route('student.log-out') }}">
                                @csrf
                            </form>

                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-12" id="dashboardMainContent">
                       
                    </div>
                    
                </div>
            </div>
        </div>

    </div>
    <!-- dashboardarea__area__end   -->

    @push('js')
        <script>
            
            $(document).ready(function () {
                
                $('#dashSummeryTab').trigger('click');
            });

            //Logout Function
            $('#logOut').on('click',function (e) {
                e.preventDefault();
                console.log('logout');

                Swal.fire({
                    title: "You are about to be Logged Out !",
                    showCancelButton: true,
                    confirmButtonText: "Okay",
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {

                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            method: 'POST',
                            url: "{{route('student.log-out')}}",

                            success: function (res) {

                                if (res.status === 'success') {
                                    successToast('Logout Successful !');
                                    window.location.href = '{{url('/')}}';
                                }
                            },
                            error: function (err) {

                                errorToast('error');
                            }
                        })
                        
                    } else if (result.isCanceled) {
                        Swal.fire("Changes are not saved", "", "info");
                    }
                });
                
         
            });
            
            // dashboard Summery
            $(document).on('click', '#dashSummeryTab', function (e) {

                e.preventDefault();
                
               
                $(this).addClass('active'); // Add active class to the clicked element's anchor
                
                $('#profileTab').removeClass('active');
                $('#courseTab').removeClass('active');
                $('#examTab').removeClass('active');
                $('#SettingsTab').removeClass('active');
                
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'GET',
                    url: "{{route('student.dashboard.summery')}}",

                    // contentType: false,
                    // processData: false,
                    beforeSend: function() {
                        // Show loader
                        showLoader();
                    },
                    
                    success: function (res) {

                        $('#dashboardMainContent').empty();
                        $('#dashboardMainContent').append(res.html);
                        
                        $("html, body").animate({
                            scrollTop: $("#dashboardSummerSection").offset().top - 160
                        }, 200);
                        
                    },
                    error: function (err) {

                        errorToast('error');
                    },
                    
                    complete: function() {
                        // Hide loader
                        hideLoader();
                    }
                })
            });

            //Profile Page
            $(document).on('click', '#profileTab', function (e) {

                e.preventDefault();


                $(this).addClass('active'); // Add active class to the clicked element's anchor
                
                $('#dashSummeryTab').removeClass('active');
                $('#courseTab').removeClass('active');
                $('#examTab').removeClass('active');
                $('#SettingsTab').removeClass('active');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'GET',
                    url: "{{route('student.dashboard.profile')}}",

                    // contentType: false,
                    // processData: false,
                    beforeSend: function() {
                        // Show loader
                        showLoader();
                    },

                    success: function (res) {

                        $('#dashboardMainContent').empty();
                        $('#dashboardMainContent').append(res.html);
                        
                         $("html, body").animate({
                            scrollTop: $("#profileSection").offset().top - 100
                        }, 200); // 800ms smooth scrolling

                    },
                    error: function (err) {

                        errorToast('error');
                    },
                    complete: function() {
                        // Hide loader
                        hideLoader();
                    }
                })
            });

            //Enrolled Courses
            $(document).on('click', '#courseTab', function (e) {

                e.preventDefault();


                $(this).addClass('active'); // Add active class to the clicked element's anchor
                $('#dashSummeryTab').removeClass('active');
                $('#profileTab').removeClass('active');
                $('#examTab').removeClass('active');
                $('#SettingsTab').removeClass('active');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'GET',
                    url: "{{route('student.dashboard.courses')}}",

                    // contentType: false,
                    // processData: false,
                    beforeSend: function() {
                        // Show loader
                        showLoader();
                    },

                    success: function (res) {

                        $('#dashboardMainContent').empty();
                        $('#dashboardMainContent').append(res.html);
                        
                         $("html, body").animate({
                            scrollTop: $("#enrolledCourseSection").offset().top - 100
                        }, 200); // 800ms smooth scrolling

                    },
                    error: function (err) {

                        errorToast('error');
                    },
                    complete: function() {
                        // Hide loader
                        hideLoader();
                    }
                })
            });

            //Attempted Exams
            $(document).on('click', '#examTab', function (e) {

                e.preventDefault();


                $(this).addClass('active'); // Add active class to the clicked element's anchor

                $('#dashSummeryTab').removeClass('active');
                $('#profileTab').removeClass('active');
                $('#courseTab').removeClass('active');
                $('#SettingsTab').removeClass('active');
                
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'GET',
                    url: "{{route('student.dashboard.exam')}}",

                    // contentType: false,
                    // processData: false,
                    beforeSend: function() {
                        // Show loader
                        // showLoader();
                    },

                    success: function (res) {

                        $('#dashboardMainContent').empty();
                        $('#dashboardMainContent').append(res.html);
                        
                           $("html, body").animate({
                            scrollTop: $("#attemptSection").offset().top - 100
                        }, 200); // 800ms smooth scrolling

                    },
                    error: function (err) {

                        errorToast('error');
                    },
                    complete: function() {
                        // Hide loader
                        // hideLoader();
                    }
                })
            });

            //Settings
            $(document).on('click', '#SettingsTab', function (e) {

                e.preventDefault();


                $(this).addClass('active'); // Add active class to the clicked element's anchor

                $('#dashSummeryTab').removeClass('active');
                $('#profileTab').removeClass('active');
                $('#courseTab').removeClass('active');
                $('#examTab').removeClass('active');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'GET',
                    url: "{{route('student.dashboard.setting')}}",

                    // contentType: false,
                    // processData: false,
                    beforeSend: function() {
                        // Show loader
                        showLoader();
                    },

                    success: function (res) {

                        $('#dashboardMainContent').empty();
                        $('#dashboardMainContent').append(res.html);
                        
                        
                        
                            $("html, body").animate({
                            scrollTop: $("#settingSection").offset().top - 100
                        }, 200); // 800ms smooth scrolling

                    },
                    error: function (err) {

                        errorToast('error');
                    },
                    complete: function() {
                        // Hide loader
                        hideLoader();
                    }
                })
            });
            
            //Exam Solution
            $(document).on('click', '.examSolutionBtn', function (e) {

                let id= $(this).data('id');
                console.log(id)
                e.preventDefault();
                
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'GET',
                    url: "{{route('student.dashboard.exam.solution', ':id')}}".replace(':id', id),

                    // contentType: false,
                    // processData: false,
                    beforeSend: function() {
                        // Show loader
                        showLoader();
                    },

                    success: function (res) {

                        $('#dashboardMainContent').empty();
                        $('#dashboardMainContent').append(res.html);

                    },
                    error: function (err) {

                        errorToast('error');
                    },
                    complete: function() {
                        // Hide loader
                        hideLoader();
                    }
                })
            });
            
            //Close Button
            $(document).on('click', '.examCloseBtn', function (e) {
                
                e.preventDefault();
                
                $('#examTab').trigger('click');
            });
            
        </script>
    @endpush

@endsection