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
                max-width: 600px;
                margin: 1.75rem auto;
            }
        }
    </style>
@endpush

@section('contents')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Blogs</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                        <li class="breadcrumb-item active">Blogs/News</li>
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
                        <h4 class="card-title">Blogs/News List</h4>

                        {{--                        @if(Auth::user()->can('Create Admin'))--}}
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBlog">
                            Add Blog/News
                        </button>
                        {{--                        @endif--}}

                    </div>

                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0  nowrap w-100 dataTable no-footer dtr-inline" id="blogTable">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Thumbnail Image</th>
                                <th>Main Image</th>
                                <th>Blog Title</th>
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

    {{--    Add Blogs Modal--}}
    <div class="modal fade" id="addBlog" tabindex="-1" aria-labelledby="exampleModalLabel"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Blogs</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form name="form" id="addBlogForm">
                        @csrf
                        <div class="mb-3">
                            <label for="type" class="col-form-label">Thumbnail Image</label>
                            <input type="file" class="form-control" name="thumbnail_img" >
                        </div>

                        <div class="mb-3">
                            <label for="type" class="col-form-label">Main Image</label>
                            <input type="file" class="form-control" name="main_img" >
                        </div>

                        <div class="mb-3">
                            <label for="name" class="col-form-label">Title</label>
                            <input type="text" class="form-control"  name="title">
                        </div>

                        <div class="mb-3">
                            <label for="desc" class="col-form-label">Description</label>
                            <textarea  class="form-control"  name="desc" id="blogDesc"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="col-form-label">Meta Title (optional)</label>
                            <input type="text" class="form-control"  name="meta_title">
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="col-form-label">Meta Description (optional)</label>
                            <textarea  class="form-control"  name="meta_description" ></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="col-form-label">Meta Keywords (optional) </label>
                            <textarea  class="form-control"  name="meta_keywords"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="type" class="col-form-label">Meta Image</label>
                            <input type="file" class="form-control" name="meta_img" >
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
                            <label for="type" class="col-form-label">Thumbnail Image</label>
                            <input type="file" class="form-control" id="thumbnail_img" name="thumbnail_img" >
                            <div id="thumbnail_imgPrev"></div>
                        </div>

                        <div class="mb-3">
                            <label for="type" class="col-form-label">Main Image</label>
                            <input type="file" class="form-control" id="main_img" name="main_img" >
                            <div id="main_imgPrev"></div>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="col-form-label">Title</label>
                            <input type="text" class="form-control" id="title"  name="title">
                        </div>

                        <div class="mb-3">
                            <label for="desc" class="col-form-label">Description</label>
                            <textarea  class="form-control"  name="desc" id="eBlogDesc"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="col-form-label">Meta Title (optional)</label>
                            <input type="text" class="form-control" id="meta_title"  name="meta_title">
                        </div>

                        <div class="mb-3">
                            <label for="desc" class="col-form-label">Meta Description (optional)</label>
                            <textarea  class="form-control" id="meta_description"  name="meta_description" ></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="desc" class="col-form-label">Meta Keywords (optional) </label>
                            <textarea  class="form-control" id="meta_keywords"  name="meta_keywords"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="type" class="col-form-label">Meta Image (optional)</label>
                            <input type="file" class="form-control" name="meta_img">
                            <div id="meta_imgPrev"></div>
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
    <script src="{{asset('https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js')}}"></script>

    <script>

        $(document).ready(function () {

            //  CKEditor on Blog Description
            let jReq;
            ClassicEditor.create(document.querySelector('#blogDesc'),{
                ckfinder:
                    {
                        uploadUrl: "{{route('admin.blog.ckeditor.upload', ['_token' => csrf_token() ])}}",
                    }
            })
                .then(newEditor => {
                    jReq = newEditor;
                })
                .catch(error => {
                    console.error(error);
                });

            let Req;
            ClassicEditor.create(document.querySelector('#eBlogDesc'),{
                ckfinder:
                    {
                        uploadUrl: "{{route('admin.blog.ckeditor.upload', ['_token' => csrf_token() ])}}",
                    }
            })
                .then(newEditor => {
                    Req = newEditor;
                })
                .catch(error => {
                    console.error(error);
                });




            var token = $("input[name='_token']").val();

            //Show Data through Datatable 
            let blogTable = $('#blogTable').DataTable({
                order: [
                    [0, 'asc']
                ],
                processing: true,
                serverSide: true,
                ajax: "{{route('admin.blog.data')}}",
                // pageLength: 30,

                columns: [
                    {
                        data: 'id',


                    },
                    {
                        data: 'thumbnail_img',
                        render: function (data) {
                            return '<img src="{{asset('')}}' + data + '" alt="' + data + '" style="width: 100px; height: 100px; border-radius: 50%;">';
                        }

                    },

                    {
                        data: 'main_img',
                        render: function (data) {
                            return '<img src="{{asset('')}}' + data + '" alt="' + data + '" style="width: 100px; height: 100px; border-radius: 50%;">';
                        }

                    },

                    {
                        data: 'title',

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
            $('#addBlogForm').submit(function (e) {
                e.preventDefault();

                let formData = new FormData(this);

                formData.append('desc', jReq.getData());
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('admin.blog.store') }}",
                    data: formData,
                    processData: false,  // Prevent jQuery from processing the data
                    contentType: false,  // Prevent jQuery from setting contentType
                    success: function (res) {
                        if (res.status === 'success') {
                            $('#addBlog').modal('hide');
                            $('#addBlogForm')[0].reset();
                            blogTable.ajax.reload()
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
                        url: "{{ url('admin/blogs') }}/" + id + "/edit",
                        data: {
                            id: id
                        },

                        processData: false,  // Prevent jQuery from processing the data
                        contentType: false,  // Prevent jQuery from setting contentType
                        success: function (res) {

                            $('#thumbnail_imgPrev').empty();
                            $('#thumbnail_imgPrev').append('<img src="{{asset('')}}' + res.data.thumbnail_img + '" style="width: 100px; height: 100px; border-radius: 50%;">');

                            $('#main_imgPrev').empty();
                            $('#main_imgPrev').append('<img src="{{asset('')}}' + res.data.main_img + '" style="width: 100px; height: 100px; border-radius: 50%;">');

                            $('#title').val(res.data.title);
                            $('#meta_title').val(res.data.meta_title);
                            $('#meta_description').val(res.data.meta_description);
                            $('#meta_keywords').val(res.data.meta_keywords);

                            $('#meta_imgPrev').empty();
                            $('#meta_imgPrev').append('<img src="{{asset('')}}' + res.data.meta_img + '" style="width: 100px; height: 100px; border-radius: 50%;">');

                            // $('#eBlogDesc').val(res.data.desc);
                            Req.setData( res.data.desc );


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
                formData.append('desc', Req.getData());

                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('admin/blogs') }}/" + id,
                    data: formData,
                    processData: false,  // Prevent jQuery from processing the data
                    contentType: false,  // Prevent jQuery from setting contentType
                    success: function (res) {
                        if (res.status === 'success') {
                            $('#editTestimonialFormModal').modal('hide');
                            $('#editTestimonialForm')[0].reset();
                            blogTable.ajax.reload()
                            swal.fire({
                                title: "Success",
                                text: "Blog Updated !",
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

                                url: "{{ url('admin/blogs') }}/" + id,
                                data: {
                                    '_token': token
                                },
                                success: function (res) {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: "Blogs has been deleted.",
                                        icon: "success"
                                    });

                                    blogTable.ajax.reload();
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

            // Change Status
            $(document).on('click', '#testimonialStatus', function () {
                let id = $(this).data('id');
                let status = $(this).data('status')

                $.ajax(
                    {
                        type: 'post',
                        url: "{{route('admin.blog.change-status')}}",
                        data: {
                            '_token': token,
                            id: id,
                            status: status

                        },
                        success: function (res) {
                            blogTable.ajax.reload();

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