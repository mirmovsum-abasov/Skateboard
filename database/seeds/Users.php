<?php

use Illuminate\Database\Seeder;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => \Hash::make(1234)
        ]);
    }
}
