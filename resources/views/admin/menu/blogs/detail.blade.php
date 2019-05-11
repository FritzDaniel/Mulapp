@extends('admin.layouts.app')

@section('title')
    Mulapp | Article detail
@endsection

@section('css')

@endsection

@section('headerTitle')
    Blogs
    <small>Admin</small>
@endsection

@section('content')

    <div class="margin-b10">
        <a href="{{ route('admin.blogs.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
    </div>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Article detail</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                    <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            @if($data->thumbnail !== null)
                <img src="{{ asset('assets/uploads/thumbnail/'.$data->thumbnail) }}"
                 alt=""
                 class="img-thumbnail"
                 style="height: 250px;
                 width: 250px;">
            @else
                <img src="{{ asset('assets/img/mulapp.jpg') }}"
                 alt=""
                 class="img-thumbnail"
                 style="height: 250px;
                 width: 250px;">
            @endif
            <h3>Title : {{ isset($data) ? $data->title : '' }}</h3>
            <h4>Created by : {{ isset($data) ? $data->user->name : '' }}</h4>
            <h4>Created at : {{ isset($data) ? \Carbon\Carbon::parse($data->created_at)->format('d-M-Y') : '' }}</h4>
            <h4>Category : {{ isset($data) ? $data->category->category : '' }}</h4>
            <h4>Tags:
                @foreach($dataTags as $tags)
                    {{ $loop->first ? '' : ', ' }}
                    {{ isset($tags) ? $tags->tags->tags : '' }}
                @endforeach
            </h4>
            {!! $data->body !!}
        </div>
    </div>

@endsection

@section('js')

@endsection