@extends('admin.layouts.app')
@section('panel')
    <nav class="page-breadcrumb">
        <a href="{{ route('admin.all.agent') }}" class="btn btn-inverse-warning">Agent List</a>
    </nav>
    <div class="col-md-8 col-xl-12 middle-wrapper">
        <div class="row">
            <div class="card">
                <div class="card-body">

                    <h6 class="card-title">Create Agent</h6>

                    <form id="myForm" action="{{ route('admin.store.agent') }}" method="POST"
                        enctype="multipart/form-data" class="forms-sample">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="exampleInputUsername1" class="form-label">Agent Name</label>
                            <input type="text" class="form-control" name="name" id="name" autocomplete="off"
                                value="">
                        </div>
                        <div class="form-group mb-3">
                            <label for="exampleInputUsername1" class="form-label">User Name</label>
                            <input type="text" class="form-control" name="username" id="name" autocomplete="off"
                                value="">
                        </div>
                        <div class="form-group mb-3">
                            <label for="exampleInputUsername1" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="name" autocomplete="off"
                                value="">
                        </div>
                        <div class="form-group mb-3">
                            <label for="exampleInputUsername1" class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" id="name" autocomplete="off"
                                value="">
                        </div>
                        <div class="form-group mb-3">
                            <label for="exampleInputUsername1" class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" id="name" autocomplete="off"
                                value="">
                        </div>
                        <div class="form-group mb-3">
                            <label for="exampleInputUsername1" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="name" autocomplete="off"
                                value="">
                        </div>

                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    username: {
                        required: true,
                    },
                    email: {
                        required: true,
                    },
                    phone: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                    password: {
                        required: true,
                    },

                },
                messages: {
                    name: {
                        required: 'Please Enter Agent Name',
                    },
                    Username: {
                        required: 'Please Enter User Name',
                    },

                    email: {
                        required: 'Please Enter Email Name',
                    },

                    phone: {
                        required: 'Please Enter Phone Name',
                    },

                    address: {
                        required: 'Please Enter Address Name',
                    },

                    Password: {
                        required: 'Please Enter Password',
                    },

            
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
@endpush
