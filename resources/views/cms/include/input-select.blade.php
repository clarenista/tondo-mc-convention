<div class="form-group">
    <div class="input-group">
        <span class="input-group-prepend">
            <span class="input-group-text">{{ $label }}</span>
        </span>
        <select class="custom-select" required name="{{ $key }}">
            <option value="">Choose...</option>
            <option value="lobby" {{ $model->{$key} == 'lobby' ? 'selected' : ''}}>Lobby</option>
            <option value="hall_a"  {{ $model->{$key} == 'hall_a' ? 'selected' : ''}}>Hall A</option>
            <option value="hall_b" {{ $model->{$key} == 'hall_b' ? 'selected' : ''}}>Hall B</option>
            <option value="hall_c" {{ $model->{$key} == 'hall_c' ? 'selected' : ''}}>Hall C</option>
            <option value="hall_d" {{ $model->{$key} == 'hall_d' ? 'selected' : ''}}>Hall D</option>
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
