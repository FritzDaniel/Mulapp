@extends('student.layouts.app')

@section('title')
    MulApp | Notification
@endsection

@section('css')

@endsection

@section('headerTitle')
    Notification
    <small>Student</small>
@endsection

@section('content')

    <div class="margin-b10">
        <a href="{{ route('student.notify.viewAll') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
    </div>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $data->notify->title }}</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                    <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <h5>To : {{ $data->user->name }}</h5>
            <h5>From : Admin</h5>
            <h5>Date : {{ \Carbon\Carbon::parse($data->created_at)->format('d-M-Y') }}</h5>
            <br>
            <h5>Hi! {{ $data->user->name }}, Admin has sent a notification to you!</h5>
            {!! $data->notify->body !!}
        </div>
        <div class="box-footer">
            Mulapp | Developer
        </div>
    </div>

@endsection

@section('js')

@endsection