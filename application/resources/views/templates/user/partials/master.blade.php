@extends('templates.layouts.frontend')
@section('master')
    @include('templates.user.partials.header')


    <!-- sidebar-page-container -->
    <section class="sidebar-page-container blog-details sec-pad-2">
        <div class="auto-container">
            <div class="row clearfix">






                @include('templates.user.partials.sidenav')




               @yield('dashboard')


            </div>
        </div>
    </section>
    <!-- sidebar-page-container -->

    @include('templates.user.partials.footer')

@endsection
