<!-- resources/views/livewire/provider-form.blade.php -->

<form wire:submit.prevent="save" class="space-y-4">
    <div>
        <label>Nombre</label>
        <input type="text" wire:model="provider.name" class="form-input w-full">
        @error('provider.name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <label>Teléfono</label>
        <input type="text" wire:model="provider.phone" class="form-input w-full">
        @error('provider.phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <label>Dirección</label>
        <input type="text" wire:model="provider.address" class="form-input w-full">
        @error('provider.address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <label>Localidad</label>
        <input type="text" wire:model="provider.location" class="form-input w-full">
        @error('provider.location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <label>País</label>
        <input type="text" wire:model="provider.country" class="form-input w-full">
        @error('provider.country') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <button type="submit" class="btn btn-primary">
        {{ $isEdit ? 'Actualizar' : 'Crear' }} Proveedor
    </button>
</form>
