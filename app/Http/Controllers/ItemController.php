<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Provider;
use App\Models\Sector;
use Endroid\QrCode\Builder\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use TCPDF;
 use Illuminate\Validation\Rule;

// use Illuminate\Support\Facades\DB;

/**
 * Class ItemController
 */
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sectors = Sector::pluck('name', 'id');
        $providers = Provider::pluck('name', 'id');

        $items = Item::search(request('search'))->orderBy('name', 'ASC')->paginate(6);

        return view('item.index', compact('items', 'sectors', 'providers'))
            ->with('i', (request()->input('page', 1) - 1) * $items->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $providers = Provider::orderBy('name')->pluck('name', 'id');
        $sectors = Sector::orderBy('name')->pluck('name', 'id');


        $item = new Item;

        return view('item.create', compact('item', 'sectors', 'providers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    /*
    public function store(Request $request)
    {
        $primera_en_mayuscula = ucfirst($request->input('name'));
        $request->merge(['name' => $primera_en_mayuscula]);
        $trademark = $request->input('trademark');
        $caracteristica = $request->input('characteristic');
        $nota = $request->input('note');

        if ($trademark == null) {
            $request->merge(['trademark' => ' no suministrada ']);
        }

        if ($caracteristica == null) {
            $request->merge(['characteristic' => ' sin comentarios ']);
        }

        if ($nota == null) {
            $request->merge(['note' => ' sin comentarios ']);
        }

        request()->validate(Item::$rules);

        $item = Item::create($request->all());

         if ($request->hasFile('image')) {
            $path = $request->file('image')->store('imagenes', 'public');
            $item->image = $path;
        }

        return redirect()->route('items.index')
            ->with('success', 'Item created successfully.');
    }   */

    public function store(Request $request)
{
    // Formateos y reemplazos
    $primera_en_mayuscula = ucfirst($request->input('name'));
    $request->merge(['name' => $primera_en_mayuscula]);

    if ($request->filled('trademark') === false) {
        $request->merge(['trademark' => ' no suministrada ']);
    }

    if ($request->filled('characteristic') === false) {
        $request->merge(['characteristic' => ' sin comentarios ']);
    }

    if ($request->filled('note') === false) {
        $request->merge(['note' => ' sin comentarios ']);
    }

    request()->validate(Item::$rules);
    $request->validate(['name' => ['required', Rule::unique('items', 'name')],]);

    // Cargar imagen si existe
    $imagenPath = null;
    if ($request->hasFile('image')) {
        $imagenPath = $request->file('image')->store('imagenes', 'public');
    }

    // Crear ítem con todos los campos
    $item = Item::create([
        'name' => $request->name,
        'sector_id' => $request->sector_id,
        'characteristic' => $request->characteristic,
        'note' => $request->note,
        'trademark' => $request->trademark,
        'provider_id' => $request->provider_id,
        'image' => $imagenPath,
    ]);

    return redirect()->route('items.index')
        ->with('success', 'Item creado exitosamente.');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $providers = Provider::pluck('name', 'id');
        $sectors = Sector::pluck('name', 'id');
        $item = Item::find($id);

        return view('item.show', compact('item', 'sectors', 'providers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $providers = Provider::orderBy('name')->pluck('name', 'id');
        $sectors = Sector::orderBy('name')->pluck('name', 'id');
        $item = Item::find($id);

        return view('item.edit', compact('item', 'sectors', 'providers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $primera_en_mayuscula = ucfirst($request->input('name'));
        $request->merge(['name' => $primera_en_mayuscula]);
        request()->validate(Item::$rules);

        $request->validate(['name' => ['required',Rule::unique('items')->ignore($item->id)],]);


        $item->update($request->all());

        return redirect()->route('items.index')
            ->with('success', 'Item updated successfully');
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $item = Item::find($id)->delete();

        return redirect()->route('items.index')
            ->with('success', 'Item deleted successfully');
    }
    /*
    public function printItemQr($id)   // funcion para imprimir codigo QR
    {

       // ✅ Test rápido de acceso a la carpeta storage
        //dd(File::exists(storage_path('app')));
        // 🧠 Test para ver si Laravel accede a storage/app correctamente
    //dd(\Illuminate\Support\Facades\File::exists(storage_path('app')));



        $item = Item::findOrFail($id);

        // 1. Crear contenido QR
        $qrCode = Builder::create()
            ->data("ID: {$item->id}\nNombre: {$item->name}\nMarca: {$item->trademark}")
            ->size(200)
            ->margin(10)
            ->build();

        $filename = 'qr_' . $item->id . '.png';
        $filePath = storage_path('app/public/' . $filename);

        // 🧪 Guardar imagen
        File::put($filePath, $qrCode->getString());

        // ✅ Verificar si el archivo existe
        // dd(File::exists($filePath));

        $qrImage = $qrCode->getDataUri();

        // 2. Generar PDF con TCPDF
        $pdf = new TCPDF();
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 12);
        $pdf->Write(0, "Nombre: {$item->name}");

        // ✅ Mostrar el QR
        $pdf->Image($filePath, 15, 30, 30, 30);  // X, Y, width, height

        $pdf->Output("qr_item_{$item->id}.pdf", 'I'); // 'I' lo muestra en pantalla
    }  */

    public function printItemQr($id)
    {
        $item = Item::findOrFail($id);

        // Crear QR con resumen básico
        $qrCode = \Endroid\QrCode\Builder\Builder::create()
            ->data("ID: {$item->id}\nNombre: {$item->name}\nSector: {$item->sector->name}\nMarca: {$item->trademark}\nProveedor: {$item->provider->name}\nCaracterísticas: {$item->characteristic}")
            ->size(200)
            ->margin(10)
            ->build();

        $filename = 'qr_'.$item->id.'.png';
        $filePath = storage_path('app/public/'.$filename);
        \Illuminate\Support\Facades\File::put($filePath, $qrCode->getString());

        $pdf = new \TCPDF;
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 12);

        // Título
        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Write(10, "Ficha Técnica: {$item->name}");

        $pdf->Ln(8); // Espacio

        // Detalles del ítem
        $pdf->SetFont('helvetica', '', 12);
        $pdf->Write(6, "Sector: {$item->sector->name}");
        $pdf->Ln(6);
        $pdf->Write(6, "Proveedor: {$item->provider->name}");
        $pdf->Ln(6);
        $pdf->Write(6, "Marca: {$item->trademark}");
        $pdf->Ln(6);
        $pdf->Write(6, "Características: {$item->characteristic}");
        $pdf->Ln(6);
        $pdf->Write(6, "Nota: {$item->note}");
        $pdf->Ln(10);

        // Imagen del código QR
        $pdf->Image($filePath, 150, 40, 30, 30); // Posición y tamaño del QR

        \Illuminate\Support\Facades\File::delete($filePath);

        $pdf->Output("Ficha_Item_{$item->id}.pdf", 'I');
    }
}
