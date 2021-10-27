<?php

use \Illuminate\Database\Eloquent\Model;

class Demo extends Model {
  // refer to a database table, an object us used here for demo purposes
  public $timestamps = false;

  public $name;

  public function __construct($name){
    $this->name = $name;
  }
}
