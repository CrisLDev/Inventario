<?php

use Illuminate\Database\Seeder;

use Caffeinated\Shinobi\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'description' => 'Acceso a todo el sistema.',
            'special' => 'all-access'
        ]);

        $now = new \DateTime();

        DB::table('role_user')->insert([
            'role_id' => '1',
            'user_id' => '1',
        ]);
    }
}
