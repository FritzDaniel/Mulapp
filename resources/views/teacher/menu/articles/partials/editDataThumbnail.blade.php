<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Edit thumbnail</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                <i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body text-center">
        @if($data->thumbnail == null)
            <img class="img-thumbnail" src="{{ asset('assets/img/mulapp.jpg') }}" alt="" height="150" width="150">
        @else
            <img src="{{ asset('assets/uploads/thumbnail/'.$data->thumbnail) }}" alt="" height="150" width="150">
        @endif

        <form id="updateThumbnail" action="{{ route('teacher.article.update.thumbnail',$data->id) }}"
              method="POST" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="form-groupt text-left" style="margin-top: 10px;">
                <label for="exampleInputFile">Thumbnail</label>
                <input type="file" class="form-control" name="thumbnail">

                <p class="help-block">Upload your new thumbnail</p>
            </div>
        </form>
    </div>
    <div class="box-footer with-border text-left">
        <button id="updateThumbnailSubmit" class="btn btn-primary">Update</button>
    </div>
</div>