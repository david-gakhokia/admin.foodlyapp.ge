<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    // public function __construct()
    // {
    //     // მხოლოდ ამ Middleware–ებით დაცული ექშენები
    //     $this->middleware('permission:view permissions')->only('index');
    //     $this->middleware('permission:create permissions')->only(['create','store']);
    //     $this->middleware('permission:edit permissions')->only(['edit','update']);
    //     $this->middleware('permission:delete permissions')->only('destroy');
    // }

    /**
     * მოშაქის დაგებული გადაცემები
     */
    public function index(): View
    {
        // paginate(15) ესეიგი სერიალიზებული გვერდებად
        $permissions = Permission::orderBy('name')->paginate(15);

        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * ახალი უფლების შექმნის ფორმა
     */
    public function create(): View
    {
        return view('admin.permissions.create');
    }

    /**
     * ახალი უფლების შენახვა
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|unique:permissions,name',
        ]);

        Permission::create($data);

        return redirect()
            ->route('admin.permissions.index')
            ->with('success', __('Permission created successfully.'));
    }

    /**
     * უფლების რედაქტირების ფორმა
     */
    public function edit(Permission $permission): View
    {
        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * უფლების განახლება
     */
    public function update(Request $request, Permission $permission): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|unique:permissions,name,' . $permission->id,
        ]);

        $permission->update($data);

        return redirect()
            ->route('admin.permissions.index')
            ->with('success', __('Permission updated successfully.'));
    }

    /**
     * უფლების წაშლა
     */
    public function destroy(Permission $permission): RedirectResponse
    {
        $permission->delete();

        return redirect()
            ->route('admin.permissions.index')
            ->with('success', __('Permission deleted successfully.'));
    }
}
