@extends('teacher.layouts.app')

@section('title')
    Mulapp | Add Article
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/adminLTE/bower_components/select2/dist/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/adminLTE//plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

    <style>
        .select2-container--default .select2-selection--single, .select2-selection .select2-selection--single {
            border: 1px solid #d2d6de;
            border-radius: 0;
            padding: 6px 4px;
            height: 34px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #3c8dbc;
            border-color: #367fa9;
            padding: 1px 10px;
            color: #fff;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: white;
            cursor: pointer;
            display: inline-block;
            font-weight: bold;
            margin-right: 10px;
        }

        .select2-container--default .select2-selection--multiple {
            background-color: white;
            border: 1px solid #aaa;
            border-radius: 4px;
            cursor: text;
            padding-left: 8px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 33px !important;
        }
    </style>
@endsection

@section('headerTitle')
    Article
    <small>Teacher</small>
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
        <a href="{{ route('teacher.article') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
    </div>

    @include('teacher.menu.articles.partials.modal-addTags')

    <div class="row">
        <div class="col-md-6">
            {{--Edit thumbnail--}}
            @include('teacher.menu.articles.partials.editDataThumbnail')
        </div>
        {{--Edit data--}}
        <div class="col-md-6">
            @include('teacher.menu.articles.partials.editData')
        </div>
        <div class="col-md-12">
            @include('teacher.menu.articles.partials.editDataBody')
        </div>
    </div>

@endsection

@section('js')

    <script src="{{ asset('assets/adminLTE/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

    <script src="{{ asset('assets/adminLTE//plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>

    <script>
        $('#updateDataSubmit').on('click',function(){
            $('#updateData').submit();
        });

        $('#updateBodySubmit').on('click',function(){
            $('#updateBody').submit();
        });

        $('#updateThumbnailSubmit').on('click',function(){
            $('#updateThumbnail').submit();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#categoryInput').select2();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#tagsInput').select2();
        });
    </script>

    <script>
        $(function () {
            $('#body').wysihtml5()
        })
    </script>

    <script>
        $('#submitTags').on('click',function () {
            $('#tagsForm').submit();
        });
    </script>

@endsection