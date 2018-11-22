<?php

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class NewsItem extends Model
{
    use LogsActivity;

    protected $fillable = ['name', 'text'];

    protected static $logAttributes = '*';
}
