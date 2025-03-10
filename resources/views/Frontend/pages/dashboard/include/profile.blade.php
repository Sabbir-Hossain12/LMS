<style>
    .dashboard__section__title2
    {
        margin-bottom: 24px;
        padding-bottom: 20px;
        margin-top: 24px;
        padding-top: 20px;
        border-top: 2px solid var(--borderColor);
        border-bottom: 2px solid var(--borderColor);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>

<div class="dashboard__content__wraper" id="profileSection">
    <div class="dashboard__section__title">
        <h4>My Profile</h4>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-4">
            <div class="dashboard__form">Registration Date</div>
        </div>
        <div class="col-lg-8 col-md-8">
            <div class="dashboard__form">{{$student->created_at->format('d M Y h:i A')}}</div>
        </div>
        <div class="col-lg-4 col-md-4">
            <div class="dashboard__form dashboard__form__margin">Name</div>
        </div>
        <div class="col-lg-8 col-md-8">
            <div class="dashboard__form dashboard__form__margin">{{$student->name ?? ''}}</div>
        </div>

        <div class="col-lg-4 col-md-4">
            <div class="dashboard__form dashboard__form__margin">Email</div>
        </div>
        <div class="col-lg-8 col-md-8">
            <div class="dashboard__form dashboard__form__margin">{{$student->email ?? ''}}</div>
        </div>
        <div class="col-lg-4 col-md-4">
            <div class="dashboard__form dashboard__form__margin">Phone Number</div>
        </div>
        <div class="col-lg-8 col-md-8">
            <div class="dashboard__form dashboard__form__margin">{{$student->phone ?? ''}}</div>
        </div>
  
        <div class="col-lg-4 col-md-4">
            <div class="dashboard__form dashboard__form__margin">Address</div>
        </div>
        <div class="col-lg-8 col-md-8">
            <div class="dashboard__form dashboard__form__margin">{{$student->address ?? ''}}</div>
        </div>
        
    </div>

    <div class="dashboard__section__title2">
        <h4>Social Media Links</h4>
    </div>


    <div class="row">
        

        <div class="col-lg-4 col-md-4">
            <div class="dashboard__form dashboard__form__margin">Facebook Link</div>
        </div>
        <div class="col-lg-8 col-md-8">
            <div class="dashboard__form dashboard__form__margin">{{$student->fb_link ?? ''}}</div>
        </div>

        <div class="col-lg-4 col-md-4">
            <div class="dashboard__form dashboard__form__margin">Youtube Link</div>
        </div>
        <div class="col-lg-8 col-md-8">
            <div class="dashboard__form dashboard__form__margin">{{$student->youtube_link ?? ''}}</div>
        </div>


        <div class="col-lg-4 col-md-4">
            <div class="dashboard__form dashboard__form__margin">Instagram Link</div>
        </div>
        <div class="col-lg-8 col-md-8">
            <div class="dashboard__form dashboard__form__margin">{{$student->insta_link ?? ''}}</div>
        </div>

        <div class="col-lg-4 col-md-4">
            <div class="dashboard__form dashboard__form__margin">Twitter Link</div>
        </div>
        <div class="col-lg-8 col-md-8">
            <div class="dashboard__form dashboard__form__margin">{{$student->twitter_link ?? ''}}</div>
        </div>

    </div>
    
</div>