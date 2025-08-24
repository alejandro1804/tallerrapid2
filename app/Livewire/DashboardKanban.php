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
        
        if (!$estado) return;

         Ticket::find($ticketId)?->update(['state_id' => $estado->id]);

        $this->loadTickets();
    }

    protected $listeners = ['ticketMovido' => 'actualizarEstado'];
    
   
    public function render()
    {
       return view('livewire.dashboard-kanban', [
        'ticketsNuevo' => $this->ticketsNuevo,
        'ticketsEjecucion' => $this->ticketsEjecucion,
        'ticketsEspera' => $this->ticketsEspera,
        ]);
    }
  
}