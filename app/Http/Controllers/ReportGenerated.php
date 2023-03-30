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


class ReportGenerated extends Controller
{
   public function showphaseones(Request $request){

      $esat = DB::table('esat')
                    ->where('esat.employeeid',$request->usersid)
                    ->where('esat.taskid',$request->taskid)
                    ->join('objectives', 'esat.objectiveid','=', 'objectives.id')
                    ->select('objectives.id','objectives.name',
                       'esat.level','esat.priotrity','esat.learnings','esat.intevention','esat.timeline','esat.resources')
                    ->get();
    $behavior = DB::table('behavioresat')
                    ->where('behavioresat.employeeid',$request->usersid)
                    ->where('behavioresat.phaseid','=',$request->phaseid)
                    ->where('behavioresat.taskid','=',$request->taskid)
                    ->join('developement', 'behavioresat.behaiorid','=', 'developement.id')
                   ->select('behavioresat.behaiorid as id','behavioresat.total',
                            'developement.corename','developement.description','behavioresat.learnings','behavioresat.intervention','behavioresat.timeline','behavioresat.resources')
                    ->get();
 $feedback= DB::table('evalfeedback')
              ->where('evalfeedback.phaseid',$request->phaseid)
              ->where('evalfeedback.taskid',$request->taskid)
               ->select('evalfeedback.feedback')
               ->get();

$people = DB::table('users')
              ->where('users.id',$request->usersid)
              ->join('evaluators','evaluators.id','=','users.evaluator')
               ->select('users.name','evaluators.name as evalname')
               ->get();

                    return response()->json([
         'esat' => $esat,
         'behavior' => $behavior,
         'feedback'=> $feedback,
          'people'=> $people,
                       ]);
   }



 public function showphasetwo(Request $request){


    $showrate = DB::table('ratings')
             ->where("ratings.taskid","=",$request->taskid)
             ->where("ratings.phaseid","=",$request->phaseid) 
            ->join('selfratings', 'ratings.objectiveid', '=', 'selfratings.objectiveid')
             ->where("selfratings.phaseid","=",$request->phaseid) 
             ->where("selfratings.taskid","=",$request->taskid) 
            ->join('objectives', 'selfratings.objectiveid', '=', 'objectives.id')
            ->join('kras','kras.id','=','objectives.kraid')
            ->select('ratings.objectiveid as id','ratings.quality as rquality','ratings.efficiency as refficiency','ratings.timeliness as rtimeliness','ratings.remarks as rremarks','ratings.average as raverage','ratings.score as rscore'
                ,'ratings.midyear as rmidyear',"selfratings.quality as squality","selfratings.efficiency as sefficiency","selfratings.timeliness as stimeliness","selfratings.average as saverage","selfratings.score as sscore","selfratings.remarks as sremarks","selfratings.remarks as sremarks","objectives.name as objname","objectives.mov","objectives.weight",'kras.name as kraname')
                        
                    ->get();

    $people = DB::table('users')
              ->where('users.id',$request->usersid)
              ->join('tasks','tasks.employeid','=','users.id')
              ->where('tasks.id',$request->taskid)
              ->join('position','position.id','=','users.positionid')

               ->select('users.name as username','tasks.duedate','tasks.completed_date as complete','position.name as teacherpos')
               ->get();

    $coaching= DB::table('coaching')
               ->where('taskid',$request->taskid)    
                ->select('coaching.critdescription','coaching.output','coaching.impact')
                 ->get();
$rater = DB::table('users')
              ->where('users.id',$request->usersid)
              ->join("evaluators",'users.evaluator','=','evaluators.id')
              ->join('position','position.id','=','evaluators.positionid')

               ->select('evaluators.name as evalname','position.name')
               ->get();


$totalscore = Ratings::where("taskid",$request->taskid)
             ->where("phaseid",$request->phaseid) 
             ->sum('score');
$midyear = Ratings::where("taskid",$request->taskid)
             ->where("phaseid",$request->phaseid) 
             ->sum('midyear');

          return response()->json([
         'showrate' => $showrate,
         'people' => $people,
        'coaching' => $coaching,
        'rater' => $rater,
         'score' => $totalscore,
         'midyear' => $midyear

                       ]);
 }


 public function showphasethree(Request $request){

         $showfinal = DB::table('ratings')
             ->where("ratings.taskid","=",$request->taskid)
             ->where("ratings.phaseid","=",$request->phaseid) 
            ->join('objectives', 'ratings.objectiveid', '=', 'objectives.id')
            ->join('kras', 'kras.id', '=', 'objectives.kraid')
            ->select('ratings.objectiveid as id','kras.name as kraname','objectives.name as objectname','objectives.mov','objectives.weight','ratings.quality','ratings.efficiency','ratings.timeliness','ratings.remarks','ratings.average','ratings.score')
            ->get();
 $people = DB::table('users')
              ->where('users.id',$request->usersid)
              ->join('tasks','tasks.employeid','=','users.id')
              ->where('tasks.id',$request->taskid)
              ->join('position','position.id','=','users.positionid')

               ->select('users.name as username','tasks.duedate','tasks.completed_date as complete','position.name as teacherpos')
               ->get();

$rater = DB::table('users')
              ->where('users.id',$request->usersid)
              ->join("evaluators",'users.evaluator','=','evaluators.id')
              ->join('position','position.id','=','evaluators.positionid')

               ->select('evaluators.name as evalname','position.name as evalpos')
               ->get();
$total = Ratings::where("taskid",$request->taskid)
             ->where("phaseid",$request->phaseid) 
             ->sum('score');
            
return response()->json([
         'finals' => $showfinal,
         'rater' => $rater,
         'people'=>$people,
         'total'=>$total,
       
        
                       ]);

 }

 public function showphasefour(Request $request){
   $esat = DB::table('esat')
                    ->where('esat.employeeid',$request->usersid)
                    ->join('objectives', 'esat.objectiveid','=', 'objectives.id')
                    ->select('objectives.id','objectives.name',
                       'esat.level','esat.priotrity','esat.learnings','esat.intevention','esat.timeline','esat.resources')
                    ->get();
    $behavior = DB::table('behavioresat')
                    ->where('behavioresat.employeeid',$request->usersid)
                    ->where('behavioresat.phaseid','=',1)
                    ->join('developement', 'behavioresat.behaiorid','=', 'developement.id')
                   ->select('behavioresat.behaiorid as id','behavioresat.total',
                            'developement.corename','developement.description','behavioresat.learnings','behavioresat.intervention','behavioresat.timeline','behavioresat.resources')
                    ->get();
 $feedback= DB::table('evalfeedback')
              ->where('evalfeedback.employeeid',$request->usersid)
               ->select('evalfeedback.feedback')
               ->get();

$people = DB::table('users')
              ->where('users.id',$request->usersid)
              ->join('evaluators','evaluators.id','=','users.evaluator')
               ->select('users.name','evaluators.name as evalname')
               ->get();
    $finale = DB::table('behavioresat')
                    ->where('behavioresat.employeeid',$request->usersid)
                    ->where('behavioresat.phaseid','=',3)
                    ->join('developement', 'behavioresat.behaiorid','=', 'developement.id')
                   ->select('behavioresat.behaiorid as id','behavioresat.total',
                            'developement.corename','developement.description','behavioresat.learnings','behavioresat.intervention','behavioresat.timeline','behavioresat.resources')
                    ->get();

                    return response()->json([
         'esat' => $esat,
         'behavior' => $behavior,
         'feedback'=> $feedback,
          'people'=> $people,
          'finale'=> $finale
                       ]);


 }
 
}
