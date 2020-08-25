<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => bcrypt('Admin1234'),
        ]);
            
        $admin = User::where('name', 'Admin')->first();
        $admin->assignRole('Admin');
    }
}
