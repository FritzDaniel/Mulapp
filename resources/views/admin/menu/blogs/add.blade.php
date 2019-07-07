@extends('admin.layouts.app')

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
    Blogs
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
        <a href="{{ route('admin.blogs.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
    </div>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Add article </h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            <small class="pull-right">* Required</small>
            <form id="addArticle" class="fpms" method="POST" action="{{ route('admin.blogs.store') }}" autocomplete="off" enctype="multipart/form-data">
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

                <div class="form-group{{ $errors->has('category') ? ' has-error' : ' has-feedback' }}">
                    <label>Category *</label>
                    <select class="form-control select2 select2-hidden-accessible" name="category"
                            style="width: 100%;" tabindex="-1" aria-hidden="true" id="category">
                        <option value="">Select category</option>
                        @foreach($cat as $cats)
                            <option value="{{ $cats->id }}"
                                {{ old('category') == $cats->id ? 'selected' : '' }}>
                                {{ $cats->category }}
                            </option>
                        @endforeach
                    </select>

                    @if ($errors->has('category'))
                        <span class="help-block">
                            <strong>{{ $errors->first('category') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('tag') ? ' has-error' : ' has-feedback' }}">
                    <label>Tags *</label>
                    <select class="form-control select2 select2-hidden-accessible"
                            name="tag[]" multiple="multiple" data-placeholder="Tag" style="width: 100%;"
                            tabindex="-1" aria-hidden="true" id="tagsInput">
                            <option value="">Select Tag</option>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}"
                                @if(old('tag'))
                                    @foreach(old('tag') as $oldTags)
                                        @if($tag->tags == $oldTags)
                                            selected
                                        @elseif($tag->id == $oldTags)
                                            selected
                                        @else

                                        @endif
                                    @endforeach
                                @endif
                            >{{ $tag->tags }}
                            </option>
                        @endforeach
                    </select>

                    @if ($errors->has('tag'))
                        <span class="help-block">
                            <strong>{{ $errors->first('tag') }}</strong>
                        </span>
                    @endif
                    <small>Add new tags <a href="#" data-toggle="modal" data-target="#tagsModal">here!</a></small>
                </div>

                <div class="form-groupt text-left">
                    <label for="exampleInputFile">Thumbnail</label>
                    <input type="file" class="form-control" name="thumbnail">
                    <p class="help-block">Upload your thumbnail</p>
                </div>

                <div class="form-group{{ $errors->has('body') ? ' has-error' : ' has-feedback' }}">
                    <label>Body *</label>
                    <textarea class="textarea" id="body" name="body"
                              style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px;"
                              placeholder="Place some text here">
                        {{ old('body') }}
                    </textarea>
                    @if ($errors->has('body'))
                        <span class="help-block">
                            <strong>{{ $errors->first('body') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label>Allow Comments *</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="allow_comment" id="allow_comment" value="1" checked
                                {{ old('allow_comment') == '1' ? 'checked' : '' }}>
                                Allowed
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="allow_comment" id="allow_comment" value="0"
                                {{ old('allow_comment') == '0' ? 'checked' : '' }}>
                                Disabled
                        </label>
                    </div>
                </div>
            </form>
        </div>
        <div class="box-footer">
            <button id="addArticleSubmit" type="submit" class="btn btn-primary bpms">
                Save
            </button>
        </div>
    </div>

    @include('admin.menu.blogs.partials.modal-addTags')

@endsection

@section('js')

    <script src="{{ asset('assets/adminLTE/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

    <script src="{{ asset('assets/adminLTE//plugins/bootstrap-wysihtml5/html5editor-fixed.js') }}"></script>

    <script>
        $('#addArticleSubmit').on('click',function(){
            $('#addArticle').submit();
        });
    </script>

    <script>
        $('#submitTags').on('click',function () {
            $('#tagsForm').submit();
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

@endsection