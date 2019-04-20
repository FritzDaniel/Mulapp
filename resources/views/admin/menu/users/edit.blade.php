@extends('admin.layouts.app')

@section('title')
    Mul-App | Edit Data User
@endsection

@section('css')

    <link rel="stylesheet" href="{{ asset('assets/jquery-ui/jquery-ui.css') }}">

@endsection

@section('headerTitle')
    Users
    <small>Admin</small>
@endsection

@section('content')

    @if (session('status'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Success!</h4>
            {{ session('status') }}
        </div>
    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> There were some problems with your input!</h4>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif

    <div class="margin-b10">
        <a href="{{ route('admin.users') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
    </div>

    <div class="row">

        <div class="col-md-6">
            {{--Edit display picture--}}
            @include('admin.menu.users.partials.editDisplayPicture')
            {{--Edit password--}}
            @include('admin.menu.users.partials.editPassword')
        </div>
        {{--Edit data profile--}}
        <div class="col-md-6">
            @include('admin.menu.users.partials.editData')
        </div>
    </div>

@endsection

@section('js')

    <script src="{{ asset('assets/jquery-ui/jquery-ui.js') }}"></script>

    @yield('editData.js')
    @yield('editPassword.js')
    @yield('editDisplayPicture.js')

@endsection
