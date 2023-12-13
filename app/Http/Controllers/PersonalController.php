<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use App\Http\Controllers\Controller;
use App\Models\departamento;
use Illuminate\Http\Request;

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $personals = Personal::with('departamento')->where('estatus', 1)->get();
        return view('personal.index', compact('personals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $departamentos=departamento::where('estatus', 1)->get();
        return view(('personal.create'), compact('departamentos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(personal $personal)
    {
        //
        
            return view('personal.show', compact('personal'));

        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(personal $personal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, personal $personal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(personal $personal)
    {
        //
    }
}
