<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
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
        //
    }public function store(Request $request)
{
$validated = $request->validate([
'titre' => 'required|string|max:255',
'description' => 'nullable|string',
'date_debut' => 'required|date|before_or_equal:date_fin',
'date_fin' => 'required|date|after_or_equal:date_debut',
'delegue_id' => 'required|exists:users,id',
'zone_id' => 'required|exists:zones,id',
'digital_support' => 'nullable|file|mimes:pdf,mp4|max:20480',
]);
if ($request->user()->role !== 'manager') {
abort(403, 'Seul un manager peut créer une campagne.');
}
if ($request->hasFile('digital_support')) {
$path = $request->file('digital_support')->store('campaign_supports', 'public');
$validated['digital_support_path'] = $path;
}
Campaign::create($validated);
return redirect()->route('campaigns.index')->with('success', 'Campagne créée !');


    /**
     * Display the specified resource.
     */
    public function show(Campaign $campaign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Campaign $campaign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Campaign $campaign)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Campaign $campaign)
    {
        //
    }
}
