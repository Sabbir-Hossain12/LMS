@extends('backend.layout.master')

@push('backendCss')

    <link href="{{asset('backend')}}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css"
          rel="stylesheet" type="text/css">
    <link href="{{asset('backend')}}/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css"
          rel="stylesheet" type="text/css">
    
    <style>
        
        input,button
        {
            border-radius: 0!important;
        }
    </style>
@endpush

@section ('contents')

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">

                    <div class="d-flex justify-content-center align-items-center">
                        <h4 class="card-title">Exam Submission List For <span
                                    class="text-primary">{{$assessment->title}}</span></h4>
                        {{--                       @can('Create Admin')--}}
                        {{--                       @if(Auth::guard('admin')->user()->can('Create Admin'))--}}

                        {{--                        @endcan--}}
                        {{--                        @endif--}}
                    </div>

                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0  nowrap w-100 dataTable no-footer dtr-inline" id="adminTable">
                            @if($assessment->type == 'assignment')
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Student Name</th>
                                <th>Exam Marks</th>
                                <th>Attempts</th>
                                <th>Last Submit</th>
                                <th>Answer File</th>
                                <th>Marks Obtained</th>
                                <th>Upload</th>
                                <th>Status</th>
{{--                                <th>Actions</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($exam_answers as $key=> $exam_answer)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$exam_answer->student->name}}</td>
                                    <td>{{$assessment->total_marks}}</td>
                                    <td>{{$exam_answer->attempts}}</td>
                                    <td>{{$exam_answer->submitted_at->format('d M Y h:i A')}}</td>
                                    <td>
                                        @if($exam_answer->file_path)
                                            <a href="{{ url($exam_answer->file_path) }}" target="_blank" download>
                                                Download File
                                            </a>
                                        @else
                                            No file available
                                        @endif
                                    </td>
                                    <td>
                                        <form method="post" action="{{route('admin.assessment-mark-evaluate.store')}}">
                                            @csrf
                                            <input type="hidden" name="assessment_answer_id" value="{{$exam_answer->id ?? null}}">
                                            <input type="hidden" name="assessment_id" value="{{$exam_answer->assessment_id}}">
                                            <input type="hidden" name="student_id" value="{{$exam_answer->student_id }}">
                                            
                                            <div class="d-flex">
                                            <input type="number" min="1" max="{{$assessment->total_marks}}" value="{{intval(isset($exam_answer->assessmentGrade->marks_obtained) ? $exam_answer->assessmentGrade->marks_obtained : null)}}" name="marks_obtained" class="form-control" required>
                                            
                                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                            </div>
                                        </form>

                                    </td>
                                    <!--upload-->
                                      <td>
                                        <form method="post" action="{{route('admin.assessment-teacher-upload.store')}}" enctype='multipart/form-data'>
                                            @csrf
                                            <input type="hidden" name="assessment_answer_id" value="{{$exam_answer->id ?? null}}">
                                            <input type="hidden" name="assessment_id" value="{{$exam_answer->assessment_id}}">
                                            <input type="hidden" name="student_id" value="{{$exam_answer->student_id }}">
                                            
                                            <div class="d-flex">
                                            <input type="file" name="teacher_upload" class="form-control" required>
                                            
                                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                            </div>
                                        </form>

                                    </td>
                                    
                                    <td>
                                        @if($exam_answer->status == 1)
                                            <span class="badge bg-success">Checked</span>
                                        @else
                                            <span class="badge bg-danger">Pending</span>
                                        @endif
                                    </td>
{{--                                    <td>--}}
{{--                                        <div class="d-flex gap-2">--}}
{{--                                            <a href="" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>--}}
{{--                                            <form method="post" id="delete-form-{{$assessment->id}}" action="">--}}
{{--                                                @csrf--}}
{{--                                                @method('delete')--}}
{{--                                                <button type="submit" class="btn btn-sm btn-danger"><i--}}
{{--                                                            class="fas fa-trash"></i></button>--}}
{{--                                            </form>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
                                </tr>
                            @empty
                            @endforelse

                            </tbody>
                                
                                
                            @else
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Student Name</th>
                                    <th>Exam Marks</th>
                                    <th>Attempts</th>
                                    <th>Last Submit</th>
                                    <th>Marks Obtained</th>
                                    <th>Status</th>
                                    {{--                                <th>Actions</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($answerGrades as $key2=> $answerGrade)
                                    <tr>
                                        <td>{{$key2+1}}</td>
                                        <td>{{$answerGrade->student->name }}</td>
                                        <td>{{$assessment->total_marks}}</td>
                                        <td>{{$answerGrade->attempts}}</td>
                                        <td>{{$answerGrade->submitted_at->format('d M Y h:i A')}}</td>
                                        <td>{{$answerGrade->marks_obtained}}</td>

                                        <td>
                                            @if($answerGrade->status == 1)
                                                <span class="badge bg-success">Checked</span>
                                            @else
                                                <span class="badge bg-danger">Pending</span>
                                            @endif
                                        </td>
                                        {{--                                    <td>--}}
                                        {{--                                        <div class="d-flex gap-2">--}}
                                        {{--                                            <a href="" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>--}}
                                        {{--                                            <form method="post" id="delete-form-{{$assessment->id}}" action="">--}}
                                        {{--                                                @csrf--}}
                                        {{--                                                @method('delete')--}}
                                        {{--                                                <button type="submit" class="btn btn-sm btn-danger"><i--}}
                                        {{--                                                            class="fas fa-trash"></i></button>--}}
                                        {{--                                            </form>--}}
                                        {{--                                        </div>--}}
                                        {{--                                    </td>--}}
                                    </tr>
                                @empty
                                @endforelse

                                </tbody>

                            @endif
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


        // $('#assessmentType').on('change',function (e)
        // {
        //     let value=$(this).val();
        //    
        //     if (value == 'assignment')
        //     {
        //         $('#startTimeDiv').hide();
        //         $('#endTimeDiv').hide();
        //         $('#dueTimeDiv').show();
        //     }
        //     else
        //     {
        //         $('#startTimeDiv').show();
        //         $('#endTimeDiv').show();
        //         $('#dueTimeDiv').hide();
        //        
        //     }
        // })


    </script>
@endpush