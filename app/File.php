<?php

namespace teambernieny;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
  public function event() {
    # Define an inverse one-to-many relationship.
    return $this->belongsTo('\teambernieny\Event');
  }
}
