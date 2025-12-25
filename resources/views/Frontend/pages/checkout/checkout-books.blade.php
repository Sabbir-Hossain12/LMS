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
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li>Checkout</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('order.submit') }}" method="post" id="purchase">
        @csrf
        <div class="checkoutarea sp_bottom_100 sp_top_100">
            <div class="container">
                <div class="row">

                    {{-- Billing Details --}}
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
                                                   value="{{ auth()->user()->name ?? '' }}" class="info"
                                                   placeholder="Full Name" required>
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="checkoutarea__inputbox">
                                            <label for="phone__number">Phone Number *</label>
                                            <input type="text" id="phone__number" name="phone" class="info"
                                                   value="{{ auth()->user()->phone ?? '' }}" placeholder="Phone Number" required>
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="checkoutarea__inputbox">
                                            <label for="email__address">Email Address *</label>
                                            <input type="email" id="email__address" name="email" class="info"
                                                   value="{{ auth()->user()->email ?? '' }}" placeholder="Your email" required>
                                        </div>
                                    </div>

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
                                   


                                    <div class="col-xl-12">
                                        <div class="checkoutarea__inputbox">
                                            <label for="address__info">Address </label>
                                            <input type="text" id="address__info" name="address" class="info"
                                                   value="{{auth()->user()->address ?? ''}}" placeholder="Address">
                                        </div>
                                    </div>

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

                    {{-- Order Summary --}}
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="checkoutarea__payment__wraper">
                            <div class="checkoutarea__total">
                                <h3>Your order</h3>

                                <div class="checkoutarea__table__wraper">
                                    <table class="checkoutarea__table">
                                        <thead>
                                        <tr class="checkoutarea__item">
                                            <td class="fw-bold">Course Title</td>
                                            <td class="fw-bold">Qty</td>
                                            <td class="fw-bold">Total</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $grandTotal = 0; @endphp
                                        @foreach($cartItems as $item)
                                            <tr class="checkoutarea__item">
                                                <td>{{ $item->course->title }}</td>
                                                <td class="checkoutarea__cgt__des">
                                                    <div class="qty-input">
                                                        <button type="button" class="qty-btn minus">-</button>
                                                        <input type="number" min="1" value="1" name="qty" />
                                                        <button type="button" class="qty-btn plus">+</button>
                                                    </div>
                                                </td>
                                                <td>{{ $basicInfo->currency_symbol }} {{ $item->total }}</td>
                                            </tr>
                                            @php $grandTotal += $item->total; @endphp
                                        @endforeach

                                        <tr class="checkoutarea__item">
                                            <td colspan="2" class="fw-bold">Delivery Charge</td>
                                            <td class="fw-bold">{{ $basicInfo->currency_symbol }} 50</td>
                                        </tr>
                                        <tr class="checkoutarea__item">
                                            

                                            <td colspan="2" class="fw-bold">Grand Total</td>
                                            <td class="fw-bold">{{ $basicInfo->currency_symbol }} {{ $grandTotal }}</td>
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- Payment Options --}}
                            <div class="checkoutarea__payment clearfix">
                                <div class="checkoutarea__payment__toggle">
                                    <div class="checkoutarea__payment__type">
                                        <input type="radio" id="pay-bkash" name="payment_method" value="bkash" checked>
                                        <label for="pay-bkash">
                                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSHX7h0I6s8TJsqxI7pLDR8yGLu450Ph71rpg&s" width="120" alt="bkash" />
                                        </label>
                                    </div>
                                    <div class="checkoutarea__payment__type">
                                        <input type="radio" id="pay-cod" name="payment_method" value="cod">
                                        <label for="pay-cod">Cash On Delivery</label>
                                    </div>
                                </div>

                                <div class="checkoutarea__payment__input__box">
                                    <button type="submit" class="default__button w-100">Place order</button>
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

        let price = 100;
        let basePrice = parseFloat(price);
        let discount = 100;
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
