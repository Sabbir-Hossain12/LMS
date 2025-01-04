
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
        <a class="nav-link ">
            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
            <span class="d-none d-sm-block">Lesson</span>
        </a>
    </li>

    <li class="nav-item waves-effect waves-light">
        <a class="nav-link">
            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
            <span class="d-none d-sm-block">Lesson Videos</span>
        </a>
    </li>

    <li class="nav-item waves-effect waves-light">
        <a class="nav-link">
            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
            <span class="d-none d-sm-block">Lesson Exams</span>
        </a>
    </li>

    <li class="nav-item waves-effect waves-light">
        <a class="nav-link">
            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
            <span class="d-none d-sm-block">Lesson Assignments</span>
        </a>
    </li>


</ul>
    
</div>