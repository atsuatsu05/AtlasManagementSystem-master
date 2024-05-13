<?php

use Illuminate\Database\Seeder;
use App\Models\Users\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'over_name' => '田中',
                'under_name' => '花子',
                'over_name_kana' => 'タナカ',
                'under_name_kana' => 'ハナコ',
                'mail_address' => 'tanaka@gmail.com',
                'sex' => '2',
                'birth_day' => '2000-01-01',
                'role' => '1',
                'password' => bcrypt('tanaka123'),
            ]
            ]);
    }
}
