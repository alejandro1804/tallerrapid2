<div class="box box-info padding-1">
    <div class="box-body">
        
       <div class="form-group">
    <label for="name">{{ __('Name') }}</label>
    <input type="text" name="name" id="name"
        value="{{ old('name', $user->name) }}"
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
            <option value="{{ $id }}" {{ old('position_id', $user->position_id) == $id ? 'selected' : '' }}>
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
        value="{{ old('phone', $user->phone) }}"
        class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
        placeholder="Phone">
    @if ($errors->has('phone'))
        <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
    @endif
</div>


<div class="form-group">
    <label for="email">{{ __('Email') }}</label>
    <input type="text" name="email" id="email"
        value="{{ old('email', $user->email) }}"
        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
        placeholder="Email">
    @if ($errors->has('email'))
        <div class="invalid-feedback">{{ $errors->first('email') }}</div>
    @endif
</div>
<div class="form-group">
    <label for="role_id">{{ __('Role') }}</label>
    <select name="role_id" id="role_id"
        class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}">
        <option value="">{{ __('') }}</option>
        @foreach ($roles as $id => $role)
            <option value="{{ $id }}" {{ old('role_id', $user->role_id) == $id ? 'selected' : '' }}>
                {{ $role }}
            </option>
        @endforeach
    </select>
    @if ($errors->has('role_id'))
        <div class="invalid-feedback">{{ $errors->first('role_id') }}</div>
    @endif
</div>


    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>