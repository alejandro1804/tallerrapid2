<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
    <label for="ticket_id">{{ __('Ticket Id') }}</label>
    <select name="ticket_id" id="ticket_id"
        class="form-control{{ $errors->has('ticket_id') ? ' is-invalid' : '' }}">
        <option value="">{{ __('Ticket Id') }}</option>
        @foreach ($tickets as $id => $ticket)
            <option value="{{ $id }}" {{ old('ticket_id', $binnacle->ticket_id) == $id ? 'selected' : '' }}>
                {{ $ticket }}
            </option>
        @endforeach
    </select>
    @if ($errors->has('ticket_id'))
        <div class="invalid-feedback">{{ $errors->first('ticket_id') }}</div>
    @endif
</div>

<div class="form-group">
    <label for="user_id">{{ __('User Id') }}</label>
    <select name="user_id" id="user_id"
        class="form-control{{ $errors->has('user_id') ? ' is-invalid' : '' }}">
        <option value="">{{ __('User Id') }}</option>
        @foreach ($users as $id => $user)
            <option value="{{ $id }}" {{ old('user_id', $binnacle->user_id) == $id ? 'selected' : '' }}>
                {{ $user }}
            </option>
        @endforeach
    </select>
    @if ($errors->has('user_id'))
        <div class="invalid-feedback">{{ $errors->first('user_id') }}</div>
    @endif
</div>

<div class="form-group">
    <label for="note">{{ __('Note') }}</label>
    <input type="text" name="note" id="note"
        value="{{ old('note', $binnacle->note) }}"
        class="form-control{{ $errors->has('note') ? ' is-invalid' : '' }}"
        placeholder="Note">
    @if ($errors->has('note'))
        <div class="invalid-feedback">{{ $errors->first('note') }}</div>
    @endif
</div>
     </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>