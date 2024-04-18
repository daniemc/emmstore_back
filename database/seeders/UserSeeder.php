<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DateTime;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
