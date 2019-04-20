<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Edit Display Picture</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                <i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body text-center">
        @if($data->avatar == "default.jpg")
            <img class="img-thumbnail" src="{{ asset('assets/img/default.jpg') }}" alt="" height="150" width="150">
        @else
            <img src="{{ asset('assets/uploads/avatar/'.$data->avatar) }}" alt="" height="150" width="150">
        @endif

        <form id="editDisplayPicture" action="{{ route('admin.profile.update.displayPicture') }}"
              method="POST" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="form-groupt text-left" style="margin-top: 10px;">
                <label for="exampleInputFile">Display Picture</label>
                <input type="file" class="form-control" name="avatar">

                <p class="help-block">Upload your new display picture</p>
            </div>
        </form>
    </div>
    <div class="box-footer with-border text-left">
        <button id="editDisplayPictureSubmit" class="btn btn-primary">Save</button>
    </div>
</div>

@section('editDisplayPicture.js')
    <script>
        $('#editDisplayPictureSubmit').on('click',function(){
            $('#editDisplayPicture').submit();
        });
    </script>
@endsection