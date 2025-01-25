@extends('backend.layout.master')

@push('backendCss')

    <link href="{{asset('backend')}}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css"
          rel="stylesheet" type="text/css">
    <link href="{{asset('backend')}}/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css"
          rel="stylesheet" type="text/css">
@endpush

@section ('contents')
    

    <form method="post" action="{{route('admin.lesson.update',$lesson->id)}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Edit Lesson <span class="text-primary">{{$lesson->title}}</span></h4>
                    </div>
                    <div class="card-body p-4">

                        <div class="row">

                            <div class="col-lg-6">
                                <div>

{{--                                    <input type="number" hidden name="course_id" value="{{$course->id}}">--}}

                                    <div class="mb-3">
                                        <label class="form-label">Select Subject *</label>
                                        <select class="form-control" name="subject_id" required>

                                            @forelse($subjects as $subject)
                                                <option value="{{$subject->id}}" @if($lesson->subject_id == $subject->id) selected @endif>{{$subject->title}}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="title" class="form-label">Lesson Title *</label>
                                        <input class="form-control" type="text" id="title" name="title" value="{{$lesson->title ?? ''}}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="subtitle" class="form-label">Subtitle</label>
                                        <textarea id="subtitle" name="subtitle" class="form-control">{{$lesson->subtitle ?? ''}}</textarea>
                                    </div>



                                </div>
                            </div>
                            <div class="col-lg-6">

                                <div class="mb-3">
                                    <label for="desc" class="form-label">Description</label>
                                    <textarea id="desc" name="desc" class="form-control">{{$lesson->desc ?? ''}}</textarea>
                                </div>



                                <div class="mb-3">
                                    <label for="position" class="form-label">Position *</label>
                                    <input class="form-control" type="number" id="position" name="position" value="{{$lesson->position ?? 1}}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="pageStatus" class="form-label">Status *</label>
                                    <select id="pageStatus" class="form-select form-control" name="status" required>
                                        <option value="1" @if($lesson->status == 1) selected @endif>Active</option>
                                        <option value="0" @if($lesson->status == 0) selected @endif>Inactive</option>
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