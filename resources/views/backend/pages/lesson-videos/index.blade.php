@extends('backend.layout.master')

@push('backendCss')

    <link href="{{asset('backend')}}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css"
          rel="stylesheet" type="text/css">
    <link href="{{asset('backend')}}/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css"
          rel="stylesheet" type="text/css">
@endpush

@section ('contents')

    <div class="row">
        <div class="col-12">
            @include('backend.include.course-tab')
        </div>
    </div>

    <form method="post" action="{{route('admin.lesson-video.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Add Lesson Videos</h4>
                    </div>
                    <div class="card-body p-4">

                        <div class="row">

                            <div class="col-lg-6">
                                <div>

                                    <input type="number" hidden name="course_id" value="{{$course->id}}">

                                    <div class="mb-3">
                                        <label class="form-label">Select Lesson *</label>
                                        <select class="form-control" name="lesson_id" required>

                                            @forelse($lessons as $lesson)
                                                <option value="{{$lesson->id}}">{{$lesson->title}}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="title" class="form-label">Video Title *</label>
                                        <input class="form-control" type="text" id="title" name="title" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="video_url" class="form-label">Video URL (embed) *</label>
                                        <input class="form-control" type="text" id="video_url" name="video_url" placeholder="https://www.youtube.com/embed/v5nSFx7YEXc?si=7HPDNFUSxUbq3e9B" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="duration" class="form-label">Duration </label>
                                        <input class="form-control" type="text" id="duration" name="duration" placeholder="1 Hour">
                                    </div>

                                  

                                </div>
                            </div>
                            <div class="col-lg-6">

                               

                                <div class="mb-3">
                                    <label for="position" class="form-label">Position *</label>
                                    <input class="form-control" type="number" id="position" name="position" value="1" required>
                                </div>
                                <div class="mb-3" id="startTimeDiv">
                                    <label for="start_time" class="form-label">Start Date</label>
                                    <input class="form-control" type="datetime-local" id="start_time" step="any" value="{{now()}}" name="start_time" required>
                                </div>

                                <div class="mb-3" id="endTimeDiv">
                                    <label for="end_time" class="form-label">End Date</label>
                                    <input class="form-control" type="datetime-local" id="end_time" name="end_time" required>
                                </div>

                                <div class="mb-3">
                                    <label for="pageStatus" class="form-label">Status *</label>
                                    <select id="pageStatus" class="form-select form-control" name="status" required>
                                        <option value="1" selected>Active</option>
                                        <option value="0">Inactive</option>
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

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">

                    <div class="d-flex justify-content-center align-items-center">
                        <h4 class="card-title">Lesson Video List</h4>
                        {{--                       @can('Create Admin')--}}
                        {{--                       @if(Auth::guard('admin')->user()->can('Create Admin'))--}}

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
                                <th>Lesson Name</th>
                                <th>Video Title</th>
                                <th>Video URL</th>
                                <th>position</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($lessonVideos as $key=> $lVideo)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$lVideo->lesson->title}}</td>
                                    <td>{{$lVideo->title}}</td>
                                    <td>{{$lVideo->video_url}}</td>
                                    <td>{{$lVideo->position}}</td>
                                    <td>
                                        @if($lVideo->status == 1)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            <a href="{{route('admin.lesson-video.edit',$lVideo->id)}}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                            <form method="post" id="delete-form-{{$lVideo->id}}" action="{{route('admin.lesson-video.destroy',$lVideo->id)}}">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-sm btn-danger delete-btn" data-id="{{$lVideo->id}}" ><i class="fas fa-trash"></i></button>
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
        </div>
    </div>
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


            let adminTable = $('#adminTable').DataTable({

            });
        });


    </script>
    <script>
        $(document).ready(function () {
            // Handle delete button click
            $(document).on('click','.delete-btn', function () {
                let formId = '#delete-form-' + $(this).data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action cannot be undone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the form if confirmed
                        $(formId).submit();
                    }
                });
            });
        });
    </script>
@endpush