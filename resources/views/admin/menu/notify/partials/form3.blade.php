<form id="form_3" class="fpms" method="POST" action="{{ route('admin.notify.send_multiple') }}" autocomplete="off" style="display: none">
    @csrf

    <div class="form-group{{ $errors->has('user_id') ? ' has-error' : ' has-feedback' }}">
        <label>Select User</label>
        <select class="form-control select2 select2-hidden-accessible"
                name="user_id[]" multiple="multiple" style="width: 100%;"
                tabindex="-1" aria-hidden="true" id="form3_selectUser">
            @foreach($users as $user)
                <option value="{{ $user->id }}"
                    @if(old('user_id'))
                        @foreach(old('user_id') as $oldSelected)
                            @if($user->name == $oldSelected)
                                selected
                            @elseif($user->id == $oldSelected)
                                selected
                            @else

                            @endif
                        @endforeach
                    @endif>
                {{ $user->name }}
                </option>
            @endforeach
        </select>

        @if ($errors->has('user_id'))
            <span class="help-block">
                <strong>{{ $errors->first('user_id') }}</strong>
            </span>
        @endif
    </div>

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
        <textarea class="textarea" id="body_form3" name="body"
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