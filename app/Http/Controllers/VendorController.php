<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\VendorProfile;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    // List all vendors (Admin)
    public function index()
    {
        $vendors = User::where('role', 'vendor')->get();
        return view('admin.vendors.index', compact('vendors'));
    }

    // Show form to create new vendor (Admin)
    public function create()
    {
        return view('admin.vendors.create');
    }

    // Store new vendor (Admin)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $vendor = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'vendor',
            'is_active' => false, // new vendors inactive by default
        ]);

        return redirect()
            ->route('admin.vendors.index')
            ->with('success', 'Vendor created successfully. Pending approval.');
    }

    // Approve vendor (Admin)
    public function approve(User $vendor)
    {
        if (!$vendor->isVendor()) {
            abort(404);
        }

        // Activate vendor
        $vendor->update([
            'is_active' => true,
        ]);

        // Auto-create VendorProfile if missing
        if (!$vendor->vendorProfile) {
            VendorProfile::create([
                'user_id' => $vendor->id,
                'business_name' => $vendor->name, // default business name
                'phone' => '',
                'address' => '',
                'description' => '',
            ]);
        }

        return back()->with('success', 'Vendor approved successfully.');
    }

    // Disable vendor (Admin)
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
