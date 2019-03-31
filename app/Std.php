<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Std extends Model
{
  // model for SYSADM.PS_KS_COM_PERS_INF
  protected $connection= 'oracle';

  protected $table = 'SYSADM.PS_KS_COM_ENRL_INF';

}
