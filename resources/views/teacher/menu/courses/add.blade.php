@extends('teacher.layouts.app')

@section('title')
    Mul-App | Add courses
@endsection

@section('css')

    <style>
        #title-error{
            margin-top: 10px;
        }
        #category-error{
            margin-top: 10px;
        }
    </style>

@endsection

@section('headerTitle')
    Courses
    <small>Teacher</small>
@endsection

@section('content')

    <div class="margin-b10">
        <a href="{{ route('teacher.courses') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
    </div>

    @include('teacher.menu.courses.partials.step1')
    @include('teacher.menu.courses.partials.step2')
    @include('teacher.menu.courses.partials.step3')

    <div class="hidden">

        <form action="{{ route('teacher.courses.storeCourse') }}" method="POST" id="dataForm">
            @csrf

            <input type="text" value="" name="title" id="set_title">
            <input type="text" value="" name="category_id" id="set_category">
            <input type="text" value="" name="objective" id="set_objective">
            <input type="text" value="" name="requirement" id="set_requirement">
            <input type="text" value="" name="target" id="set_target">

        </form>

    </div>

@endsection

@section('js')

    <script src="{{ asset('assets/jquery-validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/jquery-validate/additional-methods.min.js') }}"></script>
    <script src="{{ asset('js/form_wizard.js') }}"></script>

    <script>

        $('#title').change(function() {
            $('#set_title').val($(this).val());
        });

        $('#category').change(function () {
            $('#set_category').val($(this).val());
        });

        $('#objective').change(function () {
            $('#set_objective').val($(this).val());
        });

        $('#requirement').change(function () {
            $('#set_requirement').val($(this).val());
        });

        $('#target').change(function () {
            $('#set_target').val($(this).val());
        });

        $('#save').on('click',function () {
             $('#dataForm').submit();
        });

    </script>

@endsection