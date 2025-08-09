<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Ticket;
use App\Models\State;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class DashboardKanban extends Component
{
    public $ticketsNuevo;
    public $ticketsEjecucion;
    public $ticketsEspera;

    public function mount()
    {
        $this->loadTickets();
    }

    public function loadTickets()
    {
        $this->ticketsNuevo = Ticket::estado('NUEVO')->with('item', 'users.state')->get();
        $this->ticketsEjecucion = Ticket::estado('EN EJECUCION')->with('item', 'users.state')->get();
        $this->ticketsEspera = Ticket::estado('EN ESPERA')->with('item', 'users.state')->get();
    }
    
    public function actualizarEstado($ticketId, $nuevoEstado)
    {
        $estado = State::where('name', $nuevoEstado)->first();
        Ticket::find($ticketId)->update(['state_id' => $estado->id]);
        $this->loadTickets();
    }

    protected $listeners = ['ticketMovido' => 'actualizarEstado'];
    
   
    public function render()
    {
        $nombresEstados = ['NUEVO', 'EN EJECUCION', 'EN ESPERA'];
        $ticketsPorEstado = [];

        foreach ($nombresEstados as $nombre) {
            $estado = State::where('name', $nombre)->first(); // o 'estado', según el campo real

            if ($estado) {
                $key = 'tickets' . ucfirst($nombre);
                $ticketsPorEstado[$key] = Ticket::where('state_id', $estado->id)
                                                ->with(['item', 'state'])
                                                ->get();
            } else {
                // Si el estado no existe, devolvemos colección vacía
                $ticketsPorEstado[$key] = collect();
            }
        }

        return view('livewire.dashboard-kanban', $ticketsPorEstado);
    }

    
}