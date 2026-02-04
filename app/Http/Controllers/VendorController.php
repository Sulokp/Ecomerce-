<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class VendorController extends Controller
{
    public function index()
    {
        $vendors = User::where('role', 'vendor')->get();
        return view('admin.vendors.index', compact('vendors'));
    }

    public function create()
    {
        return view('admin.vendors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'vendor',
        'is_active' => false,
        ]);


        return redirect()
            ->route('admin.vendors.index')
            ->with('success', 'Vendor created successfully');
    }
        
        public function approve(User $vendor)
    {
        if (!$vendor->isVendor()) {
            abort(404);
        }

        $vendor->update([
            'is_active' => true,
        ]);

        return back()->with('success', 'Vendor approved successfully.');
    }

    public function disable(User $vendor)
    {
        if (!$vendor->isVendor()) {
            abort(404);
        }

        $vendor->update([
            'is_active' => false,
        ]);

        return back()->with('success', 'Vendor disabled successfully.');
    }

}
