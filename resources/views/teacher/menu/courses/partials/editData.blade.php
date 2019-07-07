<div class="box">

    <div class="box-header with-border">
        <h3 class="box-title">Edit data</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <small class="pull-right">* Required</small>
        <form id="updateData" class="fpms" method="POST" action="{{ route('teacher.courses.editDataCourse',$data->id) }}" autocomplete="off" enctype="multipart/form-data">
            @csrf

            <div class="form-group{{ $errors->has('title') ? ' has-error' : ' has-feedback' }}">
                <label>Title *</label>
                <input type="text" class="form-control"
                       placeholder="Title" name="title" value="{{ $data->title }}">
                @if ($errors->has('title'))
                    <span class="help-block">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('category') ? ' has-error' : ' has-feedback' }}">
                <label>Category *</label>
                <select class="form-control select2 select2-hidden-accessible" name="category"
                        style="width: 100%;" tabindex="-1" aria-hidden="true" id="categoryInput">
                    <option value="">Select category</option>
                    @foreach($category as $cats)
                        <option value="{{ $cats->id }}" @if ( $data->category_id == $cats->id) selected @endif>{{ $cats->category }}</option>
                    @endforeach
                </select>
                @if ($errors->has('category'))
                    <span class="help-block">
                        <strong>{{ $errors->first('category') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('objective') ? ' has-error' : ' has-feedback' }}">
                <label>Objective *</label>
                <input type="text" class="form-control"
                       placeholder="Objective" name="objective" value="{{ isset($dataCourse) ? $dataCourse->objective : old('objective') }}">
                @if ($errors->has('objective'))
                    <span class="help-block">
                        <strong>{{ $errors->first('objective') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('requirement') ? ' has-error' : ' has-feedback' }}">
                <label>Requirement *</label>
                <input type="text" class="form-control"
                       placeholder="Requirement" name="requirement" value="{{ isset($dataCourse) ? $dataCourse->requirement : old('requirement') }}">
                @if ($errors->has('requirement'))
                    <span class="help-block">
                        <strong>{{ $errors->first('requirement') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('target') ? ' has-error' : ' has-feedback' }}">
                <label>Target *</label>
                <input type="text" class="form-control"
                       placeholder="Target" name="target" value="{{ isset($dataCourse) ? $dataCourse->target : old('target') }}">
                @if ($errors->has('target'))
                    <span class="help-block">
                        <strong>{{ $errors->first('target') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label>Course Price Type *</label>
                <div class="radio">
                    <label>
                        <input type="radio" name="priceType" value="0" id="freeType"
                            @if($dataCourse->priceType == 0 ) checked @endif>
                        Free
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="priceType" value="1" id="paidType"
                           @if($dataCourse->priceType == 1 ) checked @endif>
                        Paid
                    </label>
                </div>

                <div id="priceInput" class="form-group{{ $errors->has('price') ? ' has-error' : ' has-feedback' }}">
                    <label id="priceLabel">Price</label>
                    <input type="number" class="form-control"
                           placeholder="Insert Point" name="price" value="{{ isset($dataCourse) ? $dataCourse->price : old('price') }}">
                    @if ($errors->has('price'))
                        <span class="help-block">
                        <strong>{{ $errors->first('price') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('description') ? ' has-error' : ' has-feedback' }}">
                    <label>Description</label>
                    <textarea class="textarea" name="description"
                              style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px;"
                              placeholder="Place some text here">{{ isset($dataCourse) ? $dataCourse->description : old('description') }}</textarea>
                    @if ($errors->has('description'))
                        <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                    @endif
                </div>

            </div>
        </form>
    </div>
    <div class="box-footer">
        <button id="updateDataSubmit" type="submit" class="btn btn-primary bpms">
            Update
        </button>
    </div>
</div>

@section('course_js')
    <script src="{{ asset('assets/adminLTE/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

    <script src="{{ asset('assets/adminLTE/plugins/bootstrap-wysihtml5/html5editor-fixed.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#categoryInput').select2();
        });
    </script>

    <script>
        $('#updateDataSubmit').on('click',function () {
            $('#updateData').submit();
        });
    </script>

    <script>
        if ({{ $dataCourse->priceType }} == 0)
        {
            $('#priceInput').hide();
        }
        else
        {
            $('#priceInput').show();
        }

        $('#paidType').on('change',function () {
            $('#priceInput').show();
        });

        $('#freeType').on('change',function () {
            $('#priceInput').hide();
        });

    </script>

@endsection