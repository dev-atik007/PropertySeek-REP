@extends('admin.layouts.master')
@section('content')

    <div class="main-wrapper">
        @include('admin.partials.sidenav')
        <div class="page-wrapper">
            @include('admin.partials.topnav')
  
            <div class="page-content">
                @yield('panel')
            </div>
            @include('admin.partials.footer')
        </div>
    </div>
@endsection
