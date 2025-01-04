@extends('backend.layout.master')

@push('backendCss')


@endpush

@section ('contents')

    <div class="row">
        <div class="col-12">
            @include('backend.include.course-tab')
        </div>
    </div>

    <form method="post" action="{{route('admin.course.store')}}" enctype="multipart/form-data">
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
                                        <label for="desc" class="form-label">Description</label>
                                        <textarea id="desc" name="desc" class="form-control" required></textarea>
                                    </div>

                                

                                    <div class="mb-3">
                                        <label for="pageStatus" class="form-label">Featured Status</label>
                                        <select id="pageStatus" class="form-select form-control" name="is_featured" required>
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
                                <div class="mb-3">
                                    <label for="img" class="form-label">Image</label>
                                    <input class="form-control" type="file" id="img" name="img" required>
                                </div>

                                <div class="mb-3">
                                    <label for="icon" class="form-label">Icon</label>
                                    <input class="form-control" type="text" id="icon" name="icon" required>
                                </div>
                                <div class="mb-3">
                                    <label for="position" class="form-label">Position</label>
                                    <input class="form-control" type="number" id="position" name="position" required>
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