<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;


class AdminUserController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = User::role('admin')->get();
        return view('superadmin.admin.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('superadmin.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        ]);

        // Hash the password before saving
        $data['password'] = bcrypt($data['password']);

        // Create the new admin
        $admin = User::create($data);

        $admin->assignRole('admin');

        return redirect()->route('superadmin.admin.index')
                        ->with('success', 'New admin created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $admin)
    {
        return view('superadmin.admin.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $admin)
    {
        $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $admin->id,
        'password' => 'nullable|string|min:8|confirmed',
         ]);

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']); // hash new password
        } else {
            unset($data['password']); // keep current password
        }

        $admin->update($data);

        return redirect()->route('superadmin.admin.edit', $admin)
            ->with('success', 'Admin updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $admin)
    {
        $admin->delete();

        return redirect()->route('superadmin.admin.index')
                     ->with('success', 'Admin deleted successfully.');
    }
}
