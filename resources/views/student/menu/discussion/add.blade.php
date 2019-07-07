@extends('student.layouts.app')

@section('title')
    Mul-app | Add Discussion
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/adminLTE//plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endsection

@section('headerTitle')
    Discussion
    <small>Student</small>
@endsection

@section('content')

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Add Discussion</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                    <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <form action="{{ route('student.discussion.store') }}" method="POST" id="DiscussionForm" autocomplete="off">
                @csrf
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" name="title" class="form-control">
                </div>

                <div class="form-group">
                    <label for="">Body</label>
                    <textarea name="body" id="body" class="form-control"></textarea>
                </div>
            </form>
        </div>
        <div class="box-footer">
            <input type="submit" class="btn btn-success btn-sm" id="SubmitBtn">
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('assets/adminLTE/plugins/bootstrap-wysihtml5/html5editor-fixed.js') }}"></script>
    <script>
        $(function () {
            $('#body').wysihtml5({
                "font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
                "emphasis": true, //Italics, bold, etc. Default true
                "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
                "html": false, //Button which allows you to edit the generated HTML. Default false
                "link": false, //Button to insert a link. Default true
                "image": true, //Button to insert an image. Default true,
                "color": true, //Button to change color of font
                "blockquote": true, //Blockquote
            });
        })
    </script>

    <script>
        $('#SubmitBtn').on('click',function () {
            $('#DiscussionForm').submit();
        });
    </script>
@endsection