@extends('backend.layout.master')

@push('backendCss')

    <link href="{{asset('backend')}}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css"
          rel="stylesheet" type="text/css">
    <link href="{{asset('backend')}}/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css"
          rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

    {{--  Editor  --}}

    <!-- include summernote css/js-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">

    <!-- KaTeX -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.9.0/katex.min.css" rel="stylesheet">


@endpush

@section ('contents')
    
    <form method="post" action="{{route('admin.assessment-question.update',$question->id)}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Edit Question for <span class="text-primary">{!!  $question->question_text!!}</span>
                        </h4>
                    </div>
                    <div class="card-body p-4">

                        <div class="row">

                            <div class="col-lg-6">
                                <div>

{{--                                    <input type="number" hidden name="course_id" value="{{$course->id}}">--}}

                                    <div class="mb-3">
                                        <label class="form-label">Select Assessment *</label>
                                        <select class="form-control" name="assessment_id" required>

                                            @forelse($assessments as $assessment)
                                                <option value="{{$assessment->id}}" @if($question->assessment_id == $assessment->id) selected @endif>{{$assessment->title}}</option>
                                            @empty
                                            @endforelse

                                        </select>
                                    </div>

                                    <div class="mb-3">

                                        <label class="form-label">Select Question Image </label>
                                        <input type="file" class="form-control" name="question_image">

                                        @if($question->question_image)
                                            
                                            <div class="imgPrev mt-1">
                                                <img src="{{asset($question->question_image)}}" class="img-fluid" width="300px" alt="">
                                            </div>
                                        @endif

                                    </div>


                                    <div class="mb-3">
                                        <label for="question_text" class="form-label">Question Text *</label>
                                        <textarea class="form-control" id="question_text" name="question_text"
                                                    cols="3" rows="1">{{$question->question_text}}</textarea>
                                    </div>

                                  

                                    <div class="mb-3">
                                        <label for="desc" class="form-label">Question Marks *</label>
                                        <input type="number" class="form-control" id="marks" min="1" value="{{$question->marks ?? ''}}" name="marks" required>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-1" id="optionMultiple">
                                    <label  class="form-label">Options *</label>
                                    <div id="optionMultiple">
                                        @forelse(json_decode($question->options) as $key=>$option) 
                                        <div class="input-group mb-1 option-item">
                                            <span class="input-group-text">{{ $key }}</span>
                                            <textarea class="form-control options" name="options[]"  rows="1">{{$option}}</textarea>
                                            <button type="button" class="btn btn-danger remove-option"><i class="mdi mdi-close text-light"></i></button>
                                        </div>
                                        @empty
                                        @endforelse
                                    </div>
                                </div>
{{--                                <div class="mb-3">--}}
{{--                                    <button type="button" id="add-option" class="btn btn-sm btn-secondary">Add Option</button>--}}
{{--                                </div>--}}

                                <div class="mb-3">
                                    <label for="desc" class="form-label">Correct Answer </label>
                                    <textarea class="form-control" id="correct_answers" name="correct_answers" 
                                        cols="3" rows="1" readonly>{{$question->correct_answers}}</textarea>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="correct_option" class="form-label">Correct Option *</label>
                                    <select class="form-select form-control" name="correct_option" id="correct_option">
                                        <option value="A" @if($question->correct_option == 'A') selected @endif>A</option>
                                        <option value="B" @if($question->correct_option == 'B') selected @endif>B</option>
                                        <option value="C" @if($question->correct_option == 'C') selected @endif>C</option>
                                        <option value="D" @if($question->correct_option == 'D') selected @endif>D</option>
                                    </select>
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
    
@endsection

@push('backendJs')

    {{--  CkEditor CDN  --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

    <!-- summernote css/js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.9.0/katex.min.js"></script>
    <script src="{{asset('backend/assets/js/summernote-math.js')}}"></script>




    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('backend')}}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('backend')}}/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#question_text').summernote({
                height: 100,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['insert', ['picture', 'link', 'math']],
                    ['para', ['paragraph']],
                    ['misc', ['codeview']]
                ],
            });

            $('#correct_answers').summernote({
                height: 50,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['insert', ['picture', 'link', 'math']],
                    ['para', ['paragraph']],
                    ['misc', ['codeview']]
                ],
            });


        });
        
        //Options
        $(document).ready(function () {
            let optionCount = 1;
            
            $('.options').summernote({
                height: 40,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['insert', ['picture', 'link', 'math']],
                    ['para', ['paragraph']],
                    ['misc', ['codeview']]
                ],
            });

            // Add new option
            $('#add-option').click(function () {
                optionCount++;
                const newOption = `   <div class="input-group mb-1 option-item" >
                                     <textarea class="form-control options" id="options" name="options[]" cols="3" rows="1"></textarea>

                                     <button type="button" class="btn btn-danger remove-option"><i class="mdi mdi-close"></i></button>
                                 </div>`;


                $('#optionMultiple').append(newOption);

                // Reinitialize Summernote for the newly added textarea
                $('#optionMultiple .options').last().summernote({
                    height: 40,
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['insert', ['picture', 'link', 'math']],
                        ['para', ['paragraph']],
                        ['misc', ['codeview']]
                    ]
                });


            });



            // Remove option
            $(document).on('click', '.remove-option', function () {
                $(this).closest('.option-item').remove();
            });
        });

    </script>

    <script>
        //Delete Question
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