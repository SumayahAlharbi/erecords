<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Student extends Model
{
  use HasRoles;

  protected $guard_name = 'web'; // or whatever guard you want to use
   
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

  public function attachment()
  {
    return $this->hasMany('App\Attachment');
  }

}
