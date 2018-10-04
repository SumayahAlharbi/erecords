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
  // every session created on this function is used to create excel sheet
  public function advanced_search(Request $request)
  {

    $query = DB::table('students')->select('*');

    // text
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

    // dates
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
    session(['SR'=>$query->get()]);
    Session::forget('search');

    $searchResults = $query->orderBy('FirstName', 'asc')->paginate(5);
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

    $query = Student::where('id', '=', $id)->update(
      ['ArabicFirstName' => $ArabicFirstName ,
      'ArabicMiddleName' => $ArabicMiddleName ,
      'ArabicLastName' => $ArabicLastName]);

      if ($query) {return back();}
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
        'Batch' => 'required|numeric|min:1',
        'Stream' => 'required|numeric|min:1',
        'FirstAcademicViolation' => 'required',
        'FirstAttemptAttendanceViolation' => 'required',
        'SecondAcademicViolation' => 'required',
        'SecondAttemptAttendanceViolation' => 'required',
        'ThirdAcademicViolation' => 'required',
        'ThirdAttemptAttendanceViolation' => 'required',
      ]);

      $id = $request->get('id');
      $Batch = $request->get('Batch');
      $Stream = $request->get('Stream');
      $FirstAcademicViolation = $request->get('FirstAcademicViolation');
      $FirstAttemptAttendanceViolation = $request->get('FirstAttemptAttendanceViolation');
      $SecondAcademicViolation = $request->get('SecondAcademicViolation');
      $SecondAttemptAttendanceViolation = $request->get('SecondAttemptAttendanceViolation');
      $ThirdAcademicViolation = $request->get('ThirdAcademicViolation');
      $ThirdAttemptAttendanceViolation = $request->get('ThirdAttemptAttendanceViolation');

      $query = Student::where('id', '=', $id)->update(
        ['Batch' => $Batch ,
        'Stream' =>  $Stream,
        'FirstAcademicViolation' =>  $FirstAcademicViolation,
        'FirstAttemptAttendanceViolation' =>  $FirstAttemptAttendanceViolation,
        'SecondAcademicViolation' =>  $SecondAcademicViolation,
        'SecondAttemptAttendanceViolation' =>  $SecondAttemptAttendanceViolation,
        'ThirdAcademicViolation' =>  $ThirdAcademicViolation,
        'ThirdAttemptAttendanceViolation' =>  $ThirdAttemptAttendanceViolation
      ]);

      if ($query) {return back();}
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
      $Mobile = $request->get('Mobile');
      $query = Student::where('id', '=', $id)->update(['Mobile' => $Mobile]);
      if ($query) {return back();}
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
