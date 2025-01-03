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
                                        <img loading="lazy"  src="../img/teacher/teacher__2.png" alt="">
                                    </div>
                                    <div class="dashboardarea__left__content">
                                        <h4>Dond Tond</h4>
                                        <ul>
                                            <li>                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book-open"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                                                9 Courses Enroled
                                            </li>
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
                                                8 Certificate
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                                <div class="dashboardarea__right">
                                    <div class="dashboardarea__right__button">
                                        <a class="default__button" href="create-course.html">Enroll A New Course
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></a>
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
                                <h6>Welcome, Dond Tond </h6>
                            </div>
                            <div class="dashboard__nav">
                                <ul>
                                    <li>
                                        <a href="student-dashboard.html">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                            Dashboard</a>
                                    </li>
                                    <li>
                                        <a href="student-profile.html">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                            My Profile</a>
                                    </li>
                                    <li>
                                        <a href="student-message.html">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book-open"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                                            Message</a><span class="dashboard__label">12</span>
                                    </li>
                                    <li>
                                        <a href="student-enrolled-courses.html">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bookmark"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg>
                                            Enrolled Courses</a>
                                    </li>
                                    <li>
                                        <a class="active" href="student-wishlist.html">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bookmark"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg>
                                            Wishlist</a>
                                    </li>
                                    <li>
                                        <a href="student-reviews.html">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                            Reviews</a>
                                    </li>
                                    <li>
                                        <a href="student-my-quiz-attempts.html">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                                            My Quiz Attempts</a>
                                    </li>
                                    <li>
                                        <a href="student-assignments.html">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-volume-1"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon><path d="M15.54 8.46a5 5 0 0 1 0 7.07"></path></svg>
                                            Assignments</a>
                                    </li>
                                    <li>
                                        <a href="student-settings.html">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                                            Settings</a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-volume-1"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon><path d="M15.54 8.46a5 5 0 0 1 0 7.07"></path></svg>
                                            Logout</a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-12">
                        <div class="dashboard__content__wraper">
                            <div class="dashboard__section__title">
                                <h4>Wishlist</h4>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="gridarea__wraper">
                                        <div class="gridarea__img">
                                            <img loading="lazy"  src="../img/grid/grid_2.png" alt="grid">
                                            <div class="gridarea__small__button">
                                                <div class="grid__badge blue__color">Mechanical</div>
                                            </div>
                                            <div class="gridarea__small__icon">
                                                <a href="#"><i class="icofont-heart-alt"></i></a>
                                            </div>

                                        </div>
                                        <div class="gridarea__content">
                                            <div class="gridarea__list">
                                                <ul>
                                                    <li>
                                                        <i class="icofont-book-alt"></i> 29 Lesson
                                                    </li>
                                                    <li>
                                                        <i class="icofont-clock-time"></i> 2 hr 10 min
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="gridarea__heading">
                                                <h3><a href="#">Nidnies course to under stand
                                                        about softwere</a></h3>
                                            </div>
                                            <div class="gridarea__price green__color">
                                                $32.00<del>/$67.00</del>
                                                <span>.Free</span>

                                            </div>
                                            <div class="gridarea__bottom">
                                                <a href="instructor-details.html">
                                                    <div class="gridarea__small__img">
                                                        <img loading="lazy"  src="../img/grid/grid_small_2.jpg" alt="grid">
                                                        <div class="gridarea__small__content">
                                                            <h6>Rinis Jhon</h6>
                                                        </div>
                                                    </div>
                                                </a>
                                                <div class="gridarea__star">
                                                    <i class="icofont-star"></i>
                                                    <i class="icofont-star"></i>
                                                    <i class="icofont-star"></i>
                                                    <i class="icofont-star"></i>
                                                    <i class="icofont-star"></i>
                                                    <span>(44)</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="gridarea__wraper">
                                        <div class="gridarea__img">
                                            <a href="../course-details.html"><img loading="lazy"  src="../img/grid/grid_3.png" alt="grid"></a>
                                            <div class="gridarea__small__button">
                                                <div class="grid__badge pink__color">Development</div>
                                            </div>
                                            <div class="gridarea__small__icon">
                                                <a href="#"><i class="icofont-heart-alt"></i></a>
                                            </div>

                                        </div>
                                        <div class="gridarea__content">
                                            <div class="gridarea__list">
                                                <ul>
                                                    <li>
                                                        <i class="icofont-book-alt"></i> 25 Lesson
                                                    </li>
                                                    <li>
                                                        <i class="icofont-clock-time"></i> 1 hr 40 min
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="gridarea__heading">
                                                <h3><a href="../course-details.html">Minws course to under stand
                                                        about solution</a></h3>
                                            </div>
                                            <div class="gridarea__price">
                                                $40.00 <del>/ $67.00</del>
                                                <span> <del class="del__2">Free</del></span>

                                            </div>
                                            <div class="gridarea__bottom">

                                                <a href="instructor-details.html">
                                                    <div class="gridarea__small__img">
                                                        <img loading="lazy"  src="../img/grid/grid_small_3.jpg" alt="grid">
                                                        <div class="gridarea__small__content">
                                                            <h6>Micle Jhon</h6>
                                                        </div>
                                                    </div>
                                                </a>

                                                <div class="gridarea__star">
                                                    <i class="icofont-star"></i>
                                                    <i class="icofont-star"></i>
                                                    <i class="icofont-star"></i>
                                                    <i class="icofont-star"></i>
                                                    <i class="icofont-star"></i>
                                                    <span>(44)</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="gridarea__wraper">
                                        <div class="gridarea__img">
                                            <a href="../course-details.html"><img loading="lazy"  src="../img/grid/grid_3.png" alt="grid"></a>
                                            <div class="gridarea__small__button">
                                                <div class="grid__badge pink__color">Development</div>
                                            </div>
                                            <div class="gridarea__small__icon">
                                                <a href="#"><i class="icofont-heart-alt"></i></a>
                                            </div>

                                        </div>
                                        <div class="gridarea__content">
                                            <div class="gridarea__list">
                                                <ul>
                                                    <li>
                                                        <i class="icofont-book-alt"></i> 25 Lesson
                                                    </li>
                                                    <li>
                                                        <i class="icofont-clock-time"></i> 1 hr 40 min
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="gridarea__heading">
                                                <h3><a href="../course-details.html">Minws course to under stand
                                                        about solution</a></h3>
                                            </div>
                                            <div class="gridarea__price">
                                                $40.00 <del>/ $67.00</del>
                                                <span> <del class="del__2">Free</del></span>

                                            </div>
                                            <div class="gridarea__bottom">

                                                <a href="instructor-details.html">
                                                    <div class="gridarea__small__img">
                                                        <img loading="lazy"  src="../img/grid/grid_small_3.jpg" alt="grid">
                                                        <div class="gridarea__small__content">
                                                            <h6>Micle Jhon</h6>
                                                        </div>
                                                    </div>
                                                </a>

                                                <div class="gridarea__star">
                                                    <i class="icofont-star"></i>
                                                    <i class="icofont-star"></i>
                                                    <i class="icofont-star"></i>
                                                    <i class="icofont-star"></i>
                                                    <i class="icofont-star"></i>
                                                    <span>(44)</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>

                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>

    <!-- dashboardarea__menu__end   -->

@endsection