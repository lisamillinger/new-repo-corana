<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Location;
use App\Models\Vaccination;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\Util\Json;



class VaccinationController extends Controller
{
    //
    public function index(){
        //load all objects
        $vaccinations = Vaccination::with(['locations', 'people'])->get();
        return $vaccinations;
    }

    public function findByKey(string $key) : Vaccination {
        $vaccination = Vaccination::where('key', $key)
            ->with(['locations', 'people'])->first();
        return $vaccination;
    }

    public function checkKey(string $key) {
        $vaccination = Vaccination::where('key', $key)->first();
        return $vaccination != null ? response()->json(true, 200) : response()->json(false,
            200);
    }

    /**
     * create new vaccination :)
     */
    public function save(Request $request) : JsonResponse {
        $request = $this->parseRequest($request);

        DB::beginTransaction();

        try {
            $vaccination = Vaccination::create($request->all());

            //save people
            /*if(isset($request['people']) && is_array($request['people'])) {
                foreach ($request['people'] as $per) {
                    $person =
                        Person::firstOrNew(['firstName'=>$per['firstName'], 'lastName'=>$per['lastName'],
                            'birthday'=>$per['birthday'], 'gender'=>$per['gender'], 'sv_number'=>$per['sv_number'],
                            'address'=>$per['address'], 'email'=>$per['email'], 'password'=>$per['password'],
                            'telephone_number'=>$per['telephone_number'], 'isVaccinated'=>$per['isVaccinated'],
                            'isAdmin'=>$per['isAdmin']]);
                    $vaccination->people()->save($person);
                }
            }*/

            //save location
            if(isset($request['locations']) && is_array($request['locations'])) {
                foreach ($request['locations'] as $loc) {
                    $location = Location::firstOrNew(['post_code'=>$loc['post_code'], 'address'=>
                    $loc['address'], 'city'=>$loc['city']]);
                    $vaccination->locations()->save($location);
                }
            }
            DB::commit();
            return response()->json($vaccination, 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json("saving vaccination failed: " .$e->getMessage(), 420);
        }
    }

    private function parseRequest(Request $request) : Request {
        // get date and convert it - its in ISO 8601, e.g. "2018-01-01T23:00:00.000Z"
        $date = new \DateTime($request->date);
        $request['date'] = $date;
        return $request;
    }




}
