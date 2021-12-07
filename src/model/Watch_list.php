<?php

use \Illuminate\Database\Eloquent\Model;

class Watch_list extends Model {
  //
  public $timestamps = false;

  public function users(){
    return $this->belongsToOne(User::class);
  }

   public static function validate($data){
   $errors = [];
    if(empty($data['title'])){
      $errors['text'] = "Please fill in a movie or series";
    }
    return $errors;
  }
}
