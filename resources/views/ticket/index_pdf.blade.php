<h2 style="text-align: center;">Listado de Tickets</h2>

<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <thead style="background-color: #f2f2f2;">
        <tr>
            <th>ID</th>
            <th>Estado</th>
            <th>Ingreso</th>
            <th>Item</th>
            <th>Falla</th>
            <th>Prioridad</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tickets as $ticket)
            <tr>
                <td>{{ $ticket->id }}</td>
                <td>{{ $ticket->state->name ?? 'Sin estado' }}</td>
                <td>{{ $ticket->admission }}</td>
                <td>{{ $ticket->item->name ?? 'Sin item' }}</td>
                <td>{{ $ticket->flaw }}</td>
                <td>{{ $ticket->priority }}</td>
            </tr>
        @endforeach
    </tbody>
</table>