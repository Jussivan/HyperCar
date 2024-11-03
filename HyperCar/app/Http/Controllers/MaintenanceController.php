<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maintenances = Maintenance::all();
        return view('maintenances.index', compact('maintenances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('maintenances.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|string|max:255',
            'date' => 'required|date',
            'car_id' => 'required|exists:cars,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('maintenances.create')
                             ->withErrors($validator)
                             ->withInput();
        }

        Maintenance::create($request->all());
        return redirect()->route('maintenances.index')->with('success', 'Maintenance created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Maintenance $maintenance)
    {
        return view('maintenances.show', compact('maintenance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Maintenance $maintenance)
    {
        return view('maintenances.edit', compact('maintenance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Maintenance $maintenance)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|string|max:255',
            'date' => 'required|date',
            'car_id' => 'required|exists:cars,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('maintenances.edit', $maintenance->id)
                             ->withErrors($validator)
                             ->withInput();
        }

        $maintenance->update($request->all());
        return redirect()->route('maintenances.index')->with('success', 'Maintenance updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Maintenance $maintenance)
    {
        $maintenance->delete();
        return redirect()->route('maintenances.index')->with('success', 'Maintenance deleted successfully.');
    }
}