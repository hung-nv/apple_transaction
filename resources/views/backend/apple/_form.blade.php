<div class="form-body">

    <div class="form-group">
        <label class="control-label col-md-2">Apple ID</label>
        <div class="col-md-8">
            <textarea name="apple_ids" class="form-control" rows="20" required>{{ $data['apple_ids'] or old('apple_ids') }}</textarea>
        </div>
    </div>

</div>