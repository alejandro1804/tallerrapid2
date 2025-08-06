<div class="box box-info padding-1">
    <div class="box-body">
        <input type="hidden" name="ticket_id" value="{{ $ticket_id }}">
        <input type="hidden" name="user_id" value="{{ $user_id }}">

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