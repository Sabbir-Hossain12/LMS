@extends('Frontend.layouts.master')

@push('css')

    <style>
        .d-flex input.form-control,
        .d-flex button.btn {
            height: 50px;
        }

        .qty-input {
            display: flex;
            /*align-items: center;*/
            width: 120px; /* Adjust as needed */
            border: 1px solid #ccc;
            /*border-radius: 5px;*/
            overflow: hidden;
        }

        .qty-input input {
            width: 50px;
            text-align: center;
            border: none;
            outline: none;
        }

        .qty-btn {
            flex: 1;
            padding: 5px 10px;
            background-color: #f0f0f0;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .qty-btn:hover {
            background-color: #ddd;
        }

        input[type=number]::-webkit-outer-spin-button,
        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield; /* hides arrows in Firefox */
        }
    </style>
@endpush

@section('content')
    <!-- breadcrumbarea__section__start -->


    @php
        $course_price = $course->sale_price;
        $discount = 0;
        $delivery_charge = 0;   // default
    
        // ============================
        //  APPLY COUPON (IF VALID)
        // ============================
        if (session()->has('coupon')) {
            $coupon = session('coupon');
    
            // Apply coupon only if coupon belongs to this course
            if ($coupon['course_id'] == $course->id) {
    
                if ($coupon['type'] == 'Percentage') {
                    $discount = ($course->sale_price * $coupon['discount']) / 100;
                } else {
                    $discount = $coupon['discount'];
                }
    
                $course_price = $course->sale_price - $discount;
            }
        }
    
        // ============================
        //  APPLY DELIVERY CHARGE (ONLY FOR BOOK)
        // ============================
        if ($course->product_type == 'book') {
            // Get old selected charge OR default value (50)
            $delivery_charge = old('delivery_charge', 50);
    
            $course_price = $course_price + $delivery_charge;
        }
    @endphp
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
    <form action="{{route('order.submit')}}" method="post" id="purchese">
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
                                            <label for="first__name">Full Name *</label>
                                            <input type="text" id="first__name" name="name"
                                                   value="{{auth()->user()->name ?? ''}}" class="info"
                                                   placeholder="First Name" required>
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="checkoutarea__inputbox">
                                            <label for="phone__number">Phone Number *</label>
                                            <input type="text" id="phone__number" name="phone" class="info" maxlength="11" pattern="[0-9]{11}"
                                                   title="Phone number must be exactly 11 digits"
                                                   value="{{ auth()->check() && auth()->user()->hasRole('student') ? auth()->user()->phone : '' }}" placeholder="Phone Number"
                                                   @if($course->product_type == 'course' || auth()->check()) readonly @endif required>


                                        </div>
                                    </div>


                                    <div class="col-xl-12">
                                        <div class="checkoutarea__inputbox">
                                            <label for="email__address">Email Address *</label>
                                            <input type="text" id="email__address" name="email" class="info"
                                                   value="{{ auth()->check() && auth()->user()->hasRole('student') ? auth()->user()->email : '' }}" placeholder="Your email" required>
                                        </div>
                                    </div>

                                    @if($course->product_type == 'book')
                                        <div class="col-xl-12">
                                            <div class="checkoutarea__inputbox">
                                                <label for="district">District *</label>
                                                <input type="text" id="district" name="district" class="info"
                                                       value="{{auth()->user()->district ?? ''}}" placeholder="District">
                                            </div>
                                        </div>

                                        <div class="col-xl-12">
                                            <div class="checkoutarea__inputbox">
                                                <label for="thana">Thana/Upazila *</label>
                                                <input type="text" id="thana" name="thana" class="info"
                                                       value="{{auth()->user()->thana ?? ''}}" placeholder="Enter Thana/Upazila">
                                            </div>
                                        </div>

                                        <div class="col-xl-12">
                                            <div class="checkoutarea__inputbox">
                                                <label for="area">Area/Locality * </label>
                                                <input type="text" id="area" name="area" class="info"
                                                       value="{{ auth()->user()->area ?? '' }}" placeholder="Enter Area/Locality" required>
                                            </div>
                                        </div>

                                        <div class="col-xl-12">
                                            <div class="checkoutarea__inputbox">
                                                <label for="holding_number">Holding Number * </label>
                                                <input type="text" id="holding_number" name="holding_number" class="info"
                                                       value="{{auth()->user()->holding_number ?? ''}}" placeholder="Enter Holding Number" required>
                                            </div>
                                        </div>
                                    @endif


                                    <div class="col-xl-12">
                                        <div class="checkoutarea__inputbox">
                                            <label for="address__info">Address </label>
                                            <input type="text" id="address__info" name="address" class="info"
                                                   value="{{auth()->user()->address ?? ''}}" placeholder="Address">
                                        </div>
                                    </div>

                                    @if($course->product_type == 'book')
                                        <div class="col-xl-12">
                                            <div class="">
                                                <label>Delivery Area *</label>

                                                <div class="d-flex gap-3 mt-2 flex-column">

                                                    <label class="d-flex align-items-center gap-2">
                                                        <input type="radio" name="delivery_charge" value="50" checked>
                                                        Inside Dhaka (50 TK)
                                                    </label>

                                                    <label class="d-flex align-items-center gap-2">
                                                        <input type="radio" name="delivery_charge" value="90">
                                                        Outside Dhaka (90 TK)
                                                    </label>

                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-xl-12 mt-3">
                                        <div class="checkoutarea__inputbox w-50">
                                            <label for="coupon_code">Coupon Code (if any)</label>
                                            <div class="d-flex">
                                                <input type="text" id="coupon_code" name="coupon" class="info" placeholder="Coupon"/>
                                                <button type="button" id="apply_coupon" class="btn btn-sm btn-primary ml-2 align-self-stretch">Apply</button>
                                            </div>
                                            <div id="coupon_message"></div>
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
                                            <td class="checkoutarea__cgt__des"> {{$basicInfo->currency_symbol}} <span id="salePriceText">{{$course->sale_price}}</span></td>
                                        </tr>

                                        @if($course->product_type == 'book')
                                            <tr class="checkoutarea__item">
                                                <td class="checkoutarea__ctg__type"> Quantity</td>
                                                <td class="checkoutarea__cgt__des">
                                                    <div class="qty-input">
                                                        <button type="button" class="qty-btn minus">-</button>
                                                        <input type="number" min="1" value="1" name="qty" />
                                                        <button type="button" class="qty-btn plus">+</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif

                                        <tr class="checkoutarea__item">
                                            <td class="checkoutarea__ctg__type"> Subtotal</td>
                                            <td class="checkoutarea__cgt__des">{{$basicInfo->currency_symbol}} <span id="subtotalPriceText">{{$course->sale_price}}</span> </td>
                                        </tr>
                                        @if($course->product_type == 'book')
                                            <tr class="checkoutarea__item">
                                                <td class="checkoutarea__ctg__type"> Delivery Charge</td>
                                                <td class="checkoutarea__cgt__des">{{$basicInfo->currency_symbol}} <span id="delivery_amount">50</span> </td>
                                            </tr>
                                        @endif

                                        <tr class="checkoutarea__item">
                                            <td class="checkoutarea__ctg__type"> Discount</td>
                                            <td class="checkoutarea__cgt__des"> - <span id="discountText">{{ $discount }}</span> </td>
                                        </tr>

                                        <tr class="checkoutarea__item">
                                            <td class="checkoutarea__itemcrt-total"> Total</td>
                                            <td class="checkoutarea__cgt__des prc-total">{{$basicInfo->currency_symbol}} <span id="totalPriceText">{{ $course_price }}</span> </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>


                            <div class="checkoutarea__payment clearfix">
                                <div class="checkoutarea__payment__toggle">
                                    <div class="checkoutarea__payment__total">
                                        @if($course->sale_price)
                                            <div class="checkoutarea__payment__type">
                                                <input type="radio" id="pay-toggle01" name="payment_method" value="bkash" checked>
                                                <label for="pay-toggle01">
                                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSHX7h0I6s8TJsqxI7pLDR8yGLu450Ph71rpg&s"  width="120" alt="bkash" />
                                                </label>
                                            </div>

                                            @if($course->product_type == 'book')
                                                <div class="checkoutarea__payment__type">
                                                    <input type="radio" id="pay-toggle02" name="payment_method" value="cod">
                                                    <label for="pay-toggle02">
                                                        Cash On Delivery
                                                    </label>
                                                </div>
                                            @endif

                                        @else
                                            <div class="checkoutarea__payment__type">
                                                <input type="radio" id="pay-toggle01" name="payment_method" value="free" checked>
                                                <label for="pay-toggle01">Free</label>
                                            </div>
                                        @endif


                                    </div>
                                    <input type="hidden" name="course_id" id="course_id" value="{{ $course->id }}">

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

@push('js')

    <script>

        var gtmprice = {{ $course->sale_price ?? 0 }};
        var gtmqty=1;
        var gtmid={{ $course->id }};
        var gtmsku='SMM{{ $course->id }}';
        var gtmproductname='{{ $course->title}}';
        var gtmdiscount={{ $course->discount}};

        window.dataLayer = window.dataLayer || [];
        dataLayer.push({
            ecommerce: null
        });

        dataLayer.push({
            event: "begin_checkout",
            ecommerce: {
                currency: "BDT",
                value: gtmprice,
                items: [{
                    item_id: gtmid,
                    item_name: gtmproductname,
                    index: 0,
                    price: gtmprice,
                    discount: gtmdiscount,
                    item_brand: 'schoolmathematics.com.bd',
                    currency: "BDT",
                    quantity: 1,
                }]

            }
        });

        document.getElementById('purchese').addEventListener('submit', function(event) {
            window.dataLayer = window.dataLayer || [];
            dataLayer.push({
                ecommerce: null
            });
            dataLayer.push({
                event: "purchese",
                ecommerce: {
                    currency: "BDT",
                    value: gtmprice,
                    shipping: "0",
                    tax:0,
                    coupon:$('#coupon_code').val(),
                    affiliation:"",
                    external_id :"<?php echo App\Models\Order::latest()->first()->id+1 ?>",
                    transaction_id:"<?php echo 'TRX45324'.App\Models\Order::latest()->first()->id+1 ?>",
                    items: [
                        {
                            item_id: gtmid,
                            item_name: gtmproductname,
                            index: 0,
                            price: gtmprice,
                            discount: gtmdiscount,
                            item_brand: 'schoolmathematics.com.bd',
                            currency: "BDT",
                            quantity: 1,
                        }],
                    more:[
                        {
                            Customer_Name:$('#first__name').val(),
                            Customer_Address:$('#address__info').val(),
                            Customer_Phone_Number:$('#phone__number').val(),
                            Customer_Email:$('#email__address').val(),
                            Customer_Country:'Bangladesh',
                            // Customer_Visitor_ID :{{auth()->user()->id ?? null}}, 
                            payment_method:"Cash On Delivery",
                        }
                    ]
                }
            });
        });


        let price = {{$course->sale_price}};
        let basePrice = parseFloat(price);
        let discount = parseFloat("{{ $discount }}");
        let deliveryCharge = parseFloat($("input[name='delivery_charge']:checked").val() || 0);

        $('#apply_coupon').on('click', function () {


            const code = $('#coupon_code').val();
            let course_id = $('#course_id').val();

            // console.log(course_id)
            if(code.length == '0')
            {
                $('#coupon_message').text('Code can not be empty !').css('color', 'red');

                return;
            }

            $.ajax({
                url: '{{ route('apply-coupon') }}',
                method: 'POST',
                data: {
                    code: code,
                    course_id :course_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.success) {

                        if(response.type == 'Percentage')
                        {
                            $('#coupon_message').text('Coupon applied! Discount: ' + response.discount + '%').css('color', 'green');

                            $('#discountText').text(response.discount + '%');

                            $('#totalPriceText').text(price - (price * response.discount)/100 + deliveryCharge )
                        }
                        else
                        {
                            $('#coupon_message').text('Coupon applied! Discount: ' + response.discount + 'TK').css('color', 'green');
                            $('#discountText').text(response.discount);

                            $('#totalPriceText').text(price - response.discount + deliveryCharge)
                        }



                        location.reload();

                    } else {
                        $('#coupon_message').text(response.message).css('color', 'red');
                    }
                },
                error: function () {
                    $('#coupon_message').text('Something went wrong.').css('color', 'red');
                }
            });
        });

        // delivery charge
        $(document).ready(function () {




            // Initial total load
            updateTotal();

            // On change event
            $("input[name='delivery_charge']").on('change', function () {

                deliveryCharge = parseFloat($(this).val());
                updateTotal();



            });

            function updateTotal() {
                let qty = parseInt($("input[name='qty']").val()) || 1;

                let subtotal = basePrice * qty;

                let total = (subtotal + deliveryCharge)- discount;

                $('#subtotalPriceText').text(subtotal.toFixed(2));
                $("#delivery_amount").text(deliveryCharge);
                $("#totalPriceText").text(total);
                $('#discountText').text(discount);

            }

            // Quantity buttons
            $('.qty-btn.plus').on('click', function() {
                console.log('clicked');
                let input = $(this).siblings("input[name='qty']");
                input.val(parseInt(input.val() || 1) + 1);
                updateTotal();
            });

            $('.qty-btn.minus').on('click', function() {
                let input = $(this).siblings("input[name='qty']");
                let val = parseInt(input.val() || 1);
                if(val > 1) input.val(val - 1);
                updateTotal();
            });

            // Manual input change
            $("input[name='qty']").on('change', function() {
                if ($(this).val() < 1) $(this).val(1);
                updateTotal();
            });

        });
    </script>
@endpush
