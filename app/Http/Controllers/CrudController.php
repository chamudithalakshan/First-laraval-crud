<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;

class CrudController extends Controller
{
    //
    public function showAllCars()
    {
        $all_cars = Car::all();
        return view('all-cars', compact('all_cars'));
    }

    public function addCar(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'manufacture_year' => 'required',
            'fuel_type' => 'required',
            'engine_capacity' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['msg' => $validator->errors()->toArray()]);
        } else {
            try {
                $addCar = new Car;
                $addCar->name = $request->name;
                $addCar->manufacture_year = $request->manufacture_year;
                $addCar->fuel_type = $request->fuel_type;
                $addCar->engine_capacity = $request->engine_capacity;
                $addCar->save();

                return response()->json(['success' => true, 'msg' => 'car added successfully']);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'msg' => $e->getMessage()]);
            }
        }
    }
    public function deleteCar($id)
    {
        try {
            $delete_car = Car::where('id', $id)->delete();
            return response()->json(['success' => true, 'msg' => 'car deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function editCar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'manufacture_year' => 'required',
            'fuel_type' => 'required',
            'engine_capacity' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['msg' => $validator->errors()->toArray()]);
        } else {
            try {
                $editCar = Car::where('id', $request->car_id)->update([
                    'name' => $request->name,
                    'manufacture_year' =>$request->manufacture_year,
                    'engine_capacity' =>$request->engine_capacity,
                    'fuel_type' =>$request->fuel_type,
                    
                ]);
                return response()->json(['success' => true, 'msg' => 'car Updated successfully']);
            } catch (\Exception $e) {
                return response()->json(['success' => false,  'msg' => $e->getMessage()]);
            }
        }
    }
}
