<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\Validator;
class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $query = Supplier::orderBy('supplier_id', 'desc');
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->get('search') . '%');
        }
        $supp_key = $query->paginate(10);
        $totalSupplier = Supplier::count();
        return view('admin.supplier', compact('supp_key','totalSupplier'));
    }

    public function create(){
        return view('admin.crud_supp.create');
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' =>'required|min:4',
            'email' => 'required|email|unique:users,email', 
            'phone'  => 'nullable|string',
            'address'=>'required',
        ]);
        
    if ($validator->fails()) {
        return response()->json([
            'status'  => 422,
            'message' => "Validation failed",
            'errors'  => $validator->errors(),
        ], 422); 
    }

    try {
        $supplier = new Supplier();
        $supplier->name     = $request->name;
        $supplier->email    = $request->email;
        $supplier->phone    = $request->phone;
        $supplier->address  = $request->address;
        $supplier->save(); 
        session()->flash('supplier_status', 'Supplier Created Successfully');

        return response()->json([
            'status'  => 201, 
            'message' => "Supplier Created Successfully"
        ], 201);

    } catch (Exception $e) {
        return response()->json([
            'status'  => 500,
            'message' => "Database error occurred",
            'error'   => $e->getMessage() 
        ], 500);
    }
    }
    public function delete(string $supplier_id){
        $supplier = Supplier::find($supplier_id);
        if($supplier == null){
            return redirect()->back();
        }
        $supplier->delete();
        return redirect()->back()->with('delete_supplier','Supplier Delete Successfully');
    }
    public function edit(string $supplier_id){
        $supplier = Supplier::findOrFail($supplier_id);
        return view('admin.crud_supp.edit',compact('supplier'));
    }
    
    public function update(Request $request, string $supplier_id)
    {
        $supplier = Supplier::find($supplier_id);

        if ($supplier == null) {
            return redirect()->back()->with('error', 'Supplier not found');
        }

        $validator = Validator::make($request->all(), [
            'name' =>'required|min:4',
            'email' => 'required|email|unique:users,email', 
            'phone'  => 'nullable|string',
            'address'=>'required',
        ]);

        if ($validator->passes()) {
            $supplier->name     = $request->name;
            $supplier->email    = $request->email;
            $supplier->phone    = $request->phone;
            $supplier->address  = $request->address;
            $supplier->save(); 
            return redirect()->route('supplier.list')->with('supplier_update', 'Supplier updated successfully');
        } else {
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

}
