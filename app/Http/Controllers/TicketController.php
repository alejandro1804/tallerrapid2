<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\State;
use App\Models\Ticket;
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
    public function index(Request $request)
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

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    /*  version vieja
    public function store(Request $request)
    {
        request()->validate(Ticket::$rules);

        $date = Carbon::now();
        $date->toDateTimeString(); // muestra fecha y hora

        // $request->merge(['admission'=>$date]);

        $ticket = Ticket::create($request->all());

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket created successfully.');
    }
      */

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
        'state_id' => 'NUEVO',
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
