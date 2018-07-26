<div class="row">
    <form action="{{ route('apple.index') }}" method="get">
        <div class="col-md-8 col-sm-12">
            <div class="dataTables_length" id="datatable_ajax_length">
                <label>
                    Show
                    <select name="page_size"
                            aria-controls="datatable_ajax"
                            class="form-control input-xs input-sm input-inline">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="150">150</option>
                        <option value="-1">All</option>
                    </select> records</label></div>
            <div class="dataTables_info" id="datatable_ajax_info" role="status"
                 aria-live="polite"></div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="table-group-actions pull-right">
                <span> </span>
                <input placeholder="Total fail" name="fail"
                       class="form-control input-inline input-sm input-small table-group-action-input">
                <button class="btn btn-sm green table-group-action-submit" type="submit">
                    <i class="fa fa-check"></i> Submit
                </button>
            </div>
        </div>
    </form>
</div>