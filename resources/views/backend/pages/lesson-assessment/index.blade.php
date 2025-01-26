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

    <form method="post" action="{{route('admin.lesson-assessment.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Add Lesson Exams (MCQ/Assignments)
                        </h4>
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
                                        <label class="form-label">Assessment Type *</label>
                                        <select class="form-control" name="type" id="assessmentType" required>
                                            
                                            <option value="quiz">Quiz</option>
                                            <option value="assignment">Assignment</option>
                                            
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="title" class="form-label">Assessment Title *</label>
                                        <input class="form-control" type="text" id="title" name="title"
                                               placeholder="Title" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="desc" class="form-label">Description</label>
                                        <textarea class="form-control" id="desc" name="desc"></textarea>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-lg-6">
                                
                                <div class="mb-3" id="startTimeDiv">
                                    <label for="start_time" class="form-label">Start Date </label>
                                    <input class="form-control" type="datetime-local" id="start_time" step="any" value="{{now()}}" name="start_time" required>
                                </div>

                                <div class="mb-3" id="endTimeDiv">
                                    <label for="end_time" class="form-label">End Date </label>
                                    <input class="form-control" type="datetime-local" id="end_time" name="end_time" required>
                                </div>
                                
{{--                                <div class="mb-3" id="dueTimeDiv">--}}
{{--                                    <label for="due_date" class="form-label">Due Date </label>--}}
{{--                                    <input class="form-control" type="datetime-local" name="due_date">--}}
{{--                                </div>--}}

                                <div class="mb-3">
                                    <label for="totalMarks" class="form-label">Total Marks *</label>
                                    <input class="form-control" type="number" id="totalMarks" name="total_marks"
                                           placeholder="Total Marks" required>
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
                        <h4 class="card-title">Lesson Exam List</h4>
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
                                <th>Title</th>
                                <th>Assessment Type</th>
                                <th>Total Marks</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($lessonAssessment as $key=> $assessment)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$assessment->lesson->title}}</td>
                                    <td>{{$assessment->title}}</td>
                                    <td>{{$assessment->type}}</td>
                                    <td>{{$assessment->total_marks}}</td>
                                    <td>{{$assessment->start_time->format('d M Y h:i A')}}</td>
                                    <td>{{$assessment->end_time->format('d M Y h:i A')}}</td>
                                    <td>
                                        @if($assessment->status == 1)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{route('admin.assessment-answer',$assessment->id)}}" class="btn btn-sm btn-success"><i class="fas fa-a"></i></a>
                                            <a href="{{route('admin.lesson-assessment.edit',$assessment->id)}}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                            <form method="post" id="delete-form-{{$assessment->id}}" action="{{route('admin.lesson-assessment.destroy',$assessment->id)}}">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="delete-btn btn btn-sm btn-danger" data-id="{{$assessment->id}}"><i
                                                            class="fas fa-trash"></i></button>
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
            $('#dueTimeDiv').hide();

            ClassicEditor
                .create(document.querySelector('#materialText'))
                .catch(error => {
                    console.error(error);
                });


            let adminTable = $('#adminTable').DataTable({});
        });
        
    </script>


    <script>
        //Delete Assessment
        $(document).ready(function () {
            // Handle delete button click
            $('.delete-btn').on('click', function () {
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