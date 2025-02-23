@extends('backend.layout.master')

@push('backendCss')

    <link href="{{asset('backend')}}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css"
          rel="stylesheet" type="text/css">
    <link href="{{asset('backend')}}/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css"
          rel="stylesheet" type="text/css">
@endpush

@section ('contents')

    <form method="post" action="{{route('admin.lesson-video.update',$lessonVideo->id)}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Edit Lesson Videos For <span
                                    class="text-primary"> {{$lessonVideo->title}} </span></h4>
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
                                                <option value="{{$lesson->id}}"
                                                        @if($lessonVideo->lesson_id == $lesson->id) selected @endif>{{$lesson->title}}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="title" class="form-label">Video Title *</label>
                                        <input class="form-control" type="text" id="title" name="title"
                                               value="{{$lessonVideo->title ?? ''}}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="video_url" class="form-label">Video URL (embed) *</label>
                                        <input class="form-control" type="text" id="video_url" name="video_url"
                                               value="{{$lessonVideo->video_url ?? ''}}"
                                               placeholder="https://www.youtube.com/embed/v5nSFx7YEXc?si=7HPDNFUSxUbq3e9B"
                                               required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="duration" class="form-label">Duration </label>
                                        <input class="form-control" type="text" id="duration" name="duration"
                                               placeholder="1 Hour" value="{{$lessonVideo->duration ?? ''}}">
                                    </div>


                                </div>
                            </div>
                            <div class="col-lg-6">

                                <div class="mb-3" id="startTimeDiv">
                                    <label for="start_time" class="form-label">Start Date * </label>
                                    <input class="form-control" type="datetime-local" id="start_time" value="{{$lessonVideo->start_time ?? ''}}" name="start_time" required>
                                </div>

                                <div class="mb-3" id="endTimeDiv">
                                    <label for="end_time" class="form-label">End Date * </label>
                                    <input class="form-control" type="datetime-local" id="end_time" name="end_time" value="{{$lessonVideo->end_time ?? ''}}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="position" class="form-label">Position *</label>
                                    <input class="form-control" type="number" id="position" name="position" value="{{$lessonVideo->position ?? 1}}"
                                           required>
                                </div>

                                <div class="mb-3">
                                    <label for="pageStatus" class="form-label">Status *</label>
                                    <select id="pageStatus" class="form-select form-control" name="status" required>
                                        <option value="1" @if($lessonVideo->status == 1) selected @endif>Active</option>
                                        <option value="0" @if($lessonVideo->status == 0) selected @endif>Inactive</option>
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
                .create(document.querySelector('#long_desc'))
                .catch(error => {
                    console.error(error);
                });


        });


    </script>
@endpush