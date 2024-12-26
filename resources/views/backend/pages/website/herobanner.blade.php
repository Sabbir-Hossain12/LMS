@extends('backend.layout.master')

@push('backendCss')
    <link href="{{asset('backend')}}/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css"
          rel="stylesheet" type="text/css">

@endpush

@section('contents')

{{--    <div class="row">--}}
{{--        <div class="col-12">--}}
{{--            <div class="page-title-box d-sm-flex align-items-center justify-content-between">--}}
{{--                <h4 class="mb-sm-0 font-size-18">Basic Info</h4>--}}

{{--                <div class="page-title-right">--}}
{{--                    <ol class="breadcrumb m-0">--}}
{{--                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>--}}
{{--                        <li class="breadcrumb-item active">Basic-info</li>--}}
{{--                    </ol>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    {{--    Form Starts--}}
        @if(isset($heroBanner)) 
        <form method="post" action="{{route('admin.herobanner.update',$heroBanner->id)}}" enctype="multipart/form-data">
            @method('PUT')
         @else
          <form method="post" action="{{route('admin.herobanner.store')}}" enctype="multipart/form-data">
             
        @endif
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Hero Banner</h4>

                    </div>
                    <div class="card-body p-4">

                        <div class="row">
                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">
                                        <label for="video_thumbnail_img" class="form-label">Thumbnail Image (550px x 420px)</label>
                                        <input oninput="bLogoImgPrev.src=window.URL.createObjectURL(this.files[0])"
                                               class="form-control" type="file" name="video_thumbnail_img"
                                               id="video_thumbnail_img">
                                        @if( $heroBanner &&$heroBanner->video_thumbnail_img) 
                                        <img id="bLogoImgPrev" class="mt-1" src="{{asset($heroBanner->video_thumbnail_img)}}"
                                             height="100px" width="100px" alt=""/>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <label for="short_title" class="form-label">Short Title</label>
                                        <input class="form-control" type="text" name="short_title"
                                               placeholder=""
                                               id="short_title" value="{{$heroBanner->short_title ?? ''}}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="main_title" class="form-label">Main Title</label>
                                        <input class="form-control" name="main_title" type="text"
                                               placeholder=""
                                               id="main_title" value="{{$heroBanner->main_title ?? ''}}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="sub_title" class="form-label">Sub Title</label>
                                        <input class="form-control" name="sub_title" type="text"
                                               placeholder=""
                                               id="sub_title" value="{{$heroBanner->sub_title ?? ''}}">
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mt-3 mt-lg-0">
                                
                                    <div class="mb-3">
                                        <label for="video_url" class="form-label">Video URL</label>
                                        <input class="form-control" name="video_url" type="text"
                                               placeholder=""
                                               id="video_url" value="{{$heroBanner->video_url ?? ''}}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="insta_link" class="form-label">Button 1 Text</label>
                                        <input class="form-control" name="btn1_text" type="text"
                                               placeholder=""
                                               id="btn1_text" value="{{$heroBanner->btn1_text ?? ''}}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="btn1_link" class="form-label">Button 1 Link</label>
                                        <input class="form-control" type="text" placeholder=""
                                               id="btn1_link" name="btn1_link"
                                               value="{{$heroBanner->btn1_link ?? ''}}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="btn2_text" class="form-label">Button 2 Text</label>
                                        <input class="form-control" name="btn2_text" type="text"
                                               placeholder=""
                                               id="btn2_text" value="{{$heroBanner->btn2_text ?? ''}}">
                                    </div>
                                    

                                    <div class="mb-3">
                                        <label for="btn2_link" class="form-label">Button 2 Link</label>
                                        <input type="text" id="btn2_link" name="btn2_link"
                                               class="form-control" value="{{$heroBanner->btn2_link ?? ''}}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-4 d-grid">
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
      
    </form>
@endsection

@push('backendJs')


@endpush