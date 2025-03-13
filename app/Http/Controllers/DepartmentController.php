<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class DepartmentController extends Controller
{
    public function index(): View
    {
        $departments = Department::withCount('assets')
            ->latest()
            ->paginate(10);

        $totalDepartments = Department::count();
        $activeDepartments = Department::where('is_active', true)->count();

        return view('departments.index', compact(
            'departments',
            'totalDepartments',
            'activeDepartments'
        ));
    }

    public function create(): View
    {
        return view('departments.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:departments',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'manager_name' => 'nullable|string',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        Department::create($validated);

        return redirect()->route('departments.index')
            ->with('success', 'Department created successfully.');
    }

    public function edit(Department $department): View
    {
        return view('departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:departments,code,' . $department->id,
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'manager_name' => 'nullable|string',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $department->update($validated);

        return redirect()->route('departments.index')
            ->with('success', 'Department updated successfully.');
    }

    public function destroy(Department $department): RedirectResponse
    {
        if ($department->assets()->count() > 0) {
            return redirect()->route('departments.index')
                ->with('error', 'Cannot delete department with associated assets.');
        }

        $department->delete();

        return redirect()->route('departments.index')
            ->with('success', 'Department deleted successfully.');
    }
}