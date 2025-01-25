@extends('backend.layout.master')

@push('backendCss')

    <link href="{{asset('backend')}}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css"
          rel="stylesheet" type="text/css">
    <link href="{{asset('backend')}}/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css"
          rel="stylesheet" type="text/css">
@endpush

@section ('contents')
    

    <form method="post" action="{{route('admin.subject.update',$subject->id)}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Edit Subject <span class="text-primary">{{$subject->title}}</span></h4>
                    </div>
                    <div class="card-body p-4">

                        <div class="row">

                            <div class="col-lg-6">
                                <div>
{{--                                    <input type="number" hidden name="course_id" value="{{$course->id}}">--}}
                                    <div class="mb-3">
                                        <label class="form-label">Subject Title</label>
                                        <input class="form-control" type="text" placeholder="Course Title"
                                               id="name" name="title" value="{{$subject->title ?? ''}}" required>
                                    </div>


                                    <div class="mb-3">
                                        <label for="subtitle" class="form-label">Subtitle</label>
                                        <textarea id="subtitle" name="subtitle" class="form-control">{{$subject->subtitle ?? ''}}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="icon" class="form-label">Icon</label>
                                        <input class="form-control" type="text" id="icon" name="icon" value="{{$subject->icon ?? ''}}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="pageStatus" class="form-label">Featured Status</label>
                                        <select id="pageStatus" class="form-select form-control" name="is_featured" required>
                                            <option value="1" @if($subject->is_featured == 1) selected @endif>Active</option>
                                            <option value="0" @if($subject->is_featured == 0) selected @endif>Inactive</option>
                                        </select>
                                    </div>




                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="img" class="form-label">Image</label>
                                    <input class="form-control" type="file" id="img" name="img">
                                    <div id="imgPrevDiv" class="mt-1">
                                        @if($subject->img)
                                            <img src="{{asset($subject->img)}}" alt="" width="100">
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="desc" class="form-label">Description</label>
                                    <textarea id="desc" name="desc" class="form-control" required>{{$subject->desc ?? ''}}</textarea>
                                </div>



                                <div class="mb-3">
                                    <label for="position" class="form-label">Position</label>
                                    <input class="form-control" type="number" id="position" name="position" value="{{$subject->position ?? ''}}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="pageStatus" class="form-label">Status</label>
                                    <select id="pageStatus" class="form-select form-control" name="status" required>
                                        <option value="1" @if($subject->status == 1) selected @endif>Active</option>
                                        <option value="0" @if($subject->status == 0) selected @endif>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-center">Meta Information</h4>

                </div>
                <div class="card-body p-4">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="meta_title" class="form-label">Meta Title</label>
                                <input class="form-control" type="text" placeholder="Meta Title"
                                       id="meta_title" name="meta_title" value="{{$subject->meta_title ?? ''}}">
                            </div>
                            <div class="mb-3">
                                <label for="meta_keyword" class="form-label">Meta Keywords</label>
                                <input class="form-control" type="text" placeholder="Enter Meta Keywords"
                                       id="meta_keyword" name="meta_keywords" value="{{$subject->meta_keywords ?? ''}}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="meta_desc" class="form-label">Meta Description</label>
                                <textarea id="meta_desc" name="meta_desc" class="form-control">{{$subject->meta_description ?? ''}}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="meta_img" class="form-label">Meta Image</label>
                                <input class="form-control" type="file" id="meta_img" name="meta_img">
                                <div id="imgPrevDiv" class="mt-1">
                                    @if($subject->meta_img)
                                        <img src="{{asset($subject->meta_img)}}" alt="" width="100">
                                    @endif
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
            <div class="text-center d-grid">
                <button type="submit" class="btn  btn-primary">Update</button>
            </div>

        </div> <!-- end col -->



    </form>

   
@endsection

@push('backendJs')

    {{--  CkEditor CDN  --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('backend')}}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('backend')}}/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

   
@endpush