@extends('Frontend.layouts.master')

@section('content')

    <!-- login__section__start -->
    <div class="loginarea sp_top_100 sp_bottom_100">
        <div class="container">
            <div class="row">
{{--                                <div class="col-xl-8 col-md-8 offset-md-2" data-aos="fade-up">--}}
{{--                                    <ul class="nav  tab__button__wrap text-center" id="myTab" role="tablist">--}}
{{--                                        <li class="nav-item" role="presentation">--}}
{{--                                            <button class="single__tab__link active" data-bs-toggle="tab"--}}
{{--                                                    data-bs-target="#projects__one" type="button">Login--}}
{{--                                            </button>--}}
{{--                                        </li>--}}
{{--                                        <li class="nav-item" role="presentation">--}}
{{--                                            <button class="single__tab__link" data-bs-toggle="tab" data-bs-target="#projects__two"--}}
{{--                                                    type="button">Sign up--}}
{{--                                            </button>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}


                <div class="tab-content tab__content__wrapper" id="myTabContent" data-aos="fade-up">
                    
                        <div class="col-xl-8 offset-md-2">
                            <div class="loginarea__wraper">
                                <div class="login__heading">
                                    <h5 class="login__title">Sign Up</h5>
                                    <p class="login__description">Already have an account? <a href="{{route('student.phone-page')}}" data-bs-toggle="modal" data-bs-target="#registerModal">Log In</a></p>
                                </div>


                                <form id="registerForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="login__form">
                                                <label class="form__label">Phone</label>
                                                <input id="phone" class="common__login__input" type="number"
                                                       placeholder="01*********" name="phone" readonly>

                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="login__form">
                                                <label class="form__label">Name</label>
                                                <input class="common__login__input" name="name" type="text"
                                                       placeholder="Full Name" required>

                                            </div>
                                        </div>
                                     
                                    
                                        <div class="col-xl-6">
                                            <div class="login__form">
                                                <label class="form__label">Password</label>
                                                <input class="common__login__input" type="password"
                                                       placeholder="Password" name="password" required>

                                            </div>
                                        </div>
                                        
                                        <div class="col-xl-6">
                                            <div class="login__form">
                                                <label class="form__label">Re-Enter Password</label>
                                                <input class="common__login__input" type="password"
                                                       placeholder="Re-Enter Password" name="password_confirmation" required>

                                            </div>
                                        </div>
                                    </div>

{{--                                    <div class="login__form d-flex justify-content-between flex-wrap gap-2">--}}
{{--                                        <div class="form__check">--}}
{{--                                            <input id="accept_pp" type="checkbox"> <label for="accept_pp">Accept the--}}
{{--                                                Terms and Privacy Policy</label>--}}
{{--                                        </div>--}}

{{--                                    </div>--}}
                                    <div class="login__button">
                                        <button type="submit" class="default__button w-100">Submit</button>
                                    </div>
                                </form>


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


    @push('js')
        <script>
            $(document).ready(function () {
                // Accessing Laravel session value in JavaScript
                var phone = @json(session('phone'));
                
                $('#phone').val(phone);
            })
               
        

            $('#registerForm').submit(function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: "{{route('student.register')}}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        // Show loader
                        showLoader();
                    },
                    success: function (res) {
                        if (res.status === 'success') {
                            successToast('Registration successful !');
                            // setTimeout(function() {
                                window.location.href = '{{route('student.dashboard.index')}}';
                            // }, 2000);

                        }
                      
                    },
                    error: function (err) {

                        errorToast(err.responseJSON?.message);
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