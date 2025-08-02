<div class="box box-info padding-1">
    <div class="box-body">
        @if ($ticket->exists)
        <div class="form-group">
            <label for="state_id">{{ __('State') }}</label>
            <select name="state_id" id="state_id" class="form-control{{ $errors->has('state_id') ? ' is-invalid' : '' }}">
                <option value="">{{ __('') }}</option>
                @foreach ($states as $id => $state)
                    
                    <option value="{{ $id }}" {{ old('state_id', $ticket->state_id ?? '') == $id ? 'selected' : '' }}>
                        {{ $state }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('state_id'))
                <div class="invalid-feedback">
                    {{ $errors->first('state_id') }}
                </div>
            @endif
        </div>
        @endif    
<input type="hidden" name="admission" value="{{ $ticket->admission }}">

<div class="form-group">
    <label for="item_id">{{ __('Item') }}</label>
    <select name="item_id" id="item_id" class="form-control{{ $errors->has('item_id') ? ' is-invalid' : '' }}">
        <option value="">{{ __('') }}</option>
        @foreach ($items as $id => $item)
            <option value="{{ $id }}" {{ old('item_id', $ticket->item_id) == $id ? 'selected' : '' }}>
                {{ $item }}
            </option>
        @endforeach
    </select>
    @if ($errors->has('item_id'))
        <div class="invalid-feedback">
            {{ $errors->first('item_id') }}
        </div>
    @endif
</div>

<div class="form-group">
    <label for="flaw">{{ __('Defecto') }}</label>
    <input type="text" name="flaw" id="flaw" value="{{ old('flaw', $ticket->flaw) }}"
        class="form-control{{ $errors->has('flaw') ? ' is-invalid' : '' }}" placeholder="Flaw">
    @if ($errors->has('flaw'))
        <div class="invalid-feedback">
            {{ $errors->first('flaw') }}
        </div>
    @endif
</div>


<div class="form-group">
    <label for="priority">{{ __('Priority') }}</label>
    <select name="priority" id="priority" 
        class="form-control{{ $errors->has('priority') ? ' is-invalid' : '' }}">
        <option value="1" {{ old('priority', $ticket->priority) == 'ALTA' ? 'selected' : '' }}>1-ALTA</option>
        <option value="2" {{ old('priority', $ticket->priority) == 'MEDIA' ? 'selected' : '' }}>2-MEDIA</option>
        <option value="3" {{ old('priority', $ticket->priority) == 'BAJA' ? 'selected' : '' }}>3-BAJA</option>
    </select>

    @if ($errors->has('priority'))
        <div class="invalid-feedback">{{ $errors->first('status') }}</div>
    @endif
</div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>