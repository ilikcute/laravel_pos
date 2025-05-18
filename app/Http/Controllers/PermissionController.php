<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\PermissionRole;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Permission::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $permission = $query->paginate(10)->withQueryString();

        $data = [
            'title' => 'Permission',
            'permission' => $permission
        ];

        return view('permission.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Create URL'
        ];

        return view('permission.form', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'route_name' => 'required|string|max:255',
        ]);

        Permission::create($validated);
        return redirect('/dashboard/permission')->with('success', 'Success Creating Data');
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        $data = [
            'title' => 'Edit Role',
            'permission' => $permission
        ];

        return view('permission.form', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'route_name' => 'required|string|max:255',
        ]);

        // Update data
        $permission->update($validated);

        // Redirect kembali ke index dengan pesan sukses
        return redirect('/dashboard/permission')->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect('/dashboard/permission')->with('success', 'Permission deleted successfully.');
    }

    // permission Role

    public function permission_role($role_id)
    {
        // ambil semua permission
        $permissions = Permission::all();
        // ambil permission yang sudah ada  di role
        $role_permissions = PermissionRole::with(['permission'])
            ->where('role_id', $role_id)
            ->get();

        // buat variable untuk mengirimkan ke front end
        $data = [
            'role_id' => $role_id,
            'role_permissions' => $role_permissions,
            'permissions' => $permissions,
            'title' => 'Role Akses',
        ];

        return view('role_access.index', compact('data'));
    }

    public function permission_role_update(Request $request, $role_id)
    {
        // Validasi Input
        $validated = $request->validate([
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
        ]);


        // Hapus Semua Permission yang ada Sebelumnya (Cleaning)
        PermissionRole::where('role_id', $role_id)->delete();


        // Input Data yang Baru Lagi
        $permissions = $request->input('permissions', []);


        // Looping untuk Update Data
        $insertData = collect($permissions)->map(function ($permission_id) use ($role_id) {
            return [
                'role_id' => $role_id,
                'permission_id' => $permission_id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        })->toArray();


        // Input data ke Permission Role
        PermissionRole::insert($insertData);
        return redirect()->back()->with('success', 'Permissions updated successfully.');
    }
}
