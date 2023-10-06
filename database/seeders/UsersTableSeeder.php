<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('users')->delete();

        \DB::table('users')->insert(array(
            0 =>
            array(
                'id' => 1,
                'first_name' => 'Atiar',
                'last_name' => 'Rahman',
                'username' => 'Admin',
                'email' => 'atiar.cse@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$DE5x6wBCM5UzpO2ukQvEn.bJAqVPPJA34tI5PjRJzeDuZdg2a6/sq',
                'remember_token' => NULL,
                'created_at' => '2023-10-04 03:13:25',
                'updated_at' => '2023-10-04 03:13:25',
            ),
        ));
    }
}
