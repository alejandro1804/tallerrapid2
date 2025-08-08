<?php

namespace App\Http\Controllers;

use App\Models\Binnacle;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Http\Request;

// use Carbon\Carbon;

/**
 * Class BinnacleController
 */
class BinnacleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ticket_id = request('id'); // Obtiene el id del ticket

        $tickets = Ticket::with('item')->findOrFail($ticket_id);

        $itemName = $tickets->item->name ?? '[Ítem no asignado]'; // 👈 Extrae el nombre del ítem


        $users = User::pluck('name', 'id');
        $binnacles = Binnacle::where('ticket_id', $ticket_id)->paginate(6);

        return view('binnacle.index', compact('binnacles', 'tickets', 'users', 'ticket_id','itemName'))
            ->with('i', (request()->input('page', 1) - 1) * $binnacles->perPage());
    }

 /*   public function create()
    {

        $tickets = Ticket::pluck('id', 'id')->toArray();
        $users = User::pluck('name', 'id');
        $binnacle = new Binnacle;

        $modo = 'CREAR';

        return view('binnacle.create', compact('binnacle', 'users', 'tickets', 'modo'));
    }   */
/*    public function create(Request $request)
    {
        $ticket_id = $request->input('ticket_id');
        $user_id = $request->input('user_id');

        $binnacle = new Binnacle;
        $modo = 'CREAR';

        return view('binnacle.create', compact('binnacle', 'ticket_id', 'user_id', 'modo'));
    }  */

    public function create(Request $request)
{
    $ticket_id = $request->input('ticket_id');
    $user_id = $request->input('user_id');

    $ticket = Ticket::with('item')->findOrFail($ticket_id); // Asegurate de tener la relación 'item'

    $binnacle = new Binnacle;
    $modo = 'CREAR';

    return view('binnacle.create', compact('binnacle', 'ticket_id', 'user_id', 'ticket', 'modo'));
}

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // print_r($request->all());

        $identificador = $request->input('ticket_id');

        request()->validate(Binnacle::$rules);
        $binnacle = Binnacle::create($request->all());

        // dd(Ticket::find($request->ticket_id));

        return redirect()->route('binnacles.index', ['id' => $identificador])
            ->with('success', 'Binnacle created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::pluck('name', 'id');
        $tickets = Ticket::pluck('id');
        $binnacle = Binnacle::find($id);

        return view('binnacle.show', compact('binnacle', 'users', 'tickets'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::pluck('name', 'id');
        $tickets = Ticket::pluck('id');
        $binnacle = Binnacle::find($id);
        // echo 'en function edit : ' .$binnacle->ticket_id;

        return view('binnacle.edit', compact('binnacle', 'users', 'tickets'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Binnacle $binnacle)
    {
        request()->validate(Binnacle::$rules);
        // $date = Carbon::now();
        // $date->toDateTimeString(); //muestra fecha y hora
        // $request->merge(['timestamp'=>$date]);
        // echo "identificador en function update : " . $identificador = $request->input('ticket_id');
        // echo $request->all();

        $binnacle->update($request->all());

        $identificador = $request->input('ticket_id'); // Obtiene el id del ticket

        return redirect()->route('binnacles.index', ['id' => $identificador])
            ->with('success', 'Binnacle updated successfully');
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function destroy($id)
    {

        $binnacle = Binnacle::find($id)->delete();

        return redirect()->back()->with('success', 'Binnacle eliminado exitosamente');

    }
}
