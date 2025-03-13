<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            [
                'name' => 'Human Resources',
                'code' => 'HR',
                'description' => 'Manages employee relations and recruitment',
                'location' => 'Floor 2, Wing A',
                'manager_name' => 'Sarah Johnson',
                'contact_email' => 'hr@ministry.gov',
                'contact_phone' => '(021) 555-0101',
                'is_active' => true
            ],
            [
                'name' => 'Information Technology',
                'code' => 'IT',
                'description' => 'Manages IT infrastructure and support',
                'location' => 'Floor 3, Wing B',
                'manager_name' => 'Michael Chen',
                'contact_email' => 'it@ministry.gov',
                'contact_phone' => '(021) 555-0102',
                'is_active' => true
            ],
            [
                'name' => 'Finance',
                'code' => 'FIN',
                'description' => 'Manages financial operations and budgeting',
                'location' => 'Floor 4, Wing A',
                'manager_name' => 'Robert Wilson',
                'contact_email' => 'finance@ministry.gov',
                'contact_phone' => '(021) 555-0103',
                'is_active' => true
            ],
            [
                'name' => 'Operations',
                'code' => 'OPS',
                'description' => 'Manages daily operational activities',
                'location' => 'Floor 1, Wing C',
                'manager_name' => 'Linda Martinez',
                'contact_email' => 'ops@ministry.gov',
                'contact_phone' => '(021) 555-0104',
                'is_active' => true
            ],
            [
                'name' => 'Legal Affairs',
                'code' => 'LEG',
                'description' => 'Handles legal matters and compliance',
                'location' => 'Floor 5, Wing A',
                'manager_name' => 'David Thompson',
                'contact_email' => 'legal@ministry.gov',
                'contact_phone' => '(021) 555-0105',
                'is_active' => true
            ]
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}