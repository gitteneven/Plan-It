<?php

use \Illuminate\Database\Eloquent\Model;

class Watch_list extends Model {
  //
  public $timestamps = false;

  public function users(){
    return $this->belongsToMany(User::class);
  }
}
