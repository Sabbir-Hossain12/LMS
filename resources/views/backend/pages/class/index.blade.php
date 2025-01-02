@extends('backend.layout.master')

@push('backendCss')
    {{--    <meta name="csrf_token" content="{{ csrf_token() }}" />--}}

    <link href="{{asset('backend')}}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css"
          rel="stylesheet" type="text/css">
    <link href="{{asset('backend')}}/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css"
          rel="stylesheet" type="text/css">

    <style>
        @media (min-width: 576px) {
            .modal-dialog {
                max-width: 800px;
                margin: 1.75rem auto;
            }
        }

        #iconPrevDiv i
        {
            font-size: 40px;
        }
    </style>
@endpush

@section('contents')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Classes</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard.index')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Classes</li>
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
                        <h4 class="card-title">Class List</h4>
                        {{--                       @can('Create Admin')--}}
                        {{--                       @if(Auth::guard('admin')->user()->can('Create Admin'))--}}
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createAdminModal">
                            Create Class
                        </button>
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
                                <th>Title</th>
                                <th>Position</th>
                                <th>Featured Status</th>
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

    {{--    Create Class Modal--}}
    <div class="modal fade" id="createAdminModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Class</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form name="form" id="createAdmin">
                        @csrf

                        <div class="row">
                            <div class="col-6"> 
                                <div class="mb-3">
                                    <label  class="col-form-label">Class Title</label>
                                    <input type="text" class="form-control" name="title">
                                </div>

                                <div class="mb-3">
                                    <label  class="col-form-label">Subtitle</label>
                                    <textarea  class="form-control" name="subtitle"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label  class="col-form-label">Description</label>
                                    <textarea  class="form-control" name="desc"></textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label  class="col-form-label">Image (optional)</label>
                                    <input type="file" class="form-control" name="img">
                                </div>
                                <div class="mb-3">
                                    <label  class="col-form-label">Icon</label>
                                    <input type="text" class="form-control" name="icon">
                                </div>

                                <div class="mb-3">
                                    <label  class="col-form-label">Position</label>
                                    <input type="number" value="1" class="form-control" name="position">
                                </div>
                            </div>
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

    {{--    Edit Class Modal--}}
    <div class="modal fade" id="editAdminModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form name="form2" id="editAdmin" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="title"  class="col-form-label">Class Title</label>
                                    <input type="text" class="form-control" id="title" name="title">
                                </div>

                                <div class="mb-3">
                                    <label for="subtitle"  class="col-form-label">Subtitle</label>
                                    <textarea  class="form-control" id="subtitle" name="subtitle"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="desc" class="col-form-label">Description</label>
                                    <textarea  class="form-control" id="desc" name="desc"></textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label  class="col-form-label">Image (optional)</label>
                                    <input type="file" class="form-control" name="img">
                                    <div id="imgPrevDiv"></div>
                                </div>
                                <div class="mb-3">
                                    <label  class="col-form-label">Icon</label>
                                    <input type="text" class="form-control" id="icon" name="icon">
                                    <div id="iconPrevDiv" class="mt-1">
                                        
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="position"  class="col-form-label">Position</label>
                                    <input type="number" value="1" class="form-control" id="position" name="position">
                                </div>
                            </div>
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
            let adminTable = $('#adminTable').DataTable({
                order: [
                    [0, 'asc']
                ],
                processing: true,
                serverSide: true,
                ajax: "{{route('admin.class.data')}}",
                // pageLength: 30,

                columns: [
                    {
                        data: 'id',

                    },

                    {
                        data: 'title',

                    },

                    {
                        data: 'position',

                    },
                    {
                        data: 'featured_status',
                        name: 'Featured Status',
                        orderable: false,
                        searchable: false,
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

            // Create Class
            $('#createAdmin').submit(function (e) {
                e.preventDefault();

                let formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('admin.class.store')}}",
                    data: formData,
                    processData: false,  // Prevent jQuery from processing the data
                    contentType: false,  // Prevent jQuery from setting contentType
                    success: function (res) {
                        if (res.status === 'success') {
                            $('#createAdminModal').modal('hide');
                            $('#createAdmin')[0].reset();
                            adminTable.ajax.reload()
                            swal.fire({
                                title: "Success",
                                text: "Class Added !",
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

            // Edit Student Data
            $(document).on('click', '.editButton', function () {
                let id = $(this).data('id');
                $('#id').val(id);

                $.ajax(
                    {
                        type: "GET",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ url('admin/classes') }}/" + id + "/edit",
                        data: {
                            id: id
                        },

                        processData: false,  // Prevent jQuery from processing the data
                        contentType: false,  // Prevent jQuery from setting contentType
                        success: function (res) {
                            
                            $('#title').val(res.data.title);
                            $('#subtitle').val(res.data.subtitle);
                            $('#desc').val(res.data.desc);
                            $('#position').val(res.data.position);
                            $('#icon').val(res.data.icon);

                            if (res.data.img) {


                                $('#imgPrevDiv').empty();
                                $('#imgPrevDiv').append(
                                    `<img  src="{{asset('')}}${res.data.img}" width="100px" height="100px">`
                                );
                            }

                            if (res.data.icon) {


                                $('#iconPrevDiv').empty();
                                $('#iconPrevDiv').append(
                                    `<i class="fas ${res.data.icon}"></i>`
                                );
                            }
                            
                            
                        },
                        error: function (err) {
                            console.log('failed')
                        }
                    }
                )
            })

            // Update Student Data
            $('#editAdmin').submit(function (e) {
                e.preventDefault();
                let id = $('#id').val();
                let formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('admin/classes') }}/" + id,
                    data: formData,
                    processData: false,  // Prevent jQuery from processing the data
                    contentType: false,  // Prevent jQuery from setting contentType
                    success: function (res) {
                        if (res.status === 'success') {
                            $('#editAdminModal').modal('hide');
                            $('#editAdmin')[0].reset();
                            adminTable.ajax.reload()
                            swal.fire({
                                title: "Success",
                                text: "Student Updated !",
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

            // Delete Student
            $(document).on('click', '#deleteAdminBtn', function () {
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

                                url: "{{ url('admin/classes') }}/" + id,
                                data: {
                                    '_token': token
                                },
                                success: function (res) {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: "Class has been deleted.",
                                        icon: "success"
                                    });

                                    adminTable.ajax.reload();
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

            // Change  Status
            $(document).on('click', '#adminStatus', function () {
                let id = $(this).data('id');
                let status = $(this).data('status')
                console.log(id + status)
                $.ajax(
                    {
                        type: 'post',
                        url: "{{route('admin.class.status')}}",
                        data: {
                            '_token': token,
                            id: id,
                            status: status

                        },
                        success: function (res) {
                            adminTable.ajax.reload();

                            if (res.status == 1) {

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

            // Change Featured Status
            $(document).on('click', '#featuredStatus', function () {
                let id = $(this).data('id');
                let status = $(this).data('status')
                console.log(id)
                console.log(status)
                $.ajax(
                    {
                        type: 'post',
                        url: "{{route('admin.class.featured-status')}}",
                        data: {
                            '_token': token,
                            id: id,
                            status: status

                        },
                        success: function (res) {
                            adminTable.ajax.reload();

                            if (res.status == 1) {

                                swal.fire(
                                    {
                                        title: 'Featured Status Changed to Active',
                                        icon: 'success'
                                    })
                            } else {
                                swal.fire(
                                    {
                                        title: 'Featured Status Changed to Inactive',
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