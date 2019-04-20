@extends('admin.layouts.app')

@section('title')
    Mul-App | Users
@endsection

@section('css')

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

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Users Table</h3>

            <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">

            <a href="{{ route('admin.users.add') }}" class="btn btn-sm btn-primary" style="margin: 10px">
                <i class="fa fa-user-plus"></i> Add Account
            </a>

            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Status</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data as $key => $dt)
                    <tr>
                        <td>{{ $key+1 }}.</td>
                        <td>
                            @if($dt->status !== 'active')
                                <span class="label label-danger">Deactive</span>
                            @else
                                <span class="label label-success">Active</span>
                            @endif
                        </td>
                        <td>{{ isset($dt->name) ? $dt->name : 'Empty name' }}</td>
                        <td>{{ isset($dt->username) ? $dt->username : 'Empty username' }}</td>
                        <td>{{ isset($dt->email) ? $dt->email : 'Empty email' }}</td>
                        <td>{{ isset($dt->phone) ? $dt->phone : 'Empty Phone Number' }}</td>
                        <td>{{ isset($dt->created_at) ? \Carbon\Carbon::parse($dt->created_at)->format('d-M-Y') : 'Empty Created At' }}</td>
                        <td>
                            @if($dt->isAdmin())
                                <a href="{{ route('admin.users.show',$dt->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('admin.users.edit',$dt->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                            @else
                                <a href="{{ route('admin.users.show',$dt->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('admin.users.edit',$dt->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                @include('admin.menu.users.partials.changeStatus')
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

@endsection

@section('js')

@endsection