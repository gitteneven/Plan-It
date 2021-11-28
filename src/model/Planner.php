<?php

use \Illuminate\Database\Eloquent\Model;

class Planner extends Model {
  //
  public $timestamps = false;

  public function users(){
    return $this->belongsToOne(User::class);
  }
}
