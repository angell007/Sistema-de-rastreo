<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\USer;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'admin';
        $role->description = 'Administrator';
        $role->save();

        $role = new Role();
        $role->name = 'user';
        $role->description = 'User';
        $role->save();

        $role = new Role();
        $role->name = 'tecnico';
        $role->description = 'Tecnico';
        $role->save();

        $user = new User();
        $user->name = 'ADMIN';
        $user->email = 'admin@gmail.com';
        $user->email_verified_at = now();
        $user->password = Hash::make('secret'); // password
        $user->remember_token = Str::random(10);
        $user->save();
        $user->roles()->attach(Role::where('name', 'admin')->first());
    }
}
