<?php

namespace App\Exports;
use App\Http\Controllers;
use App\Student;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Session;

class SimpleSearchExport implements FromCollection, WithHeadings
{
        use Exportable;

        public function collection()
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

        public function headings(): array
        {
            return [
                'Badge',
                'NationalID',
                'Batch',
                'Stream',
                'Status',
                'FirstName',
                'LastName',
                'StudentNo'
            ];
        }
  }
