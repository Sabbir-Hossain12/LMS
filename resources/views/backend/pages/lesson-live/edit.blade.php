@extends('backend.layout.master')

@push('backendCss')

    <link href="{{asset('backend')}}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css"
          rel="stylesheet" type="text/css">
    <link href="{{asset('backend')}}/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css"
          rel="stylesheet" type="text/css">
@endpush

@section ('contents')
    
    <form method="post" action="{{route('admin.lesson-live.update', $lessonLive->id)}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Edit Lesson Live Class for <span class="text-primary"> {{$lessonLive->title}}</span>
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
                                                <option value="{{$lesson->id}}" @if($lessonLive->lesson_id == $lesson->id) selected @endif>{{$lesson->title}}</option>
                                            @empty
                                            @endforelse

                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="title" class="form-label">Live Title *</label>
                                        <input class="form-control" type="text" id="title" name="title"
                                               placeholder="Title" value="{{$lessonLive->title ?? ''}}" required>
                                    </div>

                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="class_link" class="form-label">Live URL/Link </label>
                                    <input class="form-control" type="text" id="class_link" name="class_link"
                                           placeholder="Link or URL" value="{{ $lessonLive->class_link ?? '' }}">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="pageStatus" class="form-label">Status *</label>
                                    <select id="pageStatus" class="form-select form-control" name="status" required>
                                        <option value="1" @if($lessonLive->status == 1) selected  @endif>Active</option>
                                        <option value="0" @if($lessonLive->status == 0) selected  @endif>Inactive</option>
                                    </select>
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