@extends('student.layouts.app')

@section('title')
    Mul-App | Notify
@endsection

@section('css')

@endsection

@section('headerTitle')
    Notification
    <small>Student</small>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-3">

            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Navigation</h3>

                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    @include('student.menu.notify.partials.navigation')
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /. box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Notification List</h3>

                    <div class="box-tools">
                        <form action="{{ route('student.notify.readable') }}"
                              class="input-group input-group-sm" style="width: 150px;" method="GET" autocomplete="off">
                            <input type="text" name="search" class="form-control pull-right" placeholder="Search">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                @if($data->isEmpty())

                    <div class="box-body">
                        Empty Notification!
                    </div>

                @else
                    <div class="box-body no-padding">
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $key => $dt)
                                    <tr>
                                        <td>{{ $key+1 }}.</td>
                                        <td>
                                            @if($dt->read_at == null)
                                                <b>{{ isset($keyword) ? $dt->title : $dt->notify->title }}</b> <small class="label bg-green" style="margin-left: 10px;">new</small>
                                            @else
                                                {{ isset($keyword) ? $dt->title : $dt->notify->title }}
                                            @endif
                                        </td>
                                        <td>{{ isset($dt) ? \Carbon\Carbon::parse($dt->created_at)->format('d-M-Y') : '' }}</td>
                                        <td>
                                            <a href="{{ route('student.notify.read',['id' => isset($keyword) ? $dt->id : $dt->id ,'title' => isset($keyword) ? $dt->title : $dt->notify->title ]) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!-- /.table -->
                        </div>
                        @if(!empty($keyword))

                        @else
                            <div class="text-center">
                                {{ $data->links() }}
                            </div>
                        @endif
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