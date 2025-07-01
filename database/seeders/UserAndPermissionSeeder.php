<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\password;

class UserAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create([
            'name' => 'admin',
            'display_name' => 'Admin',
        ]);

        $user = Role::create([
            'name' => 'user',
            'display_name' => 'User', // optional
        ]);

        $u1 = User::create([
            'name' => 'Admin',
            'email' => 'admin@site.com',
            'password' => Hash::make('Welkom01!'),
        ]);
        $u2 = User::create([
            'name' => 'User',
            'email' => 'user@site.com',
            'password' => Hash::make('Welkom01!'),
        ]);

        $u1->addRole($admin);
        $u2->addRole($user);
    }
}
