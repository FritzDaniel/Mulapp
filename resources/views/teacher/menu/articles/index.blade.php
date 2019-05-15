@extends('teacher.layouts.app')

@section('title')
    Mul-App | Blog
@endsection

@section('css')

@endsection

@section('headerTitle')
    Article
    <small>Teacher</small>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('teacher.article.add') }}" class="btn btn-primary btn-block margin-bottom">
                <i class="fa fa-plus-circle"></i> Add article
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
                            <a href="{{ route('teacher.article') }}"><i class="fa fa-circle-o"></i> All article
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
                    <h3 class="box-title">Article list</h3>

                    <div class="box-tools">
                        <form action="{{ route('teacher.article') }}" class="input-group input-group-sm" style="width: 150px;" method="GET" autocomplete="off">
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
                                <th>Title</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $dt)
                                <tr>
                                    <td>{{ $key+1 }}.</td>
                                    <td>{{ isset($dt->title) ? $dt->title : 'null' }}</td>
                                    <td>{{ isset($dt->created_at) ? \Carbon\Carbon::parse($dt->created_at)->format('d-M-Y') : 'null' }}</td>
                                    <td>
                                        <a href="{{ route('teacher.article.detail',$dt->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('teacher.article.edit',$dt->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('teacher.article.delete',$dt->id) }}" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></a>
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
        $(document).ready(function(){
            $("a.delete").click(function(e){
                if(!confirm('Are you sure want to delete this article?')){
                    e.preventDefault();
                    return false;
                }
                return true;
            });
        });
    </script>

@endsection