<?php

namespace App\Http\Controllers;

use App\Models\Operator;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


/**
 * Class OperatorController
 */
class OperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $positions = Position::pluck('name', 'id');
        $operators = Operator::search(request('search'))->orderBy('name', 'ASC')->paginate(6);

        //  $operators = Operator::with ('position')->get();
        return view('operator.index', compact('operators', 'positions'))
            ->with('i', (request()->input('page', 1) - 1) * $operators->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $positions = Position::orderBy('name')->pluck('name', 'id');
        $operator = new Operator;

        return view('operator.create', compact('operator', 'positions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Operator::$rules);
        $enminuscula = strtolower($request->input('name'));          // todo a minusculas
        $primeras_en_mayuscula = ucwords($enminuscula);   // primera letra de cada palabra a mayusculas
        $request->merge(['name' => $primeras_en_mayuscula]);
        
        $request->validate(['name' => ['required', Rule::unique('items', 'name')],]);

        $operator = Operator::create($request->all());

        return redirect()->route('operators.index')
            ->with('success', 'Operator created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $positions = Position::pluck('name', 'id');
        $operator = Operator::find($id);

        return view('operator.show', compact('operator', 'positions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $positions = Position::orderBy('name')->pluck('name', 'id');
        $operator = Operator::find($id);

        return view('operator.edit', compact('operator', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Operator $operator)
    {
       // request()->validate(Operator::$rules);
        $request->validate([
            'name' => 'required|unique:operators,name,' . $operator->id,
            'position_id' => 'required',
            'phone' => 'numeric|required',
            'status' => 'nullable',
        ]);

        $enminuscula = strtolower($request->input('name'));          // todo a minusculas
        $primeras_en_mayuscula = ucwords($enminuscula);   // primera letra de cada palabra a mayusculas
        $request->merge(['name' => $primeras_en_mayuscula]);

        $operator->update($request->all());

        return redirect()->route('operators.index')
            ->with('success', 'Operator updated successfully');
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $operator = Operator::find($id)->delete();

        return redirect()->route('operators.index')
            ->with('success', 'Operator deleted successfully');
    }
}
