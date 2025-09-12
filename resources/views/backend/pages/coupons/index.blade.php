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
                <h4 class="mb-sm-0 font-size-18">Coupons</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                        <li class="breadcrumb-item active">Coupons</li>
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
                        <h4 class="card-title">Coupons List</h4>
                        
{{--                        @if(Auth::user()->can('Create Admin'))--}}
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTestimonial">
                                Add Coupons
                            </button>
{{--                        @endif--}}
                        
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0  nowrap w-100 dataTable no-footer dtr-inline" id="testimonialTable">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Coupon Code</th>
                                <th>Coupon Type</th>
                                <th>Discount Value</th>
                                <th>Status</th>
                                <th>Actions</th>

                            </tr>
                            </thead>
                            <tbody>

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

    {{--    Add Coupons Modal--}}
    <div class="modal fade" id="addTestimonial" tabindex="-1" aria-labelledby="exampleModalLabel"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Testimonial</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form name="form" id="addTestimonialForm">
                        @csrf
                     
                        <div class="mb-3">
                            <label for="code" class="col-form-label">Coupon Code</label>
                            <input type="text" class="form-control" id="code" name="code">
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="col-form-label">Short Description</label>
                            <textarea  class="form-control" id="description" name="description"></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="discount_type" class="col-form-label">Discount Type</label>
                            <select class="form-control" id="discount_type" name="discount_type">
                                
                                <option value="Percentage">Percentage (%)</option>
                                <option value="fixed_amount">Fixed Amount</option>
                                
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="discount_value" class="col-form-label">Discount Value</label>
                            <input type="number" class="form-control" id="discount_value" name="discount_value">
                        </div>
                        
                        <div class="mb-3">
                            <label for="usage_limit" class="col-form-label">Usage Limit</label>
                            <input type="number" class="form-control" id="usage_limit" name="usage_limit">
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--    Edit Categories Modal--}}
    <div class="modal fade" id="editTestimonialFormModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form name="form2" id="editTestimonialForm">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="ecode" class="col-form-label">Coupon Code</label>
                            <input type="text" class="form-control" id="ecode" name="code">
                        </div>
                        
                        <div class="mb-3">
                            <label for="edescription" class="col-form-label">Short Description</label>
                            <textarea  class="form-control" id="edescription" name="description"></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="ediscount_type" class="col-form-label">Discount Type</label>
                            <select class="form-control" id="ediscount_type" name="discount_type">
                                
                                <option value="Percentage"> Percentage (%)</option>
                                <option value="fixed_amount">Fixed Amount</option>
                                
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="ediscount_value" class="col-form-label">Discount Value</label>
                            <input type="number" class="form-control" id="ediscount_value" name="discount_value">
                        </div>
                        
                        <div class="mb-3">
                            <label for="eusage_limit" class="col-form-label">Usage Limit</label>
                            <input type="number" class="form-control" id="eusage_limit" name="usage_limit">
                        </div>
                        
                         <div class="mb-3">
                            <label for="eused_count" class="col-form-label">Used Count</label>
                            <input type="number" class="form-control" id="eused_count" name="used_count">
                        </div>
                      
                        
                        <input id="id" type="number" hidden>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('backendJs')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('backend')}}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('backend')}}/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

    <script>

        $(document).ready(function () {


            var token = $("input[name='_token']").val();

            //Show Data through Datatable 
            let testimonialTable = $('#testimonialTable').DataTable({
                order: [
                    [0, 'asc']
                ],
                processing: true,
                serverSide: true,
                ajax: "{{route('admin.coupon.data')}}",
                // pageLength: 30,

                columns: [
                    {
                        data: 'id',


                    },
                    {
                        data: 'code',

                    },
                    {
                        data: 'discount_type'
                    },
                    
                    {
                       data:  'discount_value'
                    },
                    
                    {
                        data: 'status',
                        name: 'Status',
                        orderable: false,
                        searchable: false,
                    },

                    {
                        data: 'action',
                        name: 'Actions',
                        orderable: false,
                        searchable: false
                    },

                ]
            });


            // Create Testimonial
            $('#addTestimonialForm').submit(function (e) {
                e.preventDefault();

                let formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('admin.coupon.store') }}",
                    data: formData,
                    processData: false,  // Prevent jQuery from processing the data
                    contentType: false,  // Prevent jQuery from setting contentType
                    success: function (res) {
                        if (res.status === 'success') {
                            $('#addTestimonial').modal('hide');
                            $('#addTestimonialForm')[0].reset();
                            testimonialTable.ajax.reload()
                            swal.fire({
                                title: "Success",
                                text: "Coupon Added !",
                                icon: "success"
                            })


                        }
                    },
                    error: function (err) {
                        console.error('Error:', err);
                        swal.fire({
                            title: "Failed",
                            text: "Something Went Wrong !",
                            icon: "error"
                        })
                        // Optionally, handle error behavior like showing an error message
                    }
                });
            });

      
        
            // Edit  Data
            $(document).on('click', '.editButton', function () {
                let id = $(this).data('id');
                $('#id').val(id);
        
                $.ajax(
                    {
                        type: "GET",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ url('admin/coupons') }}/" + id + "/edit",
                        data: {
                            id: id
                        },
        
                        processData: false,  // Prevent jQuery from processing the data
                        contentType: false,  // Prevent jQuery from setting contentType
                        success: function (res) {

                          
                            $('#edescription').val(res.data.description);
                            $('#eused_count').val(res.data.used_count);
                            $('#ecode ').val(res.data.code );
                            $('#ediscount_type').val(res.data.discount_type);
                            $('#ediscount_value').val(res.data.discount_value);
                            $('#eusage_limit').val(res.data.usage_limit);
                            $('#eused_count').val(res.data.used_count);
                            
                            
                        },
                        error: function (err) {
                            console.log('failed')
                        }
                    }
                )
            })
    
        
            // Update Data
            $('#editTestimonialForm').submit(function (e) {
                e.preventDefault();
                let id = $('#id').val();
                let formData = new FormData(this);
        
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('admin/coupons') }}/" + id,
                    data: formData,
                    processData: false,  // Prevent jQuery from processing the data
                    contentType: false,  // Prevent jQuery from setting contentType
                    success: function (res) {
                        if (res.status === 'success') {
                            $('#editTestimonialFormModal').modal('hide');
                            $('#editTestimonialForm')[0].reset();
                            testimonialTable.ajax.reload()
                            swal.fire({
                                title: "Success",
                                text: "Coupon Updated !",
                                icon: "success"
                            })
                            
                        }
                    },
                    error: function (err) {
                        console.error('Error:', err);
                        swal.fire({
                            title: "Failed",
                            text: "Something Went Wrong !",
                            icon: "error"
                        })
                        // Optionally, handle error behavior like showing an error message
                    }
                });
            });

      
            // Delete Data
            $(document).on('click', '#deleteTestimonialBtn', function () {
                let id = $(this).data('id');
        
                swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this !",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, delete it!"
                })
                    .then((result) => {
                        if (result.isConfirmed) {
        
        
                            $.ajax({
                                type: 'DELETE',
        
                                url: "{{ url('admin/coupons') }}/" + id,
                                data: {
                                    '_token': token
                                },
                                success: function (res) {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: "Coupon has been deleted.",
                                        icon: "success"
                                    });
        
                                    testimonialTable.ajax.reload();
                                },
                                error: function (err) {
                                    console.log('error')
                                }
                            })
        
        
                        } else {
                            swal.fire('Your Data is Safe');
                        }
        
                    })
        
        
            })
        
            // Change Admin Status
            $(document).on('click', '#testimonialStatus', function () {
                let id = $(this).data('id');
                let status = $(this).data('status')
                console.log(id + status)
                $.ajax(
                    {
                        type: 'post',
                        url: "{{route('admin.coupon.change-status')}}",
                        data: {
                            '_token': token,
                            id: id,
                            status: status
        
                        },
                        success: function (res) {
                            testimonialTable.ajax.reload();
        
                            if (res.status === 1) {
        
                                swal.fire(
                                    {
                                        title: 'Status Changed to Active',
                                        icon: 'success'
                                    })
                            } else {
                                swal.fire(
                                    {
                                        title: 'Status Changed to Inactive',
                                        icon: 'success'
                                    })
        
                            }
                        },
                        error: function (err) {
                            console.log(err)
                        }
                    }
                )
            })
        });
        
        
    </script>

@endpush