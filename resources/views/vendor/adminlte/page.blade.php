<!-- resources/views/vendor/adminlte/page.blade.php -->

@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')
    <div class="wrapper">

        {{-- Preloader Animation --}}
        @if($layoutHelper->isPreloaderEnabled())
            @include('adminlte::partials.common.preloader')
        @endif

        {{-- Top Navbar --}}
        @if($layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.navbar.navbar-layout-topnav')
        @else
            @include('adminlte::partials.navbar.navbar')
        @endif

        {{-- Left Main Sidebar --}}
        @if(!$layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.sidebar.left-sidebar')
        @endif

        {{-- Content Wrapper --}}
        @empty($iFrameEnabled)
            @include('adminlte::partials.cwrapper.cwrapper-default')
        @else
            @include('adminlte::partials.cwrapper.cwrapper-iframe')
        @endempty

        {{-- Footer --}}
        @hasSection('footer')
            @include('adminlte::partials.footer.footer')
        @endif

        {{-- Right Control Sidebar --}}
        @if(config('adminlte.right_sidebar'))
            @include('adminlte::partials.sidebar.right-sidebar')
        @endif

        {{-- DataTables Assets --}}
        @section('css')
            <link rel="stylesheet" href="{{ asset('vendor/datatables/datatables.min.css') }}">
        @stop

        @section('js')
            <script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
            <script>
                $(document).ready(function() {
                    $('#yourDataTable').DataTable({
                        searching: true,
                        paging: true,
                        ordering: true
                        // Add more options as needed
                    });
                });
            </script>
        @stop

    </div>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop
