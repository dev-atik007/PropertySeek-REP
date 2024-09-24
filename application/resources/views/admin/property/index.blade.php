@extends('admin.layouts.app')
@section('panel')
    <nav class="page-breadcrumb">
        <a href="{{ route('admin.property.create') }}" class="btn btn-inverse-warning">Add Property</a>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Property List</h6>

                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>S1</th>
                                    <th>Image</th>
                                    <th>Property Name</th>
                                    <th>Property Type</th>
                                    <th>Status Type</th>
                                    <th>City</th>
                                    <th>Code</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($property as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <img src="{{ asset($item->thumbnail) }}" style="width: 70px; height: 40px;" alt="Image">
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item['type']['type'] }}</td>
                                        <td>{{ $item->property_status }}</td>
                                        <td>{{ $item->city }}</td>
                                        <td>{{ $item->property_code }}</td>
                                        <td>
                                            @if ($item->status == 1)
                                                <span class="badge rounded-pill bg-success">Active</span>
                                            @else
                                                <span class="badge rounded-pill bg-danger">InActive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.property.view', $item->id) }}"
                                                class="btn btn-inverse-info btn-sm" title="Details"><i data-feather="eye"></i></a>
                                            <a href="{{ route('admin.property.details', $item->id) }}"
                                                class="btn btn-inverse-warning btn-sm" title="Edit"><i data-feather="edit"></i></a>
                                            <a href="{{ route('admin.property.delete', $item->id) }}" id="delete"
                                                class="btn btn-inverse-danger btn-sm" title="Delete"><i data-feather="trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
