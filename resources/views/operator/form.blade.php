<div class="box box-info padding-1">
    <div class="box-body">
        
       <div class="form-group">
    <label for="name">{{ __('Name') }}</label>
    <input type="text" name="name" id="name"
        value="{{ old('name', $operator->name) }}"
        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
        placeholder="Name">
    @if ($errors->has('name'))
        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
    @endif
</div>

<div class="form-group">
    <label for="position_id">{{ __('Position') }}</label>
    <select name="position_id" id="position_id"
        class="form-control{{ $errors->has('position') ? ' is-invalid' : '' }}">
        <option value="">{{ __('') }}</option>
        @foreach ($positions as $id => $position)
            <option value="{{ $id }}" {{ old('position_id', $operator->position_id) == $id ? 'selected' : '' }}>
                {{ $position }}
            </option>
        @endforeach
    </select>
    @if ($errors->has('position_id'))
        <div class="invalid-feedback">{{ $errors->first('position_id') }}</div>
    @endif
</div>

<div class="form-group">
    <label for="phone">{{ __('Phone') }}</label>
    <input type="text" name="phone" id="phone"
        value="{{ old('phone', $operator->phone) }}"
        class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
        placeholder="Phone">
    @if ($errors->has('phone'))
        <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
    @endif
</div>

<div class="form-group">
    <label for="status">{{ __('Status') }}</label>
    <select name="status" id="status" 
        class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}">
        <option value="activo" {{ old('status', $operator->status) == 'ACTIVO' ? 'selected' : '' }}>ACTIVO</option>
        <option value="inactivo" {{ old('status', $operator->status) == 'DESVINCULADO' ? 'selected' : '' }}>DESVINCULADO</option>
        <option value="suspendido" {{ old('status', $operator->status) == 'SUSPENDIDO' ? 'selected' : '' }}>SUSPENDIDO</option>
    </select>

    @if ($errors->has('status'))
        <div class="invalid-feedback">{{ $errors->first('status') }}</div>
    @endif
</div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>