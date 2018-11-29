<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Attachment;
use DB;
use PDF;
use Session;
use Spatie\Activitylog\Models\Activity;
use Auth;

class StudentController extends Controller
{

  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    //
  }

  /**
  * search
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function search(Request $request)
  {

    $search = $request->get('keyword');

    //adding session for exporting the result and removing old session
    session(['search'=>$search]);
    Session::forget('SR');

    //check current user role
    $current_user_role = Auth::user()->roles->first()->name;

    switch ($current_user_role) {
      case 'admin': // all students
      $searchResults = Student::where('Badge', '=', $search)
      ->orWhere('NationalID', '=', $search)
      ->orWhere('Batch', 'LIKE', '%'.$search.'%')
      ->orWhere('Stream', 'LIKE', '%'.$search.'%')
      ->orWhere('Status', 'LIKE', '%'.$search.'%')
      ->orWhere('FirstName', 'LIKE', '%'.$search.'%')
      ->orWhere('LastName', 'LIKE', '%'.$search.'%')
      ->orWhere('StudentNo', 'LIKE', '%'.$search.'%')
      ->paginate(5);
      break;

      case 'male-manager':
      case 'male-officer': // all male students
      $searchResults = Student::where('Gender', '=', 'm')
      ->where(function($query)use ($search)
      {
        $query->Where('Badge', '=', $search)
        ->orWhere('NationalID', '=', $search)
        ->orWhere('Batch', 'LIKE', '%'.$search.'%')
        ->orWhere('Stream', 'LIKE', '%'.$search.'%')
        ->orWhere('Status', 'LIKE', '%'.$search.'%')
        ->orWhere('FirstName', 'LIKE', '%'.$search.'%')
        ->orWhere('LastName', 'LIKE', '%'.$search.'%')
        ->orWhere('StudentNo', 'LIKE', '%'.$search.'%');
      })->paginate(5);
      break;

      case 'female-manager':
      case 'female-officer':  // all female students
      $searchResults = Student::where('Gender', '=', 'f')
      ->where(function($query)use ($search)
      {
        $query->Where('Badge', '=', $search)
        ->orWhere('NationalID', '=', $search)
        ->orWhere('Batch', 'LIKE', '%'.$search.'%')
        ->orWhere('Stream', 'LIKE', '%'.$search.'%')
        ->orWhere('Status', 'LIKE', '%'.$search.'%')
        ->orWhere('FirstName', 'LIKE', '%'.$search.'%')
        ->orWhere('LastName', 'LIKE', '%'.$search.'%')
        ->orWhere('StudentNo', 'LIKE', '%'.$search.'%');
      })->paginate(5);
      break;
    };

    return view('search_result',compact('searchResults','search'));
  }


  // this function is for exporting the search result to PDF
  public function export_pdf()
  {
    if (Session::has('SR')) {
      $searchResults =session('SR')->all();

      /*return view('ExportPDFSearch',compact('searchResults'));
      $pdf = PDF::loadView('ExportPDFSearch',compact('searchResults'));
      $pdf->save(storage_path().'_erecords.pdf');
      return $pdf->download('erecords.pdf');
      */
      $pdf = PDF::loadView('ExportPDFSearch', compact('searchResults'));
      $pdf->save(public_path('/mpdf-temp/').'export_students.pdf');
      return $pdf->download('export_students.pdf');
    }
    else
    {
      $search =session('search');
      //check current user role
      $current_user_role = Auth::user()->roles->first()->name;

      switch ($current_user_role) {
        case 'admin': // all students
        $searchResults = Student::where('Badge', '=', $search)
        ->orWhere('NationalID', '=', $search)
        ->orWhere('Batch', 'LIKE', '%'.$search.'%')
        ->orWhere('Stream', 'LIKE', '%'.$search.'%')
        ->orWhere('Status', 'LIKE', '%'.$search.'%')
        ->orWhere('FirstName', 'LIKE', '%'.$search.'%')
        ->orWhere('LastName', 'LIKE', '%'.$search.'%')
        ->orWhere('StudentNo', 'LIKE', '%'.$search.'%')
        ->get();
        $pdf = PDF::loadView('ExportPDFSearch', compact('searchResults','search'));
        $pdf->save(public_path('/mpdf-temp/').'export_students.pdf');
        return $pdf->download('export_students.pdf');
        break;

        case 'male-manager':
        case 'male-officer': // all male students
        $searchResults = Student::where('Gender', '=', 'm')
        ->where(function($query)use ($search)
        {
          $query->Where('Badge', '=', $search)
          ->orWhere('NationalID', '=', $search)
          ->orWhere('Batch', 'LIKE', '%'.$search.'%')
          ->orWhere('Stream', 'LIKE', '%'.$search.'%')
          ->orWhere('Status', 'LIKE', '%'.$search.'%')
          ->orWhere('FirstName', 'LIKE', '%'.$search.'%')
          ->orWhere('LastName', 'LIKE', '%'.$search.'%')
          ->orWhere('StudentNo', 'LIKE', '%'.$search.'%');
        })->get();
        $pdf = PDF::loadView('ExportPDFSearch', compact('searchResults','search'));
        $pdf->save(public_path('/mpdf-temp/').'export_students.pdf');
        return $pdf->download('export_students.pdf');
        break;

        case 'female-manager':
        case 'female-officer':  // all female students
        $searchResults = Student::where('Gender', '=', 'f')
        ->where(function($query)use ($search)
        {
          $query->Where('Badge', '=', $search)
          ->orWhere('NationalID', '=', $search)
          ->orWhere('Batch', 'LIKE', '%'.$search.'%')
          ->orWhere('Stream', 'LIKE', '%'.$search.'%')
          ->orWhere('Status', 'LIKE', '%'.$search.'%')
          ->orWhere('FirstName', 'LIKE', '%'.$search.'%')
          ->orWhere('LastName', 'LIKE', '%'.$search.'%')
          ->orWhere('StudentNo', 'LIKE', '%'.$search.'%');
        })->get();
        $pdf = PDF::loadView('ExportPDFSearch', compact('searchResults','search'));
        $pdf->save(public_path('/mpdf-temp/').'export_students.pdf');
        return $pdf->download('export_students.pdf');
        break;
      }
    }
  }


  // this function is for creating the Summery Report
  public function summeryReport_pdf()
  {

    //check current user role
    $current_user_role = Auth::user()->roles->first()->name;

    switch ($current_user_role) {
      case 'admin':
      $batches = Student::distinct()->get(['Batch']);

      $active = [];
      $alumni=[];
      $intern=[];
      $postponed=[];
      $withdrawal=[];
      $dismissed=[];
      $total=[];

      foreach ($batches as $key => $value) {
        $active[] = Student::where('Batch', '=', $value->Batch)->where('Status', '=', 'ACTIVE')->count();
        $total_active = Student::where('Status', '=', 'ACTIVE')->count();

        $alumni[] = Student::where('Batch', '=', $value->Batch)->where('Status', '=', 'ALUMNI')->count();
        $total_alumni = Student::where('Status', '=', 'ALUMNI')->count();


        $intern[] = Student::where('Batch', '=', $value->Batch)->where('Status', '=', 'INTERN')->count();
        $total_intern = Student::where('Status', '=', 'INTERN')->count();

        $postponed[] = Student::where('Batch', '=', $value->Batch)->where('Status', '=', 'POSTPONED')->count();
        $total_postponed = Student::where('Status', '=', 'POSTPONED')->count();

        $withdrawal[] = Student::where('Batch', '=', $value->Batch)->where('Status', '=', 'WITHDRAWL')->count();
        $total_withdrawal = Student::where('Status', '=', 'WITHDRAWL')->count();

        $dismissed[] = Student::where('Batch', '=', $value->Batch)->where('Status', '=', 'DISMISSED')->count();
        $total_dismissed = Student::where('Status', '=', 'DISMISSED')->count();

        $total[] = Student::where('Batch', '=', $value->Batch)->count();
        $totaloftotal = Student::all()->count();
      }

      // Send data to the view using loadView function of PDF facade
      $pdf = PDF::loadView('SummeryReport', compact(
        'batches','active','alumni','intern','postponed','withdrawal','dismissed','total',
        'total_active','total_alumni','total_intern','total_postponed','total_withdrawal','total_dismissed','totaloftotal'
      ));
      $pdf->save(public_path('/mpdf-temp/').'SummeryReport.pdf');
      return $pdf->download('SummeryReport.pdf');
      break;

      case 'male-manager':
      case 'male-officer':
      $batches = Student::distinct()->select('Batch')->where('Gender', '=', 'm')->get();

      $active = [];
      $alumni=[];
      $intern=[];
      $postponed=[];
      $withdrawal=[];
      $dismissed=[];
      $total=[];

      foreach ($batches as $key => $value) {
        $active[] = Student::where('Batch', '=', $value->Batch)->where('Status', '=', 'ACTIVE')->where('Gender', '=', 'm')->count();
        $total_active = Student::where('Status', '=', 'ACTIVE')->where('Gender', '=', 'm')->count();

        $alumni[] = Student::where('Batch', '=', $value->Batch)->where('Status', '=', 'ALUMNI')->where('Gender', '=', 'm')->count();
        $total_alumni = Student::where('Status', '=', 'ALUMNI')->where('Gender', '=', 'm')->count();


        $intern[] = Student::where('Batch', '=', $value->Batch)->where('Status', '=', 'INTERN')->where('Gender', '=', 'm')->count();
        $total_intern = Student::where('Status', '=', 'INTERN')->where('Gender', '=', 'm')->count();

        $postponed[] = Student::where('Batch', '=', $value->Batch)->where('Status', '=', 'POSTPONED')->where('Gender', '=', 'm')->count();
        $total_postponed = Student::where('Status', '=', 'POSTPONED')->where('Gender', '=', 'm')->count();

        $withdrawal[] = Student::where('Batch', '=', $value->Batch)->where('Status', '=', 'WITHDRAWL')->where('Gender', '=', 'm')->count();
        $total_withdrawal = Student::where('Status', '=', 'WITHDRAWL')->where('Gender', '=', 'm')->count();

        $dismissed[] = Student::where('Batch', '=', $value->Batch)->where('Status', '=', 'DISMISSED')->where('Gender', '=', 'm')->count();
        $total_dismissed = Student::where('Status', '=', 'DISMISSED')->where('Gender', '=', 'm')->count();

        $total[] = Student::where('Batch', '=', $value->Batch)->where('Gender', '=', 'm')->count();
        $totaloftotal = Student::all()->where('Gender', '=', 'm')->count();
      }

      // Send data to the view using loadView function of PDF facade
      $pdf = PDF::loadView('SummeryReport', compact(
        'batches','active','alumni','intern','postponed','withdrawal','dismissed','total',
        'total_active','total_alumni','total_intern','total_postponed','total_withdrawal','total_dismissed','totaloftotal'
      ));
      $pdf->save(public_path('/mpdf-temp/').'SummeryReport.pdf');
      return $pdf->download('SummeryReport.pdf');
      break;

      case 'female-manager':
      case 'female-officer':
      $batches = Student::distinct()->select('Batch')->where('Gender', '=', 'f')->get();

      $active = [];
      $alumni=[];
      $intern=[];
      $postponed=[];
      $withdrawal=[];
      $dismissed=[];
      $total=[];

      foreach ($batches as $key => $value) {
        $active[] = Student::where('Batch', '=', $value->Batch)->where('Status', '=', 'ACTIVE')->where('Gender', '=', 'f')->count();
        $total_active = Student::where('Status', '=', 'ACTIVE')->where('Gender', '=', 'f')->count();

        $alumni[] = Student::where('Batch', '=', $value->Batch)->where('Status', '=', 'ALUMNI')->where('Gender', '=', 'f')->count();
        $total_alumni = Student::where('Status', '=', 'ALUMNI')->where('Gender', '=', 'f')->count();


        $intern[] = Student::where('Batch', '=', $value->Batch)->where('Status', '=', 'INTERN')->where('Gender', '=', 'f')->count();
        $total_intern = Student::where('Status', '=', 'INTERN')->where('Gender', '=', 'f')->count();

        $postponed[] = Student::where('Batch', '=', $value->Batch)->where('Status', '=', 'POSTPONED')->where('Gender', '=', 'f')->count();
        $total_postponed = Student::where('Status', '=', 'POSTPONED')->where('Gender', '=', 'f')->count();

        $withdrawal[] = Student::where('Batch', '=', $value->Batch)->where('Status', '=', 'WITHDRAWL')->where('Gender', '=', 'f')->count();
        $total_withdrawal = Student::where('Status', '=', 'WITHDRAWL')->where('Gender', '=', 'f')->count();

        $dismissed[] = Student::where('Batch', '=', $value->Batch)->where('Status', '=', 'DISMISSED')->where('Gender', '=', 'f')->count();
        $total_dismissed = Student::where('Status', '=', 'DISMISSED')->where('Gender', '=', 'f')->count();

        $total[] = Student::where('Batch', '=', $value->Batch)->where('Gender', '=', 'f')->count();
        $totaloftotal = Student::all()->where('Gender', '=', 'f')->count();
      }

      // Send data to the view using loadView function of PDF facade
      $pdf = PDF::loadView('SummeryReport', compact(
        'batches','active','alumni','intern','postponed','withdrawal','dismissed','total',
        'total_active','total_alumni','total_intern','total_postponed','total_withdrawal','total_dismissed','totaloftotal'
      ));
      $pdf->save(public_path('/mpdf-temp/').'SummeryReport.pdf');
      return $pdf->download('SummeryReport.pdf');
      break;
    }

    //$pdf->save(storage_path().'_SummeryReport.pdf');
    //return $pdf->download('SummeryReport.pdf');
  }

  // this function is for creating the Student Details Report
  public function studentReport_pdf($id)
  {
    $student = Student::findOrFail($id);
    $pdf = PDF::loadView('StudentReport',compact('student'));
    $pdf->save(public_path('/mpdf-temp/').'StudentReport.pdf');
    return $pdf->download('StudentReport.pdf');
    //$pdf->save(storage_path().'_StudentReport.pdf');
    //return $pdf->download('StudentReport.pdf');
  }

  public function advanced_search_form ()
  {
    $batches = Student::distinct()->select('Batch')->get();
    $streams = Student::distinct()->select('Stream')->get();
    $status = Student::distinct()->select('Status')->get();

    return view('advanced_search', compact('batches','streams','status'));
  }

  /**
  * advanced search
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  // every session created on this function is used to create excel sheet
  public function advanced_search(Request $request)
  {

    $fname= $request->get('FirstName');
    session(['fname'=>$fname]); //used to create excel sheet
    $mname= $request->get('MiddleName');
    session(['mname'=>$mname]); //used to create excel sheet
    $lname= $request->get('LastName');
    session(['lname'=>$lname]); //used to create excel sheet

    $NationalID= $request->get('NationalID');
    session(['NationalID'=>$NationalID]); //used to create excel sheet
    $Batch = $request->get('Batch');
    session(['Batch'=>$Batch]); //used to create excel sheet

    $Badge= $request->get('Badge');
    session(['Badge'=>$Badge]); //used to create excel sheet
    $Status= $request->get('Status');
    session(['Status'=>$Status]); //used to create excel sheet
    $StudentNo= $request->get('StudentNo');
    session(['StudentNo'=>$StudentNo]); //used to create excel sheet
    $Mobile= $request->get('Mobile');
    session(['Mobile'=>$Mobile]); //used to create excel sheet
    $KSAUHSEmail= $request->get('KSAUHSEmail');
    session(['KSAUHSEmail'=>$KSAUHSEmail]); //used to create excel sheet
    $NGHAEmail= $request->get('NGHAEmail');
    session(['NGHAEmail'=>$NGHAEmail]); //used to create excel sheet
    $PersonalEmail= $request->get('PersonalEmail');
    session(['PersonalEmail'=>$PersonalEmail]); //used to create excel sheet
    $GraduateExpectationsYear= $request->get('GraduateExpectationsYear');
    session(['GraduateExpectationsYear'=>$GraduateExpectationsYear]); //used to create excel sheet
    $Stream = $request->get('Stream');
    session(['Stream'=>$Stream]); //used to create excel sheet

    $LastActivationDate= $request->get('LastActivationDate');
    session(['LastActivationDate'=>$LastActivationDate]); //used to create excel sheet
    $Dismissed= $request->get('Dismissed');
    session(['Dismissed'=>$Dismissed]); //used to create excel sheet
    $FirstBlockDrop= $request->get('FirstBlockDrop');
    session(['FirstBlockDrop'=>$FirstBlockDrop]); //used to create excel sheet
    $FirstPostpone= $request->get('FirstPostpone');
    session(['FirstPostpone'=>$FirstPostpone]); //used to create excel sheet
    $FirstAcademicViolation= $request->get('FirstAcademicViolation');
    session(['FirstAcademicViolation'=>$FirstAcademicViolation]); //used to create excel sheet
    $SecondBlockDrop= $request->get('SecondBlockDrop');
    session(['SecondBlockDrop'=>$SecondBlockDrop]); //used to create excel sheet
    $SecondPostpone= $request->get('SecondPostpone');
    session(['SecondPostpone'=>$SecondPostpone]); //used to create excel sheet
    $SecondAcademicViolation= $request->get('SecondAcademicViolation');
    session(['SecondAcademicViolation'=>$SecondAcademicViolation]); //used to create excel sheet
    $ThirdBlockDrop= $request->get('ThirdBlockDrop');
    session(['ThirdBlockDrop'=>$ThirdBlockDrop]); //used to create excel sheet
    $ThirdPostpone= $request->get('ThirdPostpone');
    session(['ThirdPostpone'=>$ThirdPostpone]); //used to create excel sheet
    $ThirdAcademicViolation= $request->get('ThirdAcademicViolation');
    session(['ThirdAcademicViolation'=>$ThirdAcademicViolation]); //used to create excel sheet
    $FirstAttemptAttendanceViolation= $request->get('FirstAttemptAttendanceViolation');
    session(['FirstAttemptAttendanceViolation'=>$FirstAttemptAttendanceViolation]); //used to create excel sheet
    $SecondAttemptAttendanceViolation= $request->get('SecondAttemptAttendanceViolation');
    session(['SecondAttemptAttendanceViolation'=>$SecondAttemptAttendanceViolation]); //used to create excel sheet
    $ThirdAttemptAttendanceViolation= $request->get('ThirdAttemptAttendanceViolation');
    session(['ThirdAttemptAttendanceViolation'=>$ThirdAttemptAttendanceViolation]); //used to create excel sheet
    $Withdrawal= $request->get('Withdrawal');
    session(['Withdrawal'=>$Withdrawal]); //used to create excel sheet
    $DelayedGraduation= $request->get('delayedGraduation');
    session(['DelayedGraduation'=>$DelayedGraduation]); //used to create excel sheet

    //check current user role
    $current_user_role = Auth::user()->roles->first()->name;

    switch ($current_user_role) {
      case 'admin': // same old code
      $query = DB::table('students')->select('*');
      if ($fname) {
        $query->where('FirstName', 'LIKE', '%'.$fname.'%');
      }

      if ($mname) {
        $query->where('MiddleName', 'LIKE', '%'.$mname.'%');
      }

      if ($lname) {
        $query->where('LastName', 'LIKE', '%'.$lname.'%');
      }

      if ($NationalID) {
        $query->where('NationalID', 'LIKE', '%'.$NationalID.'%');
      }

      if ($Badge) {
        $query->where('Badge', 'LIKE', '%'.$Badge.'%');
      }

      if ($Status) {
        $query->whereIn('Status', $Status);
      }

      if ($Stream) {
        $query->whereIn('Stream', $Stream);
      }

      if ($Batch) {
        $query->whereIn('Batch', $Batch);
      }

      if ($StudentNo) {
        $query->where('StudentNo', 'LIKE', '%'.$StudentNo.'%');
      }

      if ($Mobile) {
        $query->where('Mobile', 'LIKE', '%'.$Mobile.'%');
      }

      if ($KSAUHSEmail) {
        $query->where('KSAUHSEmail', 'LIKE', '%'.$KSAUHSEmail.'%');
      }

      if ($NGHAEmail) {
        $query->where('NGHAEmail', 'LIKE', '%'.$NGHAEmail.'%');
      }

      if ($PersonalEmail) {
        $query->where('PersonalEmail', 'LIKE', '%'.$PersonalEmail.'%');
      }

      if ($GraduateExpectationsYear) {
        $query->whereIn('GraduateExpectationsYear',$GraduateExpectationsYear);
      }

      if ($LastActivationDate) {
        $query->where('LastActivationDate', '=', $LastActivationDate.'%');
      }

      if ($Dismissed) {
        $query->where('Dismissed', 'LIKE', '%'.$Dismissed.'%');
      }

      if ($FirstBlockDrop) {
        $query->where('FirstBlockDrop', 'LIKE', '%'.$FirstBlockDrop.'%');
      }

      if ($FirstPostpone) {
        $query->where('FirstPostpone', 'LIKE', '%'.$FirstPostpone.'%');
      }

      if ($FirstAcademicViolation) {
        $query->where('FirstAcademicViolation', 'LIKE', '%'.$FirstAcademicViolation.'%');
      }

      if ($SecondBlockDrop) {
        $query->where('SecondBlockDrop', 'LIKE', '%'.$SecondBlockDrop.'%');
      }

      if ($SecondPostpone) {
        $query->where('SecondPostpone', 'LIKE', '%'.$SecondPostpone.'%');
      }

      if ($SecondAcademicViolation) {
        $query->where('SecondAcademicViolation', 'LIKE', '%'.$SecondAcademicViolation.'%');
      }

      if ($ThirdBlockDrop) {
        $query->where('ThirdBlockDrop', 'LIKE', '%'.'LIKE', '%'.$ThirdBlockDrop.'%');
      }

      if ($ThirdPostpone) {
        $query->where('ThirdPostpone', 'LIKE', '%'.$ThirdPostpone.'%');
      }

      if ($ThirdAcademicViolation) {
        $query->where('ThirdAcademicViolation', 'LIKE', '%'.$ThirdAcademicViolation.'%');
      }

      if ($FirstAttemptAttendanceViolation) {
        $query->where('FirstAttemptAttendanceViolation', 'LIKE', '%'.$FirstAttemptAttendanceViolation.'%');
      }

      if ($SecondAttemptAttendanceViolation) {
        $query->where('SecondAttemptAttendanceViolation', 'LIKE', '%'.$SecondAttemptAttendanceViolation.'%');
      }

      if ($ThirdAttemptAttendanceViolation) {
        $query->where('ThirdAttemptAttendanceViolation', 'LIKE', '%'.$ThirdAttemptAttendanceViolation.'%');
      }

      if ($Withdrawal) {
        $query->where('Withdrawal', 'LIKE', '%'.$Withdrawal.'%');
      }

      if ($DelayedGraduation){
      $query->whereRaw('Batch != GraduationBatch');
      }
      session(['SR'=>$query->orderBy('FirstName', 'asc')->get()]);
      Session::forget('search');
      $searchResults = $query->orderBy('FirstName', 'asc')->paginate(5);
      break;

      case 'male-manager':
      case 'male-officer':
      $query = Student::where('Gender', '=', 'm');
      if ($fname) {
        $query->where('FirstName', 'LIKE', '%'.$fname.'%');
      }

      if ($mname) {
        $query->where('MiddleName', 'LIKE', '%'.$mname.'%');
      }

      if ($lname) {
        $query->where('LastName', 'LIKE', '%'.$lname.'%');
      }

      if ($NationalID) {
        $query->where('NationalID', 'LIKE', '%'.$NationalID.'%');
      }

      if ($Badge) {
        $query->where('Badge', 'LIKE', '%'.$Badge.'%');
      }

      if ($Status) {
        $query->whereIn('Status', $Status);
      }

      if ($Stream) {
        $query->whereIn('Stream', $Stream);
      }

      if ($Batch) {
        $query->whereIn('Batch', $Batch);
      }

      if ($StudentNo) {
        $query->where('StudentNo', 'LIKE', '%'.$StudentNo.'%');
      }

      if ($Mobile) {
        $query->where('Mobile', 'LIKE', '%'.$Mobile.'%');
      }

      if ($KSAUHSEmail) {
        $query->where('KSAUHSEmail', 'LIKE', '%'.$KSAUHSEmail.'%');
      }

      if ($NGHAEmail) {
        $query->where('NGHAEmail', 'LIKE', '%'.$NGHAEmail.'%');
      }

      if ($PersonalEmail) {
        $query->where('PersonalEmail', 'LIKE', '%'.$PersonalEmail.'%');
      }

      if ($GraduateExpectationsYear) {
        $query->whereIn('GraduateExpectationsYear',$GraduateExpectationsYear);
      }

      if ($LastActivationDate) {
        $query->where('LastActivationDate', '=', $LastActivationDate.'%');
      }

      if ($Dismissed) {
        $query->where('Dismissed', 'LIKE', '%'.$Dismissed.'%');
      }

      if ($FirstBlockDrop) {
        $query->where('FirstBlockDrop', 'LIKE', '%'.$FirstBlockDrop.'%');
      }

      if ($FirstPostpone) {
        $query->where('FirstPostpone', 'LIKE', '%'.$FirstPostpone.'%');
      }

      if ($FirstAcademicViolation) {
        $query->where('FirstAcademicViolation', 'LIKE', '%'.$FirstAcademicViolation.'%');
      }

      if ($SecondBlockDrop) {
        $query->where('SecondBlockDrop', 'LIKE', '%'.$SecondBlockDrop.'%');
      }

      if ($SecondPostpone) {
        $query->where('SecondPostpone', 'LIKE', '%'.$SecondPostpone.'%');
      }

      if ($SecondAcademicViolation) {
        $query->where('SecondAcademicViolation', 'LIKE', '%'.$SecondAcademicViolation.'%');
      }

      if ($ThirdBlockDrop) {
        $query->where('ThirdBlockDrop', 'LIKE', '%'.'LIKE', '%'.$ThirdBlockDrop.'%');
      }

      if ($ThirdPostpone) {
        $query->where('ThirdPostpone', 'LIKE', '%'.$ThirdPostpone.'%');
      }

      if ($ThirdAcademicViolation) {
        $query->where('ThirdAcademicViolation', 'LIKE', '%'.$ThirdAcademicViolation.'%');
      }

      if ($FirstAttemptAttendanceViolation) {
        $query->where('FirstAttemptAttendanceViolation', 'LIKE', '%'.$FirstAttemptAttendanceViolation.'%');
      }

      if ($SecondAttemptAttendanceViolation) {
        $query->where('SecondAttemptAttendanceViolation', 'LIKE', '%'.$SecondAttemptAttendanceViolation.'%');
      }

      if ($ThirdAttemptAttendanceViolation) {
        $query->where('ThirdAttemptAttendanceViolation', 'LIKE', '%'.$ThirdAttemptAttendanceViolation.'%');
      }

      if ($Withdrawal) {
        $query->where('Withdrawal', 'LIKE', '%'.$Withdrawal.'%');
      }

      if ($DelayedGraduation){
      $query->whereRaw('Batch != GraduationBatch');
      }
      session(['SR'=>$query->get()]);
      Session::forget('search');
      $searchResults = $query->orderBy('FirstName', 'asc')->paginate(5);
      break;

      case 'female-manager':
      case 'female-officer':
      $query = Student::where('Gender', '=', 'f');
      if ($fname) {
        $query->where('FirstName', 'LIKE', '%'.$fname.'%');
      }

      if ($mname) {
        $query->where('MiddleName', 'LIKE', '%'.$mname.'%');
      }

      if ($lname) {
        $query->where('LastName', 'LIKE', '%'.$lname.'%');
      }

      if ($NationalID) {
        $query->where('NationalID', 'LIKE', '%'.$NationalID.'%');
      }

      if ($Badge) {
        $query->where('Badge', 'LIKE', '%'.$Badge.'%');
      }

      if ($Status) {
        $query->whereIn('Status', $Status);
      }

      if ($Stream) {
        $query->whereIn('Stream', $Stream);
      }

      if ($Batch) {
        $query->whereIn('Batch', $Batch);
      }

      if ($StudentNo) {
        $query->where('StudentNo', 'LIKE', '%'.$StudentNo.'%');
      }

      if ($Mobile) {
        $query->where('Mobile', 'LIKE', '%'.$Mobile.'%');
      }

      if ($KSAUHSEmail) {
        $query->where('KSAUHSEmail', 'LIKE', '%'.$KSAUHSEmail.'%');
      }

      if ($NGHAEmail) {
        $query->where('NGHAEmail', 'LIKE', '%'.$NGHAEmail.'%');
      }

      if ($PersonalEmail) {
        $query->where('PersonalEmail', 'LIKE', '%'.$PersonalEmail.'%');
      }

      if ($GraduateExpectationsYear) {
        $query->whereIn('GraduateExpectationsYear',$GraduateExpectationsYear);
      }

      if ($LastActivationDate) {
        $query->where('LastActivationDate', '=', $LastActivationDate.'%');
      }

      if ($Dismissed) {
        $query->where('Dismissed', 'LIKE', '%'.$Dismissed.'%');
      }

      if ($FirstBlockDrop) {
        $query->where('FirstBlockDrop', 'LIKE', '%'.$FirstBlockDrop.'%');
      }

      if ($FirstPostpone) {
        $query->where('FirstPostpone', 'LIKE', '%'.$FirstPostpone.'%');
      }

      if ($FirstAcademicViolation) {
        $query->where('FirstAcademicViolation', 'LIKE', '%'.$FirstAcademicViolation.'%');
      }

      if ($SecondBlockDrop) {
        $query->where('SecondBlockDrop', 'LIKE', '%'.$SecondBlockDrop.'%');
      }

      if ($SecondPostpone) {
        $query->where('SecondPostpone', 'LIKE', '%'.$SecondPostpone.'%');
      }

      if ($SecondAcademicViolation) {
        $query->where('SecondAcademicViolation', 'LIKE', '%'.$SecondAcademicViolation.'%');
      }

      if ($ThirdBlockDrop) {
        $query->where('ThirdBlockDrop', 'LIKE', '%'.'LIKE', '%'.$ThirdBlockDrop.'%');
      }

      if ($ThirdPostpone) {
        $query->where('ThirdPostpone', 'LIKE', '%'.$ThirdPostpone.'%');
      }

      if ($ThirdAcademicViolation) {
        $query->where('ThirdAcademicViolation', 'LIKE', '%'.$ThirdAcademicViolation.'%');
      }

      if ($FirstAttemptAttendanceViolation) {
        $query->where('FirstAttemptAttendanceViolation', 'LIKE', '%'.$FirstAttemptAttendanceViolation.'%');
      }

      if ($SecondAttemptAttendanceViolation) {
        $query->where('SecondAttemptAttendanceViolation', 'LIKE', '%'.$SecondAttemptAttendanceViolation.'%');
      }

      if ($ThirdAttemptAttendanceViolation) {
        $query->where('ThirdAttemptAttendanceViolation', 'LIKE', '%'.$ThirdAttemptAttendanceViolation.'%');
      }

      if ($Withdrawal) {
        $query->where('Withdrawal', 'LIKE', '%'.$Withdrawal.'%');
      }

      if ($DelayedGraduation){
      $query->whereRaw('Batch != GraduationBatch');
      }
      session(['SR'=>$query->get()]);
      Session::forget('search');
      $searchResults = $query->orderBy('FirstName', 'asc')->paginate(5);
      break;
    }

    /*adding session for exporting the result and removing old session
    session(['SR'=>$query->get()]);
    Session::forget('search');
    */

    return view('advanced_search_result',compact('searchResults'));
  }

  /**
  * Update student personal info
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function update_personal(Request $request)
  {
    // Validate the form data
    $this->validate($request, [
      'ArabicFirstName' => 'required',
      'ArabicMiddleName' => 'required',
      'ArabicLastName' => 'required',
    ]);

    $id = $request->get('id');
    $ArabicFirstName = $request->get('ArabicFirstName');
    $ArabicMiddleName = $request->get('ArabicMiddleName');
    $ArabicLastName = $request->get('ArabicLastName');

    //$student = new Student();
    $student = Student::where('id', '=', $id)->first();

    $query = Student::where('id', '=', $id)->update(
      ['ArabicFirstName' => $ArabicFirstName ,
      'ArabicMiddleName' => $ArabicMiddleName ,
      'ArabicLastName' => $ArabicLastName]);

      if ($query) {
        // log this activity
        activity()
        ->performedOn($student)
        ->causedBy(auth()->user())
        ->useLog('Update')
        ->withProperties(['ArabicFirstName' => $student->ArabicFirstName,
        'ArabicMiddleName'=> $student->ArabicMiddleName,
        'ArabicLastName'=> $student->ArabicLastName])
        ->log('Update Student Personal Info, Student id: '.$id);

        return back();
      }
    }

    /**
    * Update student academic info
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function update_academic(Request $request)
    {
      // Validate the form data
      $this->validate($request, [
        'GraduationBatch' => 'required|numeric|min:1',
        'Stream' => 'required|numeric|min:1'
      ]);

      $id = $request->get('id');
      $GraduationBatch = $request->get('GraduationBatch');
      $Stream = $request->get('Stream');
      $FirstAcademicViolation = $request->get('FirstAcademicViolation');
      $FirstAttemptAttendanceViolation = $request->get('FirstAttemptAttendanceViolation');
      $SecondAcademicViolation = $request->get('SecondAcademicViolation');
      $SecondAttemptAttendanceViolation = $request->get('SecondAttemptAttendanceViolation');
      $ThirdAcademicViolation = $request->get('ThirdAcademicViolation');
      $ThirdAttemptAttendanceViolation = $request->get('ThirdAttemptAttendanceViolation');

      //$student = new Student();
      $student = Student::where('id', '=', $id)->first();

      if ($GraduationBatch){
        $query = Student::where('id', '=', $id)->update(
          ['GraduationBatch' => $GraduationBatch]);
          if ($query)
          {
            activity()
            ->performedOn($student)
            ->causedBy(auth()->user())
            ->useLog('Update')
            ->withProperties(['GraduationBatch' => $student->GraduationBatch])
            ->log('Update Student Academic Info, Student id: '.$id);
          }
      }

      if ($Stream){
        $query = Student::where('id', '=', $id)->update(
          ['Stream' => $Stream]);

          if ($query)
          {
          activity()
          ->performedOn($student)
          ->causedBy(auth()->user())
          ->useLog('Update')
          ->withProperties(['Stream' => $student->Stream])
          ->log('Update Student Academic Info, Student id: '.$id);
        }
      }

      if ($FirstAcademicViolation){
        $query = Student::where('id', '=', $id)->update(
          ['FirstAcademicViolation' => $FirstAcademicViolation]);

          if ($query)
          {
          activity()
          ->performedOn($student)
          ->causedBy(auth()->user())
          ->useLog('Update')
          ->withProperties(['FirstAcademicViolation' => $student->FirstAcademicViolation])
          ->log('Update Student Academic Info, Student id: '.$id);
        }
      }

      if ($FirstAttemptAttendanceViolation){
        $query = Student::where('id', '=', $id)->update(
          ['FirstAttemptAttendanceViolation' => $FirstAttemptAttendanceViolation]);

          if ($query)
          {
          activity()
          ->performedOn($student)
          ->causedBy(auth()->user())
          ->useLog('Update')
          ->withProperties(['FirstAttemptAttendanceViolation' => $student->FirstAttemptAttendanceViolation])
          ->log('Update Student Academic Info, Student id: '.$id);
        }
      }

      if ($SecondAcademicViolation){
        $query = Student::where('id', '=', $id)->update(
          ['SecondAcademicViolation' => $SecondAcademicViolation]);

          if ($query)
          {
          activity()
          ->performedOn($student)
          ->causedBy(auth()->user())
          ->useLog('Update')
          ->withProperties(['SecondAcademicViolation' => $student->SecondAcademicViolation])
          ->log('Update Student Academic Info, Student id: '.$id);
        }
      }

      if ($SecondAttemptAttendanceViolation){
        $query = Student::where('id', '=', $id)->update(
          ['SecondAttemptAttendanceViolation' => $SecondAttemptAttendanceViolation]);

          if ($query)
          {
          activity()
          ->performedOn($student)
          ->causedBy(auth()->user())
          ->useLog('Update')
          ->withProperties(['SecondAttemptAttendanceViolation' => $student->SecondAttemptAttendanceViolation])
          ->log('Update Student Academic Info, Student id: '.$id);
        }
      }

      if ($ThirdAcademicViolation){
        $query = Student::where('id', '=', $id)->update(
          ['ThirdAcademicViolation' => $ThirdAcademicViolation]);

          if ($query)
          {
          activity()
          ->performedOn($student)
          ->causedBy(auth()->user())
          ->useLog('Update')
          ->withProperties(['ThirdAcademicViolation' => $student->ThirdAcademicViolation])
          ->log('Update Student Academic Info, Student id: '.$id);
        }
      }

      if ($ThirdAttemptAttendanceViolation){
        $query = Student::where('id', '=', $id)->update(
          ['ThirdAttemptAttendanceViolation' => $ThirdAttemptAttendanceViolation]);

          if ($query)
          {
          activity()
          ->performedOn($student)
          ->causedBy(auth()->user())
          ->useLog('Update')
          ->withProperties(['ThirdAttemptAttendanceViolation' => $student->ThirdAttemptAttendanceViolation])
          ->log('Update Student Academic Info, Student id: '.$id);
        }
      }

      return back();
    }

    /**
    * Update student contact info
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function update_contact(Request $request)
    {
      // Validate the form data
      $this->validate($request, [
        'Mobile' => 'required',
      ]);

      $id = $request->get('id');
      $student = Student::where('id', '=', $id)->first();

      $Mobile = $request->get('Mobile');
      $query = Student::where('id', '=', $id)->update(['Mobile' => $Mobile]);
      if ($query) {

        activity()
        ->performedOn($student)
        ->causedBy(auth()->user())
        ->useLog('Update')
        ->withProperties(['Mobile' => $student->Mobile])
        ->log('Update Student Mobile Number, Student id: '.$id);
        return back();

      }
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
      //
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function upload_attachment(Request $request)
    {

    $this->validate($request, [
      'attch_title'=>'required|max:50',
      'attachment'=>'required|mimes:doc,pdf,docx,jpeg,png,jpg|max:2000',// 2MB
    ]);

    $input = $request->except('_token');
    if ($file = $request->file('attachment'))
    {
      $name = $file->getClientOriginalName();
      $file->move(public_path('attachments'),$name);
      $input['file'] = $name;

    }
    //'title','image','stu_id'
    $input['title']=$request->get('attch_title');
    $input['student_id']=$request->get('id');
    $attachment = Attachment::create($input);
    if ($attachment){ // stay at attachments page and disply a link to the uploaded file
        return back();
    }
    else { // stay at attachments page and display an error message (Something went wrong .. try again)
      //return $request->all();
    }
    }



    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
      $student = Student::findOrFail($id);
      $attachments = $student->attachment;
      return view('student.show',compact('student','attachments'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
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
    public function update(Request $request, $id)
    {
      //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
      //
    }
  }
