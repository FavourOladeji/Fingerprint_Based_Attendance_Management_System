<?php

namespace App\Http\Controllers;

use App\Models\Fingerprint;
use App\Http\Requests\StoreFingerprintRequest;
use App\Http\Requests\UpdateFingerprintRequest;
use Illuminate\Http\Request;

class FingerprintController extends Controller
{
    public function pendingEnrollment(Request $request)
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreFingerprintRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Fingerprint $fingerprint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fingerprint $fingerprint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFingerprintRequest $request, Fingerprint $fingerprint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fingerprint $fingerprint)
    {
        //
    }
}
