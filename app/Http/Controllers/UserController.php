<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Evaluator;
use Illuminate\Support\Facades\DB;
use Validator, Input, Redirect; 
class UserController extends Controller
{
    function login(Request $request){

    $user=Evaluator::where('email',$request->email)->first();
        if(!$user || !Hash::check($request->password,$user->password)){
    return ["error"=>"Email or Password is not  match"];
                }

return $user;

    }
    function employeelogin(Request $request){

    $user=User::where('email',$request->email)->first();
        if(!$user || !Hash::check($request->password,$user->password)){
    return ["error"=>"Email or Password is not  match"];
                }

return $user;

    }
    //
    function register(Request $request){

           $role =Role::where('name','employee')->first();
      $validator = Validator::make($request->all(),[
            'name'=> 'required|max:191',
            'password'=> 'required|max:191|min:6',
            'email'=> 'required|email|string|max:191',
            'image'=>'required|file|mimes:jpeg,jpg,png,bmp,gif,svg',
            'position'=>'required',
            'evaluator'=>'required'

        ]);
 if($validator->fails()){
        return response()->json([
         'validator' => $validator->messages(),
     
        

        ]);


        }else{
    
        $user = new User;

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user['role_id']=$role->id;
        $user->image=$request->file('image')->store('users');
        $user->departmentid = $request->input('department');
        $user->positionid = $request->input('position');
        $user->evaluator = $request->input('evaluator');
        $user->save();
        return response()->json([
         'status' => 200,
         'message' => 'Account successfully stored',
         'user'=>$user,

        ]);
             
    }
}
    function userlists(Request $request){

        $users=DB::table('users')
                    ->where('users.role_id',3)
                    ->join('evaluators','users.evaluator','=','evaluators.id')
                    ->join('position', 'users.positionid', '=', 'position.id')
                    ->select('users.id','users.name','users.email','evaluators.name as ename','position.name as pname')
                    ->get();

      return $users;

    }

    function userdelete($id){

     $result = User::where('id',$id)->delete();
     Storage::delete($user->image);
     if($result){
       response()->json([
         'status' => 200,
         'message' => 'Account successfully deleted'
     ]);
     
    
        }}
        function getusers($id){

 return User::find($id);

             

    }
    function update(Request $request, $id){
     
        $user = User::find($id);
       
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
        }if($request->input('evaluator')){
  $user->evaluator = $request->input('evaluator');
        }
        $user->update();
        return response()->json([
         'status' => 200,
         'message' => 'Account updated successfully '
        ]);

             

    }
    function validateEmployee($request){
       return $this->validate($request,[
            'name'=>'required',
            'email'=>'required,unique:users',
            'password'=>'required|min:6|max:25',
            'position'=>'required',
            'evaluator'=>'required',
        ]);
    }

}
