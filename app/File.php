<?php

namespace teambernieny;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
  public function events() {
    # Define an inverse one-to-many relationship.
    return $this->belongsTo('\teambernieny\Event');
  }
  public function user() { //this is the user that 'Completed' the file
    return $this->belongsTo('\teambernieny\User');

  }
}
