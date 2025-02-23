@extends('Frontend.layouts.master')

@section('content')

    <!-- login__section__start -->
    <div class="loginarea sp_top_100 sp_bottom_100">
        <div class="container">
            <div class="row">



                <div class="tab-content tab__content__wrapper" id="myTabContent" data-aos="fade-up">

                    <div class="col-xl-8 offset-md-2">
                        <div class="loginarea__wraper">
                            <div class="login__heading">
                                <h5 class="login__title">Create a New Password</h5>
                            </div>


                            <form id="resetPasswordForm">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="login__form">
                                            <label class="form__label">Password</label>
                                            <input class="common__login__input" type="password"
                                                   placeholder="Password" name="password">

                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="login__form">
                                            <label class="form__label">Re-Enter Password</label>
                                            <input class="common__login__input" type="password"
                                                   placeholder="Re-Enter Password" name="password_confirmation">

                                        </div>
                                    </div>
                                </div>
                                
                                <div class="login__button">
                                    <button class="default__button w-100">Update</button>
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


    <!-- login__section__end -->

    @push('js')
        <script>
            $('#resetPasswordForm').submit(function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: "{{route('student.reset-password')}}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        // Show loader
                        showLoader();
                    },
                    success: function (res) {
                        if (res.status === 'success') {
                            successToast('Password Changed successfully !');
                            // setTimeout(function() {
                                window.location.href = '{{route('student.password-page')}}';
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