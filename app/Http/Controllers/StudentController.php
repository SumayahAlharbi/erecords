<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use DB;
use PDF;
use Session;



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

    $searchResults = Student::where('Badge', '=', $search)
    ->orWhere('NationalID', '=', $search)
    ->orWhere('Batch', 'LIKE', '%'.$search.'%')
    ->orWhere('Stream', 'LIKE', '%'.$search.'%')
    ->orWhere('Status', 'LIKE', '%'.$search.'%')
    ->orWhere('FirstName', 'LIKE', '%'.$search.'%')
    ->orWhere('LastName', 'LIKE', '%'.$search.'%')
    ->orWhere('StudentNo', 'LIKE', '%'.$search.'%')
    ->paginate(5);
    return view('search_result',compact('searchResults','search'));
  }


  // this function is for exporting the search result to PDF
  public function export_pdf()
  {
        if (Session::has('SR')) {
            $searchResults =session('SR')->all();
            //return view('ExportPDFSearch',compact('searchResults'));
            $pdf = PDF::loadView('ExportPDFSearch',compact('searchResults'));
            $pdf->save(storage_path().'_erecords.pdf');
            return $pdf->download('erecords.pdf');
      }
      else
      {
          $search =session('search');
          // Fetch all students from database
          $searchResults = Student::where('Badge', '=',$search)
          ->orWhere('NationalID', '=', $search)
          ->orWhere('Batch', 'LIKE', '%'.$search.'%')
          ->orWhere('Stream', 'LIKE', '%'.$search.'%')
          ->orWhere('Status', 'LIKE', '%'.$search.'%')
          ->orWhere('FirstName', 'LIKE', '%'.$search.'%')
          ->orWhere('LastName', 'LIKE', '%'.$search.'%')
          ->orWhere('StudentNo', 'LIKE', '%'.$search.'%')
          ->get();

          // Send data to the view using loadView function of PDF facade
          $pdf = PDF::loadView('ExportPDFSearch', compact('searchResults','search'));
          $pdf->save(storage_path().'_erecords.pdf');
          //session->forget('search');
          return $pdf->download('erecords.pdf');
      }
  }

  /**
  * advanced search
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function advanced_search(Request $request)
  {

    $query = DB::table('students')->select('*');

    // text
    $fname= $request->get('FirstName');
    $mname= $request->get('MiddleName');
    $lname= $request->get('LastName');

    $NationalID= $request->get('NationalID');
    $Batch = $request->get('Batch');


    $Badge= $request->get('Badge');
    $Status= $request->get('Status');
    $StudentNo= $request->get('StudentNo');
    $Mobile= $request->get('Mobile');
    $KSAUHSEmail= $request->get('KSAUHSEmail');
    $NGHAEmail= $request->get('NGHAEmail');
    $PersonalEmail= $request->get('PersonalEmail');
    $GraduateExpectationsYear= $request->get('GraduateExpectationsYear');
    $Stream = $request->get('Stream');

    // dates
    $LastActivationDate= $request->get('LastActivationDate');
    $Dismissed= $request->get('Dismissed');
    $FirstBlockDrop= $request->get('FirstBlockDrop');
    $FirstPostpone= $request->get('FirstPostpone');
    $FirstAcademicViolation= $request->get('FirstAcademicViolation');
    $SecondBlockDrop= $request->get('SecondBlockDrop');
    $SecondPostpone= $request->get('SecondPostpone');
    $SecondAcademicViolation= $request->get('SecondAcademicViolation');
    $ThirdBlockDrop= $request->get('ThirdBlockDrop');
    $ThirdPostpone= $request->get('ThirdPostpone');
    $ThirdAcademicViolation= $request->get('ThirdAcademicViolation');
    $FirstAttemptAttendanceViolation= $request->get('FirstAttemptAttendanceViolation');
    $SecondAttemptAttendanceViolation= $request->get('SecondAttemptAttendanceViolation');
    $ThirdAttemptAttendanceViolation= $request->get('ThirdAttemptAttendanceViolation');
    $Withdrawal= $request->get('Withdrawal');

    if ($fname) {
        $query->where('FirstName', '=', $fname);
    }

    if ($mname) {
        $query->where('MiddleName', '=', $mname);
    }

    if ($lname) {
        $query->where('LastName', '=', $lname);
    }

    if ($NationalID) {
        $query->where('NationalID', '=', $NationalID);
    }

    if ($Badge) {
        $query->where('Badge', '=', $Badge);
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
        $query->where('StudentNo', '=', $StudentNo );
    }

    if ($Mobile) {
        $query->where('Mobile', 'LIKE', $Mobile);
    }

    if ($KSAUHSEmail) {
        $query->where('KSAUHSEmail', 'LIKE', $KSAUHSEmail );
    }

    if ($NGHAEmail) {
        $query->where('NGHAEmail', 'LIKE', $NGHAEmail);
    }

    if ($PersonalEmail) {
        $query->where('PersonalEmail', 'LIKE', $PersonalEmail);
    }

    if ($GraduateExpectationsYear) {
        $query->whereIn('GraduateExpectationsYear',$GraduateExpectationsYear);
    }

    if ($LastActivationDate) {
        $query->where('LastActivationDate', '=', $LastActivationDate);
    }

    if ($Dismissed) {
        $query->where('Dismissed', '=', $Dismissed);
    }

    if ($FirstBlockDrop) {
        $query->where('FirstBlockDrop', '=', $FirstBlockDrop);
    }

    if ($FirstPostpone) {
        $query->where('FirstPostpone', '=', $FirstPostpone);
    }

    if ($FirstAcademicViolation) {
        $query->where('FirstAcademicViolation', '=', $FirstAcademicViolation );
    }

    if ($SecondBlockDrop) {
        $query->where('SecondBlockDrop', '=', $SecondBlockDrop);
    }

    if ($SecondPostpone) {
        $query->where('SecondPostpone', '=', $SecondPostpone);
    }

    if ($SecondAcademicViolation) {
        $query->where('SecondAcademicViolation', '=',$SecondAcademicViolation );
    }

    if ($ThirdBlockDrop) {
        $query->where('ThirdBlockDrop', '=',$ThirdBlockDrop );
    }

    if ($ThirdPostpone) {
        $query->where('ThirdPostpone', '=', $ThirdPostpone);
    }

    if ($ThirdAcademicViolation) {
        $query->where('ThirdAcademicViolation', '=', $ThirdAcademicViolation);
    }

    if ($FirstAttemptAttendanceViolation) {
        $query->where('FirstAttemptAttendanceViolation', '=', $FirstAttemptAttendanceViolation);
    }

    if ($SecondAttemptAttendanceViolation) {
        $query->where('SecondAttemptAttendanceViolation', '=', $SecondAttemptAttendanceViolation );
    }

    if ($ThirdAttemptAttendanceViolation) {
        $query->where('ThirdAttemptAttendanceViolation', '=', $ThirdAttemptAttendanceViolation);
    }

    if ($Withdrawal) {
        $query->where('Withdrawal', '=', $Withdrawal);
    }

    //adding session for exporting the result and removing old session
    session(['SR'=>$query->orderBy('FirstName', 'asc')->get()]);
    Session::forget('search');

    $searchResults = $query->orderBy('FirstName', 'asc')->paginate(5);
    return view('advanced_search_result',compact('searchResults'));
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
  public function store(Request $request)
  {
    //
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
    return view('student.show',compact('student'));
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
