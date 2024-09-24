@extends('admin.layouts.app')
@section('panel')
    <nav class="page-breadcrumb">
        <a href="{{ route('admin.property.index') }}" class="btn btn-inverse-warning">Property List</a>
    </nav>
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Create Property</h6>
                    <form id="property" action="{{ route('admin.property.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Property Name</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div><!-- Col -->


                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Property Status</label>
                                    <select class="form-select" name="property_status" id="exampleFormControlSelect1">
                                        <option selected="" disabled="">Select Status</option>
                                        <option value="rent">For Rent</option>
                                        <option value="buy">For Buy</option>
                                    </select>
                                </div>
                            </div><!-- Col -->

                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Lowest Price</label>
                                    <input type="text" name="lower_price" class="form-control">
                                </div>
                            </div><!-- Col -->

                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Max Price</label>
                                    <input type="text" name="max_price" class="form-control">
                                </div>
                            </div><!-- Col -->

                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Main Thambnail</label>
                                    <input type="file" name="thumbnail" class="form-control"
                                        onchange="mainThumUrl(this)">
                                </div>
                                <img src="" alt="" id="mainThmb">
                            </div><!-- Col -->

                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Multiple Image</label>
                                    <input type="file" name="image[]" class="form-control" id="multiImg"
                                        multiple="">

                                </div>
                                <div class="row" id="preview_img"></div>
                            </div><!-- Col -->

                        </div><!-- Row -->

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label class="form-label">Bed Rooms</label>
                                    <input type="text" name="bedrooms" class="form-control">
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label class="form-label">Bath Rooms</label>
                                    <input type="text" name="bathrooms" class="form-control">
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label class="form-label">Garage</label>
                                    <input type="text" name="garage" class="form-control">
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label class="form-label">Garage Size</label>
                                    <input type="text" name="garage_size" class="form-control">
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label class="form-label">Address</label>
                                    <input type="text" name="address" class="form-control">
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label class="form-label">City</label>
                                    <input type="text" name="city" class="form-control">
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label class="form-label">State</label>
                                    <input type="text" name="state" class="form-control">
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-3">
                                <div class="form-group mb-3">
                                    <label class="form-label">Postal Code</label>
                                    <input type="text" name="postal_code" class="form-control">
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group mb-3">
                                    <label class="form-label">Property Size</label>
                                    <input type="text" name="property_size" class="form-control">
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group mb-3">
                                    <label class="form-label">Property Video</label>
                                    <input type="text" name="video" class="form-control">
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group mb-3">
                                    <label class="form-label">Neighborhood</label>
                                    <input type="text" name="neightborhood" class="form-control">
                                </div>
                            </div><!-- Col -->

                        </div><!-- Row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Latitude</label>
                                    <input type="text" name="latitude" class="form-control">
                                    <a href="https://www.latlong.net/" target="_blank">Go Here to get Latitude from
                                        address</a>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Longitude</label>
                                    <input type="text" name="longitude" class="form-control" autocomplete="off">
                                    <a href="https://www.latlong.net/" target="_blank">Go Here to get Latitude from
                                        address</a>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group mb-3">
                                    <label class="form-label">Property Type</label>
                                    <select class="form-select" name="ptype_id" id="exampleFormControlSelect1">
                                        <option selected="" disabled="">Select Property Type</option>
                                        @foreach ($propertyType as $data)
                                            <option value="{{ $data->id }}">{{ $data->type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group mb-3">
                                    <label class="form-label">Property Amenities</label>
                                    <select name="amenities_id[]" class="js-example-basic-multiple form-select"
                                        multiple="multiple" data-width="100%">
                                        @foreach ($amenities as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><!-- Col -->

                            <div class="col-sm-4">
                                <div class="form-group mb-3">
                                    <label class="form-label">Agent</label>
                                    <select class="form-select" name="agent_id" id="exampleFormControlSelect1">
                                        <option selected="" disabled="">Select Agent</option>
                                        @foreach ($activeAgent as $agent)
                                            <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><!-- Col -->

                        </div><!-- Row -->

                        <div class="col-sm-12">
                            <div class="form-group mb-3">
                                <label class="form-label">Short Description</label>
                                <textarea class="form-control" name="short_desc" id="exampleFormControlTextarea1" rows="5"></textarea>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-12">
                            <div class="form-group mb-3">
                                <label class="form-label">Long Description</label>
                                <textarea name="long_desc" class="form-control" id="summernote"> </textarea>
                            </div>
                        </div><!-- Col -->

                        <hr>
                        <div class="mb-3">
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="featured" value="1" class="form-check-input"
                                    id="checkInline1">
                                <label class="form-check-label" for="checkInline1">
                                    Featureds Property
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="hot" value="1" class="form-check-input"
                                    id="checkInlineChecked2">
                                <label class="form-check-label" for="checkInlineChecked2">
                                    Hot Property
                                </label>
                            </div>
                        </div>

                        {{-- /////Facilities Option --}}
                        <div class="row add_item">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="facility_name" class="form-label">Facilities </label>
                                    <select name="facility_name[]" id="facility_name" class="form-control">
                                        <option value="">Select Facility</option>
                                        <option value="Hospital">Hospital</option>
                                        <option value="SuperMarket">Super Market</option>
                                        <option value="School">School</option>
                                        <option value="Entertainment">Entertainment</option>
                                        <option value="Pharmacy">Pharmacy</option>
                                        <option value="Airport">Airport</option>
                                        <option value="Railways">Railways</option>
                                        <option value="Bus Stop">Bus Stop</option>
                                        <option value="Beach">Beach</option>
                                        <option value="Mall">Mall</option>
                                        <option value="Bank">Bank</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="distance" class="form-label"> Distance </label>
                                    <input type="text" name="distance[]" id="distance" class="form-control"
                                        placeholder="Distance (Km)">
                                </div>
                            </div>
                            <div class="form-group col-md-4" style="padding-top: 30px;">
                                <a class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> Add More..</a>
                            </div>
                        </div> <!---end row-->




                        <!--========== Start of add multiple class with ajax ==============-->
                        <div style="visibility: hidden">
                            <div class="whole_extra_item_add" id="whole_extra_item_add">
                                <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                                    <div class="container mt-2">
                                        <div class="row">

                                            <div class="form-group col-md-4">
                                                <label for="facility_name">Facilities</label>
                                                <select name="facility_name[]" id="facility_name" class="form-control">
                                                    <option value="">Select Facility</option>
                                                    <option value="Hospital">Hospital</option>
                                                    <option value="SuperMarket">Super Market</option>
                                                    <option value="School">School</option>
                                                    <option value="Entertainment">Entertainment</option>
                                                    <option value="Pharmacy">Pharmacy</option>
                                                    <option value="Airport">Airport</option>
                                                    <option value="Railways">Railways</option>
                                                    <option value="Bus Stop">Bus Stop</option>
                                                    <option value="Beach">Beach</option>
                                                    <option value="Mall">Mall</option>
                                                    <option value="Bank">Bank</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="distance">Distance</label>
                                                <input type="text" name="distance[]" id="distance"
                                                    class="form-control" placeholder="Distance (Km)">
                                            </div>
                                            <div class="form-group col-md-4" style="padding-top: 20px">
                                                <span class="btn btn-success btn-sm addeventmore"><i
                                                        class="fa fa-plus-circle">Add</i></span>
                                                <span class="btn btn-danger btn-sm removeeventmore"><i
                                                        class="fa fa-minus-circle">Remove</i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary submit">Save Changes</button>
                    </form>
                  
                </div>
            </div>
        </div>
    </div>
@endsection
@push('style')
    <link rel="stylesheet" href="{{ asset('application/public/backend/assets/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('application/public/backend/assets/vendors/jquery-tags-input/jquery.tagsinput.min.css') }}">
@endpush

@push('script')
    <!----For Section-------->
    <script type="text/javascript">
        $(document).ready(function() {
            var counter = 0;
            $(document).on("click", ".addeventmore", function() {
                var whole_extra_item_add = $("#whole_extra_item_add").html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++;
            });
            $(document).on("click", ".removeeventmore", function(event) {
                $(this).closest("#whole_extra_item_delete").remove();
                counter -= 1
            });
        });
    </script>
    <!--========== End of add multiple class with ajax ==============-->

    {{-- show Image --}}
    <script type="text/javascript">
        function mainThumUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#mainThmb').attr('src', e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    {{-- show Image End --}}

    {{-- show Multi Image --}}
    <script>
        $(document).ready(function() {
            $('#multiImg').on('change', function() { //on file input change
                if (window.File && window.FileReader && window.FileList && window
                    .Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data

                    $.each(data, function(index, file) { //loop though each file
                        if (/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file
                                .type)) { //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file) { //trigger function on successful read
                                return function(e) {
                                    var img = $('<img/>').addClass('thumb').attr('src',
                                            e.target.result).width(100)
                                        .height(80); //create image element 
                                    $('#preview_img').append(
                                        img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                } else {
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });
    </script>
    {{-- show Multi Image End --}}



    <script type="text/javascript">
        $(document).ready(function() {
            $('#property').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    property_status: {
                        required: true,
                    },
                    lower_price: {
                        required: true,
                    },
                    max_price: {
                        required: true,
                    },
                    thumbnail: {
                        required: true,
                    },
                    image: {
                        required: true,
                    },
                    bedrooms: {
                        required: true,
                    },
                    bathrooms: {
                        required: true,
                    },
                    garage: {
                        required: true,
                    },
                    garage_size: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                    city: {
                        required: true,
                    },
                    state: {
                        required: true,
                    },
                    postal_code: {
                        required: true,
                    },
                    property_size: {
                        required: true,
                    },
                    video: {
                        required: true,
                    },
                    neightborhood: {
                        required: true,
                    },
                    latitude: {
                        required: true,
                    },
                    longitude: {
                        required: true,
                    },
                    ptype_id: {
                        required: true,
                    },
                    amenities_id: {
                        required: true,
                    },                 
                    short_desc: {
                        required: true,
                    },
                    long_desc: {
                        required: true,
                    },
                    


                },
                messages: {
                    name: {
                        required: 'Please Enter Property Name',
                    },
                    property_status: {
                        required: 'Please Enter Property Status',
                    },
                    lower_price: {
                        required: 'Please Enter Lowest Price',
                    },
                    max_price: {
                        required: 'Please Enter Max Price',
                    },
                    thumbnail: {
                        required: 'Please Enter Image',
                    },
                    image: {
                        required: 'Please Enter Status',
                    },
                    bedrooms: {
                        required: 'Please Enter Bedrooms',
                    },
                    bathrooms: {
                        required: 'Please Enter Bathrooms',
                    },
                    garage: {
                        required: 'Please Enter Garage',
                    },
                    garage_size: {
                        required: 'Please Enter Garage Size',
                    },
                    address: {
                        required: 'Please Enter Address',
                    },
                    city: {
                        required: 'Please Enter City',
                    },
                    state: {
                        required: 'Please Enter State',
                    },
                    postal_code: {
                        required: 'Please Enter Postal Code',
                    },
                    property_size: {
                        required: 'Please Enter Property Size',
                    },
                    video: {
                        required: 'Please Enter Video',
                    },
                    neightborhood: {
                        required: 'Please Enter Neightborhood',
                    },
                    latitude: {
                        required: 'Please Enter Latitude',
                    },
                    longitude: {
                        required: 'Please Enter Longitude',
                    },
                    ptype_id: {
                        required: 'Please Enter Property Type',
                    },
                    amenities_id: {
                        required: 'Please Enter Amenities',
                    },
                    short_desc: {
                        required: 'Please Enter Short Description',
                    },
                    long_desc: {
                        required: 'Please Enter Description',
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

    <!-- summernote cdn -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
    <!--End summernote cdn -->

    <!--input field -->
    <script src="{{ asset('application/public/backend/assets/js/select2.js') }}"></script>
    <script src="{{ asset('application/public/backend/assets/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('applcation/public/backend/assets/js/inputmask.js') }}"></script>
    <script src="{{ asset('applcation/public/backend/assets/js/typeahead.js') }}"></script>
    <script src="{{ asset('applcation/public/backend/assets/js/tags-input.js') }}"></script>
    <script src="{{ asset('application/public/backend/assets/vendors/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('application/public/backend/assets/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('application/public/backend/assets/vendors/jquery-tags-input/jquery.tagsinput.min.js') }}">
    </script>
    <!--input field end -->
@endpush
