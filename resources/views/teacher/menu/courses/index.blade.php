@extends('teacher.layouts.app')

@section('title')
    Mul-App | Courses
@endsection

@section('css')

@endsection

@section('headerTitle')
    Courses
    <small>Teacher</small>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('teacher.courses.add') }}" class="btn btn-primary btn-block margin-bottom">
                <i class="fa fa-plus-circle"></i> Add Courses
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
                            <a href="{{ route('teacher.courses') }}"><i class="fa fa-circle-o"></i> All Course
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
                    <h3 class="box-title">Courses list</h3>

                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                @if($data->isEmpty())

                    <div class="box-body">
                        Empty Notification!
                    </div>

                @else
                <div class="box-body">
                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Created at</th>
                                <th>Action</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $dt)
                                <tr>
                                    <td>{{ $key+1 }}.</td>
                                    <td>{{ isset($dt) ? $dt->title : '' }}</td>
                                    <td>{{ isset($dt) ? $dt->category->category : '' }}</td>
                                    <td>{{ isset($dt) ? \Carbon\Carbon::parse($dt->created_at)->format('d-M-Y') : '' }}</td>
                                    <td>
                                        <a href="{{ route('teacher.courses.detailCourses',$dt->id) }}"
                                           class="btn btn-sm btn-info"><i class="fa fa-files-o"></i> Edit course data</a>
                                        <a href="{{ route('teacher.courses.video',$dt->id) }}"
                                           class="btn btn-sm btn-success"><i class="fa fa-play"></i> Edit course video</a>
                                    </td>
                                    <td>
                                        <a href="#"
                                           class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete course</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!-- /.table -->
                    </div>

                    <div class="text-center">
                        {{ $data->links() }}
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