<?php

namespace Database\Seeders;

use App\Models\User; // import Models User
use Spatie\Permission\Models\Role; // import model role
use Spatie\Permission\Models\Permission; // import model permission
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * @return void
     */
    public function run(): void
    {
        // create data user
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);

        // assign permission to role
        $role = Role::find(1);
        $permissions = Permission::all();

        $role->syncPermissions($permissions);

        // assign role with permission to user
        $user = User::find(1);
        $user->assignRole($role->name);

        // user -> role -> list permissions
    }
}
