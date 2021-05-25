<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Models\Location;
use App\Models\Vaccination;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Integer;
use Psy\Util\Json;


class VaccinationController extends Controller
{
    /**
     * methods to get all vaccinations and people
     */
    public function index()
    {
        //load all objects
        $vaccinations = Vaccination::with(['locations', 'people'])->get();
        return $vaccinations;
    }

    public function indexPeople()
    {
        //load all objects
        $people = People::get();
        return $people;
    }

    /**
     *  methods to get specific vaccinations & people
     */
    public function findPersonById($id)
    {
        $person = People::where('id', $id)->first();
        return $person;
    }

    public function findByKey(string $key): Vaccination
    {
        $vaccination = Vaccination::where('key', $key)
            ->with(['people', 'locations'])
            ->first();
        return $vaccination;
    }

    public function findById($id): Vaccination
    {
        $vaccination = Vaccination::where('id', $id)
            ->with(['people', 'locations'])
            ->first();
        return $vaccination;
    }

    public function findPersonBySVNR(string $sv_number): People
    {
        $person = People::where('sv_number', $sv_number)->first();
        return $person;
    }

    /**
     * methods to check id and key
     */

    //FOR VACCINATION
    public function checkKey(string $key)
    {
        $vaccination = Vaccination::where('key', $key)->first();
        return $vaccination != null ? response()->json(true, 200) : response()->json(false,
            200);
    }

    //FOR PEOPLE
    public function checkId($id)
    {
        $person = People::where('id', $id)->first();
        return $person != null ? response()->json(true, 200) : response()->json(false,
            200);
    }

    /**
     * method to get vaccination for specific person
     */

    public function getVaccinationForPerson($id)
    {
        $person = People::where('id', $id)->first();

        $vaccination = $this->findById($person['vaccination_id']);
        return $vaccination;
    }


    /**
     * CREATING AND UPDATING VACCINATIONS
     */
    public function save(Request $request): JsonResponse
    {
        $request = $this->parseRequest($request);

        DB::beginTransaction();

        try {
            $vaccination = Vaccination::create($request->all());

            if (isset($request['locations']) && is_array($request['locations'])) {
                foreach ($request['locations'] as $loc) {
                    $location = Location::firstOrNew(['post_code' => $loc['post_code'],
                        'address' => $loc['address'], 'city' => $loc['city']]);
                    $vaccination->locations()->save($location);
                }
            }
            DB::commit();
            //return http response
            return response()->json($vaccination, 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json("saving vaccination failed: " . $e->getMessage(), 420);
        }
    }


    private function parseRequest(Request $request): Request
    {
        // get date and convert it - its in ISO 8601, e.g. "2018-01-01T23:00:00.000Z"
        $date = new \DateTime($request->date);
        $request['date'] = $date;
        return $request;
    }

    public function update(Request $request, string $key)
    {
        DB::beginTransaction();
        try {
            $vaccination = Vaccination::with(['locations', 'people'])->where('key', $key)
                ->first();
            if ($vaccination != null) {
                $request = $this->parseRequest($request);
                $vaccination->update($request->all());

                $vaccination->people()->delete();

                if (isset($request['people']) && is_array($request['people'])) {
                    foreach ($request['people'] as $per) {
                        $person = People::firstOrNew(['firstName' => $per['firstName'], 'lastName' => $per['lastName'],
                            'birthday' => $per['birthday'], 'gender' => $per['gender'], 'sv_number' => $per['sv_number'],
                            'address' => $per['address'], 'email' => $per['email'], 'password' => $per['password'], 'telephone_number' => $per['telephone_number'],
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
            return response()->json("updating vaccination failed :( : " . $e->getMessage(), 420);
        }
    }

    /**
     * DELETING A VACCINATION
     */
    public function delete(string $key): JsonResponse
    {
        $vaccination = Vaccination::where('key', $key)->first();
        if ($vaccination != null) {
            $vaccination->delete();
        } else
            throw new \Exception("vaccination could not be deleted, it does not exist!");
        return response()->json('vaccination (' . $key . ') successfully deleted', 200);
    }

    public function findBySearchTerm(string $searchTerm)
    {
        $vaccination = Vaccination::with(['locations', 'people'])
            ->where('key', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('information', 'LIKE', '%' . $searchTerm . '%')
            ->orWhereHas('locations', function ($query) use ($searchTerm) {
                $query->where('address', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('city', 'LIKE', '%' . $searchTerm . '%');
            })->get();
        return $vaccination;
    }


    /**
     * VACCINATING PEOPLE
     */
    public function vaccinatePerson(string $sv_number): JsonResponse
    {
        DB::beginTransaction();

        try {
            $person = People::with(['vaccination'])->where('sv_number', $sv_number)->first();

            if ($person != null) {
                if ($person->isVaccinated == false) {
                    $person->isVaccinated = 1;
                } else
                    $person->isVaccinated = 0;
                $person->save();
            }

            DB::commit();

            $person1 = People::with(['vaccination'])->where('sv_number', $sv_number)
                ->first();
            return response()->json($person1, 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json("updating person failed: " . $e->getMessage(), 420);
        }

    }

    /**
     * REGISTRATION OF PEOPLE
     */
    public function registerPerson(string $key, string $sv_number) {
        DB::beginTransaction();

        try {
            $person = People::with(['vaccination'])->where('sv_number', $sv_number)->first();
            $vaccination = Vaccination::with(['people', 'locations'])->where('key', $key)->first();

            $vaccinationArray = (array)$vaccination;



            if ($vaccination != null) {
                if (is_array($vaccinationArray)) {

                    array_push($vaccinationArray, $person);
                    $vaccination['current_registrations'] = $vaccination['current_registrations'] + 1;
                    $person['isRegistred'] = true;
                    $person->save();
                    $vaccination->people()->save($person);
                    $vaccination->save();
                }
            }

            DB::commit();

            $vaccination1 = Vaccination::with(['people', 'locations'])->where('key', $key)->first();
            return response()->json($vaccination1, 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json("registering person failed: " . $e->getMessage(), 420);
        }
    }






}
