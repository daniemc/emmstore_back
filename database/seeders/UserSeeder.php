<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DateTime;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        
        DB::table('users')->insert([
            'name' => 'System',
            'last_name' => 'Admin',
            'username' => 'sys_admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('secret'),
            'created_by' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('user_roles')->insertGetId([
            'user_id' => 1,
            'role_id' => 1,
            'active' => true,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

    }
}
