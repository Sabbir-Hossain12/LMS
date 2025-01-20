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

    <form method="post" action="{{route('admin.enrolment.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Enroll a Student to This Course
                        </h4>
                    </div>
                    <div class="card-body p-4">

                        <div class="row">

                            <div class="col-lg-6">
                                <div>

                                    <input type="number" hidden name="course_id" value="{{$course->id}}">

                                    <div class="mb-3">
                                        <label class="form-label">Select Student *</label>
                                        <select class="form-control" name="user_id" required>
                                            
                                            @forelse($students as $student)
                                                <option value="{{$student->id}}">{{$student->name}} ({{$student->phone}})</option>
                                            @empty
                                            @endforelse

                                        </select>
                                    </div>
                                  

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
                        <h4 class="card-title">Enrolment List</h4>
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
                                <th>Student Name</th>
                                <th>Student Phone</th>
                                <th>Enrolment Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($enrolments as $key=> $enrolment)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$enrolment->student->name }}</td>
                                    <td>{{$enrolment->student->phone }}</td>
                                    <td>{{$enrolment->enrolled_at->format('d M Y') }}</td>
                                    
                                    <td>
                                        @if($enrolment->status == 1)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            <a href="" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                            <form method="post" id="delete-form-{{$enrolment->id}}" action="{{route('admin.enrolment.destroy',$enrolment->id)}}">
                                                @csrf
                                                @method('delete')
                                                <button type="button" data-id="{{$enrolment->id}}" class="btn btn-sm btn-danger delete-btn">
                                                    <i class="fas fa-trash"></i>
                                                </button>
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