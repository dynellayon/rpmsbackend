<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskProgress;
use App\Models\Task;
use App\Models\Esat;
use App\Models\Behavioresat;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        
 $curdate = date('Y-m-d');
       
       $file = new TaskProgress;

        $file->taskid=$request->input('taskid');
         $file->progress=$request->input('filename');
        $file->file=$request->file('file')->store('users');
       

        $file->save();

             Task::where('id',$request->input('taskid'))
            ->update(['status'=>$request->input('check'),
                        'completed_date'=> $curdate,
        ]);
       
        return response()->json([
         'status' => 200,
         'message' => 'file successfully stored',
         

        ]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
         $tasks = DB::table('tasks')
                    ->join('users', 'users.id', '=', 'tasks.employeid')
                    ->where("users.id","=",$id)
                      ->select('tasks.*','users.positionid')
                    ->get();         
return response()->json([
         'status' => 200,
         'emptask' => $tasks,
         

        ]);    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showobjective(Request $request,$id)
    {
          $esat = DB::table('kras')
                    ->join('objectives', 'kras.id','=', 'objectives.kraid')
                    ->where('objectives.rank',$id)
                    ->select('objectives.*','kras.name as kraname')
                    ->get();

  
  return response()->json([
         'esat' => $esat
    

                       ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function teacheresat(Request $request, $id){

$Objectids=$request->all();

        foreach($Objectids as $next){
          Esat::create([ 
           'employeeid'=>$id,
            'objectiveid'=>$next["id"],
            'taskid'=>$next["average"],
            'level'=>$next["quality"],
            'priotrity'=>$next["efficiency"],
        ]);
        }

return  $Objectids;

    }
      public function coreesat(Request $request){

 $esat = DB::table('developement')
                    ->select('developement.*')
                    ->get();
return $esat;
      }

      public function savecore(Request $request, $id){
        $curdate = date('Y-m-d');
$behaviors=$request->all();

        foreach($behaviors as $next){
          Behavioresat::create([ 
            'taskid'=>$next["taskid"],
           'employeeid'=>$id,
            'behaiorid'=>$next["id"],
            'total'=>$next["rating"],
            'phaseid'=>$next["phaseid"],
        ]);

           Task::where('id',$next["taskid"])
            ->update(['status'=>3,
                        'completed_date'=> $curdate,
        ]);
        }

        

return  $behaviors;

      }


      public function Functionbehavior(Request $request)
      {


           $esat = DB::table('esat')
                    ->where('esat.taskid',$request->taskid)
                    ->join('objectives', 'esat.objectiveid','=', 'objectives.id')
                    ->join('kras', 'kras.id','=', 'objectives.kraid')
                    ->select('objectives.id',
                        'objectives.mov','objectives.name','objectives.learnings','objectives.intevention','objectives.timeline','objectives.resources','objectives.feedbacks','kras.name as kraname','esat.level','esat.priotrity','esat.taskid')
                    ->get();

             $behavior = DB::table('behavioresat')
                    ->where('behavioresat.taskid',$request->taskid)
                    ->join('developement', 'behavioresat.behaiorid','=', 'developement.id')
                   ->select('behavioresat.behaiorid as id','behavioresat.total',
                        'behavioresat.taskid','developement.corename','developement.description','developement.learn','developement.interven','developement.timeli','developement.resour as resources')
                    ->get();

     return response()->json([
         'esat' => $esat,
         'behavior' => $behavior,
       
        
                       ]);
      }
}
