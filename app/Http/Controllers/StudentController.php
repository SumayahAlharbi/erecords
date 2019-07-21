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
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

use App\Pres;
use App\Std;
use App\Enrl;

class StudentController extends Controller
{

  public function testSIS()
  {

   // students of batch 1
   $students = Pres::Where('STUDENT_STATUS','=','Enrolled Active')
   ->select('FIRST_NAME50','LAST_NAME','EXTERNAL_SYSTEM_ID','NATIONAL_ID','STUDENT_STATUS','CAMPUS_ID')
   ->count();
   return $students;

   //$all = Student::all()->count();
   //return $all;

  }


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

    // Seach in SIS
    $searchResults_SIS = Pres::Select('EMPLID','FIRST_NAME50','LAST_NAME','EXTERNAL_SYSTEM_ID','NATIONAL_ID','STUDENT_STATUS','CAMPUS_ID')
    ->Where('EXTERNAL_SYSTEM_ID', '=', $search)
    ->orWhere('NATIONAL_ID', '=', $search)
    ->orWhereRaw('lower(STUDENT_STATUS) like lower(?)', ["%{$search}%"])
    ->orWhereRaw('lower(FIRST_NAME50) like lower(?)', ["%{$search}%"])
    ->orWhereRaw('lower(LAST_NAME) like lower(?)', ["%{$search}%"])
    ->orWhere('CAMPUS_ID', 'LIKE', '%'.$search.'%')
    ->orderBy('CAMPUS_ID', 'ASC')
    ->distinct('NATIONAL_ID')
    ->SimplePaginate(10);

    $total =  Pres::Select('NATIONAL_ID')
    ->Where('EXTERNAL_SYSTEM_ID', '=', $search)
    ->orWhere('NATIONAL_ID', '=', $search)
    ->orWhereRaw('lower(STUDENT_STATUS) like lower(?)', ["%{$search}%"])
    ->orWhereRaw('lower(FIRST_NAME50) like lower(?)', ["%{$search}%"])
    ->orWhereRaw('lower(LAST_NAME) like lower(?)', ["%{$search}%"])
    ->orWhere('CAMPUS_ID', 'LIKE', '%'.$search.'%')
    ->distinct('NATIONAL_ID')->get();

    //return count($total);

    // Seach in app DB
    $searchResults = Student::Select('Batch','Stream','NationalID','GraduationBatch')
    ->where('Badge', '=', $search)
    ->orWhere('NationalID', '=', $search)
    ->orWhere('Stream', 'LIKE', '%'.$search.'%')
    ->orWhere('FirstName', 'LIKE', '%'.$search.'%')
    ->orWhere('LastName', 'LIKE', '%'.$search.'%')
    ->orWhere('StudentNo', 'LIKE', '%'.$search.'%')
    ->get();
    //return $searchResults;

    foreach($searchResults_SIS as $k => $obj) {
    $obj->{'batch'} = '';
    $obj->{'stream'} = '';
    $obj->{'graduationBatch'} = '';
    $obj->{'profile'} = false;
    }


    foreach ($searchResults_SIS as $key1 => $value1) {
        foreach ($searchResults as $key2 => $value2) {
            if ($value1['national_id'] == $value2['NationalID']) {
                $value1['batch']=$value2['Batch'];
                $value1['stream']=$value2['Stream'];
                $value1['profile']= true;
                $value1['graduationBatch']=$value2['GraduationBatch'];
            }

        }
      }

    return view('search_result',compact('searchResults_SIS','search','total'));

  }


  // this function is for exporting the search result to PDF
  public function export_pdf()
  {
    if (Session::has('SR')) {
      $searchResults_SIS =session('SR')->all();

      $fname = session('fname');
      $status = session('Status');
      $lname = session('lname');
      $NationalID = session('NationalID');
      $Badge = session('Badge');
      $StudentNo = session('StudentNo');
      // Seach in app DB
      $searchResults = Student::Select('Batch','Stream','NationalID')
      ->where('Badge', '=', $Badge)
      ->orWhere('NationalID', '=', $NationalID)
      ->orWhere('FirstName', 'LIKE', '%'.$fname.'%')
      ->orWhere('LastName', 'LIKE', '%'.$lname.'%')
      ->orWhere('StudentNo', 'LIKE', '%'.$StudentNo.'%')
      ->get();

      foreach($searchResults_SIS as $k => $obj) {
      $obj->{'batch'} = '';
      $obj->{'stream'} = '';
      }


      foreach ($searchResults_SIS as $key1 => $value1) {
          foreach ($searchResults as $key2 => $value2) {
              if ($value1['national_id'] == $value2['NationalID']) {
                  $value1['batch']=$value2['Batch'];
                  $value1['stream']=$value2['Stream'];
              }
          }
        }

      $pdf = PDF::loadView('ExportPDFSearch', compact('searchResults_SIS'));
      $pdf->save(public_path('/mpdf-temp/').'export_students.pdf');
      return $pdf->download('export_students.pdf');
    }
    else
    {
      $search =session('search');

      $searchResults_SIS = Pres::Select('EMPLID','FIRST_NAME50','LAST_NAME','EXTERNAL_SYSTEM_ID','NATIONAL_ID','STUDENT_STATUS','CAMPUS_ID')
      ->Where('EXTERNAL_SYSTEM_ID', '=', $search)
      ->orWhere('NATIONAL_ID', '=', $search)
      ->orWhereRaw('lower(STUDENT_STATUS) like lower(?)', ["%{$search}%"])
      ->orWhereRaw('lower(FIRST_NAME50) like lower(?)', ["%{$search}%"])
      ->orWhereRaw('lower(LAST_NAME) like lower(?)', ["%{$search}%"])
      ->orWhere('CAMPUS_ID', 'LIKE', '%'.$search.'%')
      ->orderBy('CAMPUS_ID', 'ASC')
      ->distinct()
      ->get();

      // Seach in app DB
      $searchResults = Student::Select('Batch','Stream','NationalID')
      ->where('Badge', '=', $search)
      ->orWhere('NationalID', '=', $search)
      ->orWhere('Stream', 'LIKE', '%'.$search.'%')
      ->orWhere('FirstName', 'LIKE', '%'.$search.'%')
      ->orWhere('LastName', 'LIKE', '%'.$search.'%')
      ->orWhere('StudentNo', 'LIKE', '%'.$search.'%')
      ->get();

      foreach($searchResults_SIS as $k => $obj) {
      $obj->{'batch'} = '';
      $obj->{'stream'} = '';
      }


      foreach ($searchResults_SIS as $key1 => $value1) {
          foreach ($searchResults as $key2 => $value2) {
              if ($value1['national_id'] == $value2['NationalID']) {
                  $value1['batch']=$value2['Batch'];
                  $value1['stream']=$value2['Stream'];
              }
          }
        }

      $pdf = PDF::loadView('ExportPDFSearch', compact('searchResults_SIS','search'));
      $pdf->save(public_path('/mpdf-temp/').'export_students.pdf');
      return $pdf->download('export_students.pdf');
    }
  }


  // this function is for creating the Summery Report
  public function summeryReport_pdf()
  {
    $batches = Student::distinct()->get(['Batch']);

    //$recordClosed = [];
    //$cancelled = [];
    //$enrolledActive = [];
    //$graduated = [];
    //$withdrawal = [];
    //$dismissed = [];
    //$postponed = [];
    //$total = [];

    $recordClosed = Pres::where('STUDENT_STATUS', '=', 'Record Closed')->distinct()->get(['NATIONAL_ID']);
    $cancelled = Pres::where('STUDENT_STATUS', '=', 'Cancelled')->distinct()->get(['NATIONAL_ID']);
    $enrolledActive = Pres::where('STUDENT_STATUS', '=', 'Enrolled Active')->distinct()->get(['NATIONAL_ID']);
    $dismissed = Pres::where('STUDENT_STATUS', '=', 'Dismissed')->distinct()->get(['NATIONAL_ID']);
    $withdrawal = Pres::where('STUDENT_STATUS', '=', 'Withdrawn')->distinct()->get(['NATIONAL_ID']);
    $postponed = Pres::where('STUDENT_STATUS', '=', 'Postponed')->distinct()->get(['NATIONAL_ID']);
    $graduated = Pres::where('STUDENT_STATUS', '=', 'Graduated')->distinct()->get(['NATIONAL_ID']);

/*
    $total_recordClosed = Pres::where('STUDENT_STATUS', '=', 'Record Closed')->distinct()->get(['NATIONAL_ID'])->count();
    $total_cancelled = Pres::where('STUDENT_STATUS', '=', 'Cancelled')->distinct()->get(['NATIONAL_ID'])->count();
    $total_enrolledActive = Pres::where('STUDENT_STATUS', '=', 'Enrolled Active')->distinct()->get(['NATIONAL_ID'])->count();
    $total_graduated = Pres::where('STUDENT_STATUS', '=', 'Graduated')->distinct()->get(['NATIONAL_ID'])->count();
    $total_withdrawal = Pres::where('STUDENT_STATUS', '=', 'Withdrawn')->distinct()->get(['NATIONAL_ID'])->count();
    $total_postponed = Pres::where('STUDENT_STATUS', '=', 'Postponed')->distinct()->get(['NATIONAL_ID'])->count();
    $total_dismissed = Pres::where('STUDENT_STATUS', '=', 'Dismissed')->distinct()->get(['NATIONAL_ID'])->count();
*/
    $array_withdrawal ;
    $array_postponed ;
    $array_dismissed ;
    $array_graduated ;
    $array_enrolledActive ;
    $array_cancelled ;
    $array_recordClosed ;
    $total_withdrawal=0;$total_postponed=0;$total_dismissed=0;$total_graduated=0;$total_enrolledActive=0;$total_cancelled=0;$total_recordClosed=0;
    $total_in_each_batch=0;

    foreach ($batches as $key => $value) {

      $query = Student::where('Batch', '=', $value->Batch)->get(['NationalID']);
      $count_withdrawal=0;$count_postponed=0;$count_dismissed=0;$count_graduated=0;$count_enrolledActive=0;$count_cancelled=0;$count_recordClosed=0;

      foreach ($query as $key2 => $value2) {
        foreach ($withdrawal as $key3 => $value3) {

            if ($value3['national_id'] == $value2['NationalID']) {
              $count_withdrawal++;
              $total_withdrawal++;
            }
          }
        }
      $array_withdrawal[] = $count_withdrawal;
      //echo $value['Batch'].$count_withdrawal."</br>";

      foreach ($query as $key2 => $value2) {
        foreach ($postponed as $key3 => $value3) {

            if ($value3['national_id'] == $value2['NationalID']) {
              $count_postponed++;
              $total_postponed++;
            }
          }
        }
      $array_postponed[] = $count_postponed;

      foreach ($query as $key2 => $value2) {
        foreach ($dismissed as $key3 => $value3) {

            if ($value3['national_id'] == $value2['NationalID']) {
              $count_dismissed++;
              $total_dismissed++;
            }
          }
        }
      $array_dismissed[] = $count_dismissed;

      foreach ($query as $key2 => $value2) {
        foreach ($graduated as $key3 => $value3) {

            if ($value3['national_id'] == $value2['NationalID']) {
              $count_graduated++;
              $total_graduated++;
            }
          }
        }
      $array_graduated[] = $count_graduated;

      foreach ($query as $key2 => $value2) {
        foreach ($enrolledActive as $key3 => $value3) {

            if ($value3['national_id'] == $value2['NationalID']) {
              $count_enrolledActive++;
              $total_enrolledActive++;
            }
          }
        }
      $array_enrolledActive[] = $count_enrolledActive;

      foreach ($query as $key2 => $value2) {
        foreach ($cancelled as $key3 => $value3) {

            if ($value3['national_id'] == $value2['NationalID']) {
              $count_cancelled++;
              $total_cancelled++;
            }
          }
        }
      $array_cancelled[] = $count_cancelled;

      foreach ($query as $key2 => $value2) {
        foreach ($recordClosed as $key3 => $value3) {

            if ($value3['national_id'] == $value2['NationalID']) {
              $count_recordClosed++;
              $total_recordClosed++;
            }
          }
        }
      $array_recordClosed[] = $count_recordClosed;

    }

    /*
    print_r($array_withdrawal);
    print_r($array_postponed);
    print_r($array_dismissed);
    print_r($array_graduated);
    print_r($array_enrolledActive);
    print_r($array_cancelled);
    print_r($array_recordClosed);
    */

    // Send data to the view using loadView function of PDF facade
    $pdf = PDF::loadView('SummeryReport', compact(
      'batches','array_withdrawal','array_postponed','array_dismissed','array_graduated','array_enrolledActive','array_cancelled','array_recordClosed',
      'total_recordClosed','total_cancelled','total_enrolledActive','total_graduated','total_withdrawal','total_postponed','total_dismissed'));
    $pdf->save(public_path('/mpdf-temp/').'SummeryReport.pdf');
    return $pdf->download('SummeryReport.pdf');

  }

  // this function is for creating the Student Details Report
  public function studentReport_pdf($id)
  {
    $student = Pres::findOrFail($id);
    $ksauhs_email = Pres::Select('EMAIL_ADDR')
    ->where('EMPLID', '=', $id)
    ->where('E_ADDR_TYPE', '=', 'CAMP')
    ->first();

    $nationl_id = $student->national_id;

    // Student info from the app DB
    $stu = Student::Where('NationalID', '=', $nationl_id)->first();

    $pdf = PDF::loadView('StudentReport',compact('student','ksauhs_email','stu'));
    $pdf->save(public_path('/mpdf-temp/').'StudentReport.pdf');
    return $pdf->download('StudentReport.pdf');
    //$pdf->save(storage_path().'_StudentReport.pdf');
    //return $pdf->download('StudentReport.pdf');
  }

  public function advanced_search_form ()
  {
    $batches = Student::distinct()->select('Batch')->get();
    $streams = Student::distinct()->select('Stream')->get();
    $status = Pres::distinct()->select('STUDENT_STATUS')->get();

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

      $query = Pres::Select('EMPLID','FIRST_NAME50','LAST_NAME','EXTERNAL_SYSTEM_ID','NATIONAL_ID','STUDENT_STATUS','CAMPUS_ID');
      $total_query = Pres::Select('NATIONAL_ID');

      if ($fname) {
        $query->whereRaw('lower(FIRST_NAME50) like lower(?)', ["%{$fname}%"]);
        $total_query->whereRaw('lower(FIRST_NAME50) like lower(?)', ["%{$fname}%"]);
      }

      if ($mname) {
        $query->whereRaw('lower(MIDDLE_NAME) like lower(?)', ["%{$mname}%"]);
        $total_query->whereRaw('lower(MIDDLE_NAME) like lower(?)', ["%{$mname}%"]);
      }

      if ($lname) {
        $query->whereRaw('lower(LAST_NAME) like lower(?)', ["%{$lname}%"]);
        $total_query->whereRaw('lower(LAST_NAME) like lower(?)', ["%{$lname}%"]);
      }

      if ($NationalID) {
        $query->whereRaw('lower(NATIONAL_ID) like lower(?)', ["%{$NationalID}%"]);
        $total_query->whereRaw('lower(NATIONAL_ID) like lower(?)', ["%{$NationalID}%"]);
      }

      if ($Badge) {
        $query->whereRaw('lower(EXTERNAL_SYSTEM_ID) like lower(?)', ["%{$Badge}%"]);
        $total_query->whereRaw('lower(EXTERNAL_SYSTEM_ID) like lower(?)', ["%{$Badge}%"]);
      }

      if ($Status) {
        $query->whereIn('STUDENT_STATUS', $Status);
        $total_query->whereIn('STUDENT_STATUS', $Status);
      }

      /*if ($Stream) {
        $query->whereIn('Stream', $Stream);
      }

      if ($Batch) {
        $query->whereIn('Batch', $Batch);
      }*/

      if ($StudentNo) {
        $query->whereRaw('lower(CAMPUS_ID) like lower(?)', ["%{$StudentNo}%"]);
        $total_query->whereRaw('lower(CAMPUS_ID) like lower(?)', ["%{$StudentNo}%"]);
      }

      if ($Mobile) {
        $query->whereRaw('lower(PHONE) like lower(?)', ["%{$Mobile}%"]);
        $total_query->whereRaw('lower(PHONE) like lower(?)', ["%{$Mobile}%"]);
      }

      if ($KSAUHSEmail) {
        $query->where('E_ADDR_TYPE', '=', 'CAMP')
        ->whereRaw('lower(EMAIL_ADDR) like lower(?)', ["%{$KSAUHSEmail}%"]);
        $total_query->where('E_ADDR_TYPE', '=', 'CAMP')
        ->whereRaw('lower(EMAIL_ADDR) like lower(?)', ["%{$KSAUHSEmail}%"]);
      }

      /*
      if ($NGHAEmail) {
        $query->where('NGHAEmail', 'LIKE', '%'.$NGHAEmail.'%');
      }
      */

      if ($PersonalEmail) {
        $query->where('E_ADDR_TYPE', '=', 'HOME')
        ->whereRaw('lower(EMAIL_ADDR) like lower(?)', ["%{$PersonalEmail}%"]);
        $total_query->where('E_ADDR_TYPE', '=', 'HOME')
        ->whereRaw('lower(EMAIL_ADDR) like lower(?)', ["%{$PersonalEmail}%"]);
      }

      if ($LastActivationDate) {
        $query->whereRaw('lower(LastActivationDate) like lower(?)', ["%{$LastActivationDate}%"]);
        $total_query->whereRaw('lower(LastActivationDate) like lower(?)', ["%{$LastActivationDate}%"]);
      }

      /*
      if ($GraduateExpectationsYear) {
        $query->whereIn('GraduateExpectationsYear',$GraduateExpectationsYear);
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
      */

      session(['SR'=>$query->orderBy('CAMPUS_ID', 'ASC')->get()]);
      Session::forget('search');

      $searchResults_SIS = $query->orderBy('CAMPUS_ID', 'ASC')->distinct()->SimplePaginate(10);

      $total =  $total_query->distinct('NATIONAL_ID')->get();

      // Seach in app DB
      $searchResults = Student::Select('Batch','Stream','NationalID','GraduationBatch')
      ->where('Badge', '=', $Badge)
      ->orWhere('NationalID', '=', $NationalID)
      ->orWhere('Stream', '=', $Stream)
      ->orWhere('FirstName', 'LIKE', '%'.$fname.'%')
      ->orWhere('LastName', 'LIKE', '%'.$lname.'%')
      ->orWhere('StudentNo', 'LIKE', '%'.$StudentNo.'%')
      ->get();

      foreach($searchResults_SIS as $k => $obj) {
      $obj->{'batch'} = '';
      $obj->{'stream'} = '';
      $obj->{'graduationBatch'} = '';
      $obj->{'profile'} = false;
      }


      foreach ($searchResults_SIS as $key1 => $value1) {
          foreach ($searchResults as $key2 => $value2) {
              if ($value1['national_id'] == $value2['NationalID']) {
                  $value1['batch']=$value2['Batch'];
                  $value1['stream']=$value2['Stream'];
                  $value1['profile']= true;
                  $value1['graduationBatch']=$value2['GraduationBatch'];
              }

          }
        }

    return view('advanced_search_result',compact('searchResults_SIS','total'));
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

    $requestData = $request->except('_token');

    $id = $request->get('id');
    $student = Student::where('id', '=', $id)
    ->select('id','ArabicFirstName','ArabicMiddleName','ArabicLastName')
    ->first();

    foreach ($requestData as $key => $value) {
      if ($requestData[$key] != $student[$key])
      {
        $query = Student::where('id', '=', $id)->update([$key => $requestData[$key]]);
        if ($query)
        {
          activity()
          ->performedOn($student)
          ->causedBy(auth()->user())
          ->useLog('Update')
          ->withProperties(['old' => $student[$key],'current'=>$requestData[$key]])
          ->log('Update "'.$key.'", Student id: '.$id);
        }
      }
    }
    return back()->with('update_personal','Student Personal Information Updated Successfully!');

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

    $requestData = $request->except('_token','update_academic');

    $id = $request->get('id');
    $student = Student::where('id', '=', $id)
    ->select('id','GraduationBatch','Stream','FirstAcademicViolation','FirstAttemptAttendanceViolation','SecondAcademicViolation','SecondAttemptAttendanceViolation','ThirdAcademicViolation','ThirdAttemptAttendanceViolation')
    ->first();

    foreach ($requestData as $key => $value) {
      if ($requestData[$key] != $student[$key])
      {
        $query = Student::where('id', '=', $id)->update([$key => $requestData[$key]]);
        if ($query)
        {
          activity()
          ->performedOn($student)
          ->causedBy(auth()->user())
          ->useLog('Update')
          ->withProperties(['old' => "".$student[$key]."",'current'=>$requestData[$key]])
          ->log('Update "'.$key.'", Student id: '.$id);
        }
      }
    }

    return back()->with('update_academic','Student Academic Information Updated Successfully!');

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

    $requestData = $request->except('_token','update_academic');

    $id = $request->get('id');
    $student = Student::where('id', '=', $id)
    ->select('Mobile','NGHAEmail')
    ->first();

    //$Mobile = $request->get('Mobile');

    foreach ($requestData as $key => $value) {
      if ($requestData[$key] != $student[$key])
      {
        $query = Student::where('id', '=', $id)->update([$key => $requestData[$key]]);
        if ($query)
        {
          activity()
          ->performedOn($student)
          ->causedBy(auth()->user())
          ->useLog('Update')
          ->withProperties(['old' => "".$student[$key]."",'current'=>$requestData[$key]])
          ->log('Update "'.$key.'", Student id: '.$id);
        }
      }
    }

    return back()->with('update_contact','Student Contact Information Updated Successfully!');

  }

  /**
  * Show the form for creating a new resource.
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function create($id)
  {
    $student = Pres::FindOrFail($id);

    $ksauhs_email = Pres::Select('EMAIL_ADDR')
    ->where('EMPLID', '=', $id)
    ->where('E_ADDR_TYPE', '=', 'CAMP')
    ->first();

    $personal_email = Pres::Select('EMAIL_ADDR')
    ->where('EMPLID', '=', $id)
    ->where('E_ADDR_TYPE', '=', 'HOME')
    ->first();

    //Search for student in local db
    $nationl_id = $student->national_id;
    $find = Student::Where('NationalID', '=', $nationl_id)->first();

    if ($find){
      return view('studentCreationError', compact('id'));
    }
    else{
      return view('student.create',compact('student','ksauhs_email','personal_email'));
    }

  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {

    $input = $request->except('_token');
    $input['ArabicFirstName']=$request->get('ArabicFirstName');
    $input['ArabicMiddleName']=$request->get('ArabicMiddleName');
    $input['ArabicLastName']=$request->get('ArabicLastName');
    $input['FirstName']=$request->get('FirstName');
    $input['MiddleName']=$request->get('MiddleName');
    $input['LastName']=$request->get('LastName');
    $input['NationalID']=$request->get('NationalID');
    $input['Badge']=$request->get('Badge');
    $input['Status']=$request->get('Status');
    $input['Stream']=$request->get('Stream');
    $input['StudentNo']=$request->get('StudentNo');
    $input['Batch']=$request->get('AdmissionBatch');
    $input['GraduationBatch']=$request->get('GraduationBatch');
    $input['GraduateExpectationsYear']=$request->get('GraduateExpectationsYear');
    $input['Mobile']=$request->get('Mobile');
    $input['KSAUHSEmail']=$request->get('KSAUHSEmail');
    $input['PersonalEmail']=$request->get('PersonalEmail');

    if ($request->get('Gender') == 'Male')
    $input['Gender']='m';
    else {
    $input['Gender']='f';
    }

    $id = Student::withoutGlobalScopes()->max('id');
    $input['id']= $id+1;

    $sis_id = $request->get('stu_sis_id');

    $new_student = Student::create($input);

    if ($new_student){

      $student = Pres::FindOrFail($sis_id);

      $ksauhs_email = Pres::Select('EMAIL_ADDR')
      ->where('EMPLID', '=', $id)
      ->where('E_ADDR_TYPE', '=', 'CAMP')
      ->first();

      $personal_email = Pres::Select('EMAIL_ADDR')
      ->where('EMPLID', '=', $id)
      ->where('E_ADDR_TYPE', '=', 'HOME')
      ->first();

      $nationl_id = $student->national_id;

      // Student info from the app DB
      $stu = Student::Where('NationalID', '=', $nationl_id)->first();

      if ($stu !== NULL)
      {
        $attachments = $stu->attachment;
      }
      else {
        $attachments = null;
      }

      $student_create = 'Student Created Successfully!';

      return view('student.show',compact('student','ksauhs_email','personal_email','attachments','stu','student_create'));
      //return back()->with('student_create','Student Created Successfully!');
    }
    else {
      return back()->with('student_create','Something went wrong, kindly try again!');
    }

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

    $input['title']=$request->get('attch_title');
    $input['student_id']=$request->get('id');

    if ($file = $request->file('attachment'))
    {
      $timestamp = date('d-m-Y-h-i-s',time());
      //$name = $file->getClientOriginalName();
      $guessExtension = $file->guessExtension();
      $storge_name = str_replace(' ', '-', $input['title']).'-'.str_replace(' ', '-', $timestamp).'-'.$input['student_id'].'.'.$guessExtension;
      Storage::putFileAs('public/student_attachments', $file, $storge_name);
      $input['file'] = $storge_name;

    }
    $attachment = Attachment::create($input);
    if ($attachment){ // stay at attachments page and disply a link to the uploaded file
      return back()->with('upload_attachment','Attachment File Uploaded Successfully!');
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
  public function showEditAttForm($id,$sid)
  {
    $attachment = Attachment::findOrFail($id);
    $stu_sis_id = $sid;
    return view('student.edit_attachment',compact('attachment','stu_sis_id'));
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function delete_attachment($id,$sid)
  {

    $attachment = Attachment::findOrFail($id);
    $student = Student::where('id', '=', $attachment->student_id)->first();
    $query = $attachment->delete();

    if ($query){

      activity()
      ->performedOn($student)
      ->causedBy(auth()->user())
      ->useLog('Delete')
      ->withProperties(['old' => $attachment->title,'current'=>'-'])
      ->log('Delete Student Attachment, Student id: '.$attachment->student_id);

      unlink(storage_path('app/public/student_attachments/'.$attachment->file));
      return Redirect::route('student.show',$sid)->with('delete_attachment','Attachment Delete Successfully!');
    }


  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function edit_attachment(Request $request)
  {
    $this->validate($request, [
      'attch_title'=>'required|max:50',
      'attachment'=>'required|mimes:doc,pdf,docx,jpeg,png,jpg|max:2000',// 2MB
    ]);

    $input = $request->except('_token');

    $title = $request->get('attch_title');
    $id = $request->get('att_id');
    $student_id = $request->get('student_id');
    $stu_sis_id = $request->get('stu_sis_id');

    $attachment = Attachment::findOrFail($id);
    $student = Student::where('id', '=', $student_id)->first();

    if ($file = $request->file('attachment'))
    {
      // delete old file
      unlink(storage_path('app/public/student_attachments/'.$attachment->file));

      // upload new file
      $timestamp = date('d-m-Y-h-i-s',time());
      $guessExtension = $file->guessExtension();
      $storge_name = str_replace(' ', '-', $title).'-'.str_replace(' ', '-', $timestamp).'-'.$student_id.'.'.$guessExtension;
      Storage::putFileAs('public/student_attachments', $file, $storge_name);
    }
    // update db
    $query = Attachment::where('id', '=', $id)->update(
      ['title' => $title,
      'file' => $storge_name,
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now(),
    ]);

    if ($query){
      activity()
      ->performedOn($student)
      ->causedBy(auth()->user())
      ->useLog('Update')
      ->withProperties(['old' => $attachment->title,'current'=>$title])
      ->log('Update Student Attachment, Student id: '.$attachment->student_id);

      return Redirect::route('student.show', $stu_sis_id)->with('update_attachment','Attachment Updated Successfully!');
    }
    else {

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
    $student = Pres::FindOrFail($id);

    $ksauhs_email = Pres::Select('EMAIL_ADDR')
    ->where('EMPLID', '=', $id)
    ->where('E_ADDR_TYPE', '=', 'CAMP')
    ->first();

    $personal_email = Pres::Select('EMAIL_ADDR')
    ->where('EMPLID', '=', $id)
    ->where('E_ADDR_TYPE', '=', 'HOME')
    ->first();

    $nationl_id = $student->national_id;

    // Student info from the app DB
    $stu = Student::Where('NationalID', '=', $nationl_id)->first();

    if ($stu !== NULL)
    {
      $attachments = $stu->attachment;
    }
    else {
      $attachments = null;
    }

    return view('student.show',compact('student','ksauhs_email','personal_email','attachments','stu'));
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
