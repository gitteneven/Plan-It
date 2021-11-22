<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../model/Demo.php';


class PagesController extends Controller {

  public function index() {
    // this should refer to a database query, a hard-coded object is used for demo purposes
   // $demos = Demo::all();

    $demos = array(new Demo('first item'), new Demo('second item'), new Demo('last item'));
    $this->set('demos',$demos);

  }

  public function overview() {

  }
  public function search() {
  if(!empty($_POST['action'])) {
      if($_POST['action']== 'searchWatchlist'){
          $seriesSearch = 'https://api.themoviedb.org/3/search/tv?api_key=662c8478635d4f25ee66abbe201e121d&query=' . '%' . $_POST['title'] . '%';
          $moviesSearch = 'https://api.themoviedb.org/3/search/movie?api_key=662c8478635d4f25ee66abbe201e121d&query=' . '%' . $_POST['title'] . '%';
        if($_POST['type'] == 'series'){
          $content = file_get_contents($seriesSearch);
        } else if($_POST['type'] == 'movie'){
          $content = file_get_contents($moviesSearch);
        }
        $result = json_decode($content);
        $movies = $result->results;

      }
   }

  $this->set('movies',$movies);




  }
}
