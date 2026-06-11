<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        $editor = Role::firstOrCreate(['name' => 'editor', 'guard_name' => 'web']);
        $bendahara = Role::firstOrCreate(['name' => 'bendahara', 'guard_name' => 'web']);

        $editorPermissions = Permission::where(function ($q) {
            $q->where('name', 'like', 'post%')
              ->orWhere('name', 'like', 'category%')
              ->orWhere('name', 'like', 'event%')
              ->orWhere('name', 'like', 'gallery%')
              ->orWhere('name', 'like', 'gallery_item%')
              ->orWhere('name', 'like', 'streaming%')
              ->orWhere('name', 'like', 'announcement%')
              ->orWhere('name', 'like', 'official%');
        })->get();

        $editor->syncPermissions($editorPermissions);

        $bendaharaPermissions = Permission::where(function ($q) {
            $q->where('name', 'like', 'donation_info%');
        })->get();

        $bendahara->syncPermissions($bendaharaPermissions);
    }
}
