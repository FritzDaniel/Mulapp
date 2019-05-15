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
        <form id="updateData" class="fpms" method="POST" action="{{ route('teacher.article.update.data',$data->id) }}" autocomplete="off" enctype="multipart/form-data">
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
                    @foreach($cat as $cats)
                        <option value="{{ $cats->id }}" @if ( $data->category_id == $cats->id) selected @endif>{{ $cats->category }}</option>
                    @endforeach
                </select>
                @if ($errors->has('category'))
                    <span class="help-block">
                            <strong>{{ $errors->first('category') }}</strong>
                        </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('tag') ? ' has-error' : ' has-feedback' }}">
                <label>Tags *</label>
                <select class="form-control select2 select2-hidden-accessible"
                        name="tag[]" multiple="multiple" data-placeholder="Tag" style="width: 100%;"
                        tabindex="-1" aria-hidden="true" id="tagsInput">
                    <option value="">Select Tag</option>
                    @foreach($tags as $tag)
                        <option
                            @foreach($tagsData as $editTags)
                                @if($editTags->tags_id == $tag->id)
                                    value="{{ $tag->id }}" selected
                                @else
                                    value="{{ $tag->id }}"
                                @endif
                            @endforeach
                        >
                            {{ $tag->tags }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('tag'))
                    <span class="help-block">
                            <strong>{{ $errors->first('tag') }}</strong>
                        </span>
                @endif
                <small>Add new tags <a href="#" data-toggle="modal" data-target="#tagsModal">here!</a></small>
            </div>

            <div class="form-group">
                <label>Allow Comments *</label>
                <div class="radio">
                    <label>
                        <input type="radio" name="allow_comment" value="1"
                            {{ $data->allow_comment == 1 ? 'checked' : '' }}
                        >
                        Allowed
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="allow_comment" value="0"
                            {{ $data->allow_comment == 0 ? 'checked' : '' }}
                        >
                        Disabled
                    </label>
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