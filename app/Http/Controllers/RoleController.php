<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use App\User;
use App\ModelHasRoles;
use DB;

class RoleController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    //$roles = Role::all();
    //return view('role.index',compact('roles'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    $roles = Role::all();
    return view('role.create',compact('roles'));
  }

  /**
  * Show the form for creating a new resource.
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function showUserRoles($id)
  {
    $user = DB::table('users')
    ->where('users.id','=',$id)
    ->leftjoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
    ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
    ->select('users.id AS user_id', 'users.name AS user_name', 'users.email AS user_email', 'roles.id AS role_id','roles.name AS role_name')
    ->get();

    $roles = DB::table("roles")->select('*')
    ->whereNotIn('roles.id',function($query) use($id){
      $query->select('role_id')->from('model_has_roles')->where('model_id','=',$id);
    })
    ->get();

    return view('role.assign',compact('user','roles'));
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
    Role::create($input);
    return redirect('/role/create');
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $role = Role::findOrFail($id);
    return view('role.show',compact('role'));
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Role  $role
  * @return \Illuminate\Http\Response
  */
  public function edit(Role $role)
  {
    //
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $user_id)
  {
    /*Validate the form data
    $this->validate($request, [
    'roles'=>'required',
  ]);
  */// not required - to remove all the permissions of this user

  $input = $request->except('_token');
  if (isset($input['roles']))
  {
    $roles_id = array_filter($input['roles']);
  }

  $query = false;

  // delete prev Roles
  $delete = DB::table('model_has_roles')->where('model_id', '=', $user_id)->delete();
  // insert all at once
  if (isset($roles_id))
  {
    foreach ($roles_id as $role_id) {

      $query = DB::table('model_has_roles')->insert(
        array('role_id' => $role_id,
        'model_type' => 'App\User',
        'model_id' => $user_id));
      }
      if ($query) {
        return redirect('/admin');
      }
    }
    else {
      return redirect('/admin');
    }
}

/**
* Remove the specified resource from storage.
*
* @param  \App\Role  $role
* @return \Illuminate\Http\Response
*/
public function destroy(Role $role)
{
  //
}
}
