<?php

namespace App\Http\Controllers;
use App\Models\Esat;
use App\Models\Behavioresat;
use App\Models\Evaluator;
use App\Models\Evalfeedback;
use App\Models\User;
use App\Models\Task;
use App\Models\TaskProgress;
use App\Models\Objectives;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class EvaluatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listtask(Request $request)
    {
       $evaltask = DB::table('tasks')
                    ->join('users', 'users.id', '=', 'tasks.employeid')
                   ->join('evaluators', 'users.evaluator', '=', 'evaluators.id')
                   ->where('evaluators.id',$request->id)
                    ->select('tasks.id','users.id as usersid','users.name','users.positionid', 'tasks.task','tasks.duedate','tasks.status','tasks.phaseid','tasks.completed_date','evaluators.name as eval','tasks.evalstatus')
                    ->get();

  
  return response()->json([
         'status' => 200,
         'evaltask' => $evaltask,
    

                       ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Evaluator  $evaluator
     * @return \Illuminate\Http\Response
     */
    public function show(Evaluator $evaluator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Evaluator  $evaluator
     * @return \Illuminate\Http\Response
     */
    public function edit(Evaluator $evaluator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Evaluator  $evaluator
     * @return \Illuminate\Http\Response
     */
    public function updateEsat(Request $request,$id)
    {

      $esat= $request->all();
        foreach($esat as $next){

        Esat::where('taskid',$id)
            ->where('objectiveid',$next["id"])
            ->update(['learnings'=>$next["learnings"],
                        'intevention'=>$next["intevention"],
                        'timeline'=> $next["timeline"],
                        'resources'=> $next["resources"]

        ]);
        }
 Task::where('id',$id)
            ->update(['evalstatus'=>3,
                        
        ]);

   return $esat;
  
    }
     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Evaluator  $evaluator
     * @return \Illuminate\Http\Response
    */
    public function updateBehavior(Request $request,$id)
    {
        $behaviors=$request->all();
         foreach($behaviors as $nex){

        Behavioresat::where('taskid',$id)
            ->where('behaiorid',$nex["id"])
            ->update(['learnings'=>$nex["learn"],
                        'intervention'=>$nex["interven"],
                        'timeline'=> $nex["timeli"],
                        'resources'=> $nex["resources"],

        ]);
        }
    
       
        
    }
    public function updateBehaviorthree(Request $request,$id)
    {
        $behaviors=$request->all();
         foreach($behaviors as $nex){

        Behavioresat::where('employeeid',$id)
            ->where('behaiorid',$nex["id"])
            ->where('phaseid',3)
            ->update(['learnings'=>$nex["learn"],
                        'intervention'=>$nex["interven"],
                        'timeline'=> $nex["timeli"],
                        'resources'=> $nex["resources"],

        ]);
        }
    
       
        
    }
     public function feedback(Request $request)
     {
 
        Evalfeedback::create([ 
           'evaluatorid'=>$request->input('id'),
           'employeeid'=>$request->input('employeeid'),
           'phaseid'=>$request->input('phaseid'),
           'taskid'=>$request->input('taskid'),
           'feedback'=>$request->input('feedback')
           
        ]);
         Task::where('id',$request->input('taskid'))
            ->update(['evalstatus'=>3,
                        'status'=>3,
                        
        ]);
       return "success";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Evaluator  $evaluator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evaluator $evaluator)
    {
        //
    }

}
