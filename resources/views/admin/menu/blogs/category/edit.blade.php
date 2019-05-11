@extends('admin.layouts.app')

@section('title')
    MulApp | Blog Category
@endsection

@section('css')

@endsection

@section('headerTitle')
    Blog Category
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
        <a href="{{ route('admin.blogs.category.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
    </div>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Category</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            <form id="addData" class="fpms" method="POST" action="{{ route('admin.blogs.category.update',$data->id) }}" autocomplete="off">
                @csrf

                <div class="form-group{{ $errors->has('category') ? ' has-error' : ' has-feedback' }}">
                    <label>Category Name</label>
                    <input type="text" class="form-control"
                           placeholder="Category" name="category" value="{{ $data->category }}">
                    @if ($errors->has('category'))
                        <span class="help-block">
                        <strong>{{ $errors->first('category') }}</strong>
                    </span>
                    @endif
                </div>

            </form>
        </div>
        <div class="box-footer">
            <button id="addDataSubmit" type="submit" class="btn btn-primary bpms">
                Update
            </button>
        </div>
    </div>

@endsection

@section('js')

    <script>
        $('#addDataSubmit').on('click',function(){
            $('#addData').submit();
        });
    </script>

@endsection