<?php

use \Illuminate\Database\Eloquent\Model;


class Stream_service extends Model {

  public $timestamps = false;

  public function users(){
    return $this->belongsToMany(User::class);
  }


}
