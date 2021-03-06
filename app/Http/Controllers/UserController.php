<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;
use DB;
use Spatie\Activitylog\Models\Activity;
use Auth;

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
      //$users = User::with('roles')->where('roles.name','!=','admin')->get();
      /*$users = User::with(['roles' => function($q){
        $q->where('roles.name','!=', 'admin');
      }])->get();
      */

      //check current user role
      $current_user_role = Auth::user()->roles->first()->name;

      switch ($current_user_role) {
        case 'male-manager':
        $users = DB::table('users')
        ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
        ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->where('roles.name', '!=','admin')
        ->where('roles.name', '!=','female-manager')
        ->where('roles.name', '!=','female-officer')
        ->select('users.id AS user_id', 'users.name AS user_name', 'users.email AS user_email', 'roles.id AS role_id','roles.name AS role_name')
        ->get();
        break;
        case 'female-manager':
        $users = DB::table('users')
        ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
        ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->where('roles.name', '!=','admin')
        ->where('roles.name', '!=','male-manager')
        ->where('roles.name', '!=','male-officer')
        ->select('users.id AS user_id', 'users.name AS user_name', 'users.email AS user_email', 'roles.id AS role_id','roles.name AS role_name')
        ->get();
        break;
      }
      return view('users', compact('users'));
    }

    public function showLastActivity()
    {

      //check current user role
      $current_user_role = Auth::user()->roles->first()->name;

      switch ($current_user_role) {
        case 'male-manager':
        $lastLoggedActivity = DB::table('activity_log')
        ->join('students', 'activity_log.subject_id', '=', 'students.id')
        ->join('users', 'activity_log.causer_id', '=', 'users.id')
        ->where('students.Gender','=','m')
        ->select('activity_log.id AS id', 'activity_log.log_name AS name', 'activity_log.created_at AS created_date', 'activity_log.description AS des'
        ,'activity_log.properties AS pro','users.name AS user_name')
        ->orderBy('activity_log.id', 'desc')
        ->limit(5)->get();

        $after=[];$before=[];
        foreach($lastLoggedActivity as $activity)
        {
        $after[]=preg_replace('/(.*)"current":"(.*)"}(.*)/sm', '\2', $activity->pro);
        $before[]=preg_replace('/(.*){"old":"(.*)","(.*)/sm', '\2', $activity->pro);
        }
        return view('manager',compact('lastLoggedActivity','after','before'));
        break;
        case 'female-manager':
        $lastLoggedActivity = DB::table('activity_log')
        ->leftjoin('students', 'students.id', '=', 'activity_log.subject_id')
        ->leftjoin('users', 'users.id', '=', 'activity_log.causer_id')
        ->where('students.Gender','=','f')
        ->select('activity_log.id AS id', 'activity_log.log_name AS name', 'activity_log.created_at AS created_date', 'activity_log.description AS des'
        ,'activity_log.properties AS pro','users.name AS user_name')
        ->orderBy('activity_log.id', 'desc')
        ->limit(5)->get();

        $after=[];$before=[];
        foreach($lastLoggedActivity as $activity)
        {
        $after[]=preg_replace('/(.*)"current":"(.*)"}(.*)/sm', '\2', $activity->pro);
        $before[]=preg_replace('/(.*){"old":"(.*)","(.*)/sm', '\2', $activity->pro);
        }
        return view('manager',compact('lastLoggedActivity','after','before'));
        break;
      }

      //$lastLoggedActivity = Activity::latest()->limit(5)->get();
      //return view('manager',compact('lastLoggedActivity'));
    }



    public function activity_log()
    {

      //$activities = Activity::paginate(5); // all in db
      //return view('activity_log',compact('activities'));

      //check current user role
      $current_user_role = Auth::user()->roles->first()->name;

      switch ($current_user_role) {
        case 'male-manager':
        $lastLoggedActivity = DB::table('activity_log')
        ->join('students', 'activity_log.subject_id', '=', 'students.id')
        ->join('users', 'activity_log.causer_id', '=', 'users.id')
        ->where('students.Gender','=','m')
        ->select('activity_log.id AS id', 'activity_log.log_name AS name', 'activity_log.created_at AS created_date', 'activity_log.description AS des'
        ,'activity_log.properties AS pro','users.name AS user_name')
        ->orderBy('activity_log.id', 'desc')
        ->paginate(5);

        $after=[];$before=[];
        foreach($lastLoggedActivity as $activity)
        {
        $after[]=preg_replace('/(.*)"current":"(.*)"}(.*)/sm', '\2', $activity->pro);
        $before[]=preg_replace('/(.*){"old":"(.*)","(.*)/sm', '\2', $activity->pro);
        }
        return view('activity_log',compact('lastLoggedActivity','after','before'));
        break;
        case 'female-manager':
        $lastLoggedActivity = DB::table('activity_log')
        ->leftjoin('students', 'students.id', '=', 'activity_log.subject_id')
        ->leftjoin('users', 'users.id', '=', 'activity_log.causer_id')
        ->where('students.Gender','=','f')
        ->select('activity_log.id AS id', 'activity_log.log_name AS name', 'activity_log.created_at AS created_date', 'activity_log.description AS des'
        ,'activity_log.properties AS pro','users.name AS user_name')
        ->orderBy('activity_log.id', 'desc')
        ->paginate(5);

        $after=[];$before=[];
        foreach($lastLoggedActivity as $activity)
        {
        $after[]=preg_replace('/(.*)"current":"(.*)"}(.*)/sm', '\2', $activity->pro);
        $before[]=preg_replace('/(.*){"old":"(.*)","(.*)/sm', '\2', $activity->pro);
        }
        return view('activity_log',compact('lastLoggedActivity','after','before'));
        break;
      }
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

      //check current user role
      $current_user_role = Auth::user()->roles->first()->name;

      switch ($current_user_role) {
        case 'male-manager':
        $roles = DB::table("roles")->select('*')
        ->where('name', '!=', 'admin')
        ->where('name', '!=', 'female-manager')
        ->where('name', '!=', 'female-officer')
        ->whereNotIn('roles.id',function($query) use($id){
          $query->select('role_id')->from('model_has_roles')->where('model_id','=',$id);
        })
        ->get();

        break;
        case 'female-manager':
        $roles = DB::table("roles")->select('*')
        ->where('name', '!=', 'admin')
        ->where('name', '!=', 'male-manager')
        ->where('name', '!=', 'male-officer')
        ->whereNotIn('roles.id',function($query) use($id){
          $query->select('role_id')->from('model_has_roles')->where('model_id','=',$id);
        })
        ->get();
        break;

      }

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
