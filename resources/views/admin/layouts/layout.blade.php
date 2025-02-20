@extends('admin.layouts.base')
@section('body')
    <div class="container-fluid page-body-wrapper pt-0">
        @include('admin.layouts.sidebar')
        @include('admin.layouts.topbar')
        <div class="main-panel py-5 mt-5">
            <div class="content-wrapper mt-5">
                @yield('content')
            </div>
        </div>
    </div>
@endsection
