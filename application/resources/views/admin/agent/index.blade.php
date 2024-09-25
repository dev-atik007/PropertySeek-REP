@extends('admin.layouts.app')
@section('panel')
    <nav class="page-breadcrumb">
        <a href="{{ route('admin.add.agent') }}" class="btn btn-inverse-warning">Add Agent</a>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Agent List</h6>

                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>S1</th>
                                    <th>Agent</th>
                                    <th>Email/Phone</th>
                                    <th>Join At</th>
                                    <th>Status</th>
                                    <th>
                                        Change
                                    </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($agents as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->name }}</br><code>({{ $item->username }})</code></td>
                                        <td>{{ $item->email }}</br><code>{{ $item->phone }}</code></td>
                                        <td>{{ $item->created_at->format('Y-m-d h:i A') }}</br>
                                            ({{ $item->created_at->diffForHumans() }})
                                        </td>
                                        <td>
                                            @if ($item->status == 1)
                                                <span class="badge rounded-pill bg-success">Active</span>
                                            @else
                                                <span class="badge rounded-pill bg-danger">InActive</span>
                                            @endif
                                        </td>

                                        <td>
                                            <input data-id="{{ $item->id }}" class="toggle-class" type="checkbox"
                                                data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                data-on="Active" data-off="Inactive" {{ $item->status ? 'checked' : '' }}>
                                        </td>

                                        <td>
                                            <a href="{{ route('admin.edit.agent', $item->id) }}"
                                                class="btn btn-inverse-info" title="Edit"><i data-feather="edit"></i></a>
                                            <a href="{{ route('admin.delete.agent', $item->id) }}" id="delete"
                                                class="btn btn-inverse-danger" title="Delete"><i
                                                    data-feather="trash"></i></a>
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
@push('style')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endpush

@push('script')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>


    <script type="text/javascript">
        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var user_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('admin.agent.change.status') }}',
                    data: {
                        'status': status,
                        'user_id': user_id
                    },
                    success: function(data) {
                        // console.log(data.success)

                        // Start Message 

                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        if ($.isEmptyObject(data.error)) {

                            Toast.fire({
                                type: 'success',
                                title: data.success,
                            })

                        } else {

                            Toast.fire({
                                type: 'error',
                                title: data.error,
                            })
                        }

                        // End Message   


                    }
                });
            })
        })
    </script>
@endpush
