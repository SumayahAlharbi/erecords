<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
  public $table='students';
  protected $fillable =[
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
