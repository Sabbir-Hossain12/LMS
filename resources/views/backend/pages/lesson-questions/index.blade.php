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

    <form method="post" action="{{route('admin.assessment-question.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Add Questions (MCQ/Assignments)
                        </h4>
                    </div>
                    <div class="card-body p-4">

                        <div class="row">

                            <div class="col-lg-6">
                                <div>

                                    <input type="number" hidden name="course_id" value="{{$course->id}}">

                                    <div class="mb-3">
                                        <label class="form-label">Select Assessment *</label>
                                        <select class="form-control" name="assessment_id" required>

                                            @forelse($assessments as $assessment)
                                                <option value="{{$assessment->id}}">{{$assessment->title}}</option>
                                            @empty
                                            @endforelse

                                        </select>
                                    </div>
                                    
                                    <div class="mb-3">

                                        <label class="form-label">Select Question Image </label>
                                        <input type="file" class="form-control" name="question_image">
                                        
                                    </div>
                                    
                                    
                                    <div class="mb-3">
                                        <label for="question_text" class="form-label">Question Text *</label>
                                        <textarea class="form-control" id="question_text" name="question_text" cols="3" rows="1"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="desc" class="form-label">Question Marks *</label>
                                        <input type="number" class="form-control" id="marks" min="1" name="marks" required>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-lg-6">
                             <div class="mb-1" id="optionMultiple">
                                    <label  class="form-label">Options *</label>
                                 <div class="input-group mb-1 option-item" >
                                    <input type="text" class="form-control"  name="options[]" placeholder="Option 1">
                                    <button type="button" class="btn btn-danger remove-option"><i class="mdi mdi-close"></i></button>
                                 </div>
                             </div>
                                <div class="mb-3">
                                <button type="button" id="add-option" class="btn btn-sm btn-secondary">Add Option</button>
                                </div>

                                <div class="mb-3">
                                    <label for="desc" class="form-label">Correct Option/Answer </label>
                                    <input type="text" class="form-control"  name="correct_answers">
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
                        <h4 class="card-title">Question List</h4>
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
                                <th>Assessment Title</th>
                                <th>Question Text</th>
                                <th>Marks</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($questions as $key=> $question)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$question->assessment->title}}</td>
                                    <td style="width: 200px; height: 50px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        {!!$question->question_text !!}</td>
                                    <td>{{$question->marks}}</td>
                                    <td>
                                        @if($question->status == 1)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            <a href="" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                            <form method="post" id="delete-form-{{$question->id}}" action="">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm btn-danger"><i
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
{{--    <script src="https://cdn.ckeditor.com/4.25.0-lts/standard-all/ckeditor.js"></script>--}}
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('backend')}}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('backend')}}/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {

            ClassicEditor
                .create(document.querySelector('#question_text'),
                    {
                        toolbar: {
                            items: [
                                'undo', 'redo',
                                '|',
                                'bold', 'italic', 'strikethrough', 'subscript', 'superscript',
                                '|',
                                'link', 'uploadImage', 'blockQuote',
                                '|',
                                'bulletedList', 'numberedList'
                            ]
                        }
                    })
           
                .catch(error => {
                    console.error(error);
                });


            let adminTable = $('#adminTable').DataTable({});

            // CKEDITOR.replace('question_text', {
            //     extraPlugins: 'mathjax',
            //     mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML',
            //     height: 320,
            //     removeButtons: 'PasteFromWord'
            // });
            //
            // if (CKEDITOR.env.ie && CKEDITOR.env.version == 8) {
            //     document.getElementById('ie8-warning').className = 'tip alert';
            // }

        
        });
        


    

        $(document).ready(function () {
            let optionCount = 1;

            // Add new option
            $('#add-option').click(function () {
                optionCount++;
                $('#optionMultiple').append(`<div class="input-group mb-1 option-item" >
                                    <input type="text" class="form-control"  name="options[]" placeholder="Option ${optionCount}">
                                    <button type="button" class="btn btn-danger remove-option"><i class="mdi mdi-close"></i></button>
                                </div>  `);
            });

            // Remove option
            $(document).on('click', '.remove-option', function () {
                $(this).closest('.option-item').remove();
            });
        });

    </script>
@endpush