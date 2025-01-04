@extends('backend.layout.master')

@push('backendCss')


@endpush

@section ('contents')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Create New Page</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                        <li class="breadcrumb-item active">Create New Course</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    
    <form method="post" action="{{route('admin.course.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Course Information</h4>

                    </div>
                    <div class="card-body p-4">

                        <div class="row">

                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">
                                        <label class="form-label">Course Title</label>
                                        <input class="form-control" type="text" placeholder="Course Title"
                                               id="name" name="title" required>
                                        </div>
                                    
                                    <div class="mb-3">
                                        <label  class="form-label">Select Class</label>
                                        <select  class="form-select form-control" name="course_class_id" required>
                                            @foreach($classes as $class) 
                                            <option value="{{$class->id}}">{{$class->title}}</option>
                                         
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="type" class="form-label">Select Teacher</label>
                                        <select id="type" class="form-select form-control" name="teacher_id" required>
                                            @foreach($teachers as $teacher)
                                                <option value="{{$teacher->id}}">{{$teacher->name}}</option>

                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="short_desc" class="form-label">Short Description</label>
                                        <textarea id="short_desc" name="short_desc" class="form-control" required></textarea>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="thumbnail_img" class="form-label">Thumbnail Image</label>
                                        <input class="form-control" type="file" id="thumbnail_img" name="thumbnail_img" required>
                                    </div>


                                    <div class="mb-3">
                                        <label for="pageStatus" class="form-label">Certificate Status</label>
                                        <select id="pageStatus" class="form-select form-control" name="is_certificate" required>
                                            <option value="1" selected>Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
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
                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">
                                        <label for="duration" class="form-label">Course Duration</label>
                                        <input class="form-control" type="text" placeholder="Course Duration"
                                               id="duration" name="duration">
                                    </div>

                                    <div class="mb-3">
                                        <label for="regular_price" class="form-label">Regular Price</label>
                                        <input class="form-control" type="number"
                                               id="regular_price" name="regular_price" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="sale_price" class="form-label">Sale Price</label>
                                        <input class="form-control" type="number"
                                               id="sale_price" name="sale_price" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="discount" class="form-label">Discount (TK)</label>
                                        <input class="form-control" type="number"
                                               id="discount" name="discount" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="details_img" class="form-label">Details Image</label>
                                        <input class="form-control" type="file" id="details_img" name="details_img" required>
                                    </div>


                                    <div class="mb-3">
                                        <label for="pageStatus" class="form-label">Featured Status</label>
                                        <select id="pageStatus" class="form-select form-control" name="is_featured" required>
                                            <option value="1" selected>Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="pageStatus" class="form-label">Exam Status</label>
                                        <select id="pageStatus" class="form-select form-control" name="is_exam" required>
                                            <option value="1" selected>Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12">

                                <div class="mb-3">
                                    <label for="long_desc" class="form-label">Long Description</label>
                                    <textarea id="long_desc" name="long_desc"></textarea>
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
            </div> <!-- end col -->
        
        
        <div class="text-center mt-4 d-grid">
            <button type="submit" class="btn  btn-primary">Update</button>
        </div>
    </form>
@endsection

@push('backendJs')

    {{--  CkEditor CDN  --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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