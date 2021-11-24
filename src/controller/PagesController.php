<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../model/User.php';
require_once __DIR__ . '/../model/Watch_list.php';
require_once __DIR__ . '/../model/Stream_service.php';

class PagesController extends Controller {

  public function index() {
    // this should refer to a database query, a hard-coded object is used for demo purposes
   // $demos = Demo::all();

     if(isset($_SESSION['id'])){
    $userLogin= User::where('id', $_SESSION['id'])->first();
    $this->set('userLogin', $userLogin);
     }

    $this->set('title','Home');

  }

  public function overview() {
   // $user = User::where('id', '=', $_SESSION['id'])->first();
    $watchlist = Watch_list::where('user_id', '=', $_SESSION['id'])->get();

    $this->set('watchlist', $watchlist);
    $this->set('title','My watchlist');
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

    if(!empty($_POST['action'])) {
      if($_POST['action'] == 'addWatchlist'){
        $newWatch = new Watch_list;
        $newWatch->user_id = $_SESSION['id'];
        $newWatch->watch_id = $_POST['watch__id'];
        $newWatch->title = $_POST['watch__name'];
          if($_POST['watch__type']=='series'){
            $newWatch->series = 1;
          }
          if($_POST['watch__type']=='movie'){
            $newWatch->movie = 1;
          }
        $newWatch->save();
        }
    }

    $this->set('movies',$movies);
    $this->set('title','My watchlist - Search');
  }

  public function signup() {
    if(!empty($_POST['action'])) {
      if ($_POST['action'] == 'signup') {

        $newUser = new User;
        $newUser->name = $_POST['name'];
        $newUser->surname = $_POST['surname'];
        $newUser->username = $_POST['username'];
        $newUser->email = $_POST['email'];
        $newUser->password = $_POST['password'];

        $errors = User::validate($newUser);
        if (empty($errors)) {
          // $whitelist_type = array('image/jpeg', 'image/png','image/gif');
          // if(!in_array($_FILES['picture']['type'], $whitelist_type)){
          //     $errors['username--login'] = 'Please select a jpeg, png or gif file';
          // }
          //  $size = getimagesize($_FILES['picture']['tmp_name']);
          // if ($size[0] < 70 || $size[1] < 1480) {
          //     $errors['password--login'] = 'The picture must be minimum 170x480';
          // }
          // $projectFolder = realpath(__DIR__);
          // $targetFolder = $projectFolder . '/../assets/uploads';
          // $targetFolder = tempnam($targetFolder, '');
          // unlink($targetFolder);
          // mkdir($targetFolder, 0777, true);
          // $targetFileName = $targetFolder . '/' . $_FILES['picture']['name'];
          //  $this->_resizeAndCrop($_FILES['picture']['tmp_name'], $targetFileName, 480, 480);
          // $relativeFileName = substr($targetFileName, 1 + strlen($projectFolder));
          //  $data = array(
          //     'picture' => $relativeFileName,
          // );
          // $newUser->picture=$data['picture'];
           $newUser->save();
           $_SESSION['name']=$_POST['name'];
           $_SESSION['password']=$_POST['password'];
           $_SESSION['id']=$newUser->id;
          // $userLogin= User::where('id', $_SESSION['id'])->first();
          // $this->set('userLogin',$userLogin);

          header('Location:index.php?page=signup2');
          exit();
        }else{
          $this->set('errors', $errors);
        }
      }

    }
    $countries= array("-----","Albania", "Algeria","Argentina","Armenia","Australia","Austria","Azerbaijan","Bahamas","Bangladesh","Belarus","Belgium","Bolivia","Bosnia and Herzegovina","Brazil","Brunei","Bulgaria","Burkina Faso","Canada" ,"Colombia","Costa Rica","Croatia","Cuba","Cyprus","Czechoslovakia","Czech Republic","Denmark","Dominican Republic","Ecuador","Egypt","Estonia","Ethiopia","Finland","France","Georgia","Germany","Ghana","Greece","Guatemala","Honduras","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Israel","Italy","Jamaica","Japan","Jordan","Kazakhstan","Korea","Kosovo","Kuwait","Kyrgyzstan","Latvia","Lebanon" ,"Lithuania","Luxembourg" ,"Malaysia" ,"Mali","Malta","Mexico","Mongolia","Morocco","Netherlands","New Zealand","Nigeria","Norway","Pakistan","Peru","Philippines","Poland","Portugal","Romania","Russia" ,"Saudi Arabia","Senegal","Singapore","Slovakia", "Slovenia", "South Africa","Soviet Union" ,"Spain","Sweden","Switzerland","Syria","Thailand","Tunisia","Turkey","Ukraine","United Arab Emirates", "UK","USA","Venezuela","Vietnam");
    $this->set('countries', $countries);

    $this->set('title','Sign up Watcho');

  }

  public function signup2() {
    if(!empty($_POST['action'])) {
      if ($_POST['action'] == 'streaming') {
        $newUser= User::where('id', $_SESSION['id'])->first();
         $strServ=new Stream_service;
          $strServ->user_id=$_SESSION['id'];

          $_SESSION['strServ']=$_SESSION['id'];
        foreach($_POST['strOption'] as $value){
          //$newUser->stream_serv = $value;
          if($value=='netflix'){
            $strServ->netflix = 1;
          }
          if($value=='amazon_prime'){
            $strServ->amazon_prime = 1;
          }
          if($value=='disney'){
            $strServ->disney = 1;
          }
          if($value=='hbo_max'){
            $strServ->hbo_max = 1;
          }
          if($value=='hulu'){
            $strServ->hulu = 1;
          }
            //echo "Chosen stream_serv : ".$value.'<br/>';

            // echo $newUser;
        }
        $strServ->save();
        foreach($_POST['country'] as $value){
            //echo "Chosen country : ".$value.'<br/>';
            $newUser->country = $value;
        }


        $newUser->save();
        //$part1=true;
        header('Location:index.php?page=overview');
          exit();
      }

    }
    $countries= array("-----","Albania", "Algeria","Argentina","Armenia","Australia","Austria","Azerbaijan","Bahamas","Bangladesh","Belarus","Belgium","Bolivia","Bosnia and Herzegovina","Brazil","Brunei","Bulgaria","Burkina Faso","Canada" ,"Colombia","Costa Rica","Croatia","Cuba","Cyprus","Czechoslovakia","Czech Republic","Denmark","Dominican Republic","Ecuador","Egypt","Estonia","Ethiopia","Finland","France","Georgia","Germany","Ghana","Greece","Guatemala","Honduras","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Israel","Italy","Jamaica","Japan","Jordan","Kazakhstan","Korea","Kosovo","Kuwait","Kyrgyzstan","Latvia","Lebanon" ,"Lithuania","Luxembourg" ,"Malaysia" ,"Mali","Malta","Mexico","Mongolia","Morocco","Netherlands","New Zealand","Nigeria","Norway","Pakistan","Peru","Philippines","Poland","Portugal","Romania","Russia" ,"Saudi Arabia","Senegal","Singapore","Slovakia", "Slovenia", "South Africa","Soviet Union" ,"Spain","Sweden","Switzerland","Syria","Thailand","Tunisia","Turkey","Ukraine","United Arab Emirates", "UK","USA","Venezuela","Vietnam");
    $this->set('countries', $countries);

    $this->set('title','Sign up Watcho');
  }

   public function login() {

    $this->set('title','Log in');
    if(!empty($_POST['action'])) {
      if ($_POST['action'] == 'login') {

        if(!empty($_POST['username']) && !empty($_POST['password'])) {
        $username=$_POST['username'];
        $password=$_POST['password'];

        $userLogin= User::where('username', $_POST['username'])->where('password', $password)->first();
        if(empty($userLogin)){
          $errorLogin='No account was found';
          $this->set('errorLogin', $errorLogin);
        }
        else{
          $_SESSION['id']=$userLogin->id;
            header("Location: index.php?");
            exit();
        }
        }

      }}
      $userLogin= User::find(1);
    $this->set('userLogin', $userLogin);
      $this->set('title','Log in Watcho');
  }

  public function logout() {
    session_destroy();
    header("Location: index.php?");

   }
}
