<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../model/Demo.php';


class PagesController extends Controller {

  public function index() {
    // this should refer to a database query, a hard-coded object is used for demo purposes
   // $demos = Demo::all();

    $demos = array(new Demo('first item'), new Demo('second item'), new Demo('last item'));
    $this->set('demos',$demos);

    $content = file_get_contents('https://api.themoviedb.org/3/search/movie?api_key=662c8478635d4f25ee66abbe201e121d&query=' . '%' . $_GET['title'] . '%');
    $result  = json_decode($content);
    $movies = $result->results;
   

    $this->set('movies',$movies);

  }
}
