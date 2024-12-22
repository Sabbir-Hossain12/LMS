@extends('Frontend.layouts.master')

@section('content')
    
    <!-- breadcrumbarea__section__start -->
    <div class="breadcrumbarea" data-aos="fade-up">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb__content__wraper">
                        <div class="breadcrumb__title">
                            <h2 class="heading">Assignment</h2>
                        </div>
                        <div class="breadcrumb__inner">
                            <ul>
                                <li><a href="index.html">Home</a></li>
                                <li> Assignment </li>
                            </ul>
                        </div>
                    </div>



                </div>
            </div>
        </div>

        <div class="shape__icon__2">
            <img loading="lazy"  class=" shape__icon__img shape__icon__img__1" src="{{url('frontend')}}/img/herobanner/herobanner__1.png" alt="photo">
            <img loading="lazy"  class=" shape__icon__img shape__icon__img__2" src="{{url('frontend')}}/img/herobanner/herobanner__2.png" alt="photo">
            <img loading="lazy"  class=" shape__icon__img shape__icon__img__3" src="{{url('frontend')}}/img/herobanner/herobanner__3.png" alt="photo">
            <img loading="lazy"  class=" shape__icon__img shape__icon__img__4" src="{{url('frontend')}}/img/herobanner/herobanner__5.png" alt="photo">
        </div>

    </div>
    <!-- breadcrumbarea__section__end-->


    <!-- tution__section__start -->
    <div class="tution sp_bottom_100 sp_top_100">
        <div class="container-fluid full__width__padding">

            <div class="row">
                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12" data-aos="fade-up">

                    <div class="accordion content__cirriculum__wrap" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Lesson #01
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">

                                    <div class="scc__wrap">
                                        <div class="scc__info">
                                            <i class="icofont-video-alt"></i>
                                            <h5> <a href="lesson.html"><span>Course Intro</span></a></h5>
                                        </div>
                                        <div class="scc__meta">
                                            <strong>3.27</strong>
                                            <a href="lesson.html"><span class="question"><i class="icofont-eye"></i> Preview</span></a>

                                        </div>
                                    </div>
                                    <div class="scc__wrap">
                                        <div class="scc__info">
                                            <i class="icofont-video-alt"></i>
                                            <h5> <a href="lesson-2.html"><span>Course Outline</span></a></h5>
                                        </div>
                                        <div class="scc__meta">
                                            <strong>5.00</strong>
                                            <a href="lesson-2.html"><span class="question"><i class="icofont-eye"></i> Preview</span></a>

                                        </div>
                                    </div>
                                    <div class="scc__wrap">
                                        <div class="scc__info">
                                            <i class="icofont-file-text"></i>
                                            <h5> <a href="lesson-course-materials.html"><span>Course Materials</span></a></h5>
                                        </div>
                                    </div>
                                    <div class="scc__wrap">
                                        <div class="scc__info">
                                            <i class="icofont-audio"></i>
                                            <h5>  <a href="lesson-quiz.html"><span>Summer Quiz</span></a></h5>
                                        </div>
                                    </div>

                                    <div class="scc__wrap">
                                        <div class="scc__info">
                                            <i class="icofont-file-text"></i>
                                            <h5><a href="lesson-assignment.html"><span>Assignment</span></a></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Lesson #02
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">

                                <div class="accordion-body">

                                    <div class="scc__wrap">
                                        <div class="scc__info">
                                            <i class="icofont-video-alt"></i>
                                            <h5> <a href="lesson.html"><span>Course Intro</span></a></h5>
                                        </div>
                                        <div class="scc__meta">
                                            <strong>3.27</strong>
                                            <a href="lesson.html"><span class="question"><i class="icofont-eye"></i> Preview</span></a>

                                        </div>
                                    </div>
                                    <div class="scc__wrap">
                                        <div class="scc__info">
                                            <i class="icofont-video-alt"></i>
                                            <h5> <a href="lesson-2.html"><span>Course Outline</span></a></h5>
                                        </div>
                                        <div class="scc__meta">
                                            <strong>5.00</strong>
                                            <a href="lesson-2.html"><span class="question"><i class="icofont-eye"></i> Preview</span></a>

                                        </div>
                                    </div>
                                    <div class="scc__wrap">
                                        <div class="scc__info">
                                            <i class="icofont-video-alt"></i>
                                            <h5> <a href="lesson-2.html"><span>Course Outline</span></a></h5>
                                        </div>
                                        <div class="scc__meta">
                                            <strong>7.00</strong>
                                            <a href="lesson-3.html"><span class="question"><i class="icofont-eye"></i> Preview</span></a>

                                        </div>
                                    </div>
                                    <div class="scc__wrap">
                                        <div class="scc__info">
                                            <i class="icofont-file-text"></i>
                                            <h5> <a href="lesson-course-materials.html"><span>Course Materials</span></a></h5>
                                        </div>
                                    </div>
                                    <div class="scc__wrap">
                                        <div class="scc__info">
                                            <i class="icofont-audio"></i>
                                            <h5>  <a href="lesson-quiz.html"><span>Summer Quiz</span></a></h5>
                                        </div>
                                    </div>

                                    <div class="scc__wrap">
                                        <div class="scc__info">
                                            <i class="icofont-file-text"></i>
                                            <h5><a href="lesson-assignment.html"><span>Assignment</span></a></h5>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Lesson #03
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">

                                    <div class="scc__wrap">
                                        <div class="scc__info">
                                            <i class="icofont-video-alt"></i>
                                            <h5> <a href="lesson.html"><span>Course Intro</span></a></h5>
                                        </div>
                                        <div class="scc__meta">
                                            <strong>3.27</strong>
                                            <a href="lesson.html"><span class="question"><i class="icofont-eye"></i> Preview</span></a>

                                        </div>
                                    </div>
                                    <div class="scc__wrap">
                                        <div class="scc__info">
                                            <i class="icofont-video-alt"></i>
                                            <h5> <a href="lesson-2.html"><span>Course Outline</span></a></h5>
                                        </div>
                                        <div class="scc__meta">
                                            <strong>5.00</strong>
                                            <a href="lesson-2.html"><span class="question"><i class="icofont-eye"></i> Preview</span></a>

                                        </div>
                                    </div>
                                    <div class="scc__wrap">
                                        <div class="scc__info">
                                            <i class="icofont-video-alt"></i>
                                            <h5> <a href="lesson-2.html"><span>Course Outline</span></a></h5>
                                        </div>
                                        <div class="scc__meta">
                                            <strong>7.00</strong>
                                            <a href="lesson-3.html"><span class="question"><i class="icofont-eye"></i> Preview</span></a>

                                        </div>
                                    </div>
                                    <div class="scc__wrap">
                                        <div class="scc__info">
                                            <i class="icofont-file-text"></i>
                                            <h5> <a href="lesson-course-materials.html"><span>Course Materials</span></a></h5>
                                        </div>
                                    </div>
                                    <div class="scc__wrap">
                                        <div class="scc__info">
                                            <i class="icofont-audio"></i>
                                            <h5>  <a href="lesson-quiz.html"><span>Summer Quiz</span></a></h5>
                                        </div>
                                    </div>

                                    <div class="scc__wrap">
                                        <div class="scc__info">
                                            <i class="icofont-file-text"></i>
                                            <h5><a href="lesson-assignment.html"><span>Assignment</span></a></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Lesson #04
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                <div class="accordion-body">

                                    <div class="scc__wrap">
                                        <div class="scc__info">
                                            <i class="icofont-video-alt"></i>
                                            <h5> <a href="lesson.html"><span>Course Intro</span></a></h5>
                                        </div>
                                        <div class="scc__meta">
                                            <strong>3.27</strong>
                                            <a href="lesson.html"><span class="question"><i class="icofont-eye"></i> Preview</span></a>

                                        </div>
                                    </div>
                                    <div class="scc__wrap">
                                        <div class="scc__info">
                                            <i class="icofont-video-alt"></i>
                                            <h5> <a href="lesson-2.html"><span>Course Outline</span></a></h5>
                                        </div>
                                        <div class="scc__meta">
                                            <strong>5.00</strong>
                                            <a href="lesson-2.html"><span class="question"><i class="icofont-eye"></i> Preview</span></a>

                                        </div>
                                    </div>
                                    <div class="scc__wrap">
                                        <div class="scc__info">
                                            <i class="icofont-video-alt"></i>
                                            <h5> <a href="lesson-2.html"><span>Course Outline</span></a></h5>
                                        </div>
                                        <div class="scc__meta">
                                            <strong>7.00</strong>
                                            <a href="lesson-3.html"><span class="question"><i class="icofont-eye"></i> Preview</span></a>

                                        </div>
                                    </div>
                                    <div class="scc__wrap">
                                        <div class="scc__info">
                                            <i class="icofont-file-text"></i>
                                            <h5> <a href="lesson-course-materials.html"><span>Course Materials</span></a></h5>
                                        </div>
                                    </div>
                                    <div class="scc__wrap">
                                        <div class="scc__info">
                                            <i class="icofont-audio"></i>
                                            <h5>  <a href="lesson-quiz.html"><span>Summer Quiz</span></a></h5>
                                        </div>
                                    </div>

                                    <div class="scc__wrap">
                                        <div class="scc__info">
                                            <i class="icofont-file-text"></i>
                                            <h5><a href="lesson-assignment.html"><span>Assignment</span></a></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                   Lesson #05
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                <div class="accordion-body">

                                    <div class="scc__wrap">
                                        <div class="scc__info">
                                            <i class="icofont-video-alt"></i>
                                            <h5> <a href="lesson.html"><span>Course Intro</span></a></h5>
                                        </div>
                                        <div class="scc__meta">
                                            <strong>3.27</strong>
                                            <a href="lesson.html"><span class="question"><i class="icofont-eye"></i> Preview</span></a>
                                            
                                        </div>
                                    </div>
                                    <div class="scc__wrap">
                                        <div class="scc__info">
                                            <i class="icofont-video-alt"></i>
                                            <h5> <a href="lesson-2.html"><span>Course Outline</span></a></h5>
                                        </div>
                                        <div class="scc__meta">
                                            <strong>5.00</strong>
                                            <a href="lesson-2.html"><span class="question"><i class="icofont-eye"></i> Preview</span></a>
                                            
                                        </div>
                                    </div>
                                    <div class="scc__wrap">
                                        <div class="scc__info">
                                            <i class="icofont-video-alt"></i>
                                            <h5> <a href="lesson-2.html"><span>Course Outline</span></a></h5>
                                        </div>
                                        <div class="scc__meta">
                                            <strong>7.00</strong>
                                            <a href="lesson-3.html"><span class="question"><i class="icofont-eye"></i> Preview</span></a>
                                            
                                        </div>
                                    </div>
                                    <div class="scc__wrap">
                                        <div class="scc__info">
                                            <i class="icofont-file-text"></i>
                                            <h5> <a href="lesson-course-materials.html"><span>Course Materials</span></a></h5>
                                        </div>
                                    </div>
                                    <div class="scc__wrap">
                                        <div class="scc__info">
                                            <i class="icofont-audio"></i>
                                            <h5>  <a href="lesson-quiz.html"><span>Summer Quiz</span></a></h5>
                                        </div>
                                    </div>

                                    <div class="scc__wrap">
                                        <div class="scc__info">
                                            <i class="icofont-file-text"></i>
                                            <h5><a href="lesson-assignment.html"><span>Assignment</span></a></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                    </div>
                </div>
                <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12" data-aos="fade-up">
                    <div class="lesson__assignment__wrap">

                        <h3>Latest Assignment lists</h3>
                        <hr class="hr" />

                        <div class="dashboard__table table-responsive">
                            <table>
                                <thead>
                                <tr>
                                    <th>Assignment Name</th>
                                    <th>Total Marks</th>
                                    <th>Total Submit</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th>

                                        <span>Write a the 5</span>
                                        <p>course: <a href="#">Fundamentals</a></p>
                                    </th>
                                    <td>
                                        <p>80</p>
                                    </td>
                                    <td>
                                        <p>2</p>
                                    </td>


                                    <td>
                                        <div class="dashboard__button__group">
                                            <a class="dashboard__small__btn__2" href="#">
                                                <i class="icofont-download"></i> Download</a>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="dashboard__table__row">
                                    <th>

                                        <span>Write a the 5</span>
                                        <p>course: <a href="#">Fundamentals</a></p>
                                    </th>
                                    <td>
                                        <p>80</p>
                                    </td>
                                    <td>
                                        <p>2</p>
                                    </td>


                                    <td>
                                        <div class="dashboard__button__group">
                                            <a class="dashboard__small__btn__2" href="#">
                                                <i class="icofont-download"></i> Download</a>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th>

                                        <span>Write a the 5</span>
                                        <p>course: <a href="#">Fundamentals</a></p>
                                    </th>
                                    <td>
                                        <p>80</p>
                                    </td>
                                    <td>
                                        <p>2</p>
                                    </td>



                                    <td>
                                        <div class="dashboard__button__group">
                                            <a class="dashboard__small__btn__2" href="#">
                                                <i class="icofont-download"></i> Download</a>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="dashboard__table__row">
                                    <th>

                                        <span>Write a the 5</span>
                                        <p>course: <a href="#">Fundamentals</a></p>
                                    </th>
                                    <td>
                                        <p>80</p>
                                    </td>
                                    <td>
                                        <p>2</p>
                                    </td>


                                    <td>
                                        <div class="dashboard__button__group">
                                            <a class="dashboard__small__btn__2" href="#">
                                                <i class="icofont-download"></i> Download</a>
                                        </div>
                                    </td>
                                </tr>


                                </tbody>
                            </table>
                        </div>

                        <br>
                        <br>

                        <div class="assignment__submit__wrap">
                            <h3>Assignment Submission</h3>
                            <hr class="hr" />

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Assignment Content</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="formFileLg" class="form-label">Drop file here</label>
                                <input class="form-control form-control-lg" id="formFileLg" type="file">
                            </div>

                            <a class="default__button" href="#">Submit Assignment</a>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- tution__section__end -->


@endsection