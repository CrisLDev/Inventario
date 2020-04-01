<?php

use Illuminate\Database\Seeder;

use App\User;

class UserAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = bcrypt('159753Cristian');
        User::create([
            'name' => 'Cris2000',
            'email' => 'leonardomoreirapazmio@gmail.com',
            'password' => $password,
            'activo' => '1'
        ]);
    }
}
