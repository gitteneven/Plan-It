<?php

use \Illuminate\Database\Eloquent\Model;


class User extends Model {

  public static function validate($data){
    $errors = [];
    if ($_POST['action'] == 'signup') {
    if (empty($data['name'])) {
      $errors['name'] = 'Please fill in a name ';
    }
    if (empty($data['surname'])) {
      $errors['surname'] = 'Please fill in a surname';
    }
    if (empty($data['username'])) {
      $errors['username'] = 'Please fill in a username';
    }
    if(strlen(User::where('username', $data['username'])->get())>2){
      $errors['username'] = 'Username already in use';
    }
    if (empty($data['email'])) {
      $errors['email'] = 'Please fill in an email';
    }
    if (empty($data['password'])) {
      $errors['password'] = 'Please fill in an password';
    }
    // if($data['password']!==$_POST['password2']){
    if(password_verify($data['password'], $newUser->password)){
      $errors['password'] = 'Password is not the same';
    }
    }
    if ($_POST['action'] == 'streaming') {
      if (empty($data['country'])|| $data['country']==='-----') {
        $errors['country'] = 'Please select a country';
      }
    }
    return $errors;
  }

  public function stream_services(){
    return $this->hasMany(Stream_service::class);
  }
  public function planners(){
    return $this->hasMany(Planner::class);
  }
  public function series(){
    return $this->hasMany(Series::class);
  }



}
