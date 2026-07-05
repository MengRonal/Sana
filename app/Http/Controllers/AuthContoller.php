<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class AuthContoller extends Controller
{
    public function index (){
        return view("admin.user");
    }

    public function create(){
        $role = Role::select('role_id', 'role_name')->get(); 
        
        return view('admin.crud_users.create', compact('role'));
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=> 'required|string|min:4',
            'role_id'=>'required|exists:role,role_id',
            'email'=> 'required|email',
            'phone'=>'nullable|string',
            'username'=>'required|string',
            'password'=>'required|string|min:6',
            'status'=>'required|string'
        ]);
        if($validator->passes()){
            $user = new User();
            $user->name = $request->name;
            $user->role_id = $request->role_id;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->username = $request->username;
            $user->password = $request->password;
            $user->status = $request->status;
            session()->flash('user_status','User Create Successfully');
            $user->save();
                return response()->json(
                    [
                        'status' =>200,
                        'message' =>"User Create Successfully"
                    ]
                );
            
        }else{
            return response()->json(
                    [
                        'status' =>500,
                        'message' =>"Please config Error",
                        'errors'=>$validator->errors(),
                    ]
                );
        }
    }
}
