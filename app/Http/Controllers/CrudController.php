<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CellPhone;
use App\Models\Person;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use mysql_xdevapi\Exception;

/**
 * Class CrudController
 * @package App\Http\Controllers
 */
class CrudController extends Controller
{

    /**
     * @param Request $request
     */
    public function index(Request $request)
    {
        try {
            $search = $request->get('search');
            if (!empty($search)) {
                $persons = Person::where('name', 'like', '%' . $search . '%')
                    ->orWhereHas('cars', function ($query) use ($search) {
                        $query->where('car_name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('cellphones', function ($query) use ($search) {
                        $query->where('cellphone_name', 'like', '%' . $search . '%');
                    })->get();
//                return response()->json(['persons'=>$persons]);
            } else {
                $persons = Person::with(['cars', 'cellphones'])->get();
            }

            return view('crud.index', compact('persons'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            return view('crud.create');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $person = new person();
            $person->name = $request->get('name');
            $person->save();
            if ($request->get('car')) {
                $car = new Car();
                $car->car_name = $request->get('car');
                $car->person_id = $person->id;
                $car->save();
            }
            if ($request->get('cellphone')) {
                $car = new CellPhone();
                $car->cellphone_name = $request->get('cellphone');
                $car->person_id = $person->id;
                $car->save();
            }
            return redirect('/laravel-crud');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $person = Person::where('id', $id)->first();
            $car = Car::where('person_id', $id)->first();
            $cellPhone = CellPhone::where('person_id', $id)->first();
            return view('crud.create', ['person' => $person, 'car' => $car, 'cell_phone' => $cellPhone]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $name = $request->get('name');
            $car_name = $request->get('car');
            $cellPhone_name = $request->get('cellphone');
            $person = Person::find($id);
            $person->name = $name;
            $person->save();
//            \DB::enableQueryLog();
            $car = Car::where('person_id', $id)->first();
            $cars = $car->update(['car_name', $car_name]);

            $cellPhone = CellPhone::where('person_id', $id)->first();
            $cellPhones = $cellPhone->update(['cellphone_name', $cellPhone_name]);
            return route('crud');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Person::destroy($id);
        return redirect('/laravel-crud');
    }
}
