<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
    <label for="name">{{ __('Name') }}</label>
    <input type="text" name="name" id="name"
        value="{{ old('name', $provider->name) }}"
        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
        placeholder="Name">
    @if ($errors->has('name'))
        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
    @endif
</div>

<div class="form-group">
    <label for="phone">{{ __('Phone') }}</label>
    <input type="text" name="phone" id="phone"
        value="{{ old('phone', $provider->phone) }}"
        class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
        placeholder="Phone">
    @if ($errors->has('phone'))
        <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
    @endif
</div>

<div class="form-group">
    <label for="adress">{{ __('Adress') }}</label>
    <input type="text" name="adress" id="adress"
        value="{{ old('adress', $provider->adress) }}"
        class="form-control{{ $errors->has('adress') ? ' is-invalid' : '' }}"
        placeholder="Adress">
    @if ($errors->has('adress'))
        <div class="invalid-feedback">{{ $errors->first('adress') }}</div>
    @endif
</div>

<div class="form-group">
    <label for="location">{{ __('Location') }}</label>
    <input type="text" name="location" id="location"
        value="{{ old('location', $provider->location) }}"
        class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}"
        placeholder="Location">
    @if ($errors->has('location'))
        <div class="invalid-feedback">{{ $errors->first('location') }}</div>
    @endif
</div>

<div class="form-group">
    <label for="country">{{ __('Country') }}</label>
    <input type="text" name="country" id="country"
        value="{{ old('country', $provider->country) }}"
        class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}"
        placeholder="Country">
    @if ($errors->has('country'))
        <div class="invalid-feedback">{{ $errors->first('country') }}</div>
    @endif
</div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>