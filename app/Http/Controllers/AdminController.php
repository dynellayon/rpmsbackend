<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Evaluator;
use App\Models\Role;
use App\Models\Task;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    function reg(Request $request){
       $role =Role::where('name','evaluator')->first();
       $user = new Evaluator;

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user['role_id']=$role->id;
        $user->image=$request->file('image')->store('users');
        $user->positionid = $request->input('position');
        $user->departmentid = $request->input('department');

        $user->save();
        return response()->json([
         'status' => 200,
         'message' => 'Account successfully stored',
         'user'=>$user,

        ]);
             
    }
     function userlists(){

    return Evaluator::where('role_id','=',2)->get();

    }
    function addtask(Request $request){
      $employee = $request->employee;
      $evaluatorid =User::where('id',$employee)->first();
      $task =new Task;
      $task->task = $request->input('name');
      $task->employeid = $request->input('employee');
      $task->duedate = $request->input('duedate');
      $task->phaseid = $request->input('phase');
      $task->description = $request->input('description');
      $task->status = 0;
      $task->save();
    
        return response()->json([
         'status' => 200,
         'message' => 'Account successfully stored',
         

        ]);

    }
    function alltask(){
            $users = DB::table('tasks')
                    ->join('users', 'users.id', '=', 'tasks.employeid')
                    ->join('evaluators', 'evaluators.id', '=', 'users.evaluator')
                    ->select('users.name','users.role_id', 'tasks.task','tasks.status','tasks.duedate','evaluators.name as eval')
                    ->get();

  
  return response()->json([
         'status' => 200,
         'users' => $users,
    

                       ]);

    }
     function position(){

    return Position::all();

    }

}
