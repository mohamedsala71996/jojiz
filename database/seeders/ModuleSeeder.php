<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Admin\Module;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            'User Management',
            'Role Management',
            'Module Management',
            'Permission Management',
            'Dashboard Management',
            'Profile Management'
        ];

        foreach ($modules as $module) {
            Module::updateOrCreate([
                'module_name' => $module,
                'module_slug' => Str::slug($module)
            ]);
        }
    }
}
