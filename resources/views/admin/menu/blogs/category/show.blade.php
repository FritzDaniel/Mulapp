@extends('admin.layouts.app')

@section('title')
    Mulapp | Show Category
@endsection

@section('css')

@endsection

@section('headerTitle')
    Blog Category
    <small>Admin</small>
@endsection

@section('content')

    <div class="margin-b10">
        <a href="{{ route('admin.blogs.category.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
    </div>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Category Detail</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                    <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <h4>ID : {{ $data->id }}</h4>
            <h4>Category : {{ isset($data) ? $data->category : '-' }}</h4>
            <h4>Created At: {{ isset($data) ? \Carbon\Carbon::parse($data->created_at)->format('d-M-Y') : '-' }}</h4>
        </div>
    </div>

@endsection

@section('js')

@endsection