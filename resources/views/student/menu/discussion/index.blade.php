@extends('student.layouts.app')

@section('title')
    Mul-app | Discussion
@endsection

@section('css')

@endsection

@section('headerTitle')
    Discussion
    <small>Student</small>
@endsection

@section('content')

    @if (session('status'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Success!</h4>
            {{ session('status') }}
        </div>
    @endif

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Discussion List</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                    <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">

            <a href="{{ route('student.discussion.add') }}" class="btn btn-success btn-sm" style="margin-bottom: 15px;">Add Discussion</a>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @if($data->isEmpty())

                    <tr>
                        <td>Empty Data</td>
                        <td></td>
                        <td></td>
                    </tr>

                @else

                    @foreach($data as $key => $dt)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $dt->title }}</td>
                        <td>
                            <a href="" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                            <a href="" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                            <a href="" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach

                @endif
                </tbody>
            </table>
        </div>
        <div class="box-footer">

        </div>
    </div>

@endsection

@section('js')

@endsection