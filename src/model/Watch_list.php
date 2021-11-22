<?php

use \Illuminate\Database\Eloquent\Model;

class WatchList extends Model {
  //
  public $timestamps = false;

  public function users(){
    return $this->belongsToMany(User::class);
  }
}
