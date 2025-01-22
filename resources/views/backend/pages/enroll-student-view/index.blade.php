@extends('backend.layout.master')

@push('backendCss')

    <link href="{{asset('backend')}}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css"
          rel="stylesheet" type="text/css">
    <link href="{{asset('backend')}}/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css"
          rel="stylesheet" type="text/css">
@endpush

@section ('contents')


    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Student History</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Invoices</a></li>
                        <li class="breadcrumb-item active">Invoice Detail</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div>
                               
                                <h5 class="font-size-14 mb-2">Richard Saul</h5>
                                <p class="mb-1">1208 Sherwood Circle
                                    Lafayette, LA 70506</p>
                                <p class="mb-1">RichardSaul@rhyta.com</p>
                                <p>337-256-9134</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div>
                                <div>
                                    <h5 class="font-size-15">Order Date:</h5>
                                    <p>February 16, 2020</p>
                                </div>

                                <div class="mt-4">
                                    <h5 class="font-size-15">Payment Method:</h5>
                                    <p class="mb-1">Visa ending **** 4242</p>
                                    <p>richards@email.com</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="py-2 mt-3">
                        <h5 class="font-size-15">Exam History</h5>
                    </div>
                    <div class="p-4 border rounded">
                        <div class="table-responsive">
                            <table class="table table-nowrap align-middle mb-0">
                                <thead>
                                <tr>
                                    <th style="width: 70px;">No.</th>
                                    <th>Item</th>
                                    <th class="text-end" style="width: 120px;">Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">01</th>
                                    <td>
                                        <h5 class="font-size-15 mb-1">Minia</h5>
                                        <p class="font-size-13 text-muted mb-0">Bootstrap 5 Admin Dashboard </p>
                                    </td>
                                    <td class="text-end">$499.00</td>
                                </tr>

                                <tr>
                                    <th scope="row">02</th>
                                    <td>
                                        <h5 class="font-size-15 mb-1">Skote</h5>
                                        <p class="font-size-13 text-muted mb-0">Bootstrap 5 Admin Dashboard </p>
                                    </td>
                                    <td class="text-end">$499.00</td>
                                </tr>

                                <tr>
                                    <th scope="row" colspan="2" class="text-end">Sub Total</th>
                                    <td class="text-end">$998.00</td>
                                </tr>
                                <tr>
                                    <th scope="row" colspan="2" class="border-0 text-end">
                                        Tax</th>
                                    <td class="border-0 text-end">$12.00</td>
                                </tr>
                                <tr>
                                    <th scope="row" colspan="2" class="border-0 text-end">Total</th>
                                    <td class="border-0 text-end"><h4 class="m-0">$1010.00</h4></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-print-none mt-3">
                        <div class="float-end">
                            <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i></a>
                            <a href="#" class="btn btn-primary w-md waves-effect waves-light">Send</a>
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