@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        Users
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="text-right">
                            <a href="" class="btn btn-info btn-sm"><i class="fa fa-user-plus"></i> Add Account</a>
                        </div>

                        <table class="table table-striped table-hover table-bordered mt-3">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $dt)
                                <tr>
                                    <td>{{ $key+1 }}.</td>
                                    <td>{{ $dt->name }}</td>
                                    <td>{{ $dt->username }}</td>
                                    <td>{{ $dt->email }}</td>
                                    <td>{{ $dt->roles }}</td>
                                    <td>
                                        <a href="{{ route('admin.users.show',$dt->username) }}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                        <a href="" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                        <a href="" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
