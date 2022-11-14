<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use PhpParser\Node\Stmt\TryCatch;


use DB;

class PermissionController extends Controller
{

    function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $permissions = Permission::all();
        if ($request->ajax()) {
            return response()->json([
                'permissions'=>$permissions,
            ]);
        }
        return view('permissions.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return redirect()->route('permissions.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {            
        
        $this->validate($request, [
            'name' => 'required|unique:permissions',
        ]);
        Permission::Create(
            [
                'name' => $request->name,
            ]
        );

        $notification = array(            
            'message' => __('Msg_add_permission_success'),
            'alert-type' => 'success'            
        );
        
        return redirect()->route('permissions.index')
                        ->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
         return redirect()->route('permissions.index');
    }

    public function edit($id)
    {
        return redirect()->route('permissions.index');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => [
                'required',
                Rule::unique('permissions','name')->ignore($id)
            ]
        ]);
        $permission = Permission::find($id); 
        $permission->name = $request->name;        
        $permission->save();
    
        return redirect()->route('permissions.index')
                        ->with('success',__('Msg_update_permission_success'));
    }

    public function destroy($id)
    {
        DB::table("permissions")->where('id',$id)->delete();        
        return response()->json([
            'message' => __('Msg_delete_success')
          ]);
        /* $notification = array(            
            'message' => 'Permissions deleted successfully',
            'alert-type' => 'success'            
        );
        return redirect()->route('permissions.index')
                        ->with($notification); */

    }
}