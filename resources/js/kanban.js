document.addEventListener('livewire:load', () => {
    const tickets = document.querySelectorAll('.ticket');
    const columns = document.querySelectorAll('.kanban-column');

    tickets.forEach(ticket => {
        ticket.addEventListener('dragstart', ev => {
            ev.dataTransfer.setData("text/plain", ticket.dataset.ticketId);
        });
    });

    columns.forEach(column => {
        column.addEventListener('dragover', ev => {
            ev.preventDefault();
        });

        column.addEventListener('drop', ev => {
            ev.preventDefault();
            const ticketId = parseInt(ev.dataTransfer.getData("text/plain"));
            const nuevoEstado = column.dataset.estado.toUpperCase();

            console.log(`Moviendo ticket ${ticketId} a estado ${nuevoEstado}`);

            if (window.Livewire && typeof window.Livewire.emit === 'function') {
                window.Livewire.emit('ticketMovido', ticketId, nuevoEstado);
            } else {
                console.warn('Livewire no está disponible aún.');
            }
        });
    });
});