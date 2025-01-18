
<div class="card-body">

<ul class="nav nav-pills nav-justified">
    
    
    
    <li class="nav-item waves-effect waves-light">
        <a href="{{route('admin.course.edit',$course->id)}}" class="nav-link @if(request()->routeIs('admin.course.edit')) active @endif">
            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
            <span class="d-none d-sm-block">Course Details</span>
        </a>
    </li>

    <li class="nav-item waves-effect waves-light">
        <a href="{{route('admin.subject',$course->id)}}" class="nav-link @if(request()->routeIs('admin.subject')) active @endif">
            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
            <span class="d-none d-sm-block">Subjects</span>
        </a>
    </li>

    <li class="nav-item waves-effect waves-light">
        <a class="nav-link @if(request()->routeIs('admin.lesson')) active @endif" href="{{route('admin.lesson',$course->id)}}">
            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
            <span class="d-none d-sm-block">Lesson</span>
        </a>
    </li>

    <li class="nav-item waves-effect waves-light">
        <a class="nav-link  @if(request()->routeIs('admin.lesson-video')) active @endif" href="{{route('admin.lesson-video',$course->id)}}">
            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
            <span class="d-none d-sm-block">Videos</span>
        </a>
    </li>
{{--    lesson-material--}}
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link @if(request()->routeIs('admin.lesson-material')) active @endif" href="{{route('admin.lesson-material',$course->id)}}">
            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
            <span class="d-none d-sm-block">Materials</span>
        </a>
    </li>
{{--lesson-assessment--}}
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link @if(request()->routeIs('admin.lesson-assessment')) active @endif" href="{{route('admin.lesson-assessment',$course->id)}}">
            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
            <span class="d-none d-sm-block">Exams</span>
        </a>
    </li>
    {{--Questions--}}
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link @if(request()->routeIs('admin.assessment-question')) active @endif" href="{{route('admin.assessment-question',$course->id)}}">
            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
            <span class="d-none d-sm-block">Questions</span>
        </a>
    </li>


</ul>
    
</div>