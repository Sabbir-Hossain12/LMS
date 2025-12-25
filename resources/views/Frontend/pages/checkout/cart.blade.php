@extends('Frontend.layouts.master')

@push('css')

@endpush

@section('content')
    <div class="breadcrumbarea">

        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb__content__wraper aos-init aos-animate" data-aos="fade-up">
                        <div class="breadcrumb__title">
                            <h2 class="heading">Cart</h2>
                        </div>
                        <div class="breadcrumb__inner">
                            <ul>
                                <li><a href="index.html">Home</a></li>
                                <li>Cart</li>
                            </ul>
                        </div>
                    </div>



                </div>
            </div>
        </div>

    </div>
<!-- cart__section__start -->
<div class="cartarea sp_bottom_100 sp_top_100">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <form action="#">
                    <div class="cartarea__table__content table-responsive">
                        <table>
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($cartItems as $cart)
                            <tr>
                                <td class="cartarea__product__thumbnail">
                                    <a href="{{ route('course-details', $cart->course->slug) }}">
                                        <img loading="lazy"  src="{{ asset($cart->course->thumbnail_img) }}" alt="product-1">
                                    </a>
                                </td>
                                <td class="cartarea__product__name"><a href="{{ route('course-details', $cart->course->slug) }}">{{ $cart->course->title ?? '' }}</a></td>
                                <td class="cartarea__product__price__cart"><span class="amount">৳{{$cart->price}}</span></td>
                                <td class="cartarea__product__quantity">
                                    <div class="cartarea__plus__minus">
{{--                                        <div class="dec qtybutton">- </div>--}}
                                        <input class="cartarea__plus__minus__box" type="text" value="{{ $cart->quantity ?? 1 }}"
                                               readonly="">
{{--                                        <div class="inc qtybutton">+</div>--}}
                                    </div>

                                </td>
                                <td class="cartarea__product__subtotal">৳{{$cart->total}}</td>
                                <td class="cartarea__product__remove">
                                    
                                    <a href="{{ route('cart.remove', $cart->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><title>Trash</title><path d="M112 112l20 320c.95 18.49 14.4 32 32 32h184c17.67 0 30.87-13.51 32-32l20-320" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M80 112h352"/><path d="M192 112V72h0a23.93 23.93 0 0124-24h80a23.93 23.93 0 0124 24h0v40M256 176v224M184 176l8 224M328 176l-8 224" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg></a>

                                   
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="cartarea__shiping__update__wrapper">
                    <div class="cartarea__shiping__update">
                        <a href="{{ route('checkout.books') }}">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    
    </div>
</div>
<!-- cart__section__end-->
    
@endsection

@push('js')

@endpush