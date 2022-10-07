<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email'=>'islam@gmail.com',
            'phone'=>'01201891564',
            'type'=>'super_admin',
            'password'=>Hash::make(123456),
            'country_id'=>1
        ]);
    }
}
