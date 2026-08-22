<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Costumer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
class CostumerController extends Controller
{
    public function index()
    {
        $customers = Costumer::with('user')->orderBy('customer_id', 'desc')->paginate(10);
        $totalCustomers = Costumer::count();

        return view('admin.costumer', compact('customers', 'totalCustomers'));
    }
    public function webLogin (){
        // if(Auth::check){
        //     return redirect()->route('auth.list');
        // }
        return view('website.login.login');
    }
    public function webRegister (){
        // if(Auth::check){
        //     return redirect()->route('auth.list');
        // }
        return view('website.register.register');
    }
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'phone'    => 'required|string|unique:users,phone',
            'email'    => 'nullable|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $user = DB::transaction(function () use ($request) {
            $newUser = User::create([
                'name'     => $request->name,
                'phone'    => $request->phone,
                'email'    => $request->email,
                'username' => $request->phone, 
                'password' => Hash::make($request->password),
                'role_id'  => 6, 
                'status'   => 'active',
            ]);
            Costumer::create([
                'user_id' => $newUser->user_id,
                'name'    => $request->name,
                'phone'   => $request->phone,
            ]);

            return $newUser;
        });
        Auth::login($user);
        return redirect()->to('/web/shop')->with('success', 'Account created successfully!');
    }
    

    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
        ]);
        $user = User::where('phone', $request->phone)->first();
        if (!$user) {
            return back()->withErrors([
                'phone' => 'លេខទូរស័ព្ទនេះមិនទាន់បានចុះឈ្មោះនៅក្នុងប្រព័ន្ធឡើយ។',
            ])->onlyInput('phone');
        }
        if ($user->status !== 'active') {
            return back()->withErrors([
                'phone' => 'គណនីរបស់អ្នកត្រូវបានផ្អាក។',
            ])->onlyInput('phone');
        }
        Auth::login($user, $request->has('remember'));
        $request->session()->regenerate();
        return redirect()->to('/web/shop')->with('success', 'ចូលប្រើប្រាស់ជោគជ័យ!');
    }

    public function logout(Request $request)
        {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/web/login');
        }
}
