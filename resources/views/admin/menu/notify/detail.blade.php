@extends('admin.layouts.app')

@section('title')
    Mul-App | Notify User
@endsection

@section('css')

@endsection

@section('headerTitle')
    Notification
    <small>Admin</small>
@endsection

@section('content')

    <div class="margin-b10">
        <a href="{{ route('admin.notify') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
    </div>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Notify Detail</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                    <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <h3>ID : {{ isset($data) ? $data->id : '' }}</h3>
            <h4>Title : {{ isset($data) ? $data->title : '' }}</h4>
            <h4>Send to :
                @if(!$dataNotify->isEmpty())
                    @foreach($dataNotify as $notify)
                        {{ $loop->first ? '' : ', ' }}
                        {{ $notify->user->name }}
                    @endforeach

                @else
                    No participant!
                @endif
            </h4>
            <h4>Created at : {{ isset($data) ? \Carbon\Carbon::parse($data->created_at)->format('d-M-Y') : '' }}</h4>
            <span style="display:block; margin-bottom: 10px;">Message :</span>
            {!! isset($data) ? $data->body : '' !!}
        </div>
    </div>

@endsection

@section('js')

@endsection