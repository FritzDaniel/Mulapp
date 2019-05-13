<form id="form_1" class="fpms" method="POST" action="{{ route('admin.notify.send_all') }}" autocomplete="off">
    @csrf

    <div class="form-group{{ $errors->has('title') ? ' has-error' : ' has-feedback' }}">
        <label>Title</label>
        <input type="text" class="form-control"
               placeholder="Title" name="title"
               value="{{ old('title') }}">
        @if ($errors->has('title'))
            <span class="help-block">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('body') ? ' has-error' : ' has-feedback' }}">
        <label>Body</label>
        <textarea class="textarea" id="body_form1" name="body"
              style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px;"
              placeholder="Place some text here">
                    {{ old('body') }}
        </textarea>
        @if ($errors->has('body'))
            <span class="help-block">
                <strong>{{ $errors->first('body') }}</strong>
            </span>
        @endif
    </div>
</form>