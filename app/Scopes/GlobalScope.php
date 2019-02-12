<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Auth;

class GlobalScope implements Scope
{
  /**
  * Apply the scope to a given Eloquent query builder.
  *
  * @param  \Illuminate\Database\Eloquent\Builder  $builder
  * @param  \Illuminate\Database\Eloquent\Model  $model
  * @return void
  */
  public function apply(Builder $builder, Model $model)
  {
    $current_user_role = Auth::user()->roles->first()->name;

    switch ($current_user_role) {
      case 'admin':
      $builder;
      break;
      case 'male-manager':
      case 'male-officer':
      $builder->where('Gender', '=', 'm');
      break;
      case 'female-manager':
      case 'female-officer':
      $builder->where('Gender', '=', 'f');
      break;
    }
  }
}
