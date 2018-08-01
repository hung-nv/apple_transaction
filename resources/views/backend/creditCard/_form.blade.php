<div class="form-body">

    <div class="form-group last">
        <label class="control-label col-md-3">Credit Cards</label>
        <div class="col-md-9">
            <textarea name="credit_cards" class="form-control" rows="10" required>{{ $data['credit_cards'] or old('credit_cards') }}</textarea>
            <span class="help-block">
                Example:<br />
                1111111111111111<br/>
                2222222222222222
            </span>
        </div>
    </div>

</div>