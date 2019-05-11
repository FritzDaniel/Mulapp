<div class="modal fade" id="tagsModal" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Add tags</h4>
            </div>
            <div class="modal-body">

                <form id="tagsForm" class="fpms" method="POST" action="{{ route('admin.tags.store') }}" autocomplete="off">
                    @csrf

                    <div class="form-group{{ $errors->has('tags') ? ' has-error' : ' has-feedback' }}">
                        <label>Tags</label>
                        <input type="text" class="form-control"
                               placeholder="Tags title" name="tags" value="{{ old('tags') }}">
                        @if ($errors->has('tags'))
                            <span class="help-block">
                        <strong>{{ $errors->first('tags') }}</strong>
                    </span>
                        @endif
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary pull-left bpms" id="submitTags">Save</button>
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>