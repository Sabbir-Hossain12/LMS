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


                                <form id="otpForm">
                                    @csrf
                                    <div class="login__form">
                                        <label class="form__label">OTP</label>
                                        <input class="common__login__input" type="Number" name="otp"
                                               placeholder="******"   required>

                                    </div>
                                    <div class="mt-4 d-flex justify-content-between">
                                        <p id="otpTimer"></p>
                                    
                                    
                                        <a id="resendOtp" href="javascript:void(0)" class="">Resend OTP</a>
                                    </div>
                                
                                    <div class="login__form d-flex justify-content-between flex-wrap gap-2">
                                        {{--                                        <div class="form__check">--}}
                                        {{--                                            <input id="forgot" type="checkbox">--}}
                                        {{--                                            <label for="forgot"> Remember me</label>--}}
                                        {{--                                        </div>--}}
                                        {{--                                        <div class="text-end login__form__link">--}}
                                        {{--                                            <a href="#">Forgot your password?</a>--}}
                                        {{--                                        </div>--}}
                                    </div>
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
    </div>

    <!-- login__section__end -->

    @push('js')
        <script>
            startCountdownTimer();

            $('#otpForm').submit(function (e) {
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
                                window.location.href = '{{route('student.register-page')}}';
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

            
            $('#resendOtp').on('click',function (e) {
                e.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: "{{route('student.otp-resend')}}",
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        // Show loader
                        showLoader();
                    },
                    success: function (res) {
                        if (res.status === 'success') {
                            successToast(res.message);
                            startCountdownTimer();
                        }
                        else
                        {
                            errorToast(res.message);

                        }
                    },
                    error: function (err) {

                        errorToast(err.json().message);
                    },
                    complete: function() {
                        // Hide loader
                        hideLoader();
                    }
                })
            });

           // Trigger an AJAX request to get the remaining time

            function startCountdownTimer() {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{route('student.otp-resend')}}", // Route that will provide the remaining time
                    method: 'POST',
                    success: function(res) {
                        if (res.status === 'failed') {


                            let remainingTime = res.remaining_time; // Assuming the response is { remaining_time: "02:30" }
                            let [minutes, seconds] = remainingTime.split(':');

                            // Convert remaining time into seconds
                            let totalSeconds = parseInt(minutes) * 60 + parseInt(seconds);

                            // Start the countdown timer using setInterval
                            let countdownTimer = setInterval(function () {
                                let minutesLeft = Math.floor(totalSeconds / 60);
                                let secondsLeft = totalSeconds % 60;

                                // Format the time (mm:ss)
                                let formattedTime = `${String(minutesLeft).padStart(2, '0')}:${String(secondsLeft).padStart(2, '0')}`;

                                // Update the timer in the #timer element
                                $('#otpTimer').text(formattedTime);

                                // Decrement the total seconds
                                totalSeconds--;

                                // Stop the countdown when the time reaches zero
                                if (totalSeconds < 0) {
                                    clearInterval(countdownTimer);
                                    $('#otpTimer').text('Time expired');
                                }
                            }, 1000);
                        }
                    }
                });
            }

        </script>
    @endpush
@endsection