<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../model/User.php';


class PagesController extends Controller {

  public function index() {
    // this should refer to a database query, a hard-coded object is used for demo purposes
   // $demos = Demo::all();

    $content = file_get_contents('https://api.themoviedb.org/3/search/movie?api_key=662c8478635d4f25ee66abbe201e121d&query=' . '%' . $_GET['title'] . '%');
    $result  = json_decode($content);
    $movies = $result->results;


    $this->set('movies',$movies);
    $this->set('title','Home');

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
          $userLogin= User::where('id', $_SESSION['id'])->first();
          $this->set('userLogin',$userLogin);
          header('Location:index.php?page=signup');
          exit();
        }else{
          $this->set('errors', $errors);
        }
      }
    }

    $this->set('title','Sign up');

  }
}
