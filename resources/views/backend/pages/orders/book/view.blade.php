@extends('backend.layout.master')

@push('backendCss')

    <link href="{{asset('backend')}}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css"
          rel="stylesheet" type="text/css">
    <link href="{{asset('backend')}}/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css"
          rel="stylesheet" type="text/css">

    <style>
        @media print {
            .main-content {
                padding: 50px;
            }
        }
    </style>
@endpush

@section ('contents')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Order Information</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Invoices</a></li>
                        <li class="breadcrumb-item active">Invoice Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="printBody">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-6">
                            <div>
                                <div>
                                    <h5 class="font-size-15 mb-2" >Company Details</h5>
                                    @isset($basicInfo->dark_logo)
                                        <img src="{{ asset($basicInfo->dark_logo) }}" class="img-fluid" width="140px" alt="logo" />
                                    @endisset
                                    <p class="mt-2 mb-1">{{ $basicInfo->site_name ?? '' }}</p>
                                    <p class="mb-1">{{ $basicInfo->mail ?? '' }}</p>
                                    <p class="mb-1">{{ $basicInfo->phone_1 ?? '' }}</p>
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-6">


                            <div>
                                <h5 class="font-size-14 mb-2">Customer Info</h5>
                                <p class="mb-1"><span class="text-primary">Full Name: </span>{{ $order->user->name ?? '' }}</p>
                                <p class="mb-1"><span class="text-primary">Phone: </span>{{ $order->user->phone }}</p>
                                <p class="mb-1"><span class="text-primary">Email: </span>{{ $order->user->email ?? '' }}</p>
                                <p class="mb-1"><span class="text-primary">District: </span> {{ $order->user->district ?? '' }}</p>
                                <p class="mb-1"><span class="text-primary">Thana/Upazila: </span>{{ $order->user->thana ?? '' }}</p>
                                <p class="mb-1"><span class="text-primary">Area: </span>{{ $order->user->area ?? '' }}</p>
                                <p class="mb-1"><span class="text-primary">Holding Number: </span>{{ $order->user->holding_number ?? '' }}</p>
                                <p class="mb-1"><span class="text-primary">Address: </span>{{ $order->user->address ?? '' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="py-2 mt-3">
                        <h5 class="font-size-15">Order History</h5>
                    </div>
                    <div class="p-4 border rounded">
                        <div class="table-responsive">
                            <table class="table table-nowrap align-middle mb-0">
                                <thead>
                                <tr>
                                    <th style="width: 70px;">No.</th>
                                    <th>Book Title</th>
                                    <th class="text-end" style="width: 120px;">Book Price</th>
                                    <th class="text-end" style="width: 120px;">Quantity</th>
                                    <th class="text-end" style="width: 120px;">Delivery Charge</th>
                                     <th class="text-end" style="width: 120px;">Coupon (if any)</th>
                                    <th class="text-end" style="width: 120px;">Total Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">{{ 1 }}</th>
                                    <td>
                                        <h5 class="font-size-15 mb-1">{{ $order->orderCourse->course->title ?? ''}}</h5>
                                    </td>
                                    <td class="text-end">{{ $order->orderCourse->course->sale_price }}</td>
                                    <td class="text-end">{{ $order->orderCourse->qty ?? '1' }}</td>
                                     <td class="text-end">{{ $order->delivery_charge ?? 0 }}</td>
                                     <td class="text-end">{{ $order->discount ?? 0 }}</td>
                                    
                                    <td class="text-end">{{ $order->total_amount }}</td>
                                </tr>

{{--                                <tr>--}}
{{--                                    <th scope="row" colspan="3" class="border-0 text-end">Marks Obtained</th>--}}
{{--                                    <td class="border-0 text-end"><h4--}}
{{--                                            class="m-0">{{$grades->sum('marks_obtained') ?? '0'}}</h4></td>--}}
{{--                                </tr>--}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-print-none mt-3">
                        <div class="float-end">
                            <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><i
                                    class="fa fa-print"></i> Print Report</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('backendJs')

    {{--  CkEditor CDN  --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('backend')}}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('backend')}}/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

@endpush
