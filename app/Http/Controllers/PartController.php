<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Part;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Class PartController
 */
class PartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 /*   public function index()
    {

        $items = Item::orderBy('name', 'ASC')->pluck('name', 'id');

        if (is_numeric(request('search'))) {
            $parts = Part::search(request('search'))->where('item_id', request('search'))->orderBy('name', 'ASC')->paginate(6);

        } else {
            $parts = Part::search(request('search'))->orderBy('name', 'ASC')->paginate(7);
        }

        return view('part.index', compact('parts', 'items'))
            ->with('i', (request()->input('page', 1) - 1) * $parts->perPage());
    }  */

    public function index()
{
    $search = request('search');
    $itemFilter = request('item_id');
    $providerFilter = request('provider_id');

    $query = Part::query();

    // 🔍 Búsqueda por texto o número
    if (is_numeric($search)) {
        $query->search($search)->where('item_id', $search);
    } elseif ($search) {
        $query->search($search);
    }

    // 🧩 Filtro por ítem
    if ($itemFilter) {
        $query->where('item_id', $itemFilter);
    }

    // 🧩 Filtro por proveedor
    if ($providerFilter) {
        $query->where('provider_id', $providerFilter);
    }

    $parts = $query->orderBy('name', 'ASC')->paginate(7)->appends([
        'search' => $search,
        'item_id' => $itemFilter,
        'provider_id' => $providerFilter,
    ]);


    // Para los select dropdowns
   // $items = Item::orderBy('name', 'ASC')->get();
    $items = Item::orderBy('name', 'ASC')->pluck('name', 'id');
    $providers = Provider::orderBy('name', 'ASC')->get();

    return view('part.index', compact('parts', 'items', 'providers'))
        ->with('i', (request()->input('page', 1) - 1) * $parts->perPage());
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
/*    public function create()
    {
        $items = Item::orderBy('name')->pluck('name', 'id');
        $providers = Provider::orderBy('name')->pluck('name', 'id');
        $part = new Part;

        //return view('part.create', compact('part', 'providers', 'items'));
        return view('part.index', compact('parts', 'items', 'providers', 'search', 'itemFilter', 'providerFilter'));
    } */
   /*
    public function create()
    {
        $items = Item::orderBy('name')->pluck('name', 'id');
        $providers = Provider::orderBy('name')->pluck('name', 'id');
        $part = new Part;

        return view('part.create', compact('part', 'providers', 'items'));
    }  */
    public function create(Request $request)
{
    $items = Item::orderBy('name')->pluck('name', 'id');
    $providers = Provider::orderBy('name')->pluck('name', 'id');
    $part = new Part;
    $item_id = $request->input('item_id');

    return view('part.create', compact('part', 'providers', 'items', 'item_id'));
}

    
    

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nota = $request->input('note');
        if ($nota == null) {
            $request->merge(['note' => ' sin comentarios ']);
        }

        request()->validate(Part::$rules);
        $request->validate(['name' => ['required', Rule::unique('parts', 'name')],]);


        $part = Part::create($request->all());

        return redirect()->route('parts.index')
            ->with('success', 'Part created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $items = Item::pluck('name', 'id');
        $providers = Provider::pluck('name', 'id');
        $part = Part::find($id);

        return view('part.show', compact('part', 'providers', 'items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $items = Item::orderBy('name')->pluck('name', 'id');
        $providers = Provider::orderBy('name')->pluck('name', 'id');
        $part = Part::find($id);

        return view('part.edit', compact('part', 'providers', 'items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Part $part)
    {
        request()->validate(Part::$rules);

        $part->update($request->all());

        return redirect()->route('parts.index')
            ->with('success', 'Part updated successfully');
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $part = Part::find($id)->delete();

        return redirect()->route('parts.index')
            ->with('success', 'Part deleted successfully');
    }

    public function indexpart(Item $item)
    {
        $parts = $item->parts()->paginate(10);

      //  return view('part.index', compact('parts', 'item'))
       //     ->with('i', (request()->input('page', 1) - 1) * $parts->perPage());
       return view('part.index', [
        'parts' => $parts,
        'item' => $item,
        'items' => null,
        'providers' => null,
        'search' => null,
        'itemFilter' => null,
        'providerFilter' => null,
        'item_id' => $item->id,
            'i' => (request()->input('page', 1) - 1) * $parts->perPage()
        ]);

    }

}
