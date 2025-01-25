<div class="dashboard__content__wraper">
    <div class="dashboard__section__title">
        <h4>My Profile</h4>
    </div>
    <div class="row">
        <div class="col-xl-12 aos-init aos-animate" data-aos="fade-up">
            <ul class="nav  about__button__wrap dashboard__button__wrap" id="myTab"
                role="tablist">
                
                <li class="nav-item" role="presentation">
                    <button class="single__tab__link active" data-bs-toggle="tab"
                            data-bs-target="#projects__one" type="button" aria-selected="true"
                            role="tab">Profile
                    </button>
                </li>
                
                <li class="nav-item" role="presentation">
                    <button class="single__tab__link" data-bs-toggle="tab"
                            data-bs-target="#projects__two" type="button" aria-selected="false"
                            role="tab" tabindex="-1">Password
                    </button>
                </li>
                
                <li class="nav-item" role="presentation">
                    
                    <button class="single__tab__link" data-bs-toggle="tab"
                            data-bs-target="#projects__three" type="button" aria-selected="false"
                            role="tab" tabindex="-1">Social Icon
                    </button>
                    
                </li>

            </ul>
        </div>


        <div class="tab-content tab__content__wrapper aos-init aos-animate" id="myTabContent"
             data-aos="fade-up">

            <div class="tab-pane fade active show" id="projects__one" role="tabpanel"
                 aria-labelledby="projects__one">
                <div class="row">
                    <div class="col-xl-12">

                        <form id="profileUpdateForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-xl-6">
                                    <div class="dashboard__form__wraper">
                                        <div class="dashboard__form__input">
                                            <label for="#">Profile Image</label>
                                            <input type="file" name="profile_image" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="dashboard__form__wraper">
                                        <div class="dashboard__form__input">
                                            <label for="">Full Name</label>
                                            <input type="text" name="name" value="{{$student->name ?? ''}}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="dashboard__form__wraper">
                                        <div class="dashboard__form__input">
                                            <label for="#">Phone Number</label>
                                            <input type="text" name="phone" readonly value="{{$student->phone}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="dashboard__form__wraper">
                                        <div class="dashboard__form__input">
                                            <label for="#">Email</label>
                                            <input type="text" name="email" value="{{$student->email ?? ''}}">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-xl-12">
                                    <div class="dashboard__form__wraper">
                                        <div class="dashboard__form__input">
                                            <label for="#">Address</label>
                                            <textarea name="address" id="" cols="20"
                                                      rows="5">{{$student->address ?? ''}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="dashboard__form__button">
                                        <button class="default__button" type="submit">Update Info</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            <div class="tab-pane fade" id="projects__two" role="tabpanel"
                 aria-labelledby="projects__two">

                <form id="updatePasswordForm">
                    @csrf
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="dashboard__form__wraper">
                                <div class="dashboard__form__input">
                                    <label for="#">Current Password</label>
                                    <input type="password" class="form-control" name="current_password"
                                           placeholder="Current password" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-12">
                            <div class="dashboard__form__wraper">
                                <div class="dashboard__form__input">
                                    <label for="#">New Password</label>
                                    <input type="password" name="password" class="form-control"
                                           placeholder="New Password" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-12">
                            <div class="dashboard__form__wraper">
                                <div class="dashboard__form__input">
                                    <label for="#">Re-Type New Password</label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                           placeholder="Re-Type New Password" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="dashboard__form__button">
                                <button class="default__button" type="submit">Update Password</button>
                            </div>
                        </div>

                    </div>
                </form>

            </div>

            <div class="tab-pane fade" id="projects__three" role="tabpanel"
                 aria-labelledby="projects__three">

                <form id="updateSocialForm">
                    @csrf
                <div class="row">
                    <div class="col-xl-12">
                        <div class="dashboard__form__wraper">
                            <div class="dashboard__form__input">
                                <label for="#">
                                    Facebook</label>
                                <input type="text" name="fb_link" value="{{$student->fb_link ?? ''}}"
                                       placeholder="https://facebook.com/">
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-12">
                        <div class="dashboard__form__wraper">
                            <div class="dashboard__form__input">
                                <label for="#">
                                    Twitter</label>
                                <input type="text" name="twitter_link" value="{{$student->twitter_link ?? ''}}"
                                       placeholder="https://twitter.com/">
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-12">
                        <div class="dashboard__form__wraper">
                            <div class="dashboard__form__input">
                                <label for="#">
                                    Youtube</label>
                                <input type="text" name="youtube_link" value="{{$student->youtube_link ?? ''}}"
                                       placeholder="https://youtube.com/">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="dashboard__form__wraper">
                            <div class="dashboard__form__input">
                                <label for="#">
                                    Instagram</label>
                                <input type="text" name="insta_link" value="{{$student->insta_link ?? ''}}"
                                       placeholder="https://instagram.com/">
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-12">
                        <div class="dashboard__form__button">
                            <button type="submit" class="default__button">Update Password</button>
                        </div>
                    </div>


                </div>

                </form>


            </div>


        </div>


    </div>
</div>

<script>
    /* Profile Update */
    $('#profileUpdateForm').submit(function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('student.dashboard.profile.update') }}",
            data: formData,
            processData: false,  // Prevent jQuery from processing the data
            contentType: false,  // Prevent jQuery from setting contentType
            success: function (res) {
                if (res.status === 'success') {
                   
                    $('#SettingsTab').trigger('click');
                    
                    swal.fire({
                        title: "Success",
                        text: "Student Profile Updated Successfully !",
                        icon: "success"
                    })


                }
            },
            error: function (err) {

                swal.fire({
                    title: "Failed",
                    text: err.responseJSON.message,
                    icon: "error"
                })
                // Optionally, handle error behavior like showing an error message
            }
        });
    });

    /* Password Update */
    $('#updatePasswordForm').submit(function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('student.dashboard.profile.password') }}",
            data: formData,
            processData: false,  // Prevent jQuery from processing the data
            contentType: false,  // Prevent jQuery from setting contentType
            success: function (res) {
                if (res.status === 'success') {
                    $('#updatePasswordForm').trigger('reset');
                    // $('#SettingsTab').trigger('click');
                    $('[data-bs-target="#projects__two"]').tab('show');
                    swal.fire({
                        title: "Success",
                        text: "Password Updated Successfully !",
                        icon: "success"
                    })


                }
            },
            error: function (err) {

                swal.fire({
                    title: "Failed",
                    text: err.responseJSON.message,
                    icon: "error"
                })
                // Optionally, handle error behavior like showing an error message
            }
        });
    });

    /* Social Links Update */
    $('#updateSocialForm').submit(function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('student.dashboard.profile.social') }}",
            data: formData,
            processData: false,  // Prevent jQuery from processing the data
            contentType: false,  // Prevent jQuery from setting contentType
            success: function (res) {
                if (res.status === 'success') {
                    $('#SettingsTab').trigger('click');
                    $('[data-bs-target="#projects__three"]').tab('show');
                    swal.fire({
                        title: "Success",
                        text: "Social Links Updated Successfully !",
                        icon: "success"
                    })
                }
            },
            error: function (err) {

                swal.fire({
                    title: "Failed",
                    text: err.responseJSON.message,
                    icon: "error"
                })
                // Optionally, handle error behavior like showing an error message
            }
        });
    });
 
</script>