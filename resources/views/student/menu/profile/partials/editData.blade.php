<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Edit Data</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <form id="editData" class="fpms" method="POST" action="{{ route('student.profile.update.data') }}" autocomplete="off">
            @csrf

            <div class="form-group{{ $errors->has('name') ? ' has-error' : ' has-feedback' }}">
                <label>Full Name</label>
                <input type="text" class="form-control"
                       placeholder="Full Name" name="name" value="{{ $data->name }}">
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('username') ? ' has-error' : ' has-feedback' }}">
                <label>Username</label>
                <input type="text" class="form-control"
                       placeholder="Username" name="username" value="{{ $data->username }}" disabled>
                @if ($errors->has('username'))
                    <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : ' has-feedback' }}">
                <label>Email address</label>
                <input type="email" class="form-control"
                       placeholder="Email" name="email" value="{{ $data->email }}">
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label>Gender</label>
                <div class="radio">
                    <label>
                        <input type="radio" name="gender" value="Male" {{ ($data->gender == "Male" ? 'checked' : '') }}>
                        Male
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="gender" value="Female" {{ ($data->gender == "Female" ? 'checked' : '') }}>
                        Female
                    </label>
                </div>
            </div>

            <div class="form-group{{ $errors->has('dob') ? ' has-error' : ' has-feedback' }}">
                <label>Date of birth</label>
                <input id="datepicker" type="text" class="form-control"
                       placeholder="Date of birth" name="dob" value="{{ $data->dob }}">
                @if ($errors->has('dob'))
                    <span class="help-block">
                        <strong>{{ $errors->first('dob') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('phone') ? ' has-error' : ' has-feedback' }}">
                <label>Phone Number</label>
                <input type="text" class="form-control"
                       placeholder="Phone Number" name="phone" value="{{ $data->phone }}">
                @if ($errors->has('phone'))
                    <span class="help-block">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                @endif
            </div>
        </form>
    </div>
    <div class="box-footer">
        <button id="editDataSubmit" type="submit" class="btn btn-primary bpms">
            Save
        </button>
    </div>
</div>

@section('editData.js')

    <script>
        $( "#datepicker" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            yearRange: '1950:{{ \Carbon\Carbon::now()->format('Y') }}',
        });
    </script>

    <script>
        $('#editDataSubmit').on('click',function(){
            $('#editData').submit();
        });
    </script>

@endsection