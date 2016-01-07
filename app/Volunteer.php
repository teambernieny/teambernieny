<?php

namespace teambernieny;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
  public function neighborhood() {
     # Volunteer belongs to neighborhood
     # Define an inverse one-to-many relationship.
     return $this->belongsTo('\teambernieny\Neighborhood');
  }
  public function createdbyuser() {
    # Volunteer created by a User
    # Define an inverse one-to-many relationship.
    return $this->belongsTo('\teambernieny\User');
  }

  public function tags()
  {
    # With timetsamps() will ensure the pivot table has its created_at/updated_at fields automatically maintained
    return $this->belongsToMany('\teambernieny\Tag')->withTimestamps();
  }

  public function events()
  {
    # With timetsamps() will ensure the pivot table has its created_at/updated_at fields automatically maintained
    return $this->belongsToMany('\teambernieny\Event', 'event_volunteers')->withTimestamps();

  }
  public function contactevents() {
     return $this->hasMany('\teambernieny\Contactevent');
  }
  
  public function commitments() {
     return $this->hasManyThrough('\teambernieny\Commitment', 'teambernieny\EventVolunteers');
  }
}
