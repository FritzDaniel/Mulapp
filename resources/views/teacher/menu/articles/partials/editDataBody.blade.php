<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Edit body</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <small class="pull-right">* Required</small>
        <form id="updateBody" class="fpms" method="POST" action="{{ route('teacher.article.update.body',$data->id) }}" autocomplete="off">
            @csrf

            <div class="form-group{{ $errors->has('body') ? ' has-error' : ' has-feedback' }}">
                <label>Body *</label>
                <textarea class="textarea" id="body" name="body"
                          style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px;"
                          placeholder="Place some text here">
                        {{ $data->body }}
                    </textarea>
                @if ($errors->has('body'))
                    <span class="help-block">
                        <strong>{{ $errors->first('body') }}</strong>
                    </span>
                @endif
            </div>
        </form>
    </div>
    <div class="box-footer">
        <button id="updateBodySubmit" type="submit" class="btn btn-primary bpms">
            Update
        </button>
    </div>
</div>