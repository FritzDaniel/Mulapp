@extends('admin.layouts.app')

@section('title')
    Mul-App | Tags
@endsection

@section('css')

@endsection

@section('headerTitle')
    Tags
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

    <div class="row">
        <div class="col-md-3">
            <a href="#" class="btn btn-primary btn-block margin-bottom"
               data-toggle="modal" data-target="#tagsModal">
                <i class="fa fa-plus-circle"></i> Add Tags
            </a>

            @include('admin.menu.tags.partials.modal-addTags')

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
                            <a href="{{ route('admin.tags') }}"><i class="fa fa-circle-o"></i> All tags
                                <span class="label label-info pull-right">{{ isset($nav) ? $nav->count() : '0' }}</span>
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
                    <h3 class="box-title">Tags List</h3>

                    <div class="box-tools">
                        <form action="{{ route('admin.tags') }}" class="input-group input-group-sm" style="width: 150px;" method="GET" autocomplete="off">
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
                        Empty Data!
                    </div>

                @else
                <div class="box-body no-padding">
                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Created by</th>
                                <th>Tags title</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $dt)
                            <tr>
                                <td>{{ $key+1 }}.</td>
                                <td>{{ isset($keyword) ? $dt->name : $dt->user->name }}</td>
                                <td>{{ isset($dt->tags) ? $dt->tags : 'null' }}</td>
                                <td>{{ isset($dt->created_at) ? \Carbon\Carbon::parse($dt->created_at)->format('d-M-Y') : 'null' }}</td>
                                <td>
                                    <a href="{{ route('admin.tags.delete',$dt->id) }}" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></a>
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

    <script>
        $('#submitTags').on('click',function () {
            $('#tagsForm').submit();
        });
    </script>

    <script>
        $(document).ready(function(){
            $("a.delete").click(function(e){
                if(!confirm('Are you sure want to delete this tag?')){
                    e.preventDefault();
                    return false;
                }
                return true;
            });
        });
    </script>

@endsection