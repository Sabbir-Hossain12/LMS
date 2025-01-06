<!-- animate condtent start-->

@if($classes->count()>0) 
<div class="animate__content sp_bottom_40 sp_top_40">
    <div class="container-fluid full__width__padding">
        <div class="animate__content__wrap">

            @forelse($classes as $key=> $class) 
            <div class="single__service">
                <div class="service__img">

                    <i class="fas {{$class->icon}}" style="font-size: 30px">
                        
                    </i>
                    
                </div>
                
                <div class="service__content">
                    <h3><a href="#">{{$class->title}}</a></h3>
                    <p>{{$class->subtitle}}</p>
                </div>
                <div class="service__small__img">
                    <svg class="icon__hover__img" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16.5961 10.265L19 1.33069L10.0022 3.73285L1 6.1306L7.59393 12.6627L14.1879 19.1992L16.5961 10.265Z" stroke="#FFB31F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
               
            @empty
            @endforelse
            


        </div>
    </div>
</div>
@endif
<!-- animate condtent end-->