<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
    <label for="item_id">{{ __('Item Id') }}</label>
    <select name="item_id" id="item_id"
        class="form-control{{ $errors->has('item_id') ? ' is-invalid' : '' }}">
        <option value="">{{ __('') }}</option>
        @foreach ($items as $id => $item)
            <option value="{{ $id }}" {{ old('item_id', $part->item_id) == $id ? 'selected' : '' }}>
                {{ $item }}
            </option>
        @endforeach
    </select>
    @if ($errors->has('item_id'))
        <div class="invalid-feedback">{{ $errors->first('item_id') }}</div>
    @endif
</div>

<div class="form-group">
    <label for="name">{{ __('Name') }}</label>
    <input type="text" name="name" id="name"
        value="{{ old('name', $part->name) }}"
        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
        placeholder="Name">
    @if ($errors->has('name'))
        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
    @endif
</div>

<div class="form-group">
    <label for="note">{{ __('Note') }}</label>
    <input type="text" name="note" id="note"
        value="{{ old('note', $part->note) }}"
        class="form-control{{ $errors->has('note') ? ' is-invalid' : '' }}"
        placeholder="Note">
    @if ($errors->has('note'))
        <div class="invalid-feedback">{{ $errors->first('note') }}</div>
    @endif
</div>

<div class="form-group">
    <label for="provider_id">{{ __('Provider Id') }}</label>
    <select name="provider_id" id="provider_id"
        class="form-control{{ $errors->has('provider_id') ? ' is-invalid' : '' }}">
        <option value="">{{ __('') }}</option>
        @foreach ($providers as $id => $provider)
            <option value="{{ $id }}" {{ old('provider_id', $part->provider_id) == $id ? 'selected' : '' }}>
                {{ $provider }}
            </option>
        @endforeach
    </select>
    @if ($errors->has('provider_id'))
        <div class="invalid-feedback">{{ $errors->first('provider_id') }}</div>
    @endif
</div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>