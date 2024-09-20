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


                        <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data" class="default-form">
                            @csrf
                            
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" value="{{ $data->name }}" id="name"
                                    required="">
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" value="{{ $data->username }}" required="">
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="phone" value="{{ $data->phone }}" required="">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" value="{{ $data->email }}" id="email"
                                    required="">
                            </div>
                            <div class="form-group">
                                <label>address</label>
                                <input type="text" name="address" value="{{ $data->address }}" required="">
                            </div>

                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="image"  id="image"
                                    required="">
                            </div>

                            <div class="form-group">
                                <label class="form-label"></label>
                                <img class="rounded-circle p-1 bg-primary" width="100" id="showImage"
                                    src="{{ !empty($data->image) ? url('application/public/upload/user/' . @$data->image) : url('application/public/upload/no_image.jpg') }}"
                                    alt="profile">
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection

