@extends('admin.layouts.app')

@section('title')
    Mulapp | Add User
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/jquery-ui/jquery-ui.css') }}">
@endsection

@section('headerTitle')
    Users
    <small>Admin</small>
@endsection

@section('content')

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

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Add Account</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            <form id="addData" class="fpms" method="POST" action="{{ route('admin.users.store') }}" autocomplete="off">
                @csrf

                <div class="form-group{{ $errors->has('name') ? ' has-error' : ' has-feedback' }}">
                    <label>Full Name</label>
                    <input type="text" class="form-control"
                           placeholder="Full Name" name="name" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('username') ? ' has-error' : ' has-feedback' }}">
                    <label>Username</label>
                    <input type="text" class="form-control"
                           placeholder="Username" name="username" value="{{ old('username') }}">
                    @if ($errors->has('username'))
                        <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : ' has-feedback' }}">
                    <label>Email address</label>
                    <input type="email" class="form-control"
                           placeholder="Email" name="email" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : ' has-feedback' }}">
                    <label>Password</label>
                    <input type="password" class="form-control"
                           placeholder="Password" name="password">
                    @if ($errors->has('password'))
                        <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <label>Gender</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="gender" value="Male" checked @if ( old('gender') == 'Male') checked @endif>
                            Male
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="gender" value="Female" @if ( old('gender') == 'Female') checked @endif>
                            Female
                        </label>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('dob') ? ' has-error' : ' has-feedback' }}">
                    <label>Date of birth</label>
                    <input id="datepicker" type="text" class="form-control"
                           placeholder="Date of birth" name="dob" value="{{ old('dob') }}">
                    @if ($errors->has('dob'))
                        <span class="help-block">
                            <strong>{{ $errors->first('dob') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('phone') ? ' has-error' : ' has-feedback' }}">
                    <label>Phone Number</label>
                    <input type="text" class="form-control"
                           placeholder="Phone Number" name="phone" value="{{ old('phone') }}">
                    @if ($errors->has('phone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label>Roles</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="roles" value="student" checked @if ( old('roles') == 'student') checked @endif>
                            Student
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="roles" value="teacher" @if ( old('roles') == 'teacher') checked @endif>
                            Teacher
                        </label>
                    </div>
                </div>
            </form>
        </div>
        <div class="box-footer">
            <button id="addDataSubmit" type="submit" class="btn btn-primary bpms">
                Save
            </button>
        </div>
    </div>

@endsection

@section('js')

    <script src="{{ asset('assets/jquery-ui/jquery-ui.js') }}"></script>

    <script>
        $( "#datepicker" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            yearRange: '1950:{{ \Carbon\Carbon::now()->format('Y') }}',
        });
    </script>

    <script>
        $('#addDataSubmit').on('click',function(){
            $('#addData').submit();
        });
    </script>

@endsection