<div class="dashboard__content__wraper" id="attemptSection">
    <div class="dashboard__section__title">
        <h4>Leaderboard</h4>
    </div>


    <div class="row">

        <div class="col-xl-12">
            <div class="dashboard__table table-responsive">
                <table>
                    <thead>
                    <tr>
                        <th>SL</th>
                        <th>Student</th>
                        <th>Course Title</th>
                        <th>Exam Title</th>
                        <th>Total Marks</th>
                        <th>Obtained Mark</th>
                    </tr>
                    </thead>
                    <tbody>
                        
                        @forelse($lists as $key=>$list)
                        <tr>
                            <td>
                                <p>{{$key+1 }}</p>
                            </td>
                            
                            <td>
                                <p>{{ $list->student->name ?? '' }}</p>
                            </td>
                            
                            <td>
                                <p> {{$list->assessment->course->title ?? ''}} </p>
                            </td>

                            <td>
                                <p>{{$list->assessment->title ?? ''}}</p>
                            </td>
                            
                            <td>
                                <p>{{$list->assessment->total_marks ?? ''}}</p>
                            </td>
                            
                            <td>
                                <p>{{$list->marks_obtained ?? ''}}</p>
                            </td>
                            
                            @empty
                            
                            @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>