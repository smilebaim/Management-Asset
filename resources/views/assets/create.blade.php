@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Add New Asset</h2>
        <a href="{{ route('assets.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
            Back to Assets
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('assets.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Asset Code -->
                <div>
                    <label for="asset_code" class="block text-sm font-medium text-gray-700">Asset Code *</label>
                    <input type="text" name="asset_code" id="asset_code" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required value="{{ old('asset_code') }}">
                    @error('asset_code')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name *</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required value="{{ old('name') }}">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Department -->
                <div>
                    <label for="department_id" class="block text-sm font-medium text-gray-700">Department *</label>
                    <select name="department_id" id="department_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        <option value="">Select Department</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('department_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700">Category *</label>
                    <select name="category" id="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        <option value="">Select Category</option>
                        <option value="electronics" {{ old('category') == 'electronics' ? 'selected' : '' }}>Electronics</option>
                        <option value="furniture" {{ old('category') == 'furniture' ? 'selected' : '' }}>Furniture</option>
                        <option value="vehicle" {{ old('category') == 'vehicle' ? 'selected' : '' }}>Vehicle</option>
                        <option value="equipment" {{ old('category') == 'equipment' ? 'selected' : '' }}>Equipment</option>
                    </select>
                    @error('category')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status *</label>
                    <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="in-use" {{ old('status') == 'in-use' ? 'selected' : '' }}>In Use</option>
                        <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                        <option value="retired" {{ old('status') == 'retired' ? 'selected' : '' }}>Retired</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Purchase Price -->
                <div>
                    <label for="purchase_price" class="block text-sm font-medium text-gray-700">Purchase Price</label>
                    <input type="number" step="0.01" name="purchase_price" id="purchase_price" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('purchase_price') }}">
                    @error('purchase_price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Purchase Date -->
                <div>
                    <label for="purchase_date" class="block text-sm font-medium text-gray-700">Purchase Date</label>
                    <input type="date" name="purchase_date" id="purchase_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('purchase_date') }}">
                    @error('purchase_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Warranty Expiry Date -->
                <div>
                    <label for="warranty_expiry_date" class="block text-sm font-medium text-gray-700">Warranty Expiry Date</label>
                    <input type="date" name="warranty_expiry_date" id="warranty_expiry_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('warranty_expiry_date') }}">
                    @error('warranty_expiry_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Location -->
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                    <input type="text" name="location" id="location" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('location') }}">
                    @error('location')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <button type="reset" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">Reset</button>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Asset</button>
            </div>
        </form>
    </div>
</div>
@endsection