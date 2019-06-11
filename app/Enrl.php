<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enrl extends Model
{
  // model for SYSADM.PS_KS_COM_PERS_INF
  protected $connection= 'oracle';

  protected $table = 'YSADM.PS_KS_COM_ENRL_INF';

}
