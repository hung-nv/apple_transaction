<div class="form-body">

    <div class="form-group last">
        <label class="control-label col-md-3">Apple ID</label>
        <div class="col-md-9">
            <textarea name="apple_ids" class="form-control" rows="10" required>{{ $data['apple_ids'] or old('apple_ids') }}</textarea>
        </div>
    </div>

</div>