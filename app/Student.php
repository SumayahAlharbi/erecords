<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Spatie\Permission\Traits\HasRoles;

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
    'Stream',
    'id',
  ];

  public $timestamps = false;

  public function attachment(){
    return $this->hasMany('App\Attachment');
  }

}
