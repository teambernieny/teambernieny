<?php

namespace teambernieny;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  public function neighborhood() {
    return $this->belongsTo('\teambernieny\Neighborhood');
  }

  public function volunteers()
  {
    # With timetsamps() will ensure the pivot table has its created_at/updated_at fields automatically maintained
    return $this->belongsToMany('\teambernieny\Volunteer', 'event_volunteers')->withTimestamps();
  }
  public function files() {
    #uploaded files of sign-in sheets
     return $this->hasMany('\teambernieny\File');
  }

  public function commitments() {
    #commitments volunteers made at event
     return $this->hasMany('\teambernieny\Commitment');
  }

}
