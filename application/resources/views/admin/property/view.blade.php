@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Property Details</h6>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>Property Name</td>
                                    <td><code>{{ $property->name }}</code></td>
                                </tr>
                                <tr>
                                    <td>Property Status</td>
                                    <td><code>{{ $property->property_status }}</code></td>
                                </tr>
                                <tr>
                                    <td>Property Bedrooms</td>
                                    <td><code>{{ $property->bedrooms }}</code></td>
                                </tr>
                                <tr>
                                    <td>Property Bathrooms</td>
                                    <td><code>{{ $property->bathrooms }}</code></td>
                                </tr>
                                <tr>
                                    <td>Property Garage</td>
                                    <td><code>{{ $property->garage }}</code></td>
                                </tr>
                                <tr>
                                    <td>Property Garage Size</td>
                                    <td><code>{{ $property->garage_size }} Square Footage</code></td>
                                </tr>

                                <tr>
                                    <td>Property Address</td>
                                    <td><code>{{ $property->address }}</code></td>
                                </tr>
                                <tr>
                                    <td>Property City</td>
                                    <td><code>{{ $property->city }}</code></td>
                                </tr>
                                <tr>
                                    <td>Property State</td>
                                    <td><code>{{ $property->state }}</code></td>
                                </tr>
                                <tr>
                                    <td>Property Postal Code</td>
                                    <td><code>{{ $property->postal_code }}</code></td>
                                </tr>


                                <tr>
                                    <td>Property Lower Price</td>
                                    <td><code>{{ $property->lower_price }}</code></td>
                                </tr>
                                <tr>
                                    <td>Property Max Price</td>
                                    <td><code>{{ $property->max_price }}</code></td>
                                </tr>
                                <tr>
                                    <td>Property Image</td>
                                    <td>
                                        <img src="{{ asset($property->thumbnail) }}" alt="" style="width: 100px";
                                            height="100px">
                                    </td>
                                </tr>
                                <tr>
                                    <td> Status</td>
                                    <td>
                                        @if ($property->status == 1)
                                            <span class="badge rounded-pill bg-success">Active</span>
                                        @else
                                            <span class="badge rounded-pill bg-danger">InActive</span>
                                        @endif
                                    </td>
                                </tr>


                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">


                    <div class="table-responsive">
                        <table class="table table-striped">

                            <tbody>
                                <tr>
                                    <td>Property Code</td>
                                    <td><code>{{ $property->property_code }}</code></td>
                                </tr>
                                <tr>
                                    <td>Property Size</td>
                                    <td><code>{{ $property->property_size }} Square Footage</code></td>
                                </tr>
                                <tr>
                                    <td>Property Neighborhood</td>
                                    <td><code>{{ $property->neightborhood }}</code></td>
                                </tr>

                                <tr>
                                    <td>Property Latitude</td>
                                    <td><code>{{ $property->latitude }}</code></td>
                                </tr>
                                <tr>
                                    <td>Property Longitude</td>
                                    <td><code>{{ $property->longitude }}</code></td>
                                </tr>
                                <tr>
                                    <td>Property Video</td>
                                    <td><code>{{ $property->video }}</code></td>
                                </tr>
                                <tr>
                                    <td>Property Type</td>
                                    <td><code>{{ $property['type']['type'] }}</code></td>
                                </tr>
                                <tr>
                                    <td>Property Amenities</td>
                                    <td>
                                        <select name="amenities_id[]" class="js-example-basic-multiple form-select"
                                            multiple="multiple" data-width="100%">
                                            @foreach ($amenities as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ in_array($item->id, $property_ame) ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Agent</td>

                                    @if ($property->agent_id == null)
                                        <td><code>Admin</code></td>
                                    @else
                                        <td><code>{{ $property['agent']['name'] }}</code></td>
                                    @endif

                                </tr>





                            </tbody>

                        </table>
                        <br><br>
                        @if ($property->status == 1)
                            <form action="{{ route('admin.property.inactive') }}" method="POST">
                                @csrf

                                <input type="hidden" name="id" value="{{ $property->id }}">
                                <button type="submit" class="btn btn-danger btn-sm">InActive</button>
                            </form>
                        @else
                            <form action="{{ route('admin.property.active') }}" method="POST">
                                @csrf

                                <input type="hidden" name="id" value="{{ $property->id }}">

                                <button type="submit" class="btn btn-primary btn-sm">Active</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('application/public/backend/assets/js/select2.js') }}"></script>
    <script src="{{ asset('application/public/backend/assets/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('applcation/public/backend/assets/js/inputmask.js') }}"></script>
    <script src="{{ asset('applcation/public/backend/assets/js/typeahead.js') }}"></script>
    <script src="{{ asset('applcation/public/backend/assets/js/tags-input.js') }}"></script>
    <script src="{{ asset('application/public/backend/assets/vendors/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('application/public/backend/assets/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('application/public/backend/assets/vendors/jquery-tags-input/jquery.tagsinput.min.js') }}">
    </script>
@endpush
@push('style')
    <link rel="stylesheet" href="{{ asset('application/public/backend/assets/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('application/public/backend/assets/vendors/jquery-tags-input/jquery.tagsinput.min.css') }}">
@endpush
