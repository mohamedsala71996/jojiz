<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Admin\Module;
use Illuminate\Database\Seeder;
use App\Models\Admin\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $permissions = [
            'User Index',
            'User Edit',
            'User Delete',
            'Module Index',
            'Module Edit',
            'Module Delete',
            'Role Index',
            'Role Edit',
            'Role Delete',
            'Permission Index',
            'Permission Edit',
            'Permission Delete',
            'Dashboard Access',
            'Profile Index',
            'Profile Edit',
            'Profile Delete',
        ];
        $module = Module::where('module_slug', 'user-management')->first();
        for ($i = 0; $i < 3; $i++) {
            Permission::updateOrCreate([
                'permission_name' => $permissions[$i],
                'permission_slug' => Str::slug($permissions[$i]),
                'module_id' => $module->id
            ]);
        }

        $module = Module::where('module_slug', 'module-management')->first();
        for ($i = 3; $i < 6; $i++) {
            Permission::updateOrCreate([
                'permission_name' => $permissions[$i],
                'permission_slug' => Str::slug($permissions[$i]),
                'module_id' => $module->id,
            ]);
        }

        $module = Module::where('module_slug', 'role-management')->first();
        for ($i = 6; $i < 9; $i++) {
            Permission::updateOrCreate([
                'permission_name' => $permissions[$i],
                'permission_slug' => Str::slug($permissions[$i]),
                'module_id' => $module->id,
            ]);
        }
        $module = Module::where('module_slug', 'permission-management')->first();
        for ($i = 9; $i < 12; $i++) {
            Permission::updateOrCreate([
                'permission_name' => $permissions[$i],
                'permission_slug' => Str::slug($permissions[$i]),
                'module_id' => $module->id,
            ]);
        }

        $module = Module::where('module_slug', 'dashboard-management')->first();
        for ($i = 12; $i <= 12; $i++) {
            Permission::updateOrCreate([
                'permission_name' => $permissions[$i],
                'permission_slug' => Str::slug($permissions[$i]),
                'module_id' => $module->id,
            ]);
        }
        $module = Module::where('module_slug', 'profile-management')->first();
        for ($i = 13; $i <= 15; $i++) {
            Permission::updateOrCreate([
                'permission_name' => $permissions[$i],
                'permission_slug' => Str::slug($permissions[$i]),
                'module_id' => $module->id,
            ]);
        }
    }
}
