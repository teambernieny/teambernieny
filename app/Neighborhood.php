<?php

namespace teambernieny;

use Illuminate\Database\Eloquent\Model;

class Neighborhood extends Model
{
  public function volunteers() {
     # Neighborhood has many Volunteers
     # Define a one-to-many relationship.
     return $this->hasMany('\teambernieny\Volunteer');
  }
  public function events() {
     return $this->hasMany('\teambernieny\Event');
  }
}
