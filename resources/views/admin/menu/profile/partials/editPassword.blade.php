<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">New Password</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <form class="fpms" id="editPassword" action="{{ route('admin.profile.update.password') }}" method="POST" autocomplete="off">
            @csrf
            <div class="form-group{{ $errors->has('password') ? ' has-error' : ' has-feedback' }}">
                <label>Password</label>
                <input id="passwordInput" type="password" class="form-control"
                       placeholder="Password" name="password" autocomplete="new-password">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" id="checkPassword">
                        Show Password
                    </label>
                </div>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : ' has-feedback' }}">
                <label>Retype password</label>
                <input id="passwordConfirmationInput" type="password" class="form-control"
                       placeholder="Retype password" name="password_confirmation" autocomplete="new-password">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" id="checkPasswordConfirmation">
                        Show Password Confirmation
                    </label>
                </div>
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>
        </form>
    </div>
    <div class="box-footer">
        <button id="editPasswordSubmit" type="submit" class="btn btn-primary bpms">
            Save
        </button>
    </div>
</div>

@section('editPassword.js')
    <script>
        $('#editPasswordSubmit').on('click',function(){
            $('#editPassword').submit();
        });
    </script>
    <script>
        $(document).ready(function(){
            $('#checkPassword').click(function(){
                $(this).is(':checked') ?
                    $('#passwordInput').attr('type', 'text') :
                    $('#passwordInput').attr('type', 'password');
            });
            $('#checkPasswordConfirmation').click(function(){
                $(this).is(':checked') ?
                    $('#passwordConfirmationInput').attr('type', 'text') :
                    $('#passwordConfirmationInput').attr('type', 'password');
            });
        });
    </script>
@endsection