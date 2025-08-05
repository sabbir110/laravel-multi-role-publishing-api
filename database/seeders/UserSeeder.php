<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
            ]
        );

        $editor = User::firstOrCreate(
            ['email' => 'editor@example.com'],
            [
                'name' => 'Editor User',
                'password' => Hash::make('password'),
            ]
        );

        $author = User::firstOrCreate(
            ['email' => 'author@example.com'],
            [
                'name' => 'Author User',
                'password' => Hash::make('password'),
            ]
        );

        $admin->roles()->sync([Role::where('name', 'admin')->first()->id]);
        $editor->roles()->sync([Role::where('name', 'editor')->first()->id]);
        $author->roles()->sync([Role::where('name', 'author')->first()->id]);
    }
}
