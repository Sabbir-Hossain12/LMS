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
                <h4 class="mb-sm-0 font-size-18">Testimonials</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                        <li class="breadcrumb-item active">Testimonials</li>
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
                        <h4 class="card-title">Testimonial List</h4>
                        
{{--                        @if(Auth::user()->can('Create Admin'))--}}
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTestimonial">
                                Add Testimonial
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
                                <th>Author Image</th>
                                <th>Author Name</th>
                                <th>Author Title</th>
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

    {{--    Add Testimonials Modal--}}
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
                            <label for="type" class="col-form-label">Image (74 X 74px)</label>
                            <input type="file" class="form-control" name="img" id="img">
                        </div>
                        
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="title" class="col-form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="col-form-label">Description</label>
                            <textarea  class="form-control" id="desc" name="desc"></textarea>
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
                            <label for="type" class="col-form-label">Image (74 X 74px)</label>
                            <input type="file" class="form-control" name="img" id="eImg">
                            <div id="eImgPreview" class="mt-1"></div>
                        </div>

                        <div class="mb-3">
                            <label for="eName" class="col-form-label">Name</label>
                            <input type="text" class="form-control" id="eName" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="eTitle" class="col-form-label">Title</label>
                            <input type="text" class="form-control" id="eTitle" name="title">
                        </div>
                        <div class="mb-3">
                            <label for="eDesc" class="col-form-label">Description</label>
                            <textarea  class="form-control" id="eDesc" name="desc"></textarea>
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
                ajax: "{{route('admin.testimonials.data')}}",
                // pageLength: 30,

                columns: [
                    {
                        data: 'id',


                    },
                    {
                        data: 'img',
                        render: function (data) {
                            return '<img src="{{asset('')}}' + data + '" alt="' + data + '" style="width: 100px; height: 100px; border-radius: 50%;">';
                        }

                    },
                    {
                        data: 'name',

                    },
                    {
                        data: 'title'
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
                    url: "{{ route('admin.testimonial.store') }}",
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
                                text: "Testimonial Added !",
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
                        url: "{{ url('admin/testimonials') }}/" + id + "/edit",
                        data: {
                            id: id
                        },
        
                        processData: false,  // Prevent jQuery from processing the data
                        contentType: false,  // Prevent jQuery from setting contentType
                        success: function (res) {

                            $('#eImgPreview').empty();
                            $('#eImgPreview').append('<img src="{{asset('')}}' + res.data.img + '" style="width: 100px; height: 100px; border-radius: 50%;">');
                            $('#eName').val(res.data.name);
                            $('#eTitle').val(res.data.title);
                            $('#eDesc').val(res.data.desc);
                            
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
                    url: "{{ url('admin/testimonials') }}/" + id,
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
                                text: "Testimonial Updated !",
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
        
                                url: "{{ url('admin/testimonials') }}/" + id,
                                data: {
                                    '_token': token
                                },
                                success: function (res) {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: "Testimonials has been deleted.",
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
                        url: "{{route('admin.testimonials.change-status')}}",
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