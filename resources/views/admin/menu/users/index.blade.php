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

    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('admin.users.add') }}" class="btn btn-primary btn-block margin-bottom">
                <i class="fa fa-user-plus"></i> Add account
            </a>

            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Navigation</h3>

                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <li>
                            <a href="{{ route('admin.users') }}"><i class="fa fa-users"></i> All users
                                <span class="label label-info pull-right">{{ isset($nav) ? $nav->count() : '0' }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="studentNav"><i class="fa fa-users"></i> Student
                                <span class="label label-primary pull-right">{{ isset($nav) ? $nav->where('roles','=','student')->count() : '0' }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="teacherNav"><i class="fa fa-users"></i> Teacher
                                <span class="label label-warning pull-right">{{ isset($nav) ? $nav->where('roles','=','teacher')->count() : '0' }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="activeNav"><i class="fa fa-user"></i> Active users
                                <span class="label label-success pull-right">{{ isset($nav) ? $nav->where('status','=','active')->count() : '0' }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="inactiveNav"><i class="fa fa-user-times"></i> Inactive users
                                <span class="label label-danger pull-right">{{ isset($nav) ? $nav->where('status','=','inactive')->count() : '0' }}</span>
                            </a>
                        </li>
                    </ul>

                    @include('admin.menu.users.partials.navigationForms')

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /. box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Users list</h3>

                    <div class="box-tools">
                        <form action="{{ route('admin.users') }}" class="input-group input-group-sm" style="width: 150px;" method="GET" autocomplete="off">
                            <input type="text" name="search" class="form-control pull-right" placeholder="Search">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                @if($data->isEmpty())

                    <div class="box-body">
                        Empty Data!
                    </div>

                @else
                <div class="box-body no-padding">
                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Status</th>
                                <th>Full Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Last Login</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $dt)
                                <tr>
                                    <td>{{ $key+1 }}.</td>
                                    <td>
                                        @if($dt->status !== 'active')
                                            <span class="label label-danger">Inactive</span>
                                        @else
                                            <span class="label label-success">Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ isset($dt->name) ? $dt->name : 'Empty name' }}
                                    </td>
                                    <td>{{ isset($dt->username) ? $dt->username : 'Empty username' }}</td>
                                    <td>{{ isset($dt->email) ? $dt->email : 'Empty email' }}</td>
                                    <td>{{ isset($dt->phone) ? $dt->phone : 'Empty Phone Number' }}</td>
                                    <td>{{ isset($dt->last_login) ? \Carbon\Carbon::parse($dt->last_login)->format('d-M-Y') : 'Never Login' }}</td>
                                    <td>
                                        @if($dt->isAdmin())
                                            <a href="{{ route('admin.users.show',$dt->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                            <a href="{{ route('admin.users.edit',$dt->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                        @else
                                            <a href="{{ route('admin.users.show',$dt->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                            <a href="{{ route('admin.users.edit',$dt->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!-- /.table -->
                    </div>
                    @if(!empty($keyword))

                    @else
                        <div class="text-center">
                            {{ $data->links() }}
                        </div>
                    @endif
                </div>
                @endif
                <!-- /.box-body -->
            </div>
            <!-- /. box -->
        </div>
        <!-- /.col -->
    </div>

@endsection

@section('js')

    <script>
        $('#studentNav').on('click',function () {
            $('#navigationStudent').submit();
        });
        $('#teacherNav').on('click',function () {
            $('#navigationTeacher').submit();
        });
        $('#activeNav').on('click',function () {
            $('#navigationActive').submit();
        });
        $('#inactiveNav').on('click',function () {
            $('#navigationInactive').submit();
        });
    </script>

@endsection