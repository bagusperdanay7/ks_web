@props([
    'name', 'label' => 'Name', 'placeholder' => 'Placeholder here', 'model' => ''
])

@use('Illuminate\Support\Str')

<div class="m-bottom-15">
    <label for="{{ Str::camel($name) }}" class="form-label text-color-100 m-bottom-10 fs-18 fw-medium">{{ $label }}</label>
    <input type="text" class="form-control @error($name) is-invalid @enderror"
        name="{{ $name }}" id="{{ Str::camel($name) }}" placeholder="{{ $placeholder }}"
        value="{{ old($name, $model) }}">
    @error($name)
        <div id="{{ Str::camel($name) }}Feedback" class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>