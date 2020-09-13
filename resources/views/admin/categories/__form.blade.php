<div class="form-row">
    <div class="form-group col-md-6">
        <label for="name">{{ __('categories.fields.name') }}</label>
        <input
            type="text"
            id="name"
            name="name"
            class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', optional($category ?? '')->name) }}">
        @error('name') <p class="text-danger">{{ $message }}</p> @enderror
    </div>
    <div class="form-group col-md-6">
        <label for="name">{{ __('categories.fields.slug') }}</label>
        <input
            type="text"
            id="slug"
            name="slug"
            class="form-control @error('slug') is-invalid @enderror"
            value="{{ old('slug', optional($category ?? '')->slug) }}">
        @error('slug') <p class="text-danger">{{ $message }}</p> @enderror
    </div>
</div>
