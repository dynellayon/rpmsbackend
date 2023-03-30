<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Selfrating;
use App\Models\Ratings;
use App\Models\Esat;
use App\Models\Objectives;
use App\Models\Coaching;
use App\Models\Task;
class Phasetwo extends Controller
{
    public function selfrate(Request $request, $id){

         $curdate = date('Y-m-d');
$selfrates=$request->all();
 foreach($selfrates as $next){
        Selfrating::create([ 
           'taskid'=>$id,
           'empolyeeid'=>$next["kraid"],
           'objectiveid'=>$next["id"],
           'quality'=>$next["quality"],
           'efficiency'=>$next["efficiency"],
           'timeliness'=>$next["timeline"],
           'average'=>$next["average"],
           'score'=>$next["score"],
           'phaseid'=>$next["phase"],
           'remarks'=>$next["feedbacks"],
           
        ]);
        }


             Task::where('id',$id)
            ->update(['status'=>3,
                        'completed_date'=> $curdate,
        ]);
       
       return "success";
    }

    public function evalrate(Request $request, $id){
        $evalrates=$request->all();
         foreach($evalrates as $next){
        Ratings::create([ 
           'taskid'=>$id,
           'objectiveid'=>$next["id"],
           'quality'=>$next["quality"],
           'efficiency'=>$next["efficiency"],
           'timeliness'=>$next["timeline"],
           'average'=>$next["average"],
           'score'=>$next["score"],
           'phaseid'=>$next["phase"],
           'remarks'=>$next["feedbacks"],
           
        ]);
        }

         Task::where('id',$id)
            ->update(['evalstatus'=>3,
    
        ]);

 return "success";
    }

    public function showratings(Request $request){

             $showrate = DB::table('ratings')
             ->where("ratings.taskid","=",$request->tid)
             ->where("ratings.phaseid","=",$request->pid) 
            ->join('selfratings', 'ratings.objectiveid', '=', 'selfratings.objectiveid')
             ->where("selfratings.phaseid","=",$request->pid) 
             ->where("selfratings.taskid","=",$request->tid) 
            ->join('objectives', 'selfratings.objectiveid', '=', 'objectives.id')
            ->select('ratings.objectiveid as id','ratings.quality as rquality','ratings.efficiency as refficiency','ratings.timeliness as rtimeliness','ratings.remarks as rremarks','ratings.average as raverage','ratings.score as rscore'
                ,'ratings.midyear as rmidyear',"selfratings.quality as squality","selfratings.efficiency as sefficiency","selfratings.timeliness as stimeliness","selfratings.average as saverage","selfratings.score as sscore","selfratings.remarks as sremarks","selfratings.remarks as sremarks","objectives.name as objname","objectives.mov","objectives.weight")
                        
                    ->get(); 
    
    return $showrate;
    }
    public function insertmid(Request $request, $id){
     $mid=$request->all();


        foreach($mid as $next){
             Ratings::where('taskid',$id)
            ->where('objectiveid',$next["id"])
            ->update(['midyear'=>$next["rmidyear"]
        ]);
        }
         return "success";
    }

    public function insertcoaching(Request $request, $id){

            Coaching::create([ 
           'taskid'=>$id,
           'critdescription'=>$request->critical,
           'output'=>$request->output,
           'impact'=>$request->impact,
           
        ]);

            return "success";
    }
    public function finalshow(Request $request){
     $esat = DB::table('esat')
                    ->where('esat.employeeid',$request->employeeid)
                    ->join('objectives', 'esat.objectiveid','=', 'objectives.id')
                    ->where('objectives.rank','=',$request->rank)
                    ->select('objectives.id','objectives.name',
                       'esat.level','esat.priotrity','esat.taskid','esat.learnings','esat.intevention','esat.timeline','esat.resources')
                    ->get();
                    

      $behavior = DB::table('behavioresat')
                    ->where('behavioresat.employeeid',$request->employeeid)
                    ->where('behavioresat.phaseid','=',1)
                    ->join('developement', 'behavioresat.behaiorid','=', 'developement.id')
                   ->select('behavioresat.behaiorid as id','behavioresat.total',
                        'behavioresat.taskid','developement.corename','developement.description','behavioresat.learnings','behavioresat.intervention','behavioresat.timeline','behavioresat.resources')
                    ->get();
       $final = DB::table('behavioresat')
                    ->where('behavioresat.employeeid',$request->employeeid)
                    ->where('behavioresat.phaseid','=',3)
                    ->join('developement', 'behavioresat.behaiorid','=', 'developement.id')
                   ->select('behavioresat.behaiorid as id','behavioresat.total',
                        'behavioresat.taskid','developement.corename','developement.description','developement.learn','developement.interven','developement.timeli','developement.resour as resources')
                    ->get();
     return response()->json([
         'esat' => $esat,
         'behavior' => $behavior,
          'final' => $final,
       
        
                       ]);
    }
}
