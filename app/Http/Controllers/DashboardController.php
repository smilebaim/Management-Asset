<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Department;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Get total assets count
        $totalAssets = Asset::count();

        // Get assets count by status
        $availableAssets = Asset::where('status', 'available')->count();
        $inUseAssets = Asset::where('status', 'in-use')->count();
        $maintenanceAssets = Asset::where('status', 'maintenance')->count();

        // Get recent assets with their departments and pagination
        $recentAssets = Asset::with('department')
            ->latest()
            ->paginate(10);

        // Get department statistics
        $departmentStats = Department::withCount('assets')
            ->get()
            ->map(function ($department) use ($totalAssets) {
                return [
                    'name' => $department->name,
                    'count' => $department->assets_count,
                    'percentage' => $totalAssets > 0 
                        ? round(($department->assets_count / $totalAssets) * 100, 1)
                        : 0
                ];
            });

        // Get status statistics
        $statusStats = Asset::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get()
            ->map(function ($status) use ($totalAssets) {
                return [
                    'status' => $status->status,
                    'count' => $status->count,
                    'percentage' => $totalAssets > 0
                        ? round(($status->count / $totalAssets) * 100, 1)
                        : 0
                ];
            });

        // Get monthly asset value trends for the past 6 months
        $valueTrends = Asset::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
            DB::raw('SUM(value) as total_value'),
            DB::raw('COUNT(*) as total_assets')
        )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->map(function ($trend) {
                return [
                    'month' => $trend->month,
                    'value' => $trend->total_value,
                    'count' => $trend->total_assets
                ];
            });

        return view('dashboard', compact(
            'totalAssets',
            'availableAssets',
            'inUseAssets',
            'maintenanceAssets',
            'recentAssets',
            'departmentStats',
            'statusStats',
            'valueTrends'
        ));
    }
}