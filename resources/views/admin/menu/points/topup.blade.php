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
        <a href="{{ route('admin.points') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
    </div>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Topup Points {{ $user->name }}</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            <small class="pull-right">* Required</small>
            <form id="topupForm" class="fpms" method="POST"
                  action="{{ route('admin.points.update.topup',$user->id) }}" autocomplete="off">
                @csrf

                <div class="form-group{{ $errors->has('point') ? ' has-error' : ' has-feedback' }}">
                    <label>Point *</label>
                    <input type="number" class="form-control"
                           placeholder="Point" name="point" value="{{ old('point') }}">
                    @if ($errors->has('point'))
                        <span class="help-block">
                            <strong>{{ $errors->first('point') }}</strong>
                        </span>
                    @endif
                </div>

            </form>
        </div>
        <div class="box-footer">
            <button id="topupSubmit" type="submit" class="btn btn-primary bpms">
                Topup
            </button>
        </div>
    </div>

    @include('admin.menu.blogs.partials.modal-addTags')

@endsection

@section('js')

    <script>
        $('#topupSubmit').on('click',function () {
            $('#topupForm').submit();
        });
    </script>

@endsection