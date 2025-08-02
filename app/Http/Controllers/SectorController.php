<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;

/**
 * Class SectorController
 */
class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $sectors = Sector::orderBy('name', 'ASC')->paginate(6);

        return view('sector.index', compact('sectors'))
            ->with('i', (request()->input('page', 1) - 1) * $sectors->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sector = new Sector;

        return view('sector.create', compact('sector'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $enmayuscula = strtoupper($request->input('name'));         // pasamtodo a mayusculas
        // $primera_en_mayuscula = ucfirst ($request->input('name'));   //primera en mayusculas
        $request->merge(['name' => $enmayuscula]);
        request()->validate(Sector::$rules);

        $sector = Sector::create($request->all());

        return redirect()->route('sectors.index')
            ->with('success', 'Sector created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sector = Sector::find($id);

        return view('sector.show', compact('sector'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sector = Sector::find($id);

        return view('sector.edit', compact('sector'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sector $sector)
    {

        $enmayuscula = strtoupper($request->input('name'));  // pasamtodo a mayusculas
        // $primera_en_mayuscula = ucfirst ($request->input('name'));
        $request->merge(['name' => $enmayuscula]);
        request()->validate(Sector::$rules);

        $sector->update($request->all());

        return redirect()->route('sectors.index')
            ->with('success', 'Sector updated successfully');
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $sector = Sector::find($id)->delete();

        return redirect()->route('sectors.index')
            ->with('success', 'Sector deleted successfully');
    }
}
