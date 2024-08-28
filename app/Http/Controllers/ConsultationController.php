<?php

namespace App\Http\Controllers;

use App\Events\ConsultationUpdated;
use App\Models\Consultation;
use App\Models\Professional;
use App\Models\User;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function index()
    {
        $consultations = Consultation::with('professional')->where('user_id', auth()->id())->get();
        return view('consultations.index', compact('consultations'));
    }

    public function create()
    {
        $professionals = Professional::all();
        return view('consultations.create',compact('professionals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'professional_id' => 'required|exists:professionals,id',
        ]);
        // dd($request->all());
        $consultation = Consultation::create([
            'user_id' => auth()->id(),
            'professional_id' => $request->professional_id,
            'date' => $request->date,
            'time' => $request->time,
            'status' => 'scheduled',
        ]);

        event(new ConsultationUpdated($consultation));
        return redirect()->route('consultations.index')->with('success', 'Consultation scheduled successfully!');
    }

    public function show(Consultation $consultation)
    {
        $this->authorize('view', $consultation);
        return view('consultations.show', compact('consultation'));
    }

    public function edit(Consultation $consultation)
    {
        $this->authorize('update', $consultation);

        $professionals = Professional::all();

        return view('consultations.edit', compact('consultation','professionals'));
    }

    public function update(Request $request, Consultation $consultation)
{
   
    // Authorize the user to perform the update
    $this->authorize('update', $consultation);

    // Validate the incoming request data
    $validatedData = $request->validate([
        'date' => 'required|date|after_or_equal:today',
        'time' => 'required|date_format:H:i:s',
        'status' => 'required|in:scheduled,completed,cancelled,pending',
    ]);

    // Update the consultation with validated data
    $consultation->update([
        'date' => $validatedData['date'],
        'time' => $validatedData['time'],
        'status' => $validatedData['status'],
    ]);

    event(new ConsultationUpdated($consultation));
    // Redirect back with a success message
    return redirect()->route('consultations.index')->with('success', 'Consultation updated successfully!');
}

    public function destroy(Consultation $consultation)
    {
        $this->authorize('delete', $consultation);
        $consultation->delete();
        return redirect()->route('consultations.index')->with('success', 'Consultation canceled successfully!');
    }

    public function cancel(Consultation $consultation)
{
    // Check if the user is authorized to cancel the consultation
    $this->authorize('cancel', $consultation);

    // Update the consultation status to 'canceled'
    $consultation->update(['status' => 'canceled']);

    return redirect()->route('consultations.index')->with('success', 'Consultation canceled successfully!');
}

}
