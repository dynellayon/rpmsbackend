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
use Validator, Input, Redirect; 
class AdminController extends Controller
{
    function reg(Request $request){
 
        $validator = Validator::make($request->all(),[
            'name'=> 'required|max:191',
            'password'=> 'required|max:191|min:6',
            'email'=> 'required|email|string|max:191',
            'image'=>'required|file|mimes:jpeg,jpg,png,bmp,gif,svg',
            'position'=>'required'

        ]);

        if($validator->fails()){
        return response()->json([
         'validator' => $validator->messages(),
     
        

        ]);


        }else{
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
    }
     function userlists(){

        $eval =DB::table('evaluators')
                    ->where('evaluators.role_id',2)
                    ->join('position', 'evaluators.positionid', '=', 'position.id')
                    ->select('evaluators.id','evaluators.name','position.name as pname','evaluators.email')
                    ->get();

 return  $eval;

    }
    function addtask(Request $request){


          $validator = Validator::make($request->all(),[
            'name'=> 'required|max:191',
            'employee'=> 'required',
            'duedate'=> 'required',
            'phase'=>'numeric|required'
           

        ]);

    if($validator->fails()){
        return response()->json([
         'validator' => $validator->messages(),
     
        

        ]);


        }else{       
      $employee = $request->employee;
      $evaluatorid =User::where('id',$employee)->first();
      $task =new Task;
      $task->task = $request->input('name');
      $task->employeid = $request->input('employee');
      $task->duedate = $request->input('duedate');
      $task->phaseid = $request->input('phase');
      $task->description = $request->input('description');
      $task->status = 0;
       $task->evalstatus = 0;
      $task->save();
    
        return response()->json([
         'status' => 200,
         'message' => 'Account successfully stored',
         

        ]);

    }
}
    function alltask(){
            $users = DB::table('tasks')
                    ->join('users', 'users.id', '=', 'tasks.employeid')
                    ->join('evaluators', 'evaluators.id', '=', 'users.evaluator')
                    ->select( 'tasks.id','users.name','users.id as usersid', 'tasks.task','tasks.status','tasks.duedate','evaluators.name as eval','tasks.phaseid','users.positionid','tasks.evalstatus')
                    ->get();

  
  return response()->json([
         'status' => 200,
         'users' => $users,
    

                       ]);

    }
     function position(){

    return Position::all();

    }

     function geteval($id){

  return Evaluator::find($id);

    } 

    function updateeval(Request $request, $id){

        $user = Evaluator::find($id);
       
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->departmentid = $request->input('department');
        if($request->hasFile('image')){
             $user->image=$request->file('image')->store('users');

        }
        if($request->input('password')){
            $user->password =Hash::make($request->input('password'));
        }
        if($request->input('position')){
  $user->positionid = $request->input('position');
        }
        $user->update();
        return response()->json([
         'status' => 200,
         'message' => 'Account updated successfully '
        ]);

    }

        function findtask($id){
  return Task::find($id);

        }
    function updatetask(Request $request, $id){
         $user = Task::find($id);
       
        $user->task = $request->input('name');
        $user->employeid = $request->input('employee');
        $user->duedate = $request->input('duedate');
        $user->phaseid = $request->input('phase');
        $user->description = $request->input('description');
           $user->update();
        return response()->json([
         'status' => 200,
         'message' => 'Task updated successfully '
        ]);

    }
}
