@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Asset Details</h2>
        <div class="space-x-2">
            <a href="{{ route('assets.edit', $asset) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                Edit Asset
            </a>
            <a href="{{ route('assets.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                Back to Assets
            </a>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Basic Information -->
                <div class="space-y-4">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Basic Information</h3>
                        <div class="mt-2 border-t border-gray-200 pt-4">
                            <dl class="space-y-3">
                                <div class="grid grid-cols-3 gap-4">
                                    <dt class="text-sm font-medium text-gray-500">Asset Code</dt>
                                    <dd class="text-sm text-gray-900 col-span-2">{{ $asset->asset_code }}</dd>
                                </div>
                                <div class="grid grid-cols-3 gap-4">
                                    <dt class="text-sm font-medium text-gray-500">Name</dt>
                                    <dd class="text-sm text-gray-900 col-span-2">{{ $asset->name }}</dd>
                                </div>
                                <div class="grid grid-cols-3 gap-4">
                                    <dt class="text-sm font-medium text-gray-500">Department</dt>
                                    <dd class="text-sm text-gray-900 col-span-2">{{ $asset->department->name }}</dd>
                                </div>
                                <div class="grid grid-cols-3 gap-4">
                                    <dt class="text-sm font-medium text-gray-500">Category</dt>
                                    <dd class="text-sm text-gray-900 col-span-2">{{ ucfirst($asset->category) }}</dd>
                                </div>
                                <div class="grid grid-cols-3 gap-4">
                                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                                    <dd class="text-sm col-span-2">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            @if($asset->status === 'available') bg-green-100 text-green-800
                                            @elseif($asset->status === 'in-use') bg-yellow-100 text-yellow-800
                                            @elseif($asset->status === 'maintenance') bg-red-100 text-red-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                            {{ ucfirst($asset->status) }}
                                        </span>
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>

                <!-- Financial Information -->
                <div class="space-y-4">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Financial Information</h3>
                        <div class="mt-2 border-t border-gray-200 pt-4">
                            <dl class="space-y-3">
                                <div class="grid grid-cols-3 gap-4">
                                    <dt class="text-sm font-medium text-gray-500">Purchase Price</dt>
                                    <dd class="text-sm text-gray-900 col-span-2">{{ $asset->purchase_price ? number_format($asset->purchase_price, 2) : 'N/A' }}</dd>
                                </div>
                                <div class="grid grid-cols-3 gap-4">
                                    <dt class="text-sm font-medium text-gray-500">Purchase Date</dt>
                                    <dd class="text-sm text-gray-900 col-span-2">{{ $asset->purchase_date ? $asset->purchase_date->format('M d, Y') : 'N/A' }}</dd>
                                </div>
                                <div class="grid grid-cols-3 gap-4">
                                    <dt class="text-sm font-medium text-gray-500">Warranty Expiry</dt>
                                    <dd class="text-sm text-gray-900 col-span-2">{{ $asset->warranty_expiry_date ? $asset->warranty_expiry_date->format('M d, Y') : 'N/A' }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="space-y-4 mt-6">
                <h3 class="text-lg font-medium text-gray-900">Additional Information</h3>
                <div class="mt-2 border-t border-gray-200 pt-4">
                    <dl class="space-y-3">
                        <div class="grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-gray-500">Location</dt>
                            <dd class="text-sm text-gray-900 col-span-2">{{ $asset->location ?: 'N/A' }}</dd>
                        </div>
                        <div class="grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-gray-500">Assigned To</dt>
                            <dd class="text-sm text-gray-900 col-span-2">{{ $asset->assignedUser ? $asset->assignedUser->name : 'Not Assigned' }}</dd>
                        </div>
                        <div class="grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-gray-500">Description</dt>
                            <dd class="text-sm text-gray-900 col-span-2">{{ $asset->description ?: 'No description available' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Maintenance History -->
            <div class="space-y-4 mt-6">
                <h3 class="text-lg font-medium text-gray-900">Maintenance History</h3>
                <div class="mt-2 border-t border-gray-200 pt-4">
                    @if($asset->maintenanceRecords && $asset->maintenanceRecords->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Cost</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Notes</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($asset->maintenanceRecords as $record)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $record->date->format('M d, Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $record->type }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ number_format($record->cost, 2) }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $record->notes }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-sm text-gray-500">No maintenance records available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection