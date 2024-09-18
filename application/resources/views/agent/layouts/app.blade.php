@extends('agent.layouts.master')
@section('content')

    <div class="main-wrapper">
        @include('agent.partials.sidenav')
        <div class="page-wrapper">
            @include('agent.partials.topnav')
  
            <div class="page-content">
                @yield('panel')
            </div>
            @include('agent.partials.footer')
        </div>
    </div>
@endsection
