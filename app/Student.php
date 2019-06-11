<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Spatie\Permission\Traits\HasRoles;

class Student extends Model
{

  public $table='students';

  protected $fillable =[
    'id',
    'FirstName',
    'MiddleName',
    'LastName',
    'ArabicFirstName',
    'ArabicMiddleName',
    'ArabicLastName',
    'Badge',
    'NationalID',
    'Status',
    'StudentNo',
    'Stream',
    'Gender',
    'Batch',
    'GraduationBatch',
    'GraduateExpectationsYear',
    'Mobile',
    'KSAUHSEmail',
    'PersonalEmail',
  ];

  public $timestamps = false;

  public function attachment(){
    return $this->hasMany('App\Attachment');
  }

  public static function boot()
  {
    parent::boot();

    static::addGlobalScope(new Scopes\GlobalScope);
  }

}
