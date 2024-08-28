<?php

namespace App\Http\Controllers\Api;

use App\Events\ConsultationUpdated;
use App\Http\Controllers\Controller;
use App\Models\Consultation;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Consultation::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'professional_id' => 'required|exists:professionals,id',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'status' => 'required|in:scheduled,completed,cancelled,pending',
        ]);

        $consultation = Consultation::create($request->all());
        event(new ConsultationUpdated($consultation));
        return response()->json($consultation, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Consultation $consultation)
    {
        return $consultation;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Consultation $consultation)
    {
        $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'professional_id' => 'sometimes|exists:professionals,id',
            'date' => 'sometimes|date|after_or_equal:today',
            'time' => 'sometimes|date_format:H:i',
            'status' => 'required|in:scheduled,completed,cancelled,pending',
        ]);

        $consultation->update($request->all());
        event(new ConsultationUpdated($consultation));
        return response()->json($consultation);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Consultation $consultation)
    {
        $consultation->delete();
        return response()->json(null, 204);
    }
}
