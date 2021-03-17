<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        if (DB::table('users')->count() == 0) {

            DB::table('users')->insert([
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => '$2y$10$fA8uqm0zXkD8w.vCmP.Qhenbtkx2b/7CjYjIhzPwn.vT4/cG/gEbG',
                'country_id'=>896,
                'city_id'=>2973
            ]);


        }

    }
}
