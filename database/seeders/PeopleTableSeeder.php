<?php

namespace Database\Seeders;

use App\Models\Vaccination;
use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
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

        //PERSONEN
        $person = new \App\Models\People;
        $person->firstName = "Lisa";
        $person->lastName = "Millinger";
        $person->birthday = "1999-08-22";
        $person->gender = "female";
        $person->sv_number = 3389;
        $person->address = "Zaunergasse 11";
        $person->email = "lisa@mail.com";
        $person->password = bcrypt('secret');
        $person->telephone_number = "06506514880";
        $person->isRegistred = false;
        $person->isVaccinated = false;
        $person->isAdmin = true;
        $person->save();

        $person2 = new \App\Models\People;
        $person2->firstName = "Lisa";
        $person2->lastName = "Passenbrunner";
        $person2->birthday = "2000-07-01";
        $person2->gender = "female";
        $person2->sv_number = 3399;
        $person2->address = "Ruprechtshofen 12";
        $person2->email = "lisapassenbrunner@mail.com";
        $person2->password = bcrypt('secret');
        $person2->telephone_number = "0650123456";
        $person2->isRegistred = false;
        $person2->isVaccinated = false;
        $person2->isAdmin = false;
        $person2->save();

        $person3 = new \App\Models\People;
        $person3->firstName = "Antonia";
        $person3->lastName = "Mair";
        $person3->birthday = "1999-05-08";
        $person3->gender = "female";
        $person3->sv_number = 1111;
        $person3->address = "Ried 17";
        $person3->email = "antonia@mail.com";
        $person3->password = bcrypt('secret');
        $person3->telephone_number = "0650876543";
        $person3->isRegistred = false;
        $person3->isVaccinated = false;
        $person3->isAdmin = false;
        $person3->save();

        $person4 = new \App\Models\People;
        $person4->firstName = "Helene";
        $person4->lastName = "Scheibmair";
        $person4->birthday = "1999-05-19";
        $person4->gender = "female";
        $person4->sv_number = 7856;
        $person4->address = "Königsstraße 15";
        $person4->email = "helene@mail.com";
        $person4->password = bcrypt('secret5');
        $person4->telephone_number = "0676567854";
        $person4->isRegistred = false;
        $person4->isVaccinated = false;
        $person4->isAdmin = false;
        $person4->save();

        $person5 = new \App\Models\People;
        $person5->firstName = "Hubert";
        $person5->lastName = "Kuchar";
        $person5->birthday = "1963-08-21";
        $person5->gender = "male";
        $person5->sv_number = 4523;
        $person5->address = "Zaunergasse 11";
        $person5->email = "hubert@mail.com";
        $person5->password = bcrypt('secret');
        $person5->telephone_number = "066412333555";
        $person5->isRegistred = false;
        $person5->isVaccinated = false;
        $person5->isAdmin = false;
        $person5->save();

        $person6 = new \App\Models\People;
        $person6->firstName = "Regina";
        $person6->lastName = "Millinger";
        $person6->birthday = "1966-08-02";
        $person6->gender = "female";
        $person6->sv_number = 4577;
        $person6->address = "Klessheimerallee 11";
        $person6->email = "regina@mail.com";
        $person6->password = bcrypt('secret');
        $person6->telephone_number = "066412383555";
        $person6->isRegistred = false;
        $person6->isVaccinated = false;
        $person6->isAdmin = false;
        $person6->save();
    }
}
