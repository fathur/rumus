<?php

use App\Models\User;
use Illuminate\Database\Seeder;

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
            'name' => 'Fathur Rohman',
            'email' => 'fathur_rohman17@yahoo.co.id',
            'password' => bcrypt('plokijuh')
        ]);
    }
}
