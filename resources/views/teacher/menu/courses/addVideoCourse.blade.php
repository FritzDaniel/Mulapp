@extends('teacher.layouts.app')

@section('title')
    Mulapp | Add video courses
@endsection

@section('css')

    <style>
        .overlayText{
            position: absolute;
            top: 55%;
            width: 100%;
        }
    </style>

@endsection

@section('headerTitle')
    Courses
    <small>Teacher</small>
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
        <a href="{{ route('teacher.courses.video',$data->id) }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
    </div>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit course thumbnail</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                    <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">

            <form id="videoCourseForm" action="{{ route('teacher.courses.video.store',$data->id) }}"
                  method="POST" autocomplete="off" enctype="multipart/form-data">
                @csrf

                <div class="form-group{{ $errors->has('title') ? ' has-error' : ' has-feedback' }}">
                    <label>Title *</label>
                    <input type="text" class="form-control"
                           placeholder="Title" name="title" value="{{ old('title') }}">
                    @if ($errors->has('title'))
                        <span class="help-block">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('description') ? ' has-error' : ' has-feedback' }}">
                    <label>Description</label>
                    <textarea class="textarea" name="description"
                              style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px;"
                              placeholder="Place some text here">{{ old('description') }}</textarea>
                    @if ($errors->has('description'))
                        <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group text-left" style="margin-top: 10px;">
                    <label for="exampleInputFile">Video</label>
                    <input type="file" class="form-control" name="video">

                    <p class="help-block">Extension must .mp4 or .mov</p>
                    @if ($errors->has('video'))
                        <span class="help-block">
                        <strong>{{ $errors->first('video') }}</strong>
                    </span>
                    @endif
                </div>
            </form>
        </div>

        <div id="overlay" class="overlay text-center" style="display: none;">
            <i class="fa fa-refresh fa-spin"></i> <br>
            <div class="overlayText">
                Uploading.. Please wait..
            </div>
        </div>

        <div class="box-footer with-border text-left">
            <button id="videoCourseSubmit" class="btn btn-primary">Update</button>
        </div>
    </div>

@endsection

@section('js')

    <script src="{{ asset('assets/jquery-form/jquery.form.min.js') }}"></script>

    <script>
        $('#videoCourseSubmit').on('click',function () {
            $('#overlay').show();
            $('#videoCourseForm').submit();
        });
    </script>

@endsection