<?php

namespace App\Http\Controllers;

use App\Models\People;
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

    public function findBySearchTerm(string $searchTerm) {
        $vaccination = Vaccination::with(['locations', 'people'])
            ->where('key', 'LIKE', '%'.$searchTerm. '%')
            ->orWhere('information', 'LIKE', '%'.$searchTerm. '%')
            ->orWhereHas('locations', function($query) use ($searchTerm) {
                $query->where('address', 'LIKE', '%'.$searchTerm. '%')
                    ->orWhere('city', 'LIKE', '%'.$searchTerm. '%');
            })->get();
        return $vaccination;
    }

    /**
     * create new vaccination :)
     */
    public function save(Request $request) : JsonResponse
    {
        $request = $this->parseRequest($request);

        DB::beginTransaction();
        try {
            $vaccination = Vaccination::create($request->all());

            if (isset($request['people']) && is_array($request['people'])) {
                foreach ($request['people'] as $per) {
                    $person = People::firstOrNew(['firstName' => $per['firstName'], 'lastName' => $per['lastName'],
                        'birthday' => $per['birthday'], 'gender' => $per['gender'], 'sv_number' => $per['sv_number'],
                        'address'=>$per['address'], 'email' => $per['email'], 'password'=> $per['password'], 'telephone_number' => $per['telephone_number'],
                        'isVaccinated' => $per['isVaccinated'], 'isAdmin' => $per['isAdmin']]);
                    $vaccination->people()->save($person);
                }
            }

            //save place
            if (isset($request['locations']) && is_array($request['locations'])) {
                foreach($request['locations'] as $loc) {
                    $location= Location::firstOrNew(['post_code' => $loc['post_code'],
                        'address' => $loc['address'], 'city' => $loc['city']]);
                    $vaccination->locations()->save($location);
                }
            }
            DB::commit();
            //return http response
            return response()->json($vaccination, 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json("saving vaccination failed: ". $e->getMessage(), 420);
        }
    }



    private function parseRequest(Request $request) : Request {
        // get date and convert it - its in ISO 8601, e.g. "2018-01-01T23:00:00.000Z"
        $date = new \DateTime($request->date);
        $request['date'] = $date;
        return $request;
    }

    public function update(Request $request, string $key) {
        DB::beginTransaction();
        try {
            $vaccination = Vaccination::with(['locations', 'people'])->where('key', $key)
                ->first();
            if($vaccination != null) {
                $request = $this->parseRequest($request);
                $vaccination->update($request->all());

                $vaccination->people()->delete();

                if (isset($request['people']) && is_array($request['people'])) {
                    foreach ($request['people'] as $per) {
                        $person = People::firstOrNew(['firstName' => $per['firstName'], 'lastName' => $per['lastName'],
                            'birthday' => $per['birthday'], 'gender' => $per['gender'], 'sv_number' => $per['sv_number'],
                            'address'=>$per['address'], 'email' => $per['email'], 'password'=> $per['password'], 'telephone_number' => $per['telephone_number'],
                            'isVaccinated' => $per['isVaccinated'], 'isAdmin' => $per['isAdmin']]);
                        $vaccination->people()->save($person);
                    }
                }


            }
            DB::commit();
            $vaccination1 = Vaccination::with(['people', 'locations'])->where('key', $key)
                ->first();
            return response()->json($vaccination1, 201);

            } catch (\Exception $e) {
            DB::rollBack();
            return response()->json("updating vaccination failed :( : " .$e->getMessage(), 420);
        }
    }

    public function delete(string $key) : JsonResponse {
        $vaccination = Vaccination::where('key', $key)->first();
        if($vaccination != null) {
            $vaccination->delete();
        } else
            throw new \Exception("vaccination could not be deleted, it does not exist!");
        return response()->json('vaccination (' .$key .') successfully deleted', 200);
    }




}
