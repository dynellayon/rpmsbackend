<?php

namespace App\Http\Controllers;
use App\Models\Objectives;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ObjectivesController extends Controller
{
    function insertobj(Request $request){

       $objective = new Objectives;

        $objective->name = $request->input('name');
        $objective->kraid = $request->input('kra');
        $objective->weight = $request->input('weight');
        $objective->rank = $request->input('rank');
        $objective->mov = $request->input('mov');
        $objective->save();
        return response()->json([
         'status' => 200,
         'message' => 'Account successfully stored',
         

        ]);          
        
    }
    function prof(){

   return $prof = DB::table('objectives')
                ->where('rank','=', 1)
                ->get();
   
 
    }
    function highprof(){

   return $hprof = DB::table('objectives')
                ->where('rank', 2)
                ->get();

    }
}
