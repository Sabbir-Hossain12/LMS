<div class="dashboard__content__wraper">
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
                        <th></th>
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
                                <div class="dashboard__button__group">
                                    <a class="dashboard__small__btn__2" href="#"> <i class="icofont-eye"></i>View</a>
                                </div>
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