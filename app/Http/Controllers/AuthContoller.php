<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Costumer;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class AuthContoller extends Controller
{
    public function dash() {
    $t_User = User::count();
     $t_cusomter = User::where('role_id', 6)->count();
    return view('admin.Admin_dashboard', compact('t_User','t_cusomter'));
}
    public function index (Request $request){
        if($request->get('search')!=''){
             $user_key = User::with('role')->orderBy('user_id', 'desc')->where('name','like','%'.$request->get('search').'%')->paginate(10);
        }else{
             $user_key = User::with('role')->orderBy('user_id', 'desc')->paginate(10);
        }
        $totalCustomers = Costumer::count();
        $totalUser = User::count();
        return view("admin.user",compact('user_key','totalCustomers','totalUser'));
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
            return redirect()->route('auth.list')->with('update_success', 'User Updated successfully');
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

    // authentication

    public function showLogin (){
        // if(Auth::check){
        //     return redirect()->route('auth.list');
        // }
        return view('admin.login');
    }
    public function showRegister (){
        // if(Auth::check){
        //     return redirect()->route('auth.list');
        // }
        return view('admin.register');
    }
    public function processRegister(Request $request){
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|min:4|unique:users,name', 
            'password' => 'required|string|min:4',
            'con_pass' => 'required|same:password',
        ]);

        if ($validator->passes()) {
            $adminRole = DB::table('role')->where('role_name', 'admin')->first();
            if (!$adminRole) {
                return redirect()->back()->withInput()->withErrors([
                    'register_error' => 'Not!'
                ]);
            }
            $user = new User();
            $user->name     = $request->name;
            $user->password = Hash::make($request->password);
            $user->status   = 'active';            
            $user->role_id  = $adminRole->role_id;  
            $user->save(); 
            return redirect()->route('showlogin')->with('success', 'Admin account registration successful.!');
        } else {
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }
   
    public function processlogin(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|min:4',
            'password' => 'required|string|min:4',
        ]);

        if ($validator->passes()) {
            $adminRole = DB::table('role')->where('role_name', 'admin')->first();
            if (!$adminRole) {
                return redirect()->back()->withInput()->with('error', 'Invalite Admin!');
            }
            $credentials = [
                'name'     => $request->name,
                'password' => $request->password,
                'status'   => 'active',
                'role_id'  => $adminRole->role_id,
            ];

            if (Auth::attempt($credentials)) {
                return redirect()->route('admin.dashboard')->with('success_login', 'Login Successfully!');
            } else {
                return redirect()->back()->withInput()->with('error', 'Incorrect username or password.');
            }
        } else {
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('showlogin'); 
    }
}
