<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AssetController extends Controller
{
    public function index(): View
    {
        $assets = Asset::with(['department', 'assignedUser'])
            ->latest()
            ->paginate(10);

        $totalAssets = Asset::count();
        $availableAssets = Asset::where('status', 'available')->count();
        $inUseAssets = Asset::where('status', 'in-use')->count();
        $maintenanceAssets = Asset::where('status', 'maintenance')->count();

        return view('assets.index', compact(
            'assets',
            'totalAssets',
            'availableAssets',
            'inUseAssets',
            'maintenanceAssets'
        ));
    }

    public function create(): View
    {
        $departments = Department::where('is_active', true)->get();
        return view('assets.create', compact('departments'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'asset_code' => 'required|string|unique:assets',
            'description' => 'nullable|string',
            'category' => 'required|string',
            'status' => 'required|in:available,in-use,maintenance,retired',
            'purchase_price' => 'nullable|numeric',
            'purchase_date' => 'nullable|date',
            'warranty_expiry_date' => 'nullable|date',
            'location' => 'nullable|string',
            'manufacturer' => 'nullable|string',
            'model' => 'nullable|string',
            'serial_number' => 'nullable|string',
            'department_id' => 'nullable|exists:departments,id',
            'assigned_to' => 'nullable|exists:users,id'
        ]);

        Asset::create($validated);

        return redirect()->route('assets.index')
            ->with('success', 'Asset created successfully.');
    }

    public function edit(Asset $asset): View
    {
        $departments = Department::where('is_active', true)->get();
        return view('assets.edit', compact('asset', 'departments'));
    }

    public function update(Request $request, Asset $asset): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'asset_code' => 'required|string|unique:assets,asset_code,' . $asset->id,
            'description' => 'nullable|string',
            'category' => 'required|string',
            'status' => 'required|in:available,in-use,maintenance,retired',
            'purchase_price' => 'nullable|numeric',
            'purchase_date' => 'nullable|date',
            'warranty_expiry_date' => 'nullable|date',
            'location' => 'nullable|string',
            'manufacturer' => 'nullable|string',
            'model' => 'nullable|string',
            'serial_number' => 'nullable|string',
            'department_id' => 'nullable|exists:departments,id',
            'assigned_to' => 'nullable|exists:users,id'
        ]);

        $asset->update($validated);

        return redirect()->route('assets.index')
            ->with('success', 'Asset updated successfully.');
    }

    public function destroy(Asset $asset): RedirectResponse
    {
        $asset->delete();

        return redirect()->route('assets.index')
            ->with('success', 'Asset deleted successfully.');
    }
}