<div class="row">
    <form action="{{ route('idTransaction.index') }}" method="get">
        <div class="col-md-7 col-sm-12">
            <div class="dataTables_length" id="datatable_ajax_length">
                <label>
                    Show
                    <select name="page_size" v-on:change="updatePageSize"
                            aria-controls="datatable_ajax"
                            class="form-control input-xs input-sm input-inline">
                        <option value="10" @if($pageSize == 10) selected @endif>10</option>
                        <option value="20" @if($pageSize == 20) selected @endif>20</option>
                        <option value="50" @if($pageSize == 50) selected @endif>50</option>
                        <option value="100" @if($pageSize == 100) selected @endif>100</option>
                    </select> records</label></div>
            <div class="dataTables_info" id="datatable_ajax_info" role="status"
                 aria-live="polite"></div>
        </div>
        <div class="col-md-5 col-sm-12">
            <div class="table-group-actions pull-right">
                <span class="text-error"> </span>
                <input placeholder="Id Apple" name="email" type="email"
                       value="@if($email != '-1'){{ $email }}@endif"
                       class="form-control input-inline input-sm input-small table-group-action-input">
                <button class="btn btn-sm green table-group-action-submit" type="submit">
                    <i class="fa fa-check"></i> Search
                </button>
            </div>
        </div>
    </form>
</div>