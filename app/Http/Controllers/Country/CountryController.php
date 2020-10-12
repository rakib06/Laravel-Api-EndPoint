<?php

namespace App\Http\Controllers\Country;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CountryModel;
use Validator;
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
        $country = CountryModel::find($id);
        if(is_null($country)){
            return response()->json(["message" => "Record not found!"], 404);
        }
        return response()->json($country, 200);
        //return response()->json(CountryModel::find($id), 200);
    }

    public function countrySave(Request $request){
        $rules = [
            'name' => 'required|min:3',
            'iso' => 'required|min:2|max:2|unique',  
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $country = CountryModel::create($request->all());
        return response()->json($country, 201);
    }

    public function countryUpdate(Request $request, $id){
        // $country = CountryModel::update($request->all());
        $country = CountryModel::find($id);
        if(is_null($country)){
            return response()->json(["message" => "Record not found!"], 404);
        }

        $country->update($request->all());
        return response()->json($country, 200);
    }

    public function countryDelete(Request $request, $id){
        $country = CountryModel::find($id);
        if(is_null($country)){
            return response()->json(["message" => "Record not found!"], 404);
        }
        $country->delete();
        return response()->json(null, 204);
    }
}
