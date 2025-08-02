<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
    <label for="name">{{ __('Name') }}</label>
    <input type="text" name="name" id="name"
        value="{{ old('name', $sector->name) }}"
        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
        placeholder="Name">
    @if ($errors->has('name'))
        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
    @endif
</div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>