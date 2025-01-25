@extends('backend.layout.master')

@push('backendCss')
    {{--    <meta name="csrf_token" content="{{ csrf_token() }}" />--}}

    <link href="{{asset('backend')}}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css"
          rel="stylesheet" type="text/css">
    <link href="{{asset('backend')}}/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css"
          rel="stylesheet" type="text/css">

@endpush

@section('contents')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Teachers</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                        <li class="breadcrumb-item active">Teachers</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    {{-- Table Starts--}}

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">

                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Teachers List</h4>
{{--                       @can('Create Admin')--}}
{{--                       @if(Auth::guard('admin')->user()->can('Create Admin'))--}}
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createAdminModal">
                                Add Teacher 
                            </button>
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Actions</th>
                                    
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>

    {{--    Table Ends--}}

    {{--    Create Admin Modal--}}
    <div class="modal fade" id="createAdminModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Teacher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form name="form" id="createAdmin">
                        @csrf

                        <div class="mb-3">
                            <label for="Name" class="col-form-label">Teacher Name</label>
                            <input type="text" class="form-control" id="Name" name="name" placeholder="Ayman Sadik">
                        </div>

                        <div class="mb-3">
                            <label  class="col-form-label">Teacher Title</label>
                            <input type="text" class="form-control"  name="instructor_title" placeholder="4th Year, DU">
                        </div>
                        <div class="mb-3">
                            <label  class="col-form-label">Teacher Description</label>
                            <textarea type="text" class="form-control"  name="short_desc" ></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="col-form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="xyz@gmail.com">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="col-form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="+88017XXXXXXXX">
                        </div>

                        <div class="mb-3">
                            <label for="profile_image" class="col-form-label">Profile Image</label>
                            <input type="file" class="form-control" id="profile_image" name="profile_image">
                        </div>

                        <div class="mb-3">
                            <label for="role" class="col-form-label">Role</label>
                            <select name="role" id="role"  class="form-control">

                                @forelse($roles as $role)
                                    <option value="{{$role->name}}" @if($role->name == 'teacher') selected @endif>{{$role->name}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="col-form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--    Edit Categories Modal--}}
    <div class="modal fade" id="editAdminModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Teacher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form name="form2" id="editAdmin" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="eName" class="col-form-label">Full Name</label>
                            <input type="text" id="eName" class="form-control" name="name">
                        </div>

                        <div class="mb-3">
                            <label  class="col-form-label">Teacher Title</label>
                            <input type="text" class="form-control" id="eInstructor_title"  name="instructor_title" placeholder="4th Year, DU">
                        </div>
                        
                        <div class="mb-3">
                            <label  class="col-form-label">Teacher Description</label>
                            <textarea type="text" class="form-control" id="eShort_desc"  name="short_desc" ></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="eEmail" class="col-form-label">Email</label>
                            <input type="text" id="eEmail" class="form-control" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="ePhone" class="col-form-label">Phone</label>
                            <input type="text" id="ePhone" class="form-control" name="phone">
                        </div>

                        <div class="mb-3">
                            <label for="profile_image" class="col-form-label">Profile Image</label>
                            <input type="file" class="form-control" id="eProfile_image" name="profile_image"
                                   oninput="profileImg.src=window.URL.createObjectURL(this.files[0])">
                            
                            <div id="profileImgPrev" class="mt-1">
                                
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="eType" class="col-form-label">Roles</label>
                            <select name="role" id="rolesId" class="form-control">
                                
                              
                                
                            </select>
                        </div>
                      
                        <input id="id" type="number" hidden>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('backendJs')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('backend')}}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('backend')}}/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

    <script>

        $(document).ready(function () {
            
            var token = $("input[name='_token']").val();

            //Show Data through Datatable 
            let adminTable = $('#adminTable').DataTable({
                order: [
                    [0, 'asc']
                ],
                processing: true,
                serverSide: true,
                {{--ajax: "{{url('/admin/data')}}",--}}
                ajax: "{{route('admin.teacher.data')}}",
                // pageLength: 30,

                columns: [
                    {
                        data: 'id',


                    },
                    {
                        data: 'name',

                    },
                    {
                        data: 'email',

                    },
                    {
                        data:'role'
                    },
                    {
                        data: 'status',
                        name: 'Status',
                        orderable: false,
                        searchable: false,
                    },

                    {
                        data: 'action',
                        name: 'Actions',
                        orderable: false,
                        searchable: false
                    },

                ]
            });


            // Create Admin
            $('#createAdmin').submit(function (e) {
                e.preventDefault();
            
                let formData = new FormData(this);
            
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('admin.teacher.store') }}",
                    data: formData,
                    processData: false,  // Prevent jQuery from processing the data
                    contentType: false,  // Prevent jQuery from setting contentType
                    success: function (res) {
                        if (res.status === 'success') {
                            $('#createAdminModal').modal('hide');
                            $('#createAdmin')[0].reset();
                            adminTable.ajax.reload()
                            swal.fire({
                                title: "Success",
                                text: "Teacher Added !",
                                icon: "success"
                            })
            
            
                        }
                    },
                    error: function (err) {
                        console.error('Error:', err);
                        swal.fire({
                            title: "Failed",
                            text: "Something Went Wrong !",
                            icon: "error"
                        })
                        // Optionally, handle error behavior like showing an error message
                    }
                });
            });
            
            // Edit Admin Data
            $(document).on('click', '.editButton', function () {
                let id = $(this).data('id');
                $('#id').val(id);
            
                $.ajax(
                    {
                        type: "GET",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ url('admin/teachers') }}/" + id + "/edit",
                        data: {
                            id: id
                        },
            
                        processData: false,  // Prevent jQuery from processing the data
                        contentType: false,  // Prevent jQuery from setting contentType
                        success: function (res) {
            
                            console.log(res)
                            $('#eName').val(res.data.name);
                            $('#eEmail').val(res.data.email);
                            $('#ePhone').val(res.data.phone);
                            $('#eShort_desc').val(res.data.short_desc);
                            $('#eInstructor_title').val(res.data.instructor_title);
            
                            $('#profileImgPrev').empty();
                            $('#profileImgPrev').append(
                                `<img id="profileImg" src="{{asset('')}}${res.data.profile_image}" width="100px" height="100px">`
                            );
                            
                            
                            $('#rolesId').empty();
                            // Append a default option (optional)
                            $('#rolesId').append('<option value="">Select a Role</option>');
            
                            // Iterate over the response data and append each role as an option
                            $.each(res.roles, function(index, role) {

                                let sel = res.data.roles.some(userRole => userRole.name === role.name) ? 'selected' : '';
                                
                                $('#rolesId').append(
                                    `<option value="${role.name}" ${sel}>${role.name}</option>`
                                );
                            });
                        },
                        error: function (err) {
                            console.log('failed')
                        }
                    }
                )
            })
            
            // Update Admin Data
            $('#editAdmin').submit(function (e) {
                e.preventDefault();
                let id = $('#id').val();
                let formData = new FormData(this);
            
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('admin/teachers') }}/" + id,
                    data: formData,
                    processData: false,  // Prevent jQuery from processing the data
                    contentType: false,  // Prevent jQuery from setting contentType
                    success: function (res) {
                        if (res.status === 'success') {
                            $('#editAdminModal').modal('hide');
                            $('#editAdmin')[0].reset();
                            adminTable.ajax.reload()
                            swal.fire({
                                title: "Success",
                                text: "Teacher Updated !",
                                icon: "success"
                            })
            
            
                        }
                    },
                    error: function (err) {
                        console.error('Error:', err);
                        swal.fire({
                            title: "Failed",
                            text: "Something Went Wrong !",
                            icon: "error"
                        })
                        // Optionally, handle error behavior like showing an error message
                    }
                });
            });
            
            
            // Delete Admin
            $(document).on('click', '#deleteAdminBtn', function () {
                let id = $(this).data('id');
            
                swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this !",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, delete it!"
                })
                    .then((result) => {
                        if (result.isConfirmed) {
            
            
                            $.ajax({
                                type: 'DELETE',
            
                                url: "{{ url('admin/teachers') }}/" + id,
                                data: {
                                    '_token': token
                                },
                                success: function (res) {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: "Teacher has been deleted.",
                                        icon: "success"
                                    });
            
                                    adminTable.ajax.reload();
                                },
                                error: function (err) {
                                    console.log('error')
                                }
                            })
            
            
                        } else {
                            swal.fire('Your Data is Safe');
                        }
            
                    })
            
            
            })
            
            // Change Teacher Status
            $(document).on('click', '#adminStatus', function () {
                let id = $(this).data('id');
                let status = $(this).data('status')
                console.log(id + status)
                $.ajax(
                    {
                        type: 'post',
                        url: "{{route('admin.teacher.status')}}",
                        data: {
                            '_token': token,
                            id: id,
                            status: status
            
                        },
                        success: function (res) {
                            adminTable.ajax.reload();
            
                            if (res.status == 1) {
            
                                swal.fire(
                                    {
                                        title: 'Status Changed to Active',
                                        icon: 'success'
                                    })
                            } else {
                                swal.fire(
                                    {
                                        title: 'Status Changed to Inactive',
                                        icon: 'success'
                                    })
            
                            }
                        },
                        error: function (err) {
                            console.log(err)
                        }
                    }
                )
            })
        });
    </script>

@endpush