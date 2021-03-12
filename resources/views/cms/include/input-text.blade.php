<div class="form-group">
    <div class="input-group">
        <span class="input-group-prepend">
            <span class="input-group-text">{{ $label }}</span>
        </span>
        <input type="text" class="form-control" name="{{ $key }}" placeholder="{{ $label }}" aria-label="{{ $label }}"
            value="{{ old($key, $model->{$key}) }}">
    </div>
</div>
<div class="form-group">
    @error($key)
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
