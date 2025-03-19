<div class="dashboard__content__wraper" id="attemptSection">
    <div class="dashboard__section__title">
        <h4>My Exam Attempts</h4>
    </div>


    <div class="row">

        <div class="col-xl-12">
            <div class="dashboard__table table-responsive">
                <table>
                    <thead>
                    <tr>
                        <th>Course Title</th>
                        <th>Exam Title</th>
                        <th>Total Marks</th>
                        <th>Obtained Mark</th>
                        <th>Attempts</th>
                        <th>View</th>
                        <th>Leaderboards</th>
                        
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($grades as $grade)
                        <tr>
                            <td>
                                <p>{{$grade->assessment->course->title ?? ''}}</p>
                            </td>

                            <td>
                                <p>{{$grade->assessment->title ?? ''}}</p>
                            </td>
                            
                            <td>
                                <p>{{$grade->assessment->total_marks ?? ''}}</p>
                            </td>
                            
                            <td>
                                <p>{{$grade->marks_obtained ?? ''}}</p>
                            </td>
                            

                            <td>
                                @if($grade->assessment->type == 'quiz')
                                    
                                <p>{{$grade->attempts ?? ''}}</p>
                                    
                                @else
                                    <p>{{$grade->assessmentAnswer->attempts ?? ''}}</p>
                                    
                                @endif
                            </td>
                            

                            <td>
                                @if($grade->assessment->type == 'quiz')
                                <div class="dashboard__button__group">
                                    <a href="javascript:void(0);" class="dashboard__small__btn__2 examSolutionBtn" data-id="{{$grade->assessment->id}}"> <i class="icofont-eye"></i>View</a>
                                </div>
                                    
                                @else
                                <div class="dashboard__button__group">
                                    <a href="{{asset($grade->teacher_upload)}}" class="dashboard__small__btn__2" download> <i class="icofont-eye"></i>View</a>
                                @endif
                            </td>
                            
                             <td>
                                @if($grade->assessment->attempt_type == 'Single')
                                <div class="dashboard__button__group">
                                    <a href="javascript:void(0);" class="dashboard__small__btn__2 examLeaderboardBtn" data-id="{{$grade->assessment->id}}"> <i class="icofont-eye"></i>View</a>
                                </div>
                                @endif
                            </td>
                            
                        </tr>
                    @empty
                    @endforelse


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>