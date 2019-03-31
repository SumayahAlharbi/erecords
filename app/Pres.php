<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pres extends Model
{
    // model for SYSADM.PS_KS_COM_PERS_INF
    protected $connection= 'oracle';

    protected $table = 'SYSADM.PS_KS_COM_PERS_INF';

    protected $primaryKey = 'EMPLID';

    public static function boot()
    {
      parent::boot();

      static::addGlobalScope(new Scopes\SISScope);
    }

}
