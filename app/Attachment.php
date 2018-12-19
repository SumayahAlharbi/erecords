<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Attachment extends Model
{

  protected $guard_name = 'web'; // or whatever guard you want to use

  public $table = 'attachment';

  protected $fillable = ['title','file','student_id'];

  public function student()
  {
    return $this->belongsTo('App\Student');
  }


}
