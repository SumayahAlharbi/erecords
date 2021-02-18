<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use DB;

class PermissionController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $permissions = Permission::all();
    return view('permission.index',compact('permissions'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    $permissions = Permission::all();
    return view('permission.create',compact('permissions'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function showRolePermission()
  {
    $roles_list = DB::table('roles')->get();
    return view('permission.assign',compact('roles_list'));
  }

  public function dynamic_dependent_ajax($id)
  {
    $permissions_list = DB::table("role_has_permissions")
                  ->where("role_id",$id)
                  ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                  ->pluck('permissions.name as name','permissions.id as id');

    // rest of permissions
    $permissions = DB::table("permissions")->select('*')
                  ->whereNotIn('permissions.id',function($query) use($id){
                      $query->select('permission_id')->from('role_has_permissions')->where('role_id','=',$id);
                    })->get();

    return json_encode(array($permissions_list,$permissions));
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    $this->validate($request, [
      'name'=>'required|max:50',
    ]);

    $input = $request->except('_token');
    $input['name']=$request->get('name');
    $input['guard_name']='web';
    Permission::create($input);
    return redirect('/permission/create');
  }

  /**
  * Display the specified resource.
  *
  * @param  \App\Permission  $permission
  * @return \Illuminate\Http\Response
  */
  public function show(Permission $permission)
  {
    //
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Permission  $permission
  * @return \Illuminate\Http\Response
  */
  public function edit(Request $request)
  {
    //
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request)
  {

    $input = $request->except('_token');
    if (isset($input['permission_id']))
    {
      $permission_list = array_filter($input['permission_id']);
    }

    $query = false;
    $role_id = $request->get('role_id');

    // delete prev permissions under this role
    $delete = DB::table('role_has_permissions')->where('role_id', '=', $role_id)->delete();
    // insert all at once
    if (isset($permission_list))
    {
      foreach ($permission_list as $permission_id) {
        $query = DB::table('role_has_permissions')->insert(
          array('permission_id' => $permission_id,'role_id' => $role_id ));
        }
        if ($query) {
          return redirect('/assign');
        }
      }
      else {
        return redirect('/assign');
      }
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $delete = Permission::where('id', '=', $id)->delete();
    if ($delete){
      return redirect('/permission/create')->with('success', 'Permission has been deleted');
    }
    else{
      return redirect('/permission/create')->with('warning', 'Something wrong happened, please try again');
    }
  }
}
