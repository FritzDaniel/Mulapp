@extends('teacher.layouts.app')

@section('title')
    Mul-App | Detail video
@endsection

@section('css')

@endsection

@section('headerTitle')
    Courses
    <small>Teacher</small>
@endsection

@section('content')

    <div class="margin-b10">
        <a href="{{ route('teacher.courses.video',$course) }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
    </div>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Detail Video</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                    <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <video src="{{ asset('assets/uploads/videoCourse/'.$data->video) }}" controls height="300" width="500">

            </video>

            <h4>{{ $data->title }}</h4>
            <p>{{ $data->description }}</p>
        </div>
    </div>

@endsection

@section('js')

@endsection