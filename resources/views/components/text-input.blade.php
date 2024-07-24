@props([
    'label' => '',
    'name' => '',
    'value' => '',
    'placeholder' => '',
    'type' => 'text',
    'disabled' => false,
])

<div class="form-control ">
    <label for="{{ $name }}" class="">{{ $label }}</label>
    <input type="{{ $type }}" class="input input-bordered @error($name) is-invalid @enderror" id="{{ $name }}"
        placeholder="{{ $placeholder }}" name="{{ $name }}" value="{{ $value }}"
        {{ $disabled ? 'disabled' : '' }}>
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
