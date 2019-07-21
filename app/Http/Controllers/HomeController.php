<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pres;
use App\Student;
use DB;
use Auth;

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

    $sis = [count($enrolledActive),count($postponed),count($graduated),count($dismissed),count($withdrawal),count($recordClosed),count($cancelled)];

    $total = count($enrolledActive)+count($postponed)+count($graduated)+count($dismissed)+count($withdrawal)+count($recordClosed)+count($cancelled);

    $count_graduated = count($graduated)/$total*100;
    $count_graduated = round($count_graduated, 1);

    $count_enrolledActive = count($enrolledActive)/$total*100;
    $count_enrolledActive = round($count_enrolledActive, 1);

    $count_postponed = count($postponed)/$total*100;
    $count_postponed = round($count_postponed, 1);

    $count_withdrawal = count($withdrawal)/$total*100;
    $count_withdrawal = round($count_withdrawal, 1);

    $count_dismissed = count($dismissed)/$total*100;
    $count_dismissed = round($count_dismissed, 1);

    $count_cancelled = count($cancelled)/$total*100;
    $count_cancelled = round($count_cancelled, 1);

    $count_recordClosed = count($recordClosed)/$total*100;
    $count_recordClosed = round($count_recordClosed, 1);


    $sis_prec = [$count_enrolledActive,$count_postponed,$count_graduated,$count_dismissed,$count_withdrawal,$count_recordClosed,$count_cancelled];

    /*
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

    $user  = [$count_mm,$count_fm,$count_mo,$count_fo,$count_ad];

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
    */

    // Graduation Batch for Active Student
    $total_active_stu = Student::Select('GraduationBatch')
    ->where('Status', '=', 'ACTIVE')->count();// 343

    $active_grad_batch = Student::Select('GraduationBatch')
    ->where('Status', '=', 'ACTIVE')->distinct('GraduationBatch')->get();// Labels B3,B4,B5,B6

    $active_grad_batch_count = Student::select('GraduationBatch', DB::raw('count(GraduationBatch) count'))->where('Status', '=', 'ACTIVE')->groupBy('GraduationBatch')->get();

    $active_labels;

    foreach($active_grad_batch_count as $index){
      $active_labels [] = 'B '.$index->GraduationBatch.' ('.$index->count.')';
    }

    $total_active ;

    foreach ($active_grad_batch_count as $key=>$index) {
      $active_prec = $index->count/$total_active_stu*100;
      $active_prec  = round($active_prec,1);
      $total_active [] = $active_prec;
    }

    // Graduation Batch for Postponed Student
    $total_postponed_stu = Student::Select('GraduationBatch')
    ->where('Status', '=', 'POSTPONED')->count();// 343

    $postponed_grad_batch = Student::Select('GraduationBatch')
    ->where('Status', '=', 'POSTPONED')->distinct('GraduationBatch')->get();// Labels B3,B4,B5,B6

    $postponed_grad_batch_count = Student::select('GraduationBatch', DB::raw('count(GraduationBatch) count'))->where('Status', '=', 'POSTPONED')->groupBy('GraduationBatch')->get();

    $postponed_labels;

    foreach($postponed_grad_batch_count as $index){
      $postponed_labels [] = 'B '.$index->GraduationBatch.' ('.$index->count.')';
    }

    $total_postponed ;

    foreach ($postponed_grad_batch_count as $key=>$index) {
      $postponed_prec = $index->count/$total_postponed_stu*100;
      $postponed_prec  = round($postponed_prec,1);
      $total_postponed [] = $postponed_prec;
    }


    // all users activity

    $current_user_role = Auth::user()->roles->first()->name;

    switch ($current_user_role) {
      case 'admin':
      $activities = DB::table('activity_log')
      ->select(DB::raw('MONTHNAME(created_at) as date'), DB::raw('count(*) as total'))
      ->whereYear('created_at', '=', date('Y'))
      ->groupBy('date')
      ->get();
      break;

      case 'male-manager':
      case 'male-officer':
      $activities = DB::table('activity_log')
      ->join('students', 'activity_log.subject_id', '=', 'students.id')
      ->where('students.Gender','=','m')
      ->whereYear('activity_log.created_at', '=', date('Y'))
      ->select(DB::raw('MONTHNAME(activity_log.created_at) as date'), DB::raw('count(*) as total'))
      ->groupBy('date')
      ->get();
      break;

      case 'female-manager':
      case 'female-officer':
      $activities = DB::table('activity_log')
      ->join('students', 'activity_log.subject_id', '=', 'students.id')
      ->where('students.Gender','=','f')
      ->whereYear('activity_log.created_at', '=', date('Y'))
      ->select(DB::raw('MONTHNAME(activity_log.created_at) as date'), DB::raw('count(*) as total'))
      ->groupBy('date')
      ->get();
      break;
    }

  /*$activities = DB::table('activity_log')
  ->select(DB::raw('MONTHNAME(created_at) as date'), DB::raw('count(*) as total'))
  ->whereYear('created_at', '=', date('Y'))
  ->groupBy('date')
  ->get();*/

    /*
    $month_array = DB::table('activity_log')
    ->select(DB::raw('MONTHNAME(created_at) as date'), DB::raw('MONTH(created_at) as num'))
    ->groupBy('date','num')
    ->get();
    */

    $month_array; $updates_array;
    if ($activities->count())
    {
        foreach ($activities as $key) {
            $month_array [] = $key->date;
            $updates_array [] = $key->total;
        }
      }
      else {

          $month_array= NULL; $updates_array= NULL;
    }

    return view('dashboard',compact('sis','sis_prec','month_array','updates_array','active_grad_batch','active_labels','total_active','total_active_stu'
    ,'postponed_grad_batch','postponed_labels','total_postponed','total_postponed_stu'
  ));

  }
}
