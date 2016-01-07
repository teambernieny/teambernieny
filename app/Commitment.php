<?php

namespace teambernieny;

use Illuminate\Database\Eloquent\Model;

class Commitment extends Model
{
  public function eventvolunteer() {
    # Volunteer who made commitment
    return $this->belongsTo('\teambernieny\EventVolunteer');
  }



}
