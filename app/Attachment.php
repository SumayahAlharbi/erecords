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

  protected $fillable = ['title','file','student_id'];

  public function student()
  {
    return $this->belongsTo('App\Student');
  }

  
}
