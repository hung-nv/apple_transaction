<div class="form-body">
    <div class="form-group">
        <label class="control-label col-md-2">Credit numbers</label>
        <div class="col-md-8">
            <textarea name="credit_cards" class="form-control" rows="20" required>{{ $data['credit_cards'] or old('credit_cards') }}</textarea>
        </div>
    </div>
</div>