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

    <div class="row">
        <div class="col-md-6">
            @include('admin.menu.funding.partials.userList')
        </div>
        <div class="col-md-6">
            @include('admin.menu.funding.partials.userTopup')
        </div>
    </div>

@endsection

@section('js')

@endsection