@extends('student.layouts.app')

@section('title')
    Mul-App | Profile
@endsection

@section('css')

@endsection

@section('headerTitle')
    Profile
    <small>{{ $data->name }} Profile</small>
@endsection

@section('content')

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Profile</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                    <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">

            <div class="row">
                <div class="col-md-5 text-center" style="">
                    @if($data->avatar == "default.jpg")
                        <img class="img-thumbnail" src="{{ asset('assets/img/default.jpg') }}" alt="" height="180" width="180">
                        <h3>{{ $data->name }}</h3>
                    @else
                        <img class="img-thumbnail" src="{{ asset('assets/uploads/avatar/'.$data->avatar) }}" alt="" height="180" width="180">
                    @endif
                </div>

                <div class="col-md-4" style="font-size: 16px;">
                    <p>ID : {{ isset($data->id) ? $data->id : '-' }}</p>
                    <p>Username : {{ isset($data->username) ? $data->username : '' }}</p>
                    <p>Email : {{ isset($data->email) ? $data->email : '-' }}</p>
                    <p>Gender : {{ isset($data->gender) ? $data->gender : '-' }}</p>
                    <p>Date of Birth : {{ isset($data->dob) ? \Carbon\Carbon::parse($data->dob)->format('d M Y') : '-' }}</p>
                    <p>Phone : {{ isset($data->phone) ? $data->phone : '-' }}</p>
                    <p>Roles : {{ isset($data->roles) ? $data->roles : '-'}}</p>
                    <p>Created at : {{ isset($data->created_at) ? \Carbon\Carbon::parse($data->created_at)->format('d M Y') : '-' }}</p>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('student.profile.edit') }}" class="btn btn-app">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

@endsection