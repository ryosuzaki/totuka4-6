<?php

use Illuminate\Database\Seeder;

class UserInfoBasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('user_info_bases')->insert([
            [
                'id' => 1,
                'name' => '基本情報'
            ]
        ]);
    }
}
