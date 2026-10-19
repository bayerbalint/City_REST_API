<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(){
        $cities = City::all();
        return response()->json(['cities' => $cities]);
    }

    public function store(Request $request){
        $request->validate([
            'zip_code' => ['required', 'string'],
            'city' => ['required', 'string'],
            'population' => ['required', 'integer', 'min:0', 'max:1000000'],
        ]);

        $city = City::create($request->all());

        return response()->json(['city' => $city]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'zip_code' => ['required', 'string'],
            'city' => ['required', 'string'],
            'population' => ['required', 'integer', 'min:0', 'max:1000000'],
        ]);

        $city = City::findOrFail($id);
        $city->update($request->all());

        return response()->json(['city' => $city]);
    }

    public function destroy($id){
        $city = City::findOrFail($id);
        $city->delete();

        return response()->json(['city' => $city]);
    }
}
