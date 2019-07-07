<div class="box" id="form_3" style="display:none;">
    <div class="box-header with-border">
        <h3 class="box-title">Add course step 3 of 3</h3>
    </div>
    <div class="box-body">

        <h4>Target your students</h4>

        <form action="#" name="step3" autocomplete="off">

            <div class="form-group">
                <label>What will students learn in your course?</label>
                <input type="text" class="form-control" id="objective"
                       placeholder="Objective course ex* Learn about crud,Learn about game development flow,.." name="title"
                       value="">
            </div>

            <div class="form-group">
                <label>Are there any course requirements or prerequisites?</label>
                <input type="text" class="form-control" id="requirement"
                       placeholder="Requirement course ex* Basic php,Basic C++,.." name="title"
                       value="{{ old('title') }}">
            </div>

            <div class="form-group">
                <label>Who are your target students?</label>
                <input type="text" class="form-control" id="target"
                       placeholder="Target ex* Photographer,student,.." name="title"
                       value="{{ old('title') }}">
            </div>

        </form>

    </div>
    <div class="box-footer">
        <button id="prev_step3" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Previous</button>
        <button id="save" class="btn btn-success pull-right"><i class="fa fa-check"></i> Save</button>
    </div>
</div>