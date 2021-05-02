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

        //IMPFUNG
        $vaccination2 = new \App\Models\Vaccination;
        $vaccination2->key = "IMPF2";
        $vaccination2->information = "nur für über 40-jährige";
        $vaccination2->date = new DateTime();
        $vaccination2->max_registrations = 90;
        $vaccination2->current_registrations = 1;
        $vaccination2->isFull = false;
        $vaccination2->save();

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

        $person3 = new \App\Models\People;
        $person3->firstName = "Antonia";
        $person3->lastName = "Mair";
        $person3->birthday = new DateTime();
        $person3->gender = "female";
        $person3->sv_number = 1111;
        $person3->address = "Ried";
        $person3->email = "antonia@mail.com";
        $person3->password = bcrypt('secret2');
        $person3->telephone_number = 05606514;
        $person3->isVaccinated = false;
        $person3->isAdmin = false;
        $person3->save();

        $person4 = new \App\Models\People;
        $person4->firstName = "Helene";
        $person4->lastName = "Scheibmair";
        $person4->birthday = new DateTime();
        $person4->gender = "female";
        $person4->sv_number = 2222;
        $person4->address = "Wels";
        $person4->email = "helene@mail.com";
        $person4->password = bcrypt('secret5');
        $person4->telephone_number = 0560111;
        $person4->isVaccinated = false;
        $person4->isAdmin = false;
        $person4->save();

        $vaccination2->people()->saveMany([$person3, $person4]);

        //LOCATIONS
        $location = new \App\Models\Location();
        $location->post_code = '5020';
        $location->address= 'Zaunergasse 11';
        $location->city = 'Salzburg';

        $vaccination->locations()->save($location);

        $location = new \App\Models\Location();
        $location->post_code = '4232';
        $location->address= 'Softwarepark 13';
        $location->city = 'Hagenberg';

        $vaccination2->locations()->save($location);

    }
}
