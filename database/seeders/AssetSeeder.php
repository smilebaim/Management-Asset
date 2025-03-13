<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class AssetSeeder extends Seeder
{
    public function run(): void
    {
        $departments = Department::all();
        $users = User::all();

        $categories = ['Laptop', 'Desktop', 'Printer', 'Server', 'Network Equipment', 'Mobile Device', 'Furniture', 'Vehicle'];
        $manufacturers = ['Dell', 'HP', 'Lenovo', 'Apple', 'Cisco', 'Samsung', 'Asus', 'Acer'];
        $statuses = ['available', 'in-use', 'maintenance', 'retired'];

        $laptopModels = [
            ['Dell', 'Latitude 5420', 15000000, 'Business laptop with 16GB RAM and 512GB SSD'],
            ['Dell', 'XPS 13', 18000000, 'Ultra-portable laptop with 16GB RAM and 1TB SSD'],
            ['HP', 'EliteBook 840', 16000000, 'Business laptop with 32GB RAM and 512GB SSD'],
            ['Lenovo', 'ThinkPad X1', 17000000, 'Premium business laptop with 16GB RAM and 1TB SSD'],
            ['Apple', 'MacBook Pro 14"', 25000000, 'High-performance laptop with M1 Pro chip'],
            ['Asus', 'ROG Zephyrus', 22000000, 'Gaming laptop with RTX 3060 GPU']
        ];

        $printerModels = [
            ['HP', 'LaserJet Pro M404dn', 5000000, 'Monochrome laser printer'],
            ['Epson', 'EcoTank L6490', 8000000, 'Color inkjet printer with tank system'],
            ['Brother', 'MFC-L8900CDW', 12000000, 'Color laser multifunction printer'],
            ['Canon', 'imageRUNNER 2630i', 15000000, 'Multifunction office printer']
        ];

        $networkEquipment = [
            ['Cisco', 'Catalyst 9200', 25000000, 'Enterprise network switch'],
            ['HP', 'Aruba 2930F', 20000000, 'Managed network switch'],
            ['Ubiquiti', 'UniFi USW-Pro-48', 18000000, 'Professional network switch'],
            ['Cisco', 'ISR 4321', 30000000, 'Enterprise router']
        ];

        $assets = [];
        // Generate laptop assets
        $assetCount = 1;
        foreach ($laptopModels as $model) {
            $departmentId = $departments->random()->id;
            $assignedTo = rand(0, 1) ? $users->random()->id : null;
            $status = $assignedTo ? 'in-use' : Arr::random($statuses);
            $purchaseDate = now()->subDays(rand(30, 365));

            $assets[] = [
                'name' => "{$model[0]} {$model[1]}",
                'asset_code' => 'LAP' . str_pad($assetCount++, 3, '0', STR_PAD_LEFT),
                'description' => $model[3],
                'category' => 'Laptop',
                'status' => $status,
                'purchase_price' => $model[2],
                'purchase_date' => $purchaseDate->format('Y-m-d'),
                'warranty_expiry_date' => $purchaseDate->addYears(3)->format('Y-m-d'),
                'location' => $departments->find($departmentId)->location,
                'manufacturer' => $model[0],
                'model' => $model[1],
                'serial_number' => strtoupper(substr($model[0], 0, 2)) . rand(100000, 999999),
                'department_id' => $departmentId,
                'assigned_to' => $assignedTo
            ];
        }

        // Generate printer assets
        $assetCount = 1;
        foreach ($printerModels as $model) {
            $departmentId = $departments->random()->id;
            $purchaseDate = now()->subDays(rand(30, 365));

            $assets[] = [
                'name' => "{$model[0]} {$model[1]}",
                'asset_code' => 'PRN' . str_pad($assetCount++, 3, '0', STR_PAD_LEFT),
                'description' => $model[3],
                'category' => 'Printer',
                'status' => Arr::random($statuses),
                'purchase_price' => $model[2],
                'purchase_date' => $purchaseDate->format('Y-m-d'),
                'warranty_expiry_date' => $purchaseDate->addYears(2)->format('Y-m-d'),
                'location' => $departments->find($departmentId)->location,
                'manufacturer' => $model[0],
                'model' => $model[1],
                'serial_number' => strtoupper(substr($model[0], 0, 2)) . rand(100000, 999999),
                'department_id' => $departmentId
            ];
        }

        // Generate network equipment assets
        $assetCount = 1;
        foreach ($networkEquipment as $model) {
            $departmentId = 2; // Assign to IT department
            $purchaseDate = now()->subDays(rand(30, 365));

            $assets[] = [
                'name' => "{$model[0]} {$model[1]}",
                'asset_code' => 'NET' . str_pad($assetCount++, 3, '0', STR_PAD_LEFT),
                'description' => $model[3],
                'category' => 'Network Equipment',
                'status' => Arr::random($statuses),
                'purchase_price' => $model[2],
                'purchase_date' => $purchaseDate->format('Y-m-d'),
                'warranty_expiry_date' => $purchaseDate->addYears(3)->format('Y-m-d'),
                'location' => 'Server Room, Floor 3',
                'manufacturer' => $model[0],
                'model' => $model[1],
                'serial_number' => strtoupper(substr($model[0], 0, 2)) . rand(100000, 999999),
                'department_id' => $departmentId
            ];
        }

        // Add office vehicles
        $vehicles = [
            ['Toyota', 'Innova V 2.0', 350000000, 'Office vehicle for business trips'],
            ['Honda', 'CR-V 1.5 Turbo', 400000000, 'Executive transport vehicle']
        ];

        $assetCount = 1;
        foreach ($vehicles as $vehicle) {
            $departmentId = 4; // Assign to Operations department
            $purchaseDate = now()->subDays(rand(30, 365));

            $assets[] = [
                'name' => "{$vehicle[0]} {$vehicle[1]}",
                'asset_code' => 'VEH' . str_pad($assetCount++, 3, '0', STR_PAD_LEFT),
                'description' => $vehicle[3],
                'category' => 'Vehicle',
                'status' => Arr::random($statuses),
                'purchase_price' => $vehicle[2],
                'purchase_date' => $purchaseDate->format('Y-m-d'),
                'warranty_expiry_date' => $purchaseDate->addYears(3)->format('Y-m-d'),
                'location' => 'Basement Parking B1',
                'manufacturer' => $vehicle[0],
                'model' => $vehicle[1],
                'serial_number' => strtoupper(substr($vehicle[0], 0, 2)) . rand(100000, 999999),
                'department_id' => $departmentId
            ];
        }

        foreach ($assets as $asset) {
            Asset::create($asset);
        }

        // Generate additional random assets
        $assetCount = 1;
        for ($i = 0; $i < 15; $i++) {
            $department = $departments->random();
            $category = Arr::random($categories);
            $manufacturer = Arr::random($manufacturers);
            
            Asset::create([
                'name' => $manufacturer . ' ' . ucfirst(substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 4)) . ' ' . rand(1000, 9999),
                'asset_code' => strtoupper(substr($category, 0, 3)) . str_pad($i + 6, 3, '0', STR_PAD_LEFT),
                'description' => 'Auto-generated ' . strtolower($category) . ' for testing purposes',
                'category' => $category,
                'status' => Arr::random($statuses),
                'purchase_price' => rand(1000000, 50000000),
                'purchase_date' => now()->subDays(rand(1, 365))->format('Y-m-d'),
                'warranty_expiry_date' => now()->addYears(rand(1, 3))->format('Y-m-d'),
                'location' => $department->location,
                'manufacturer' => $manufacturer,
                'model' => ucfirst(substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 6)) . '-' . rand(100, 999),
                'serial_number' => strtoupper(substr($manufacturer, 0, 3)) . rand(10000, 99999),
                'department_id' => $department->id,
                'assigned_to' => rand(0, 1) ? $users->random()->id : null
            ]);
        }
    }
}