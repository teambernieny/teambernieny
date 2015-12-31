<?php

namespace teambernieny;

use Illuminate\Database\Eloquent\Model;

class EventsVolunteer extends Model
{
  public function volunteer() {

     return $this->belongsTo('\teambernieny\Volunteer');
  }

  public function event() {

     return $this->belongsTo('\teambernieny\Event');
  }
  public function commitments() {
    return $this->hasMany('\teambernieny\Commitment');
  }

}
