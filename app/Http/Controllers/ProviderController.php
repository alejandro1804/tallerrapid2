<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Laravel\Scout\Searchable;

/**
 * Class ProviderController
 */
class ProviderController extends Controller
{
    use Searchable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = Provider::search(request('search'))->orderBy('name', 'ASC')->paginate(6);

        return view('provider.index', compact('providers'))
            ->with('i', (request()->input('page', 1) - 1) * $providers->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provider = new Provider;

        return view('provider.create', compact('provider'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $enminuscula = strtolower($request->input('name'));  // pasamtodo a minusculas
        $primera_en_mayuscula = ucwords($enminuscula);       // primeras letras de palabras a mayusculas
        $request->merge(['name' => $primera_en_mayuscula]);

        request()->validate(Provider::$rules);
        $request->validate(['name' => 'required|unique:items,name',]);

        $provider = Provider::create($request->all());

        //  Mail::to("danielabarizo@gmail.com")->send(new TestMail("Daniela"));

        return redirect()->route('providers.index')
            ->with('success', 'Provider created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $provider = Provider::find($id);

        return view('provider.show', compact('provider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $provider = Provider::find($id);

        return view('provider.edit', compact('provider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provider $provider)
    {
        $enminuscula = strtolower($request->input('name'));  // pasamtodo a minusculas
        $primera_en_mayuscula = ucwords($enminuscula);       // primeras letras de palabras a mayusculas
        $request->merge(['name' => $primera_en_mayuscula]);

        request()->validate(Provider::$rules);
       
        $provider->update($request->all());
        
        return redirect()->route('providers.index')
            ->with('success', 'Provider updated successfully');
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $provider = Provider::find($id)->delete();

        return redirect()->route('providers.index')
            ->with('success', 'Provider deleted successfully');
    }
}
