<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\State;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

/**
 * Class TicketController
 */
class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
/*    public function index(Request $request)
    {
        $search = $request->get('search');
        $estados = $request->get('estado', []); // Checkboxes seleccionados

        $fechaInicio = $request->get('fecha_inicio');
        $fechaFin = $request->get('fecha_fin');

        $states = State::pluck('name', 'id');
        $items = Item::pluck('name', 'id');

        // Construcción dinámica de la query
        $query = Ticket::with(['state', 'item'])->orderBy('id', 'DESC');

        if ($search) {
            $query->where('id', 'like', '%'.$search.'%'); // asegurate de usar el campo correcto
        }

        if (! empty($estados)) {
            $query->whereHas('state', function ($q) use ($estados) {
                $q->whereIn('name', $estados);
            });
        }
        if ($fechaInicio && $fechaFin) {
            $query->whereBetween('admission', [$fechaInicio, $fechaFin]);
        } elseif ($fechaInicio) {
            $query->whereDate('admission', '>=', $fechaInicio);
        } elseif ($fechaFin) {
            $query->whereDate('admission', '<=', $fechaFin);
        }

        $tickets = $query->paginate(6);

        // Contadores
        $cantidad = 'Total emitidos   '.Ticket::count().'______   ';
        $finalizado = 'Total finalizados    '.Ticket::where('state_id', 2)->count().'    ';

        return view('ticket.index', compact('states', 'tickets', 'items', 'cantidad', 'finalizado'))
            ->with('i', (request()->input('page', 1) - 1) * $tickets->perPage());

            //$query = Ticket::with(['state', 'item', 'binnacles'])->orderBy('id', 'DESC');
    } */

 /*  public function index(Request $request)
{
    $search = $request->get('search');
    $estados = $request->get('estado', []);
    $fechaInicio = $request->get('fecha_inicio');
    $fechaFin = $request->get('fecha_fin');

    $states = State::pluck('name', 'id');
    $items = Item::pluck('name', 'id');

    // Construcción dinámica de la query
    $query = Ticket::query()
        ->with(['state', 'item'])
        ->withCount('binnacles')
        ->orderBy('id', 'DESC');

    if ($search) {
        $query->where('id', 'like', '%'.$search.'%');
    }

    if (!empty($estados)) {
        $query->whereHas('state', function ($q) use ($estados) {
            $q->whereIn('name', $estados);
        });
    }

    if ($fechaInicio && $fechaFin) {
        $query->whereBetween('admission', [$fechaInicio, $fechaFin]);
    } elseif ($fechaInicio) {
        $query->whereDate('admission', '>=', $fechaInicio);
    } elseif ($fechaFin) {
        $query->whereDate('admission', '<=', $fechaFin);
    }

    // ✅ Esta línea debería funcionar correctamente
    $tickets = $query->paginate(6);

    $cantidad = 'Total emitidos   ' . Ticket::count() . '______   ';
    $finalizado = 'Total finalizados    ' . Ticket::where('state_id', 2)->count() . '    ';

    return view('ticket.index', compact('states', 'tickets', 'items', 'cantidad', 'finalizado'))
        ->with('i', (request()->input('page', 1) - 1) * $tickets->perPage());
}   */

/*
public function index(Request $request)
{
    $query = Ticket::query();

    // Filtros existentes
    if ($request->filled('search')) {
        $query->where('description', 'like', '%' . $request->search . '%');
    }

    if ($request->filled('estado')) {
        $query->whereIn('state_id', $request->estado); // Ajustar si usás nombres en vez de IDs
    }

    if ($request->filled('fecha_inicio')) {
        $query->whereDate('admission', '>=', $request->fecha_inicio);
    }

    if ($request->filled('fecha_fin')) {
        $query->whereDate('admission', '<=', $request->fecha_fin);
    }

    // Nuevos filtros
        // 🔍 Filtro por autor (many-to-many)
    if ($request->filled('author_id')) {
        $query->whereHas('users', function ($q) use ($request) {
            $q->where('users.id', $request->author_id)
              ->where('ticket_user.role_in_ticket', 'autor');
        });
    }



    if ($request->filled('item_id')) {
        $query->where('item_id', $request->item_id);
    }

    if ($request->filled('priority')) {
        $query->where('priority', $request->priority);
    }

    $tickets = $query->with(['author', 'item', 'state'])->paginate(10);

    // Contadores
 /*   $cantidad = $query->count(); // Total filtrado
    $finalizado = $query->whereHas('state', function ($q) {
        $q->where('name', 'Finalizado'); // Ajustá si usás otro campo
    })->count();  */
/*


    $authors = User::pluck('name', 'id');
    $items = Item::pluck('name', 'id');
    $priorities = ['Alta', 'Media', 'Baja'];

    return view('ticket.index', compact('tickets', 'authors', 'items', 'priorities'))
        ->with('i', (request()->input('page', 1) - 1) * $tickets->perPage());
} */
    public function index(Request $request)
{
    $query = Ticket::query();

    // 🔍 Filtro por texto libre
    if ($request->filled('search')) {
        $query->where('flaw', 'like', '%' . $request->search . '%');
    }

    // 📅 Filtro por fechas
    if ($request->filled('fecha_inicio')) {
        $query->whereDate('admission', '>=', $request->fecha_inicio);
    }

    if ($request->filled('fecha_fin')) {
        $query->whereDate('admission', '<=', $request->fecha_fin);
    }

    // 📌 Filtro por estado (por nombre, no ID)
    if ($request->filled('estado')) {
        $query->whereHas('state', function ($q) use ($request) {
            $q->whereIn('name', $request->estado);
        });
    }

    // 👤 Filtro por autor (many-to-many con pivot)
    if ($request->filled('author_id')) {
        $query->whereHas('users', function ($q) use ($request) {
            $q->where('users.id', $request->author_id)
              ->where('ticket_user.role_in_ticket', 'autor');
        });
    }

    // ⚙️ Filtro por item
    if ($request->filled('item_id')) {
        $query->where('item_id', $request->item_id);
    }

    // 🔥 Filtro por prioridad
    $priorityMap = [    'Alta' => 1,    'Media' => 2,    'Baja' => 3];

    if ($request->filled('priority') && isset($priorityMap[$request->priority])) {
    $query->where('priority', $priorityMap[$request->priority]);
    }
    /*
    if ($request->filled('priority')) {
        $query->where('priority', $request->priority);
    } */

    // 📦 Cargar relaciones necesarias
    $filteredQuery = clone $query;

    $tickets = $query->with(['users', 'item', 'state', 'binnacles'])->paginate(10);

    // 📊 Contadores
    $cantidad = $filteredQuery->count();

    $finalizado = (clone $filteredQuery)->whereHas('state', function ($q) {
        $q->where('name', 'CERRADO');
    })->count();

    // 📋 Datos para los selects
    $authors = User::whereHas('tickets', function ($q) {
        $q->where('ticket_user.role_in_ticket', 'autor');
    })->pluck('name', 'id');

    $items = Item::pluck('name', 'id');
    //$priorities = ['Alta', 'Media', 'Baja'];

    return view('ticket.index', compact(
        'tickets', 'authors', 'items', 'priorityMap', 'cantidad', 'finalizado'
    ))->with('i', (request()->input('page', 1) - 1) * $tickets->perPage());
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = State::orderBy('name')->pluck('name', 'id');
        $items = Item::pluck('name', 'id');
        $ticket = new Ticket;

        return view('ticket.create', compact('ticket', 'items', 'states'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'state_id' => 'required|exists:states,id',
            'item_id' => 'required|exists:items,id',
            'flaw' => 'required|string|max:255',
            'priority' => 'required|in:1,2,3',
            // otros campos si los hay
        ]);

        // Crear el ticket
        $ticket = Ticket::create([
            'state_id' => 1,
            'item_id' => $request->item_id,
            'flaw' => $request->flaw,
            'priority' => $request->priority,
            'admission' => $request->admission,
            // otros campos si los hay
        ]);

        // Asociar el usuario autenticado como autor
        $ticket->users()->attach(auth()->id(), ['role_in_ticket' => 'autor']);

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket creado y vinculado al usuario correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::find($id);
        $items = Item::pluck('name', 'id');
        $states = State::pluck('name', 'id');

        return view('ticket.show', compact('ticket', 'items', 'states'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $states = State::pluck('name', 'id');
        $items = Item::pluck('name', 'id');
        $ticket = Ticket::find($id);

        return view('ticket.edit', compact('ticket', 'items', 'states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        request()->validate(Ticket::$rules);
        $ticket->update($request->all());

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket updated successfully');
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $ticket = Ticket::find($id)->delete();

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket deleted successfully');
    }

    public function inter($id)
    {
        $binnacle = '';

        return redirect()->route('binnacles.index');
    }

    public function exportTicketsPDF()
    {

        $query = Ticket::query();

        // Filtrar por estado
        if ($estados = request()->get('estado')) {
            $query->whereIn('state_id', function ($subquery) use ($estados) {
                $subquery->select('id')
                    ->from('states')
                    ->whereIn('name', $estados);
            });
        }

        // Filtrar por fecha
        if ($inicio = request('fecha_inicio')) {
            $query->whereDate('admission', '>=', $inicio);
        }
        if ($fin = request('fecha_fin')) {
            $query->whereDate('admission', '<=', $fin);
        }

        // Búsqueda por texto
        if ($search = request('search')) {
            $query->where('flaw', 'LIKE', "%{$search}%");
        }

        $tickets = $query->get();

        $pdf = new \TCPDF;
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 12);

        $html = view('ticket.index_pdf', compact('tickets'))->render();
        Log::debug('🧾 Vista renderizada con éxito');

        $pdf->writeHTML($html, true, false, true, false, '');

        // 👉 Guardamos el PDF en memoria temporal
        $pdfContent = $pdf->Output('tickets.pdf', 'S'); // 'S' = return as string

        Log::debug('📤 PDF generado como cadena');

        // 👉 Ahora devolvemos el PDF como descarga usando stream
        return Response::streamDownload(function () use ($pdfContent) {
            echo $pdfContent;
        }, 'tickets.pdf');
    }
}
