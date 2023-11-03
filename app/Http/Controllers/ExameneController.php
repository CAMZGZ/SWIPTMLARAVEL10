<?php

namespace App\Http\Controllers;

use App\Models\Examene;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExameneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $examenes = Examene::with('curso')->where('estatus', 1)->get();
        return view('examene.index', compact('examenes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Examene $examene)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Examene $examene)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Examene $examene)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Examene $examene)
    {
        //
    }
}
