@php

    $id = auth()->user()->id;
    $data = App\Models\User::find($id);
@endphp

<div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
    <div class="blog-sidebar">
        <div class="sidebar-widget post-widget">
            <div class="widget-title">
                <h4>User Profile </h4>
            </div>
            <div class="post-inner">
                <div class="post">
                    <figure class="post-thumb"><a href="blog-details.html">
                            <img src="{{ !empty($data->image) ? url('application/public/upload/user/' . @$data->image) : url('application/public/upload/no_image.jpg') }}"
                                alt=""></a></figure>
                    <h5><a href="blog-details.html">{{ $data->name }}</a></h5>
                    <p>{{ $data->email }}</p>
                </div>
            </div>
        </div>

        <div class="sidebar-widget category-widget">
            <div class="widget-title">
                <h4>Category</h4>
            </div>
            <div class="widget-content">
                <ul class="category-list ">

                    <li class="current"> <a href="{{ route('user.dashboard') }}"><i class="fab fa fa-envelope "></i>
                            Dashboard </a></li>


                    <li><a href="{{ route('user.profile') }}"><i class="fa fa-cog" aria-hidden="true"></i>
                            Settings</a></li>
                    <li><a href="blog-details.html"><i class="fa fa-credit-card" aria-hidden="true"></i> Buy
                            credits<span class="badge badge-info">(
                                10 credits)</span></a></li>
                    <li><a href="blog-details.html"><i class="fa fa-list-alt" aria-hidden="true"></i></i>
                            Properties </a></li>
                    <li><a href="blog-details.html"><i class="fa fa-indent" aria-hidden="true"></i>
                            Add a Property </a></li>
                    <li><a href="{{ route('user.security') }}"><i class="fa fa-key" aria-hidden="true"></i>
                            Security </a></li>
                    <li><a href="{{ route('user.logout') }}"><i class="fa fa-chevron-circle-up" aria-hidden="true"></i>
                            Logout </a></li>
                </ul>
            </div>
        </div>

    </div>
</div>
