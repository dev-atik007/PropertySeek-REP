@extends('admin.layouts.app')
@section('panel')
    <nav class="page-breadcrumb">
        <a href="{{ route('admin.index.amenities') }}" class="btn btn-inverse-warning">Amenities List</a>
    </nav>
    <div class="col-md-8 col-xl-12 middle-wrapper">
        <div class="row">
            <div class="card">
                <div class="card-body">

                    <h6 class="card-title">Create Amenities</h6>

                    <form id="myForm" action="{{ route('admin.update.amenities', $amenities->id) }}" method="POST"
                        enctype="multipart/form-data" class="forms-sample">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="exampleInputUsername1" class="form-label">Amenities Name</label>
                            <input type="text" class="form-control" name="name" id="name" autocomplete="off"
                                value="{{ $amenities->name }}">
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

                },
                messages: {
                    name: {
                        required: 'Please Enter Amenities Name',
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
