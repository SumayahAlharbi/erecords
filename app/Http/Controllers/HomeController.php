<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pres;
use App\Student;
use DB;

class HomeController extends Controller
{
  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
  * Show the application dashboard.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $recordClosed = Pres::Select('NATIONAL_ID')->distinct(['NATIONAL_ID'])->where('STUDENT_STATUS', '=', 'Record Closed')->get();
    $cancelled = Pres::Select('NATIONAL_ID')->distinct(['NATIONAL_ID'])->where('STUDENT_STATUS', '=', 'Cancelled')->get();
    $enrolledActive = Pres::Select('NATIONAL_ID')->distinct(['NATIONAL_ID'])->where('STUDENT_STATUS', '=', 'Enrolled Active')->get();
    $dismissed = Pres::Select('NATIONAL_ID')->distinct(['NATIONAL_ID'])->where('STUDENT_STATUS', '=', 'Dismissed')->get();
    $withdrawal = Pres::Select('NATIONAL_ID')->distinct(['NATIONAL_ID'])->where('STUDENT_STATUS', '=', 'Withdrawn')->get();
    $postponed = Pres::Select('NATIONAL_ID')->distinct(['NATIONAL_ID'])->where('STUDENT_STATUS', '=', 'Postponed')->get();
    $graduated = Pres::Select('NATIONAL_ID')->distinct(['NATIONAL_ID'])->where('STUDENT_STATUS', '=', 'Graduated')->get();

    $sis = [count($graduated),count($enrolledActive),count($postponed),count($withdrawal),count($dismissed),count($cancelled),count($recordClosed)];

    //ALUMNI INTERN ACTIVE POSTPONED DISMISSED WITHDRAWAL TRANSFER
    $ALUMNI = Student::where('Status', '=', 'ALUMNI')->get();
    $INTERN = Student::where('Status', '=', 'INTERN')->get();
    $ACTIVE = Student::where('Status', '=', 'ACTIVE')->get();
    $POSTPONED = Student::where('Status', '=', 'POSTPONED')->get();
    $DISMISSED = Student::where('Status', '=', 'DISMISSED')->get();
    $WITHDRAWAL = Student::where('Status', '=', 'WITHDRAWAL')->get();
    $TRANSFER = Student::where('Status', '=', 'TRANSFER')->get();

    $local  = [count($ALUMNI),count($INTERN),count($ACTIVE),count($POSTPONED),count($DISMISSED),count($WITHDRAWAL),count($TRANSFER)];

    //$users = User::with('roles')->get();

    $all_users = DB::table('users')
    ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
    ->leftjoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
    ->select('users.name AS user_name', 'roles.name AS role_name')
    ->get();

    $count_mm=0;$count_fm=0;$count_mo=0;$count_fo=0;$count_ad=0;

    foreach ($all_users as $key => $value) {
      if ($value->role_name == 'male-manager') {
        $count_mm++;
      }
      if ($value->role_name == 'male-officer') {
        $count_mo++;
      }
      if ($value->role_name == 'female-manager') {
        $count_fm++;
      }
      if ($value->role_name == 'female-officer') {
        $count_fo++;
      }
      if ($value->role_name == 'admin') {
        $count_ad++;
      }
    }
    $total = $count_mm+$count_fm+$count_mo+$count_fo+$count_ad;

    $count_mm = $count_mm/$total*100;
    $count_mm = (int)$count_mm;

    $count_fm = $count_fm/$total*100;
    $count_fm = (int)$count_fm;

    $count_mo = $count_mo/$total*100;
    $count_mo = (int)$count_mo;

    $count_fo = $count_fo/$total*100;
    $count_fo = (int)$count_fo;

    $count_ad = $count_ad/$total*100;
    $count_ad = (int)$count_ad;


    $users  = [$count_mm,$count_fm,$count_mo,$count_fo,$count_ad];


    $activities = DB::table('activity_log')
    ->select(DB::raw('MONTHNAME(created_at) as date'), DB::raw('count(*) as total'))
    ->groupBy('date')
    ->get();

    /*$month_array = DB::table('activity_log')
    ->select(DB::raw('MONTHNAME(created_at) as date'), DB::raw('MONTH(created_at) as num'))
    ->groupBy('date','num')
    ->get();
    */
    $month_array;$updates_array;

    foreach ($activities as $key) {
        $month_array [] = $key->date;
        $updates_array [] = $key->total;
    }

    return view('dashboard',compact('sis','local','users','month_array','updates_array'));

  }
}
