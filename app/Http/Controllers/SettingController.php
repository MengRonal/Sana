<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $shop = Settings::orderBy('id', 'desc')->paginate(10);

        return view('admin.meanleap.setting', compact('shop'));
    }

    public function create()
    {
        return view('admin.meanleap.Add');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'shop_name'     => 'required|string|max:255',
            'address'       => 'nullable|string|max:255',
            'tel'           => 'nullable|string|max:50',
            'exchange_rate' => 'required|numeric',
            'logo'          => 'nullable|image|max:5120',
        ]);

        $shop = new Settings();
        $shop->shop_name     = $data['shop_name'];
        $shop->address       = $data['address'] ?? null;
        $shop->tel           = $data['tel'] ?? null;
        $shop->exchange_rate = $data['exchange_rate'];

        if ($request->hasFile('logo')) {
            $filename = time() . '.' . $request->logo->extension();
            $request->logo->move(public_path('uploads'), $filename);

            $shop->logo = $filename;
        }

        $shop->save();

        return redirect()->route('setting.list')
                ->with('success', 'Setting Added Successfully');
    }

    public function edit($id)
    {
        $shop = Settings::findOrFail($id);

        return view('admin.meanleap.Edit', compact('shop'));
    }

    public function update(Request $request, $id)
    {
        $shop = Settings::findOrFail($id);

        $data = $request->validate([
            'shop_name'     => 'required|string|max:255',
            'address'       => 'nullable|string|max:255',
            'tel'           => 'nullable|string|max:50',
            'exchange_rate' => 'required|numeric',
            'logo'          => 'nullable|image|max:5120',
        ]);

        $shop->shop_name     = $data['shop_name'];
        $shop->address       = $data['address'] ?? null;
        $shop->tel           = $data['tel'] ?? null;
        $shop->exchange_rate = $data['exchange_rate'];

        if ($request->hasFile('logo')) {
            // លុប logo ចាស់ចោល
            if ($shop->logo && file_exists(public_path('uploads/' . $shop->logo))) {
                unlink(public_path('uploads/' . $shop->logo));
            }

            $filename = time() . '.' . $request->logo->extension();
            $request->logo->move(public_path('uploads'), $filename);

            $shop->logo = $filename;
        }

        $shop->save();

        return redirect()->route('setting.list')
                ->with('success', 'Setting Updated Successfully');
    }

    public function delete($id)
    {
        $shop = Settings::findOrFail($id);

        if ($shop->logo && file_exists(public_path('uploads/' . $shop->logo))) {
            unlink(public_path('uploads/' . $shop->logo));
        }

        $shop->delete();

        return redirect()->back()
                ->with('success', 'Deleted Successfully');
    }
}