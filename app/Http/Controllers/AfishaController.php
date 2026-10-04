<?php

namespace App\Http\Controllers;

use App\Models\Afisha;
use Illuminate\Http\Request;

class AfishaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pending_afishes = Afisha::query()->where("status", "pending")->get();

        $expired_afishes = Afisha::query()->where("status", "expired")->get();

        return view('afisha', compact('pending_afishes', 'expired_afishes'));

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
    public function show(Afisha $afisha)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Afisha $afisha)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Afisha $afisha)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Afisha $afisha)
    {
        //
    }
}
