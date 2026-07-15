<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class AuthContoller extends Controller
{
    public function index (Request $request){
        if($request->get('search')!=''){
             $user_key = User::with('role')->orderBy('user_id', 'desc')->where('name','like','%'.$request->get('search').'%')->paginate(10);
        }else{
             $user_key = User::with('role')->orderBy('user_id', 'desc')->paginate(10);
        }
        return view("admin.user",compact('user_key'));
    }

    public function create(){
        $role = Role::select('role_id', 'role_name')->get(); 
        
        return view('admin.crud_users.create', compact('role'));
    }
   public function store(Request $request){

    $validator = Validator::make($request->all(), [
        'name'     => 'required|string|min:4',
        'role_id' => 'required|exists:role,role_id',
        'email'    => 'required|email|unique:users,email', 
        'phone'    => 'nullable|string',
        'username' => 'required|string|unique:users,username', 
        'password' => 'required|string|min:6',
        'status' => 'nullable|string'
    ]);


    if ($validator->fails()) {
        return response()->json([
            'status'  => 422,
            'message' => "Validation failed",
            'errors'  => $validator->errors(),
        ], 422); 
    }

    try {
        $user = new User();
        $user->name     = $request->name;
        $user->role_id = $request->role_id;
        $user->email    = $request->email;
        $user->phone    = $request->phone;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->status = $request->has('status') ? 'active' : 'inactive'; 
        $user->save(); 
        session()->flash('user_status', 'User Created Successfully');

        return response()->json([
            'status'  => 201, 
            'message' => "User Created Successfully"
        ], 201);

    } catch (Exception $e) {
        return response()->json([
            'status'  => 500,
            'message' => "Database error occurred",
            'error'   => $e->getMessage() 
        ], 500);
    }
}
    public function edit(string $user_id){
        $user = User::findOrFail($user_id);
        $role = Role::all();
        return view('admin.crud_users.edit',compact('user','role'));
    }
    public function update(Request $request, string $user_id)
    {
        $user = User::find($user_id);

        if ($user == null) {
            return redirect()->back()->with('error', 'User not found');
        }

        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|min:4',
            'role_id'  => 'required|exists:role,role_id',
            'email'    => 'required|email|unique:users,email,' .  $user_id . ',user_id',
            'phone'    => 'nullable|string',
            'username' => 'required|string|unique:users,username,' .  $user_id . ',user_id',
            'password' => 'nullable|string|min:6', 
            'status'   => 'nullable|string'
        ]);

        if ($validator->passes()) {
            $user->name     = $request->name;
            $user->role_id  = $user->role_id;
            $user->email    = $request->email;
            $user->phone    = $request->phone;
            $user->username = $request->username;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->status = $request->input('status', 'inactive');
            $user->save(); 
            return redirect()->route('auth.list')->with('update_success', 'User updated successfully');
        } else {
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }


    public function delete(string $user_id){
        $user = User::find($user_id);
        if($user == null){
            return redirect()->back();
        }
        $user->delete();
        
        return redirect()->back()->with('delete_success' ,'User Dedete Successfully');
    }
}
