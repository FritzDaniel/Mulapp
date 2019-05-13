@extends('admin.layouts.app')

@section('title')
    Mul-App | Manage Points
@endsection

@section('css')

@endsection

@section('headerTitle')
    Manage Points
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

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-times"></i> Error!</h4>
            {{ session('error') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            @include('admin.menu.points.partials.userList')
        </div>
        <div class="col-md-6">
            @include('admin.menu.points.partials.userReceipt')
        </div>
    </div>

@endsection

@section('js')

@endsection