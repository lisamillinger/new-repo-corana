<?php

namespace Database\Seeders;

use App\Models\Vaccination;
use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*DB::table('people')->insert([
            'firstName' =>"ndsj",
            'lastName' => 'djas',
            'email' => "test",
            'password' => "bcrypt",
            'date' => new DateTime(),
            'sex' => 'female',
            'address' => "ndsk",
            'sv_number' => 1111,
            'telephone_number' => 1111111,
            'vaccinated' => 0,
            'vaccination_id' => 1,
            'admin' => 0,
        ]);*/
    }
}
