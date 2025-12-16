@extends('Frontend.layouts.master')

@section('content')

<style>
    #success-img img
    {
        width:15%!important;
    }
    
    @media (max-width: 576px) {
    #success-img img {
        
        width: 30% !important;
    }
}
</style>
    <!-- error__section__start -->
    <div class="errorarea sp_top_100 sp_bottom_100">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-10 col-sm-12 col-12 m-auto">
                    <div class="errorarea__inner" data-aos="fade-up">
                        <div class="mb-3" id="success-img">
                            <img loading="lazy"  src="https://www.freeiconspng.com/thumbs/success-icon/success-icon-19.png" alt="error">
                        </div>
                        <div class="error__text">
                            <h3 class="mb-1">Order Successful !</h3>
                            <p>অর্ডারের জন্য আপনাকে অসংখ্য ধন্যবাদ। আশা করছি খুব শীঘ্রই আপনি আপনার পার্সেলটি পেয়ে যাবেন।
                                যেকোনো প্রয়োজনে আমাদের ফেসবুক পেজে অথবা নিচের নম্বরে যোগাযোগ করতে পারেন—
                                📞 01568792170</p>
                        </div>
                        <div class="error__button">
                            <a class="default__button" href="{{url('/')}}">Back To Home
                                <i class="icofont-simple-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- error__section__end -->

@endsection