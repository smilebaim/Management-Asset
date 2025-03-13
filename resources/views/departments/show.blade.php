@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Department Details</h2>
        <div class="flex space-x-2">
            <a href="{{ route('departments.edit', $department) }}" class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-200">
                Edit Department
            </a>
            <a href="{{ route('departments.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-200">
                Back to Departments
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Department Information -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-md p-6 space-y-6">
                <div class="border-b pb-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Department Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Department Name</p>
                            <p class="text-base font-medium text-gray-900">{{ $department->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Department Code</p>
                            <p class="text-base font-medium text-gray-900">{{ $department->code }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Location</p>
                            <p class="text-base font-medium text-gray-900">{{ $department->location ?: 'Not specified' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Status</p>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $department->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $department->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Budget</p>
                            <p class="text-base font-medium text-gray-900">${{ number_format($department->budget, 2) }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Manager</p>
                            @if($department->manager)
                            <div class="flex items-center">
                                <div class="text-base font-medium text-gray-900">{{ $department->manager->name }}</div>
                            </div>
                            @else
                            <p class="text-base text-gray-500">Not Assigned</p>
                            @endif
                        </div>
                    </div>
                </div>

                @if($department->description)
                <div>
                    <h4 class="text-sm font-medium text-gray-600 mb-2">Description</h4>
                    <p class="text-base text-gray-900">{{ $department->description }}</p>
                </div>
                @endif
            </div>

            <!-- Assets List -->
            <div class="bg-white rounded-lg shadow-md p-6 mt-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Department Assets</h3>
                @if($department->assets->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Asset Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Code</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($department->assets as $asset)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $asset->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $asset->asset_code }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $asset->status_color }}-100 text-{{ $asset->status_color }}-800">
                                        {{ $asset->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600 hover:text-blue-900">
                                    <a href="{{ route('assets.show', $asset) }}">View Details</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p class="text-gray-500">No assets assigned to this department.</p>
                @endif
            </div>
        </div>

        <!-- Staff Members -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Staff Members</h3>
                @if($department->users->count() > 0)
                <div class="space-y-4">
                    @foreach($department->users as $user)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                            <p class="text-xs text-gray-500">{{ $user->email }}</p>
                        </div>
                        @if($department->manager_id === $user->id)
                        <span class="px-2 py-1 text-xs font-medium text-blue-600 bg-blue-100 rounded-full">Manager</span>
                        @endif
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-gray-500">No staff members in this department.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection