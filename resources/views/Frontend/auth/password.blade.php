@extends('Frontend.layouts.master')

@section('content')


    <!-- login__section__start -->
    <div class="loginarea sp_top_100 sp_bottom_100">
        <div class="container">
            <div class="row">
 


                <div class="tab-content tab__content__wrapper" id="myTabContent" data-aos="fade-up">

                    <div class="tab-pane fade active show" id="projects__one" role="tabpanel"
                         aria-labelledby="projects__one">
                        <div class="col-xl-8 col-md-8 offset-md-2">
                            <div class="loginarea__wraper">
                                <div class="login__heading">
                                    <h5 class="login__title">Welcome</h5>
                                </div>


                                <form id="passwordForm">
                                    @csrf
                                    <div class="login__form">
                                        <label class="form__label">Password</label>
                                        <input class="common__login__input" name="password"  type="password"
                                               placeholder="******" required>

                                    </div>
                            
                                    <div class="login__form d-flex justify-content-between flex-wrap gap-2">
{{--                                                                                <div class="form__check">--}}
{{--                                                                                    <input id="forgot" type="checkbox">--}}
{{--                                                                                    <label for="forgot"> Remember me</label>--}}
{{--                                                                                </div>--}}
                                                                                <div class="text-end login__form__link">
                                                                                    <a href="{{route('student.forgot-page')}}">Forgot password?</a>
                                                                                </div>
                                    </div>
                                    <div class="login__button">
                                        <button type="submit" class="default__button w-100">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="projects__two" role="tabpanel" aria-labelledby="projects__two">
                        <div class="col-xl-8 offset-md-2">
                            <div class="loginarea__wraper">
                                <div class="login__heading">
                                    <h5 class="login__title">Sign Up</h5>
                                    <p class="login__description">Already have an account? <a href="#"
                                                                                              data-bs-toggle="modal"
                                                                                              data-bs-target="#registerModal">Log In</a></p>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>

            </div>

            <div class=" login__shape__img educationarea__shape_image">
                <img loading="lazy" class="hero__shape hero__shape__1" src="{{asset('frontend')}}/img/education/hero_shape2.png" alt="Shape">
                <img loading="lazy" class="hero__shape hero__shape__2" src="{{asset('frontend')}}/img/education/hero_shape3.png" alt="Shape">
                <img loading="lazy" class="hero__shape hero__shape__3" src="{{asset('frontend')}}/img/education/hero_shape4.png" alt="Shape">
                <img loading="lazy" class="hero__shape hero__shape__4" src="{{asset('frontend')}}/img/education/hero_shape5.png" alt="Shape">
            </div>


        </div>
    </div>

    <!-- login__section__end -->



    @push('js')
        <script>

            $('#passwordForm').submit(function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: "{{route('student.password-verify')}}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        // Show loader
                        showLoader();
                    },
                    success: function (res) {
                        if (res.status === 'success') {
                            successToast('Password Matched !');
                            // setTimeout(function() {
                                window.location.href = '{{route('student.dashboard.index')}}';
                            // }, 2000);
                        }
                        else
                        {
                            errorToast('Password Does not Match !');
                        }
                    },
                    error: function (err) {

                        errorToast('Password Does not Match !');
                    },
                    complete: function() {
                        // Hide loader
                        hideLoader();
                    }
                })
            });

        </script>
    @endpush
@endsection