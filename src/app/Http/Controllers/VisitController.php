<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitController extends Controller
{
    public function index()
    {
        $visits = Visit::with(['doctor.establishment'])
            ->where('user_id', Auth::id())
            ->orderBy('visit_date', 'desc')
            ->orderBy('visit_time', 'desc')
            ->paginate(15);

        return view('visits.index', compact('visits'));
    }

    public function create()
    {
        $doctors = Doctor::with('establishment')->orderBy('last_name')->get();
        return view('visits.create', compact('doctors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'visit_date' => 'required|date',
            'visit_time' => 'required',
            'purpose' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'planifiée';

        Visit::create($validated);

        return redirect()->route('visits.index')->with('success', 'Visite planifiée avec succès.');
    }
}
