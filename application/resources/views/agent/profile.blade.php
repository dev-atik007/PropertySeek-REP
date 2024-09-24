@extends('agent.layouts.app')
@section('panel')
    <div class="row profile-body">
        <!-- left wrapper start -->
        <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">
            <div class="card rounded">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div>
                            <img class="wd-100 rounded-circle"
                                src="{{ !empty($agentData->image) ? url('application/public/upload/agent/' . @$agentData->image) : url('application/public/upload/no_image.jpg') }}"
                                alt="profile">
                            <span class="h4 ms-3">{{ $agentData->name }}</span>
                        </div>

                    </div>

                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Name:</label>
                        <p class="text-muted">{{ $agentData->name }}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
                        <p class="text-muted">{{ $agentData->email }}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Phone:</label>
                        <p class="text-muted">{{ $agentData->phone }}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Address:</label>
                        <p class="text-muted">{{ $agentData->address }}</p>
                    </div>
                    <div class="mt-3 d-flex social-links">
                        <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                            <i data-feather="github"></i>
                        </a>
                        <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                            <i data-feather="twitter"></i>
                        </a>
                        <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                            <i data-feather="instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- left wrapper end -->
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Update Admin Profile</h6>

                        <form action="{{ route('agent.profile.update') }}" method="POST" enctype="multipart/form-data"
                            class="forms-sample">
                            @csrf

                            <div class="mb-3">
                                <label for="exampleInputUsername1" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" id="exampleInputUsername1"
                                    autocomplete="off" value="{{ $agentData->username }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputUsername1" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="exampleInputUsername1"
                                    autocomplete="off" value="{{ $agentData->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputUsername1" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="exampleInputUsername1"
                                    autocomplete="off" value="{{ $agentData->email }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputUsername1" class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone" id="exampleInputUsername1"
                                    autocomplete="off" value="{{ $agentData->phone }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputUsername1" class="form-label">Address</label>
                                <input type="text" class="form-control" name="address" id="exampleInputUsername1"
                                    autocomplete="off" value="{{ $agentData->address }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputUsername1" class="form-label">Image</label>
                                <input type="file" name="image" id="image" class="form-control"
                                    id="exampleInputUsername1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputUsername1" class="form-label"></label>
                                <img class="rounded-circle p-1 bg-primary" width="100" id="showImage"
                                    src="{{ !empty($agentData->image) ? url('application/public/upload/agent/' . @$agentData->image) : url('application/public/upload/no_image.jpg') }}"
                                    alt="profile">
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
        <!-- middle wrapper end -->
        <!-- right wrapper start -->

        <!-- right wrapper end -->
    </div>
@endsection

@push('script')
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
@endpush
