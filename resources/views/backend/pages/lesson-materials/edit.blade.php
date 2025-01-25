@extends('backend.layout.master')

@push('backendCss')

    <link href="{{asset('backend')}}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css"
          rel="stylesheet" type="text/css">
    <link href="{{asset('backend')}}/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css"
          rel="stylesheet" type="text/css">
@endpush

@section ('contents')
    
    <form method="post" action="{{route('admin.lesson-material.update',$lessonMaterial->id)}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Edit Lesson Material for <span class="text-primary"> {{$lessonMaterial->title}}</span>
                        </h4>
                    </div>
                    <div class="card-body p-4">

                        <div class="row">

                            <div class="col-lg-6">
                                <div>

{{--                                    <input type="number" hidden name="course_id" value="{{$course->id}}">--}}

                                    <div class="mb-3">
                                        <label class="form-label">Select Lesson *</label>
                                        <select class="form-control" name="lesson_id" required>

                                            @forelse($lessons as $lesson)
                                                <option value="{{$lesson->id}}" @if($lessonMaterial->lesson_id == $lesson->id) selected @endif>{{$lesson->title}}</option>
                                            @empty
                                            @endforelse

                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="title" class="form-label">Material Title *</label>
                                        <input class="form-control" type="text" id="title" name="title"
                                               placeholder="Title" value="{{$lessonMaterial->title ?? ''}}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Material Type *</label>
                                        <select class="form-control" name="type" required>
                                            <option value="text" @if($lessonMaterial->type == 'text') selected @endif>Text</option>
                                            <option value="file" @if($lessonMaterial->type == 'file') selected @endif>File (PDF/Doc/Image)</option>
                                            <option value="url" @if($lessonMaterial->type == 'url') selected @endif>URL Link</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="url" class="form-label">URL/Link </label>
                                    <input class="form-control" type="text" id="url" name="url"
                                           placeholder="Link or URl" value="{{$lessonMaterial->url ?? ''}}">
                                </div>

                                <div class="mb-3">
                                    <label for="duration" class="form-label">File (PDF/Doc/Image) </label>
                                    <input type="file" class="form-control" name="file">
                                    @if($lessonMaterial->file) 
                                    <div class="mt-2">
                                        <a href="{{url($lessonMaterial->file)}}" target="_blank" download>{{$lessonMaterial->title}}</a>
                                    </div>
                                    @endif
                                </div>
                               
                               

                                <div class="mb-3">
                                    <label for="pageStatus" class="form-label">Status *</label>
                                    <select id="pageStatus" class="form-select form-control" name="status" required>
                                        <option value="1" @if($lessonMaterial->status == 1) selected  @endif>Active</option>
                                        <option value="0" @if($lessonMaterial->status == 0) selected  @endif>Inactive</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="duration" class="form-label">Material Text </label>
                                    <textarea class="form-control" id="materialText" name="text">{{$lessonMaterial->text ?? ''}}</textarea>
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

    <script>
        $(document).ready(function () {

            ClassicEditor
                .create(document.querySelector('#materialText'))
                .catch(error => {
                    console.error(error);
                });
        });


    </script>
@endpush