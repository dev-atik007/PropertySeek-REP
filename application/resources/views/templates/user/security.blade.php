@extends('templates.user.partials.master')
@section('dashboard')
    <div class="col-lg-8 col-md-12 col-sm-12 content-side">
        <div class="blog-details-content">
            <div class="news-block-one">
                <div class="inner-box">

                    <div class="lower-content">
                        <h3>Including Animation In Your Design System.</h3>
                        <ul class="post-info clearfix">
                            <li class="author-box">
                                <figure class="author-thumb"><img src="assets/images/news/author-1.jpg" alt="">
                                </figure>
                                <h5><a href="blog-details.html">Eva Green</a></h5>
                            </li>
                            <li>April 10, 2020</li>
                        </ul>


                        <form action="{{ route('user.security.update') }}" method="POST" enctype="multipart/form-data"
                            class="default-form">
                            @csrf

                            <div class="form-group">
                                <label>Old Password</label>
                                <input type="password" name="old_password"
                                    @error('old_password')
                                        is-invalid
                                    @enderror
                                    id="old_password">
                                @error('old_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" name="new_password"
                                    @error('new_password')
                                is-invalid
                            @enderror
                                    id="new_password">
                                @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Confirm New Password</label>
                                <input type="password" name="new_password_confirmation"
                                    @error('new_password_confirmation')
                                is-invalid
                            @enderror
                                    id="new_password_confirmation">
                                @error('new_password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group message-btn">
                                <button type="submit" class="theme-btn btn-one">Save Changes </button>
                            </div>
                        </form>



                    </div>
                </div>
            </div>


        </div>


    </div>
@endsection
