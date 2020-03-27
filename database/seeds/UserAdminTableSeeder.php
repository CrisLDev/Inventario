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
        User::create([
            'name' => 'Cris',
            'email' => 'leonardomoreirapazmio@gmail.com',
            'password' => '159753Cristian',
            'activo' => '1'
        ]);
    }
}
