<?php
// php class for all excel export features
namespace App\Exports;
use App\Http\Controllers;
use App\Student;
use App\Pres;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Session;
use Auth;

class SimpleSearchExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping
{

  public function collection()
  {
    if (Session::has('SR')) {

      $query = Pres::Select('EMPLID','FIRST_NAME50','LAST_NAME','EXTERNAL_SYSTEM_ID','NATIONAL_ID','STUDENT_STATUS','CAMPUS_ID');

        $fname = session('fname');
        if (session('fname')) {
          $query->whereRaw('lower(FIRST_NAME50) like lower(?)', ["%{$fname}%"]);
        }

        /*if (session('Batch')) {
          $query->whereIn('Batch', session('Batch'));
        }*/

        $status = session('Status');
        if (session('Status')) {
          $query->whereRaw('lower(STUDENT_STATUS) like lower(?)', ["%{$status}%"]);
        }

        if (session('mname')) {
          $mname = session('mname');
          $query->whereRaw('lower(MIDDLE_NAME) like lower(?)', ["%{$mname}%"]);
        }

        $lname = session('lname');
        if (session('lname')) {
          $query->whereRaw('lower(LAST_NAME) like lower(?)', ["%{$lname}%"]);
        }

        $NationalID = session('NationalID');
        if (session('NationalID')) {
          $query->whereRaw('lower(NATIONAL_ID) like lower(?)', ["%{$NationalID}%"]);
        }

        $Badge = session('Badge');
        if (session('Badge')) {
          $query->whereRaw('lower(EXTERNAL_SYSTEM_ID) like lower(?)', ["%{$Badge}%"]);
        }

        /*if (session('Stream')) {
          $query->whereIn('Stream', session('Stream'));
        }*/

        $StudentNo = session('StudentNo');
        if (session('StudentNo')) {
          $query->whereRaw('lower(CAMPUS_ID) like lower(?)', ["%{$StudentNo}%"]);
        }

        if (session('Mobile')) {
          $Mobile = session('Mobile');
          $query->whereRaw('lower(PHONE) like lower(?)', ["%{$Mobile}%"]);
        }

        if (session('KSAUHSEmail')) {
          $ksauhsemail = session('KSAUHSEmail');
          $query->where('E_ADDR_TYPE', '=', 'CAMP')
          ->whereRaw('lower(EMAIL_ADDR) like lower(?)', ["%{$ksauhsemail}%"]);
        }

        /*if (session('NGHAEmail')) {
          $query->where('NGHAEmail', '=', session('NGHAEmail'));
        }*/

        if (session('PersonalEmail')) {
          $personalemail = session('PersonalEmail');
          $query->where('E_ADDR_TYPE', '=', 'HOME')
          ->whereRaw('lower(EMAIL_ADDR) like lower(?)', ["%{$personalemail}%"]);

        }

        /* in another view
        if (session('GraduateExpectationsYear')) {
          $query->whereIn('GraduateExpectationsYear', session('GraduateExpectationsYear'));
        }*/


        if (session('LastActivationDate')) {
          $lastActivationDate = session('LastActivationDate');
          $query->whereRaw('lower(LastActivationDate) like lower(?)', ["%{$lastActivationDate}%"]);
        }

        /*
        if (session('Dismissed')) {
          $query->where('Dismissed', '=', session('Dismissed'));
        }
        if (session('FirstBlockDrop')) {
          $query->where('FirstBlockDrop', '=', session('FirstBlockDrop'));
        }
        if (session('FirstPostpone')) {
          $query->where('FirstPostpone', '=', session('FirstPostpone'));
        }
        if (session('FirstAcademicViolation')) {
          $query->where('FirstAcademicViolation', '=', session('FirstAcademicViolation'));
        }
        if (session('SecondBlockDrop')) {
          $query->where('SecondBlockDrop', '=', session('SecondBlockDrop'));
        }
        if (session('SecondPostpone')) {
          $query->where('SecondPostpone', '=', session('SecondPostpone'));
        }
        if (session('SecondAcademicViolation')) {
          $query->where('SecondAcademicViolation', '=', session('SecondAcademicViolation'));
        }
        if (session('ThirdBlockDrop')) {
          $query->where('ThirdBlockDrop', '=', session('ThirdBlockDrop'));
        }
        if (session('ThirdPostpone')) {
          $query->where('ThirdPostpone', '=', session('ThirdPostpone'));
        }
        if (session('ThirdAcademicViolation')) {
          $query->where('ThirdAcademicViolation', '=', session('ThirdAcademicViolation'));
        }
        if (session('FirstAttemptAttendanceViolation')) {
          $query->where('FirstAttemptAttendanceViolation', '=', session('FirstAttemptAttendanceViolation'));
        }
        if (session('SecondAttemptAttendanceViolation')) {
          $query->where('SecondAttemptAttendanceViolation', '=', session('SecondAttemptAttendanceViolation'));
        }
        if (session('ThirdAttemptAttendanceViolation')) {
          $query->where('ThirdAttemptAttendanceViolation', '=', session('ThirdAttemptAttendanceViolation'));
        }
        if (session('Withdrawal')) {
          $query->where('Withdrawal', '=', session('Withdrawal'));
        }*/


        /*if (session('DelayedGraduation')) { in our db
            $query->whereRaw('Batch != GraduationBatch');
        }*/
        $searchResults_SIS = $query->distinct()->get();

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

        return $searchResults_SIS;

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
        ->orderBy('FIRST_NAME50', 'ASC')
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

        return $searchResults_SIS;
    }
  }

  public function map($searchResults_SIS): array
  {
    return [
      $searchResults_SIS->first_name50,
      $searchResults_SIS->last_name,
      $searchResults_SIS->external_system_id,
      $searchResults_SIS->national_id,
      $searchResults_SIS->student_status,
      $searchResults_SIS->campus_id,
      $searchResults_SIS->batch,
      $searchResults_SIS->stream,
    ];
  }
  public function headings(): array
  {
    return [
      'FirstName',
      'LastName',
      'Badge',
      'NationalID',
      'Status',
      'StudentNo',
      'Batch',
      'Stream'
    ];
  }
}
