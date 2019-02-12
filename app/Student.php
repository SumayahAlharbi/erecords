<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Spatie\Permission\Traits\HasRoles;

class Student extends Model
{

  public $table='students';

  protected $fillable =[
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
    'Batch',
    'Stream',
    'id',
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
