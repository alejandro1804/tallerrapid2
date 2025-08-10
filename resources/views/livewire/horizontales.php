<div class="py-6 px-4">
        <h3 class="text-xl font-semibold mb-4">Tablero Kanban</h3>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach(['nuevo', 'ejecucion', 'espera'] as $estado)
                <div class="bg-gray-100 p-4 rounded shadow min-h-[300px]" 
                        ondrop="drop(event, '{{ $estado }}')" 
                         ondragover="allowDrop(event)"
                >
                    <h5 class="text-lg font-bold mb-2">
                        {{ strtoupper($estado) }}
                    </h5>

                    @foreach(${'tickets' . ucfirst($estado)} as $ticket)
                        <div class="bg-white p-3 mb-2 rounded shadow cursor-move"
                            draggable="true"
                            ondragstart="drag(event)"
                            id="ticket-{{ $ticket->id }}"
                        >
                            <strong>{{ $ticket->item->name }}</strong> — {{ $ticket->flaw }}
                            <p class="text-xs text-gray-500">Prioridad: {{ $ticket->priority }}</p>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>