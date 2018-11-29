<?php
// php class for all excel export features
namespace App\Exports;
use App\Http\Controllers;
use App\Student;
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

      //check current user role
      $current_user_role = Auth::user()->roles->first()->name;

      switch ($current_user_role) {
        case 'admin':
        $query = DB::table('students')->select('*')->orderBy('FirstName', 'asc');

        if (session('fname')) {
          $query->where('FirstName', '=', session('fname'));
        }

        if (session('Batch')) {
          $query->whereIn('Batch', session('Batch'));
        }

        if (session('Status')) {
          $query->whereIn('Status', session('Status'));
        }

        if (session('mname')) {
          $query->where('MiddleName', '=', session('mname'));
        }

        if (session('lname')) {
          $query->where('LastName', '=', session('lname'));
        }

        if (session('NationalID')) {
          $query->where('NationalID', '=', session('NationalID'));
        }

        if (session('Badge')) {
          $query->where('Badge', '=', session('Badge'));
        }

        if (session('Stream')) {
          $query->whereIn('Stream', session('Stream'));
        }

        if (session('StudentNo')) {
          $query->where('StudentNo', '=', session('StudentNo'));
        }

        if (session('Mobile')) {
          $query->where('StudentNo', '=', session('StudentNo'));
        }

        if (session('KSAUHSEmail')) {
          $query->where('KSAUHSEmail', '=', session('KSAUHSEmail'));
        }

        if (session('NGHAEmail')) {
          $query->where('NGHAEmail', '=', session('NGHAEmail'));
        }

        if (session('PersonalEmail')) {
          $query->where('PersonalEmail', '=', session('PersonalEmail'));
        }
        if (session('GraduateExpectationsYear')) {
          $query->whereIn('GraduateExpectationsYear', session('GraduateExpectationsYear'));
        }
        if (session('LastActivationDate')) {
          $query->where('LastActivationDate', '=', session('LastActivationDate'));
        }
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
        }
        if (session('Withdrawal')) {
          $query->where('Withdrawal', '=', session('Withdrawal'));
        }
        if (session('DelayedGraduation')) {
            $query->whereRaw('Batch != GraduationBatch');
        }
        return $query->get();
        break;

        case 'male-manager':
        case 'male-officer':
        $query = Student::where('Gender', '=', 'm')->orderBy('FirstName', 'asc');

        if (session('fname')) {
          $query->where('FirstName', '=', session('fname'));
        }

        if (session('Batch')) {
          $query->whereIn('Batch', session('Batch'));
        }

        if (session('Status')) {
          $query->whereIn('Status', session('Status'));
        }

        if (session('mname')) {
          $query->where('MiddleName', '=', session('mname'));
        }

        if (session('lname')) {
          $query->where('LastName', '=', session('lname'));
        }

        if (session('NationalID')) {
          $query->where('NationalID', '=', session('NationalID'));
        }

        if (session('Badge')) {
          $query->where('Badge', '=', session('Badge'));
        }

        if (session('Stream')) {
          $query->whereIn('Stream', session('Stream'));
        }

        if (session('StudentNo')) {
          $query->where('StudentNo', '=', session('StudentNo'));
        }

        if (session('Mobile')) {
          $query->where('StudentNo', '=', session('StudentNo'));
        }

        if (session('KSAUHSEmail')) {
          $query->where('KSAUHSEmail', '=', session('KSAUHSEmail'));
        }

        if (session('NGHAEmail')) {
          $query->where('NGHAEmail', '=', session('NGHAEmail'));
        }

        if (session('PersonalEmail')) {
          $query->where('PersonalEmail', '=', session('PersonalEmail'));
        }
        if (session('GraduateExpectationsYear')) {
          $query->whereIn('GraduateExpectationsYear', session('GraduateExpectationsYear'));
        }
        if (session('LastActivationDate')) {
          $query->where('LastActivationDate', '=', session('LastActivationDate'));
        }
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
        }
        if (session('Withdrawal')) {
          $query->where('Withdrawal', '=', session('Withdrawal'));
        }
        if (session('DelayedGraduation')) {
            $query->whereRaw('Batch != GraduationBatch');
        }
        return $query->get();
        break;

        case 'female-manager':
        case 'female-officer':
        $query = Student::where('Gender', '=', 'f')->orderBy('FirstName', 'asc');

        if (session('fname')) {
          $query->where('FirstName', '=', session('fname'));
        }

        if (session('Batch')) {
          $query->whereIn('Batch', session('Batch'));
        }

        if (session('Status')) {
          $query->whereIn('Status', session('Status'));
        }

        if (session('mname')) {
          $query->where('MiddleName', '=', session('mname'));
        }

        if (session('lname')) {
          $query->where('LastName', '=', session('lname'));
        }

        if (session('NationalID')) {
          $query->where('NationalID', '=', session('NationalID'));
        }

        if (session('Badge')) {
          $query->where('Badge', '=', session('Badge'));
        }

        if (session('Stream')) {
          $query->whereIn('Stream', session('Stream'));
        }

        if (session('StudentNo')) {
          $query->where('StudentNo', '=', session('StudentNo'));
        }

        if (session('Mobile')) {
          $query->where('StudentNo', '=', session('StudentNo'));
        }

        if (session('KSAUHSEmail')) {
          $query->where('KSAUHSEmail', '=', session('KSAUHSEmail'));
        }

        if (session('NGHAEmail')) {
          $query->where('NGHAEmail', '=', session('NGHAEmail'));
        }

        if (session('PersonalEmail')) {
          $query->where('PersonalEmail', '=', session('PersonalEmail'));
        }
        if (session('GraduateExpectationsYear')) {
          $query->whereIn('GraduateExpectationsYear', session('GraduateExpectationsYear'));
        }
        if (session('LastActivationDate')) {
          $query->where('LastActivationDate', '=', session('LastActivationDate'));
        }
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
        }
        if (session('Withdrawal')) {
          $query->where('Withdrawal', '=', session('Withdrawal'));
        }
        if (session('DelayedGraduation')) {
            $query->whereRaw('Batch != GraduationBatch');
        }
        return $query->get();
        break;

      }



    }
    else
    {
      /*
      $search =session('search');
      // Fetch all Students from database
      $searchResults = Student::where('Badge', '=',$search)
      ->orWhere('NationalID', '=', $search)
      ->orWhere('Batch', 'LIKE', '%'.$search.'%')
      ->orWhere('Stream', 'LIKE', '%'.$search.'%')
      ->orWhere('Status', 'LIKE', '%'.$search.'%')
      ->orWhere('FirstName', 'LIKE', '%'.$search.'%')
      ->orWhere('LastName', 'LIKE', '%'.$search.'%')
      ->orWhere('StudentNo', 'LIKE', '%'.$search.'%')
      ->get();
      return $searchResults;
      */
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
        return $searchResults;
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
        return $searchResults;
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
        return $searchResults;
      }
    }
  }

  public function map($searchResults): array
  {
    return [
      $searchResults->FirstName,
      $searchResults->LastName,
      $searchResults->Badge,
      $searchResults->NationalID,
      $searchResults->Status,
      $searchResults->StudentNo,
      $searchResults->Batch,
      $searchResults->Stream
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
