<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Attachment extends Model
{

  use HasRoles;

  protected $guard_name = 'web'; // or whatever guard you want to use
  
  public $table = 'attachment';

  public $directory = "attachments/";

  protected $fillable = ['title','image','student_id'];

  public function student()
  {
    return $this->belongsTo('App\Student');
  }

  public function getImageAttribute($value)
  {
    if ($value !=NULL)
    return $this->directory.$value;
    else
    return false;
  }
}
