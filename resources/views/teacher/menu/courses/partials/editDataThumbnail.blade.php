<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Edit course thumbnail</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                <i class="fa fa-minus"></i></button>
        </div>
    </div>
        <div class="box-body text-center">
        @if($dataCourse->thumbnail == null)
            <img class="img-thumbnail" src="{{ asset('assets/img/mulapp.jpg') }}" alt="" height="150" width="150">
        @else
            <img src="{{ asset('assets/uploads/thumbnail/'.$dataCourse->thumbnail) }}" alt="" height="150" width="150">
        @endif

        <form id="thumbnailCourse" action="{{ route('teacher.courses.editDataThumbnail',$data->id) }}"
              method="POST" autocomplete="off" enctype="multipart/form-data">
            @csrf

            <div class="form-group text-left" style="margin-top: 10px;">
                <label for="exampleInputFile">Thumbnail</label>
                <input type="file" class="form-control" name="thumbnail">

                <p class="help-block">Upload your new course thumbnail</p>
            </div>
        </form>
    </div>
    <div class="box-footer with-border text-left">
        <button id="thumnailCourseSubmit" class="btn btn-primary">Update</button>
    </div>
</div>

@section('courseThumbnail_js')

    <script>
        $('#thumnailCourseSubmit').on('click',function () {
            $('#thumbnailCourse').submit();
        });
    </script>

@endsection