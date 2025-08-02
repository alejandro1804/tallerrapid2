<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
    <label for="name">{{ __('Name') }}</label>
    <input type="text" name="name" id="name"
        value="{{ old('name', $item->name) }}"
        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
        placeholder="Name">
    @if ($errors->has('name'))
        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
    @endif
</div>

<div class="form-group">
    <label for="sector_id">{{ __('Sector Id') }}</label>
    <select name="sector_id" id="sector_id"
        class="form-control{{ $errors->has('sector_id') ? ' is-invalid' : '' }}">
        <option value="">{{ __('') }}</option>
        @foreach ($sectors as $id => $sector)
            <option value="{{ $id }}" {{ old('sector_id', $item->sector_id) == $id ? 'selected' : '' }}>
                {{ $sector }}
            </option>
        @endforeach
    </select>
    @if ($errors->has('sector_id'))
        <div class="invalid-feedback">{{ $errors->first('sector_id') }}</div>
    @endif
</div>

<div class="form-group">
    <label for="characteristic">{{ __('Characteristic') }}</label>
    <input type="text" name="characteristic" id="characteristic"
        value="{{ old('characteristic', $item->characteristic) }}"
        class="form-control{{ $errors->has('characteristic') ? ' is-invalid' : '' }}"
        placeholder="Characteristic">
    @if ($errors->has('characteristic'))
        <div class="invalid-feedback">{{ $errors->first('characteristic') }}</div>
    @endif
</div>

<div class="form-group">
    <label for="note">{{ __('note') }}</label>
    <input type="text" name="note" id="note"
        value="{{ old('note', $item->note) }}"
        class="form-control{{ $errors->has('note') ? ' is-invalid' : '' }}"
        placeholder="Note">
    @if ($errors->has('note'))
        <div class="invalid-feedback">{{ $errors->first('note') }}</div>
    @endif
</div>

<div class="form-group">
    <label for="trademark">{{ __('Trademark') }}</label>
    <input type="text" name="trademark" id="trademark"
        value="{{ old('trademark', $item->trademark) }}"
        class="form-control{{ $errors->has('trademark') ? ' is-invalid' : '' }}"
        placeholder="Trademark">
    @if ($errors->has('trademark'))
        <div class="invalid-feedback">{{ $errors->first('trademark') }}</div>
    @endif
</div>

<div class="form-group">
    <label for="provider_id">{{ __('Provider Id') }}</label>
    <select name="provider_id" id="provider_id"
        class="form-control{{ $errors->has('provider_id') ? ' is-invalid' : '' }}">
        <option value="">{{ __('') }}</option>
        @foreach ($providers as $id => $provider)
            <option value="{{ $id }}" {{ old('provider_id', $item->provider_id) == $id ? 'selected' : '' }}>
                {{ $provider }}
            </option>
        @endforeach
    </select>

    @if ($errors->has('provider_id'))
        <div class="invalid-feedback">{{ $errors->first('provider_id') }}</div>
    @endif
</div>
<div class="form-group">
    <label for="image">{{ __('Image') }}</label>
    <input type="file" name="image" id="image"
        class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}"
        accept="image/*">
    @if ($errors->has('image'))
        <div class="invalid-feedback">{{ $errors->first('image') }}</div>
    @endif
</div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>