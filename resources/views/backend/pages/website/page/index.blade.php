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
                        <a class="btn btn-primary" href="{{route('admin.page.create')}}">
                            Add Page
                        </a>
                        {{--                        @endif--}}

                    </div>

                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0  nowrap w-100 dataTable no-footer dtr-inline" id="blogTable">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Image</th>
                                <th>Page name</th>
                                <th>Status</th>
                                <th>Actions</th>

                            </tr>

                            </thead>
                            <tbody>
                            @forelse($pages as $index=>$page) 
                            <tr>
                            <td>{{$index+1}}</td>
                            <td>
                                @if($page->img)
                                    <img src="{{asset($page->img)}}" alt="" style="height: 50px; width: 50px; object-fit: cover">
                                @endif
                            </td>
                            <td>{{$page->name}}</td>
                            <td>
                                <div class="d-flex gap-3"> 
                                
                                @if($page->status==1)
                                    <a class="status"  href=""> <i
                                                class="fa-solid fa-toggle-on fa-2x"></i>
                                    </a>
                                @endif
                                @if($page->status==0)
                                    <a class="status"  href=""> <i
                                                class="fa-solid fa-toggle-off fa-2x" style="color: grey"></i>
                                    </a>
                                @endif
                                </div>
                            </td>
                                <td>
                                    <div class="d-flex gap-3">
                                        <a href="{{route('admin.page.edit',$page->id)}}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                        <form method="post" id="delete-form-{{$page->id}}" action="{{route('admin.page.destroy',$page->id)}}">
                                        @csrf
                                            @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger" ><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
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
            let blogTable = $('#blogTable').DataTable();


        });


    </script>

@endpush