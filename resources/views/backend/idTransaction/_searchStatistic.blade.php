<div class="row">
    <form action="{{ route('idTransaction.statistic') }}" method="get">
        <div class="col-md-7 col-sm-12">
            <div class="dataTables_length" id="datatable_ajax_length">
                <label>
                    Type
                    <select style="width: 150px"
                            aria-controls="datatable_ajax"
                            class="form-control input-xs input-sm input-inline">
                        <option value="day">Day by day</option>
                    </select> </label></div>
            <div class="dataTables_info" id="datatable_ajax_info" role="status"
                 aria-live="polite"></div>
        </div>
        <div class="col-md-5 col-sm-12">
            <div class="table-group-actions pull-right">
                <span class="text-error"> </span>
                <input placeholder="Select date" name="date" id="datetime"
                       value="@if($date !== '-1'){{ $date }}@endif"
                       class="form-control input-inline input-sm input-small table-group-action-input">
                <button class="btn btn-sm green table-group-action-submit" type="submit">
                    <i class="fa fa-check"></i> Search
                </button>
            </div>
        </div>
    </form>
</div>