<?php

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
        DB::table('users')->insert(
            array(
                array(
                    'name'       => env('NAME', 'Test Owner'),
                    'email'      => env('EMAIL', 'test_owner@yahoo.com'),
                    'password'   => bcrypt(env('PASS', 'admin123')),
                    'role'       => 'owner',
                    'created_at' => date('Y-m-d h:i:s'),
                    'updated_at' => date('Y-m-d h:i:s')
                ),
                array(
                    'name'       => env('NAME', 'Test Admin'),
                    'email'      => env('EMAIL', 'test_admin@yahoo.com'),
                    'password'   => bcrypt(env('PASS', 'admin123')),
                    'role'       => 'admin',
                    'created_at' => date('Y-m-d h:i:s'),
                    'updated_at' => date('Y-m-d h:i:s')
                ),
                array(
                    'name'       => env('NAME', 'Rakel Keeno'),
                    'email'      => env('EMAIL', 'rakel_keeno@yahoo.com'),
                    'password'   => bcrypt(env('PASS', 'assistant123')),
                    'role'       => 'secretary',
                    'created_at' => date('Y-m-d h:i:s'),
                    'updated_at' => date('Y-m-d h:i:s')
                ),
                array(
                    'name'       => env('NAME', 'Test Assistant'),
                    'email'      => env('EMAIL', 'test_assistant@yahoo.com'),
                    'password'   => bcrypt(env('PASS', 'admin123')),
                    'role'       => 'assistant',
                    'created_at' => date('Y-m-d h:i:s'),
                    'updated_at' => date('Y-m-d h:i:s')
                ),
                array(
                    'name'       => env('NAME', 'Tester Collection'),
                    'email'      => env('EMAIL', 'test_collection@yahoo.com'),
                    'password'   => bcrypt(env('PASS', 'admin123')),
                    'role'       => 'collection',
                    'created_at' => date('Y-m-d h:i:s'),
                    'updated_at' => date('Y-m-d h:i:s')
                ),
                array(
                    'name'       => env('NAME', 'Tester Sales Engineer'),
                    'email'      => env('EMAIL', 'test_se@yahoo.com'),
                    'password'   => bcrypt(env('PASS', 'admin123')),
                    'role'       => 'sales_engineer',
                    'created_at' => date('Y-m-d h:i:s'),
                    'updated_at' => date('Y-m-d h:i:s')
                ),

                /*array(
                    'name'       => env('NAME', 'Demo User'),
                    'email'      => env('EMAIL', 'demo123@yahoo.com'),
                    'password'   => bcrypt(env('PASS', 'demo123')),
                    'role'       => 'admin',
                    'created_at' => date('Y-m-d h:i:s'),
                    'updated_at' => date('Y-m-d h:i:s')
                ),*/
            )
        );
    }
}
