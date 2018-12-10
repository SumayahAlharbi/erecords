<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;
use DB;
use Spatie\Activitylog\Models\Activity;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $users = User::with('roles')->get();
      return view('manager', compact('users'));
    }

    /**
     * Show the activity log.
     *
     * @return \Illuminate\Http\Response
     */
    public function activity_log()
    {
      //$lastLoggedActivity = Activity::all()->last();// only one

      $activities = Activity::paginate(5); // all in db
      return view('activity_log',compact('activities'));
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
      ->where('name', '!=', 'admin')
      ->whereNotIn('roles.id',function($query) use($id){
        $query->select('role_id')->from('model_has_roles')->where('model_id','=',$id);
      })
      ->get();

      return view('manager_assign',compact('user','roles'));
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

    $input = $request->except('_token');
    if (isset($input['roles']))
    {
      $roles_id = array_filter($input['roles']);
    }

    $query = false;

    // delete prev Roles
    $delete = DB::table('model_has_roles')->where('model_id', '=', $user_id)
    ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
    ->where('roles.name', '!=', 'admin')->delete();

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
          return redirect('/manager');
        }
      }
      else {
        return redirect('/manager');
      }
  }
}
