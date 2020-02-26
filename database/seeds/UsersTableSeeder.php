<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();

        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Rade',
                'email' => 'rade908@gmail.com',
                'city' => 'Beograd',
                'city_slug' => 'beograd',
                'address' => 'Novi Beograd',
                'category' => 'pekara',
                'is_activated' => 1,
                'slug' => 'rade',
                'directorium' => 'rade',
                'unique_str' => 'BelG4NGibM0iQx95s51nC9sJmm8Pb4SvqEU3DSoRGwcGG1LiOjuwcFIjDgxR',
                'email_verified' => NULL,
                'password' => '$2y$12$FiLigpBNjiAxkEgvqDiie.OuMWo9pycQOMALL8ncfB5o97BGF9.uS',//all passwords are secret
                'created_at' => '2014-11-17 16:52:12',
                'updated_at' => '2016-11-14 13:12:31',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'dule',
                'email' => 'varicak@gmail.com',
                'city' => 'Novi Sad',
                'city_slug' => 'novi-sad',
                'address' => 'Grobljanska 11',
                'category' => 'pekara',
                'is_activated' => 1,
                'slug' => 'dule',
                'directorium' => 'dule',
                'unique_str' => 't9huxhWv4ccTWPkbjVG0z9ipjybC5MESDduOqSdiC0jsW8Xg8TMhxQLSMHsw',
                'email_verified' => NULL,
                'password' => '$2y$12$DR7v5uPrts.f8eNYa4Kv6ulITICo1aFSuXmzIIdsaPZf.ETUTDalK',
                'created_at' => '2014-11-17 16:52:12',
                'updated_at' => '2016-11-14 13:12:31',
            ),
        ));
    }
}