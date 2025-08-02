<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name"
                   value="{{ old('name', $state->name ?? '') }}"
                   placeholder="Name"
                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>