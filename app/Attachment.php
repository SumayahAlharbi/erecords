<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{

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
