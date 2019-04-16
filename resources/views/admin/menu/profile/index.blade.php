@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Profile
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="text-right">
                            <a href="{{ route('admin.profile.edit') }}" class="btn btn-sm btn-info"><i class="fa fa-edit"> Edit</i></a>
                        </div>

                        <div class="text-center mt-3">
                            @if($data->avatar == "default.jpg")
                                <img src="{{ asset('img/default.jpg') }}" alt="" height="300" width="300">
                                <h3>{{ $data->name }}</h3>
                            @else
                                <img src="" alt="">
                            @endif
                        </div>

                        <div class="blockquote">
                            <p>ID : {{ $data->id }}</p>
                            <p>Username : {{ $data->username }}</p>
                            <p>Email : {{ $data->email }}</p>
                            <p>Gender : {{ $data->gender }}</p>
                            <p>Date of Birth : {{ \Carbon\Carbon::parse($data->dob)->format('d M Y') }}</p>
                            <p>Phone : {{ $data->phone }}</p>
                            <p>Roles : {{ $data->roles }}</p>
                            <p>Created at : {{ \Carbon\Carbon::parse($data->created_at)->format('d M Y' )}}</p>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection