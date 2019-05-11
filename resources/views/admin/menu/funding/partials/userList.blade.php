<div class="box">
    <div class="box-header">
        <h3 class="box-title">User list</h3>

        <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-header -->
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
                        <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> Top up</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>