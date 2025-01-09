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
            <img loading="lazy" class=" shape__icon__img shape__icon__img__1" src="{{asset('frontend')}}/img/herobanner/herobanner__1.png" alt="photo">
            <img loading="lazy" class=" shape__icon__img shape__icon__img__2" src="{{asset('frontend')}}/img/herobanner/herobanner__2.png" alt="photo">
            <img loading="lazy" class=" shape__icon__img shape__icon__img__3" src="{{asset('frontend')}}/img/herobanner/herobanner__3.png" alt="photo">
            <img loading="lazy" class=" shape__icon__img shape__icon__img__4" src="{{asset('frontend')}}/img/herobanner/herobanner__5.png" alt="photo">
        </div>

    </div>
    <!-- breadcrumbarea__section__End -->
    
<div class="checkoutarea sp_bottom_100 sp_top_100">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12">
                <div class="checkoutarea__billing">
                    <div class="checkoutarea__billing__heading">
                        <h2>Billing Details</h2>
                    </div>
                    <div class="checkoutarea__billing__form">
                        <form action="#">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="checkoutarea__inputbox">
                                        <label for="first__name">First Name *</label>
                                        <input type="text" id="first__name" name="namm" class="info" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="checkoutarea__inputbox">
                                        <label for="last__name">Last Name*</label>
                                        <input type="text" id="last__name" name="namm" class="info" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="checkoutarea__inputbox">
                                        <label for="company__name">Company Name</label>
                                        <input type="text" id="company__name" name="namm" class="info" placeholder="Company Name">
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="checkoutarea__inputbox">
                                        <label for="email__address">Email Address*</label>
                                        <input type="text" id="email__address" name="namm" class="info" placeholder="Your email">
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="checkoutarea__inputbox">
                                        <label for="phone__number">Phone Number*</label>
                                        <input type="text" id="phone__number" name="namm" class="info" placeholder="Phone Number">
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="checkoutarea__inputbox">
                                        <label for="address__info">Address *</label>
                                        <input type="text" id="address__info" name="namm" class="info" placeholder="Address">
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="checkoutarea__inputbox">
                                        <label for="town__city">Town/City *</label>
                                        <input type="text" id="town__city" name="namm" class="info" placeholder="Town/City">
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="checkoutarea__inputbox">
                                        <label for="post__code">Post Code/Zip Code*</label>
                                        <input type="text" id="post__code" name="namm" class="info" placeholder="Post Code/Zip Code">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="checkoutarea__inputbox">
                                    <label for="order__note">Order Notes</label>
                                    <input type="text" id="order__note" name="namm" class="info" placeholder="Order Notes">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-12">
                <div class="checkoutarea__payment__wraper">
                    <div class="checkoutarea__total">
                        <h3>Your order</h3>
                        <form action="#" method="post">
                            <div class="checkoutarea__table__wraper">
                                <table class="checkoutarea__table">
                                    <thead>
                                    <tr class="checkoutarea__item">
                                        <td class="checkoutarea__ctg__type"> Product</td>
                                        <td class="checkoutarea__cgt__des"> Total</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="checkoutarea__item prd-name">
                                        <td class="checkoutarea__ctg__type"> Product Title × <span>1</span></td>
                                        <td class="checkoutarea__cgt__des"> $1,026.00</td>
                                    </tr>
                                    <tr class="checkoutarea__item">
                                        <td class="checkoutarea__ctg__type"> Subtotal</td>
                                        <td class="checkoutarea__cgt__des">$1,026.00</td>
                                    </tr>
                                    <tr class="checkoutarea__item">
                                        <td class="checkoutarea__item">Shipping</td>
                                        <td class="checkoutarea__cgt__des ship-opt">
                                            <div class="checkoutarea__shipp">
                                                <input type="radio" id="pay-toggle" name="ship">
                                                <label for="pay-toggle">Flat Rate: <span>$03</span></label>
                                            </div>
                                            <div class="checkoutarea__shipp">
                                                <input type="radio" id="pay-toggle2" name="ship">
                                                <label for="pay-toggle2">Free Shipping</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="checkoutarea__item">
                                        <td class="checkoutarea__itemcrt-total"> Total</td>
                                        <td class="checkoutarea__cgt__des prc-total"> $ 1.029.00 </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                    <div class="checkoutarea__payment clearfix">
                        <div class="checkoutarea__payment__toggle">
                            <form action="#">
                                <div class="checkoutarea__payment__total">
                                    <div class="checkoutarea__payment__type">
                                        <input type="radio" id="pay-toggle01" name="pay" checked>
                                        <label for="pay-toggle01">Bkash</label>
                                    </div>
                                    
                                </div>
                                <div class="checkoutarea__payment__input__box">
                                    <a class="default__button" href="#">Place order</a>

                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
    
@endsection