<div class="box" id="form_2" style="display: none;">
    <div class="box-header with-border">
        <h3 class="box-title">Add course step 2 of 3</h3>
    </div>
    <div class="box-body">

        <h4>What category best fits the knowledge you'll share?</h4>

        <form action="#" name="step2" autocomplete="off">

            <div class="form-group">
                <label>Category</label>
                <select class="form-control" name="category" id="category"
                        style="width: 100%;" tabindex="-1" aria-hidden="true">
                    <option value="">Select category</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">
                            {{ $cat->category }}
                        </option>
                    @endforeach
                </select>

            </div>
        </form>

    </div>
    <div class="box-footer">
        <button id="prev_step2" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Previous</button>
        <button id="next_step2" class="btn btn-default pull-right"><i class="fa fa-arrow-circle-right"></i> Next</button>
    </div>
</div>