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

class SimpleSearchExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping
{
  public function collection()
  {
    if (Session::has('SR')) {
      $query = DB::table('students')->select('*');
      if (session('fname')) {
        return student::query()->where('FirstName', '=', session('fname'))->orderBy('FirstName', 'asc');
      }
      if (session('mname')) {
        return student::query()->where('MiddleName', '=', session('mname'))->orderBy('FirstName', 'asc');
      }
      if (session('lname')) {
        return student::query()->where('LastName', '=', session('lname'))->orderBy('FirstName', 'asc');
      }
      if (session('NationalID')) {
        return student::query()->where('NationalID', '=', session('NationalID'))->orderBy('FirstName', 'asc');
      }
      if (session('Badge')) {
        return student::query()->where('Badge', '=', session('Badge'))->orderBy('FirstName', 'asc');
      }
      if (session('Status')) {
        return student::query()->whereIn('Status', session('Status'))->orderBy('FirstName', 'asc');
      }
      if (session('Stream')) {
        return student::query()->whereIn('Stream', session('Stream'))->orderBy('FirstName', 'asc');
      }
      if (session('Batch')) {
        return student::query()->whereIn('Batch', session('Batch'))->orderBy('FirstName', 'asc');
      }
      if (session('StudentNo')) {
        return student::query()->where('StudentNo', '=', session('StudentNo'))->orderBy('FirstName', 'asc');
      }
      if (session('Mobile')) {
        return student::query()->where('Mobile', 'LIKE', session('Mobile'))->orderBy('FirstName', 'asc');
      }
      if (session('KSAUHSEmail')) {
        return student::query()->where('KSAUHSEmail', 'LIKE', session('KSAUHSEmail'))->orderBy('FirstName', 'asc');
      }
      if (session('NGHAEmail')) {
        return student::query()->where('NGHAEmail', 'LIKE', session('NGHAEmail'))->orderBy('FirstName', 'asc');
      }
      if (session('PersonalEmail')) {
        return student::query()->where('PersonalEmail', 'LIKE', session('PersonalEmail'))->orderBy('FirstName', 'asc');
      }
      if (session('GraduateExpectationsYear')) {
        return student::query()->whereIn('GraduateExpectationsYear', session('GraduateExpectationsYear'))->orderBy('FirstName', 'asc');
      }
      if (session('LastActivationDate')) {
        return student::query()->where('LastActivationDate', '=', session('LastActivationDate'))->orderBy('FirstName', 'asc');
      }
      if (session('Dismissed')) {
        return student::query()->where('Dismissed', '=', session('Dismissed'))->orderBy('FirstName', 'asc');
      }
      if (session('FirstBlockDrop')) {
        return student::query()->where('FirstBlockDrop', '=', session('FirstBlockDrop'))->orderBy('FirstName', 'asc');
      }
      if (session('FirstPostpone')) {
        return student::query()->where('FirstPostpone', '=', session('FirstPostpone'))->orderBy('FirstName', 'asc');
      }
      if (session('FirstAcademicViolation')) {
        return student::query()->where('FirstAcademicViolation', '=', session('FirstAcademicViolation'))->orderBy('FirstName', 'asc');
      }
      if (session('SecondBlockDrop')) {
        return student::query()->where('SecondBlockDrop', '=', session('SecondBlockDrop'))->orderBy('FirstName', 'asc');
      }
      if (session('SecondPostpone')) {
        return student::query()->where('SecondPostpone', '=', session('SecondPostpone'))->orderBy('FirstName', 'asc');
      }
      if (session('SecondAcademicViolation')) {
        return student::query()->where('SecondAcademicViolation', '=', session('SecondAcademicViolation'))->orderBy('FirstName', 'asc');
      }
      if (session('ThirdBlockDrop')) {
        return student::query()->where('ThirdBlockDrop', '=', session('ThirdBlockDrop'))->orderBy('FirstName', 'asc');
      }
      if (session('ThirdPostpone')) {
        return student::query()->where('ThirdPostpone', '=', session('ThirdPostpone'))->orderBy('FirstName', 'asc');
      }
      if (session('ThirdAcademicViolation')) {
        return student::query()->where('ThirdAcademicViolation', '=', session('ThirdAcademicViolation'))->orderBy('FirstName', 'asc');
      }
      if (session('FirstAttemptAttendanceViolation')) {
        return student::query()->where('FirstAttemptAttendanceViolation', '=', session('FirstAttemptAttendanceViolation'))->orderBy('FirstName', 'asc');
      }
      if (session('SecondAttemptAttendanceViolation')) {
        return student::query()->where('SecondAttemptAttendanceViolation', '=', session('SecondAttemptAttendanceViolation'))->orderBy('FirstName', 'asc');
      }
      if (session('ThirdAttemptAttendanceViolation')) {
        return student::query()->where('ThirdAttemptAttendanceViolation', '=', session('ThirdAttemptAttendanceViolation'))->orderBy('FirstName', 'asc');
      }
      if (session('Withdrawal')) {
        return student::query()->where('Withdrawal', '=', session('Withdrawal'))->orderBy('FirstName', 'asc');
      }
      return student::query()->select('FirstName');
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
      return $searchResults;
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
