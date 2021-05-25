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
        /**
         * Impfung 1
         */
        $vaccination = new \App\Models\Vaccination;
        $vaccination->key = "I00001";
        $vaccination->information = "nur für über 50-jährige";
        $vaccination->date = "2021-08-08";
        $vaccination->max_registrations = 50;
        $vaccination->current_registrations = 0;
        $vaccination->isFull = false;
        $vaccination->save();

        $location = new \App\Models\Location();
        $location->post_code = '5020';
        $location->address= 'Mirabellplatz 13';
        $location->city = 'Salzburg';

        $vaccination->locations()->save($location);
        //$people = \App\Models\People::all()->pluck('id');
        //$vaccination->people()->sync($people);
        $vaccination->save();

        $vaccination4 = new \App\Models\Vaccination;
        $vaccination4->key = "I00004";
        $vaccination4->information = "Anmeldung bitte bis spätestens 12 Uhr des Vortages";
        $vaccination4->date = "2021-07-07";
        $vaccination4->max_registrations = 2;
        $vaccination4->current_registrations = 0;
        $vaccination4->isFull = false;
        $vaccination4->save();

        $location2 = new \App\Models\Location();
        $location2->post_code = '4232';
        $location2->address= 'Softwarepark 13';
        $location2->city = 'Hagenberg';

        $vaccination4->locations()->save($location2);
        $vaccination4->save();

        $vaccination5 = new \App\Models\Vaccination;
        $vaccination5->key = "I00005";
        $vaccination5->information = "Impfung für alle Altersgruppen freigeschalten";
        $vaccination5->date = "2021-09-06";
        $vaccination5->max_registrations = 100;
        $vaccination5->current_registrations = 0;
        $vaccination5->isFull = false;
        $vaccination5->save();

        $location3 = new \App\Models\Location();
        $location3->post_code = '4020';
        $location3->address= 'Pfarrgasse 13';
        $location3->city = 'Linz';
        $vaccination5->locations()->save($location3);
        $vaccination5->save();
    }
}
