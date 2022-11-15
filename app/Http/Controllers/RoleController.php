<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use DB;

class RoleController extends Controller
{

    function __construct()
    {
        //  $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
        //  $this->middleware('permission:role-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $menuSystem = true;
        $title = __('Roles_management');
        $roles = Role::orderBy('id', 'DESC')->paginate(10);
        return view('roles.index', compact('roles', 'title', 'menuSystem'));
    }

    public function create()
    {
        $menuSystem = true;
        $permission = Permission::get();
        $title = __('Create_new_role');
        return view('roles.create', compact('title', 'menuSystem', 'permission'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
            ->with('success', __('Msg_create_role_success'));
    }

    public function show($id)
    {
        return redirect()->route('roles.index');
    }

    public function edit($id)
    {
        $menuSystem = true;
        $role = Role::find($id);
        $title = __('Update_role');

        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('roles.edit', compact('role', 'title', 'menuSystem', 'permission', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => [
                'required',
                Rule::unique('roles', 'name')->ignore($id)
            ],
            'permission' => 'required'
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));
        return redirect()->back();
        return redirect()->route('roles.index')
            ->with('success', __('Msg_update_success'));
    }

    public function destroy($id)
    {
        $role = Role::find($id);

        $role->delete();

        $notification = array(
            'message' => __('Msg_delete_success'),
            'alert-type' => 'success'
        );
        return redirect()->route('roles.index')
            ->with($notification);
    }
}
