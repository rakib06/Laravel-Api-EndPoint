<?php

namespace App\Http\Controllers\Country;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CountryModel;

class CountryController extends Controller
{   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    //public function index(){
    public function country(){
        //return "Hi";
        //return response()->json('This is country',200);
        return response()->json(CountryModel::get(), 200);
    }
    
    public function  countryByID($id){
        return response()->json(CountryModel::find($id), 200);
    }

    public function countrySave(Request $request){
        $country = CountryModel::create($request->all());
        return response()->json($country, 201);
    }

    public function countryUpdate(Request $request, CountryModel $country){
        // $country = CountryModel::update($request->all());
        $country->update($request->all());
        return response()->json($country, 200);
    }

    public function countryDelete(Request $request, CountryModel $country){
        $country->delete();
        return response()->json(null, 204);
    }
}
