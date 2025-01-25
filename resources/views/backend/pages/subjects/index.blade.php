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

    <form method="post" action="{{route('admin.subject.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Create Subject</h4>
                    </div>
                    <div class="card-body p-4">

                        <div class="row">

                            <div class="col-lg-6">
                                <div>
                                    <input type="number" hidden name="course_id" value="{{$course->id}}">
                                    <div class="mb-3">
                                        <label class="form-label">Subject Title</label>
                                        <input class="form-control" type="text" placeholder="Course Title"
                                               id="name" name="title" required>
                                    </div>
                                    

                                    <div class="mb-3">
                                        <label for="subtitle" class="form-label">Subtitle</label>
                                        <textarea id="subtitle" name="subtitle" class="form-control"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="icon" class="form-label">Icon</label>
                                        <input class="form-control" type="text" id="icon" name="icon" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="pageStatus" class="form-label">Featured Status</label>
                                        <select id="pageStatus" class="form-select form-control" name="is_featured" required>
                                            <option value="1" selected>Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                    

                                   

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="img" class="form-label">Image</label>
                                    <input class="form-control" type="file" id="img" name="img">
                                </div>
                                <div class="mb-3">
                                    <label for="desc" class="form-label">Description</label>
                                    <textarea id="desc" name="desc" class="form-control" required></textarea>
                                </div>

                             
                                
                                <div class="mb-3">
                                    <label for="position" class="form-label">Position</label>
                                    <input class="form-control" type="number" id="position" name="position" required>
                                </div>

                                <div class="mb-3">
                                    <label for="pageStatus" class="form-label">Status</label>
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
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-center">Meta Information</h4>

                </div>
                <div class="card-body p-4">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="meta_title" class="form-label">Meta Title</label>
                                <input class="form-control" type="text" placeholder="Meta Title"
                                       id="meta_title" name="meta_title">
                            </div>
                            <div class="mb-3">
                                <label for="meta_keyword" class="form-label">Meta Keywords</label>
                                <input class="form-control" type="text" placeholder="Enter Meta Keywords"
                                       id="meta_keyword" name="meta_keywords">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="meta_desc" class="form-label">Meta Description</label>
                                <textarea id="meta_desc" name="meta_desc" class="form-control"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="meta_img" class="form-label">Meta Image</label>
                                <input class="form-control" type="file" id="meta_img" name="meta_img">
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
                        <h4 class="card-title">Subject List</h4>
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
                                <th>Subject Name</th>
                                <th>Course Title</th>
                                <th>position</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($subjects as $key=> $subject)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$subject->title}}</td>
                                    <td>{{$subject->course->title}}</td>
                                    <td>{{$subject->position}}</td>
                                    <td>
                                        @if($subject->status == 1)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            <a href="{{route('admin.subject.edit',$subject->id)}}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                            <form method="post" id="delete-form-{{$subject->id}}" action="{{route('admin.subject.destroy',$subject->id)}}">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-sm btn-danger delete-btn" data-id="{{$subject->id}}"><i class="fas fa-trash"></i></button>
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