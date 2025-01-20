@extends('backend.layout.master')

@push('backendCss')
    {{--    <meta name="csrf_token" content="{{ csrf_token() }}" />--}}

    <link href="{{asset('backend')}}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css"
          rel="stylesheet" type="text/css">
    <link href="{{asset('backend')}}/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css"
          rel="stylesheet" type="text/css">

@endpush

@section('contents')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Orders</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                        <li class="breadcrumb-item active">Orders</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    {{-- Table Starts--}}

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">

                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Order History</h4>
                        {{--                       @can('Create Admin')--}}
                        {{--                       @if(Auth::guard('admin')->user()->can('Create Admin'))--}}
{{--                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createAdminModal">--}}
{{--                            Create Admin--}}
{{--                        </button>--}}
                        {{--                        @endcan--}}
                        {{--                        @endif--}}
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0  nowrap w-100 dataTable no-footer dtr-inline" id="adminTable">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Student Name</th>
                                <th>Course Name</th>
                                <th>Payment Status</th>
                                <th>Payment Method</th>
                                <th>Order Date</th>
                                
{{--                                <th>Status</th>--}}
{{--                                <th>Actions</th>--}}

                            </tr>
                            </thead>
                            <tbody>

                            @forelse($orders as $key=> $order)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$order->user->name}}</td>
                                    <td>{{$order->orderCourse->course->title}}</td>
                                    <td>
                                        @if($order->status== 'success')
                                            <span class="badge bg-primary"> {{$order->status}}</span>
                                        @else
                                            <span class="badge bg-danger"> {{$order->status}}</span>
                                        @endif
                                        
                                    
                                    </td>
                                    <td>
                                        <span class="badge bg-success">{{$order->payment_method}}</span>
                                    </td>
                                    <td>{{$order->created_at->format('d M Y')}}</td>
                                  
{{--                                    <td>--}}
{{--                                        @if($order->status == 1)--}}
{{--                                            <span class="badge bg-success">Active</span>--}}
{{--                                        @else--}}
{{--                                            <span class="badge bg-danger">Inactive</span>--}}
{{--                                        @endif--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <div class="d-flex gap-3">--}}
{{--                                            <a href="" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>--}}
{{--                                            <form method="post" id="delete-form-{{$order->id}}" action="">--}}
{{--                                                @csrf--}}
{{--                                                @method('delete')--}}
{{--                                                <button type="submit" class="btn btn-sm btn-danger"><i--}}
{{--                                                            class="fas fa-trash"></i></button>--}}
{{--                                            </form>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
                                </tr>
                            @empty
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>

    {{--    Table Ends--}}

    
@endsection

@push('backendJs')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('backend')}}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('backend')}}/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

    <script>

        $(document).ready(function () {

            var token = $("input[name='_token']").val();

            //Show Data through Datatable 
            let adminTable = $('#adminTable').DataTable();


         
        });
    </script>

@endpush