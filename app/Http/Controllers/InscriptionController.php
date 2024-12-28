<?php

namespace App\Http\Controllers;

use App\Models\Inscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InscriptionController extends Controller
{
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
  public function store(Request $request)
{
    try {
        // Log the incoming request data (except sensitive information)
        Log::info('Incoming request for Inscription creation', $request->only(['name', 'email', 'phone', 'cours_id']));

        // Validate the request (uncomment if needed)
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'phone' => 'required',
        //     'cours_id' => 'required',
        // ]);

        // Create the inscription
        $inscription = Inscription::create([
            "name" => $request->name,
            "phone" => $request->phone,
            "email" => $request->email,
            "cours_id" => $request->cours_id,
            "message" => $request->message,
            "city" => $request->city,
            "age_group" => $request->age,
            "status" => $request->statusUser,
            "level" => $request->level,
            // "availability" => json_encode($request->availability),
        ]);

        // Log the successful creation
        Log::info('Inscription created successfully', ['inscription_id' => $inscription->id]);

        return response()->json(['message' => 'Inscription created successfully'], 201);

    } catch (\Exception $e) {
        // Log the exception
        Log::error('Error creating Inscription', [
            'error_message' => $e->getMessage(),
            'request_data' => $request->all(),
        ]);

        return response()->json(['message' => 'Failed to create inscription', 'error' => $e->getMessage()], 500);
    }
}

    /**
     * Display the specified resource.
     */
    public function show(Inscription $inscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inscription $inscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inscription $inscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inscription $inscription)
    {
        //
    }
}
