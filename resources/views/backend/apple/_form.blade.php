<div class="form-body">

    <div class="form-group last">
        <label class="control-label col-md-3">Apple ID</label>
        <div class="col-md-9">
            <textarea name="apple_ids" class="form-control" rows="10" required>{{ $data['apple_ids'] or old('apple_ids') }}</textarea>
            <span class="help-block">
                Example:<br />
                demo1@gmail.com|pass1<br/>
                demo2@gmail.com|pass2
            </span>
        </div>
    </div>

</div>