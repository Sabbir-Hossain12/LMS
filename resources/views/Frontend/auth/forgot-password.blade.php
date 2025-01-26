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
                                    <h5 class="login__title">Please Enter the 4 Digit OTP</h5>
                                </div>


                                <form id="forgotPasswordForm">
                                    @csrf
                                    <div class="login__form">
                                        <label class="form__label">OTP</label>
                                        <input class="common__login__input" type="number"  name="otp"
                                               placeholder="****" required>

                                    </div>
                                    
                                  
                                    <div class="login__button">
                                        <button class="default__button w-100">Submit</button>
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
            $('#forgotPasswordForm').submit(function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: "{{route('student.otp-verify')}}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        // Show loader
                        showLoader();
                    },
                    success: function (res) {
                        if (res.message === 'verified') {
                            successToast('OTP Matched !');
                            setTimeout(function() {
                                window.location.href = '{{route('student.reset-page')}}';
                            }, 2000);

                        }
                        else
                        {
                            errorToast('Your OTP Expired');

                        }
                    },
                    error: function (err) {

                        errorToast('Invalid OTP');
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