@extends('Frontend.layouts.master')

@section('content')
    <!-- breadcrumbarea__section__start -->

    <div class="mt-4">

        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb__content__wraper aos-init aos-animate" data-aos="fade-up">
                        <div class="breadcrumb__title">
                            <h2 class="heading">Checkout</h2>
                        </div>
                        <div class="breadcrumb__inner">
                            <ul>
                                <li><a href="{{route('home')}}">Home</a></li>
                                <li>Checkout</li>
                            </ul>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <div class="shape__icon__2">
            <img loading="lazy" class=" shape__icon__img shape__icon__img__1"
                 src="{{asset('frontend')}}/img/herobanner/herobanner__1.png" alt="photo">
            <img loading="lazy" class=" shape__icon__img shape__icon__img__2"
                 src="{{asset('frontend')}}/img/herobanner/herobanner__2.png" alt="photo">
            <img loading="lazy" class=" shape__icon__img shape__icon__img__3"
                 src="{{asset('frontend')}}/img/herobanner/herobanner__3.png" alt="photo">
            <img loading="lazy" class=" shape__icon__img shape__icon__img__4"
                 src="{{asset('frontend')}}/img/herobanner/herobanner__5.png" alt="photo">
        </div>

    </div>
    <!-- breadcrumbarea__section__End -->
    <form action="{{route('order.submit')}}" method="post">
        @csrf
    <div class="checkoutarea sp_bottom_100 sp_top_100">
        <div class="container">
            <div class="row">
               
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="checkoutarea__billing">
                        <div class="checkoutarea__billing__heading">
                            <h2>Billing Details</h2>
                        </div>
                        <div class="checkoutarea__billing__form">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="checkoutarea__inputbox">
                                            <label for="first__name">Name *</label>
                                            <input type="text" id="first__name" name="name"
                                                   value="{{auth()->user()->name ?? ''}}" class="info"
                                                   placeholder="First Name">
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="checkoutarea__inputbox">
                                            <label for="phone__number">Phone Number *</label>
                                            <input type="text" id="phone__number" name="phone" class="info"
                                                   value="{{auth()->user()->phone ?? ''}}" placeholder="Phone Number"
                                                   readonly>
                                        </div>
                                    </div>


                                    <div class="col-xl-12">
                                        <div class="checkoutarea__inputbox">
                                            <label for="email__address">Email Address*</label>
                                            <input type="text" id="email__address" name="email" class="info"
                                                   value="{{auth()->user()->email ?? ''}}" placeholder="Your email">
                                        </div>
                                    </div>


                                    <div class="col-xl-12">
                                        <div class="checkoutarea__inputbox">
                                            <label for="address__info">Address </label>
                                            <input type="text" id="address__info" name="address" class="info"
                                                   value="{{auth()->user()->address ?? ''}}" placeholder="Address">
                                        </div>
                                    </div>


                                </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12 col-12">
                    <div class="checkoutarea__payment__wraper">
                       
                            <div class="checkoutarea__total">
                                <h3>Your order</h3>

                                <div class="checkoutarea__table__wraper">
                                    <table class="checkoutarea__table">
                                        <thead>
                                        <tr class="checkoutarea__item">
                                            <td class="checkoutarea__ctg__type fw-bold"> Course Title</td>
                                            <td class="checkoutarea__cgt__des fw-bold"> Price</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="checkoutarea__item prd-name">
                                            <td class="checkoutarea__ctg__type"> {{$course->title}} <span></span></td>
                                            <td class="checkoutarea__cgt__des"> {{$basicInfo->currency_symbol}} {{$course->sale_price}}</td>
                                        </tr>
                                        <tr class="checkoutarea__item">
                                            <td class="checkoutarea__ctg__type"> Subtotal</td>
                                            <td class="checkoutarea__cgt__des">{{$basicInfo->currency_symbol}} {{$course->sale_price}}</td>
                                        </tr>

                                        <tr class="checkoutarea__item">
                                            <td class="checkoutarea__itemcrt-total"> Total</td>
                                            <td class="checkoutarea__cgt__des prc-total">{{$basicInfo->currency_symbol}} {{$course->sale_price}} </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="checkoutarea__payment clearfix">
                                <div class="checkoutarea__payment__toggle">
                                    <div class="checkoutarea__payment__total">
                                        <div class="checkoutarea__payment__type">
                                            <input type="radio" id="pay-toggle01" name="payment_method" checked>
                                            <label for="pay-toggle01">Bkash</label>
                                        </div>

                                    </div>
                                    <input type="hidden" name="course_id" value="{{$course->id}}">
                                    
                                    <div class="checkoutarea__payment__input__box">
                                        <button type="submit" class="default__button w-100">Place order</button>
                                    </div>
                                </div>

                            </div>
                    </div>
                </div>
               
               
            </div>
        </div>
    </div>

    </form>

@endsection