<?php

use Illuminate\Database\Seeder;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//         DB::table('roles')->insert(array(
//             'slug' => 'tutor',
//             'name' => 'tutor',
//         ));

        $credential = [
            'email' => 'tutor3@gmail.com',
            'password' => '123456',
            'first_name' => 'tuto3',
            'last_name' => 'tutor3',

        ];
        $user_act = \Sentinel::registerAndActivate($credential);
        $role =  \Sentinel::findRoleByName('admin');
        $role->users()->attach($user_act);

    }
}
