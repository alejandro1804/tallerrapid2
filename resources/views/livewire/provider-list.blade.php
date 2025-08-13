<!-- resources/views/livewire/provider-list.blade.php -->

<div class="space-y-4">
    <input type="text" wire:model.debounce.300ms="search" placeholder="Buscar proveedor..." class="form-input w-full">

    @if(session()->has('message'))
        <div class="text-green-600">{{ session('message') }}</div>
    @endif

    <table class="table-auto w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">Nombre</th>
                <th class="px-4 py-2">Teléfono</th>
                <th class="px-4 py-2">Localidad</th>
                <th class="px-4 py-2">País</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($providers as $provider)
                <tr>
                    <td class="px-4 py-2">{{ $provider->name }}</td>
                    <td class="px-4 py-2">{{ $provider->phone }}</td>
                    <td class="px-4 py-2">{{ $provider->location }}</td>
                    <td class="px-4 py-2">{{ $provider->country }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('providers.edit', $provider->id) }}" class="text-blue-600">Editar</a>
                        <button wire:click="delete({{ $provider->id }})" class="text-red-600">Eliminar</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-2 text-center text-gray-500">No se encontraron proveedores.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $providers->links() }}
    </div>
</div>
