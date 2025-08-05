<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'admin',
            'editor',
            'author'
        ];

        $permissions = [
            'view all users',
            'assign roles',
            'create article',
            'edit own article',
            'publish article',
            'delete article',
            'view published',
            'view own articles',
        ];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName]);
        }

        // Assign permissions to roles
        $admin = Role::where('name', 'admin')->first();
        $editor = Role::where('name', 'editor')->first();
        $author = Role::where('name', 'author')->first();

        $admin->permissions()->sync([
            Permission::where('name', 'view all users')->first()->id,
            Permission::where('name', 'assign roles')->first()->id,
            Permission::where('name', 'publish article')->first()->id,
            Permission::where('name', 'delete article')->first()->id,
            Permission::where('name', 'view published')->first()->id,
        ]);

        $editor->permissions()->sync([
            Permission::where('name', 'publish article')->first()->id,
            Permission::where('name', 'view published')->first()->id,
        ]);

        $author->permissions()->sync([
            Permission::where('name', 'create article')->first()->id,
            Permission::where('name', 'edit own article')->first()->id,
            Permission::where('name', 'view own articles')->first()->id,
            Permission::where('name', 'view published')->first()->id,
        ]);
    }
}
