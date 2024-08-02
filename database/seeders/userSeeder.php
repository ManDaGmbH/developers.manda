<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
        		'first_name'=>'Test',
        		'last_name'=>'User',
        		'email'=>'zuber@cyberclouds.com',
        		'password'=> Hash::make('cyber@2020'),
        		'status' => 1
        	]);
        User::factory()->times(50)->create();
    }
}
