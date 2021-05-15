<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use DateTime;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
           'name' =>"Lisa",
            'password' => bcrypt('secret'),
            'email' => "lisa@mail.com"
       ]);
    }
}
