<div class="form-group">
    <div class="input-group">
        <span class="input-group-prepend">
            <span class="input-group-text">{{ $label }}</span>
        </span>

        <select class="custom-select" required name="{{ $key }}">
            <option value="">Select type</option>
            <option value="gold" {{ $model->{$key} == 'gold' ? 'selected' : ''}}>Gold</option>
            <option value="silver" {{ $model->{$key} == 'silver' ? 'selected' : ''}}>Silver</option>
            <option value="bronze" {{ $model->{$key} == 'bronze' ? 'selected' : ''}}>Bronze</option>
        </select>
        <!-- <input type="text" class="form-control" name="{{ $key }}" placeholder="{{ $label }}" aria-label="{{ $label }}"
            value="{{ old($key, $model->{$key}) }}"> -->
    </div>
</div>
<div class="form-group">
    @error($key)
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
