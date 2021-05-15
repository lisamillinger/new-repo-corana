<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use DateTime;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class VaccinationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //IMPFUNG
        $vaccination = new \App\Models\Vaccination;
        $vaccination->key = "I1";
        $vaccination->information = "nur für über 50-jährige";
        $vaccination->date = new DateTime();
        $vaccination->max_registrations = 80;
        $vaccination->current_registrations = 70;
        $vaccination->isFull = false;
        $vaccination->save();

        //$people = \App\Models\People::all()->pluck('id');
        //$vaccination->people()->sync($people);
        $vaccination->save();

        //IMPFUNG
        $vaccination2 = new \App\Models\Vaccination;
        $vaccination2->key = "IMPF2";
        $vaccination2->information = "nur für über 40-jährige";
        $vaccination2->date = new DateTime();
        $vaccination2->max_registrations = 90;
        $vaccination2->current_registrations = 1;
        $vaccination2->isFull = false;
        $vaccination2->save();


        //LOCATIONS
        $location = new \App\Models\Location();
        $location->post_code = '5020';
        $location->address= 'Zaunergasse 11';
        $location->city = 'Salzburg';

        $vaccination->locations()->save($location);

        $location2 = new \App\Models\Location();
        $location2->post_code = '4232';
        $location2->address= 'Softwarepark 13';
        $location2->city = 'Hagenberg';

        $vaccination2->locations()->save($location2);

        $vaccination2->locations()->save($location);
        $vaccination->locations()->save($location2);
        $vaccination->save();
        $vaccination2->save();
    }
}
