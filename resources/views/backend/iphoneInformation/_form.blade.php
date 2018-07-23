<div class="form-body">

    <div class="form-group">
        <label class="control-label col-md-3">Internal Name</label>
        <div class="col-md-9">
            <input type="text" name="internal_name" class="form-control" title="Internal Name"
                   value="{{ $data['internal_name'] or old('internal_name') }}" required>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3">Identify</label>
        <div class="col-md-9">
            <input type="text" name="identify" class="form-control" title="Identify"
                   value="{{ $data['identify'] or old('identify') }}" required>
        </div>
    </div>

    <div class="form-group last">
        <label class="control-label col-md-3">Models</label>
        <div class="col-md-9">
            <textarea name="models" class="form-control" rows="10"
                      required>{{ $data['models'] or old('models') }}</textarea>
        </div>
    </div>

</div>