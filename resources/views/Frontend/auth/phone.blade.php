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
                                    <h5 class="login__title">Login</h5>
                                </div>
                                
                                <form id="phoneSubmitForm">
                                    @csrf
                                    <div class="login__form">
                                        <label class="form__label">Phone Number</label>
                                        <input class="common__login__input" name="phone" type="text" placeholder="01*********" required>
                                    </div>
                                    
                                    <div class="login__button">
                                        <button type="submit" id="submitBtn" class="default__button w-100">Submit</button>
                                    </div>
                                </form>

{{--                                <div class="login__social__option">--}}
{{--                                    <p>or Log-in with</p>--}}

{{--                                    <ul class="login__social__btn">--}}
{{--                                        <li><a class="default__button login__button__1" href="#"><i--}}
{{--                                                        class="icofont-facebook"></i> Facebook</a></li>--}}
{{--                                        <li><a class="default__button" href="#"><i class="icofont-google-plus"></i>--}}
{{--                                                Google</a></li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}


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
    
    @push('js')
                <script>
                   
                    $('#phoneSubmitForm').submit(function (e) {
                        e.preventDefault();
                       
                        
                        var formData = new FormData(this);
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            method: 'POST',
                            url: "{{route('student.phone-verify')}}",
                            data: formData,
                            contentType: false,
                            processData: false,
                            beforeSend: function() {
                                
                                // Show loader
                                showLoader();
                                $('#submitBtn').prop('disabled', true);
                                
                            },
                            success: function (res) {
                               
                                if (res.message === 'verified') {
                                    successToast('Phone Number Matched !');
                                    // setTimeout(function() {
                                        window.location.href = '{{route('student.password-page')}}';
                                    // }, 2000);
                                  
                                }
                                else
                                {
                                    successToast('A 4 digit OTP has been sent to your phone !');
                                    // setTimeout(function() {
                                        window.location.href = '{{route('student.otp-page')}}';
                                    // }, 2000);
                                   
                                }
                            },
                            error: function (err) {
                                
                                errorToast('error');
                            },
                            complete: function() {
                                
                                // Hide loader
                                hideLoader();

                                $('#submitBtn').prop('disabled', false);
                               
                              
                            }
                        })
                    });
                    
                </script>
    @endpush

    <!-- login__section__end -->
@endsection