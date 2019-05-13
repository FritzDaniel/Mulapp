<div class="box">
    <div class="box-header">
        <h3 class="box-title">User list</h3>

        <div class="box-tools">
            <form action="{{ route('admin.points') }}" class="input-group input-group-sm" style="width: 150px;" method="GET" autocomplete="off">
                <input type="text" name="search" class="form-control pull-right" placeholder="Search">

                <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </div>
    </div>
    <!-- /.box-header -->
    @if($dataUser->isEmpty())

        <div class="box-body">
            Empty Data!
        </div>

    @else
    <div class="box-body table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>User</th>
                    <th>Point</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($dataUser as $key => $dtUser)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ isset($dtUser) ? $dtUser->name : '' }}</td>
                    <td>{{ isset($dtUser) ? $dtUser->point : '' }}</td>
                    <td>
                        <a href="{{ route('admin.points.topup',$dtUser->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> Topup</a>
                        <a href="{{ route('admin.points.withdraw',$dtUser->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-minus-circle"></i> Withdraw</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        @if(!empty($keyword))

        @else
            <div class="text-center">
                {{ $dataUser->links() }}
            </div>
        @endif

    </div>
    @endif
    <!-- /.box-body -->
</div>