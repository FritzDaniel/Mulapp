<div class="box" id="form_1">
    <div class="box-header with-border">
        <h3 class="box-title">Add course step 1 of 3</h3>
    </div>
    <div class="box-body">

        <h4>First, how about a working title?</h4>

        <form action="#" name="step1" autocomplete="off">

            <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control" id="title"
                       placeholder="Title" name="title"
                       value="{{ old('title') }}">
            </div>
        </form>

    </div>
    <div class="box-footer">
        <button class="btn btn-default pull-right" id="next_step1"><i class="fa fa-arrow-circle-right"></i> Next</button>
    </div>
</div>