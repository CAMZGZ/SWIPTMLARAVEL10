<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Prompts\Note;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //$empresas=Empresa::all();
        $empresas = Empresa::where('estatus', 1)->get();
        return view('empresa.index', compact('empresas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('empresa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /*
        Empresa::create([
            'rfc'=>$request->rfc,
            'razon_social' => $request->razon_social
        ]);
        */
        $empresa = new Empresa;
        $empresa -> rfc = $request->rfc;
        $empresa -> razon_social = $request->razon_social;
        $empresa->save();

        return redirect()->route('empresa.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
    {
        //
        return view('empresa.show', compact('empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empresa $empresa)
    {
        //
        return view('empresa.edit', compact('empresa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empresa $empresa)
    {
        //
        $empresa = Empresa::find($empresa->id);
        $empresa -> rfc = $request->rfc;
        $empresa -> razon_social = $request->razon_social;
        $empresa->save();
        //$empresa->update($request->all());
        return redirect()->route('empresa.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa)
    {
        //
        
        $empresa = Empresa::find($empresa->id);
        $empresa -> estatus = 0;
        $empresa->save();
        
        return redirect()->route('empresa.index');

    }

    public function bajas()
    {
        //
        $empresas = Empresa::where('estatus', 0)->get();
        return view('empresa.bajas', compact('empresas'));
    } 

    public function activar(Request $request)
    {
        $empresaId = $request->input('empresa_id');
        $empresa = Empresa::find($empresaId);
    
        if ($empresa) {
            $empresa->update(['estatus' => 1]);
            return redirect()->route('empresa.index');
        } else {
            return redirect()->route('empresa.bajas');
        }
    }
    
    
}
