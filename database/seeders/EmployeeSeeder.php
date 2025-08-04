<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $employees = [
            ['name' => 'Reihan Setya Abida', 'team' => 'Delivery', 'purpose' => '', 'status' => 'available'],
            ['name' => 'Gentha Muhammad Djamal', 'team' => 'Delivery', 'purpose' => '', 'status' => 'available'],
            ['name' => 'Lingga', 'team' => 'Delivery', 'purpose' => '', 'status' => 'available'],
            ['name' => 'Arya Sacca Utama', 'team' => 'Tech Lead', 'purpose' => '', 'status' => 'available'],
        ];

        foreach ($employees as $emp) {
            Employee::create($emp);
        }
    }
}
