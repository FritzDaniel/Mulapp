@extends('teacher.layouts.app')

@section('title')
    Mul-App | Video courses
@endsection

@section('css')

@endsection

@section('headerTitle')
    Courses
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

    <div class="margin-b10">
        <a href="{{ route('teacher.courses') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
        <a href="{{ route('teacher.courses.detailCourses',$data->id) }}" class="btn btn-primary pull-right">Course data <i class="fa fa-files-o"></i></a>
    </div>

    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('teacher.courses.video.add',$data->id) }}" class="btn btn-primary btn-block margin-bottom">
                <i class="fa fa-plus-circle"></i> Add video course
            </a>

            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Navigation</h3>

                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <li>
                            <a href="{{ route('teacher.courses') }}"><i class="fa fa-circle-o"></i> All Video Course
                                <span class="label label-info pull-right">{{ $nav->count() }}</span>
                            </a>
                        </li>
                    </ul>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /. box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Course video list</h3>

                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                @if($dataVideo->isEmpty())

                    <div class="box-body">
                        Empty video!
                    </div>

                @else
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Title</th>
                                    <th>Uploaded at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($dataVideo as $key => $dt)
                                    <tr>
                                        <td>{{ $key+1 }}.</td>
                                        <td>{{ isset($dt) ? $dt->title : '' }}</td>
                                        <td>{{ isset($dt) ? \Carbon\Carbon::parse($dt->created_at)->format('d-M-Y') : '' }}</td>
                                        <td>
                                            <a href="{{ route('teacher.course.video.detail',['slug'=> $dt->slug,'id'=> $data->id]) }}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                            <a href="#" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                            <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!-- /.table -->
                        </div>

                        <div class="text-center">
                            {{ $dataVideo->links() }}
                        </div>

                    </div>
            @endif
            <!-- /.box-body -->
            </div>
            <!-- /. box -->
        </div>
        <!-- /.col -->
    </div>

@endsection

@section('js')

@endsection