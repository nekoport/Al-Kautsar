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
            $q->where('name', 'like', '%_post')
              ->orWhere('name', 'like', '%_category')
              ->orWhere('name', 'like', '%_event')
              ->orWhere('name', 'like', '%_gallery')
              ->orWhere('name', 'like', '%_gallery_item')
              ->orWhere('name', 'like', '%_streaming')
              ->orWhere('name', 'like', '%_announcement')
              ->orWhere('name', 'like', '%_official');
        })->get();

        $editor->syncPermissions($editorPermissions);

        $bendaharaPermissions = Permission::where(function ($q) {
            $q->where('name', 'like', '%_donation_info');
        })->get();

        $bendahara->syncPermissions($bendaharaPermissions);
    }
}
