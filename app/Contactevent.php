<?php

namespace teambernieny;

use Illuminate\Database\Eloquent\Model;

class Contactevent extends Model
{
  public function createdbyuser() {
    # Contactevent performed by a User
    return $this->belongsTo('\teambernieny\User');
  }
  public function volunteers() {
    # Volunteer contacted
    return $this->belongsTo('\teambernieny\Volunteer');
  }

}
