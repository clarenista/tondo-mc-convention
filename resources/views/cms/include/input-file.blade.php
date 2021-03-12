<div class="form-group">
    <div class="input-group">
        <span class="input-group-prepend">
            <span class="input-group-text">{{ $label }}</span>
        </span>
        <div class="custom-file">
            <input type="file" class="custom-file-input" name="{{ $key }}">
            <label class="custom-file-label">Choose file</label>
        </div>
    </div>
</div>
<div class="form-group">
    @error($key)
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
