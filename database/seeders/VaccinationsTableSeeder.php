<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DateTime;
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

        //PERSONEN
        $person = new \App\Models\People;
        $person->firstName = "Lisa";
        $person->lastName = "Millinger";
        $person->birthday = new DateTime();
        $person->gender = "female";
        $person->sv_number = 3389;
        $person->address = "Zaunergasse 11";
        $person->email = "lisa@mail.com";
        $person->password = bcrypt('secret');
        $person->telephone_number = 0560;
        $person->isVaccinated = false;
        $person->isAdmin = false;
        $person->save();

        $person2 = new \App\Models\People;
        $person2->firstName = "Lisa";
        $person2->lastName = "Passenbrunner";
        $person2->birthday = new DateTime();
        $person2->gender = "female";
        $person2->sv_number = 3399;
        $person2->address = "Niederneukirchen";
        $person2->email = "lisapassenbrunner@mail.com";
        $person2->password = bcrypt('secret');
        $person2->telephone_number = 0560111;
        $person2->isVaccinated = false;
        $person2->isAdmin = false;
        $person2->save();

        $vaccination->people()->saveMany([$person, $person2]);

        //LOCATIONS
        $location = new \App\Models\Location();
        $location->post_code = '5020';
        $location->address= 'Zaunergasse 11';
        $location->city = 'Salzburg';

        $vaccination->locations()->save($location);
    }
}
