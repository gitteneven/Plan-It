<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../model/User.php';
require_once __DIR__ . '/../model/Watch_list.php';
require_once __DIR__ . '/../model/Stream_service.php';
require_once __DIR__ . '/../model/Planner.php';

class PagesController extends Controller {

  public function index() {

    if(isset($_SESSION['id'])){
      $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
      if ($contentType === "application/json") {
        $content = trim(file_get_contents("php://input"));
        $data = json_decode($content, true);

        if(!empty($data) && !empty($data['action'])) {
          if($data['action']== 'checkedTimeslot'){
            $checkedItem=Planner::where('id', '=', $data['plannedItem'])->first();
            $checkedItem->watched= 1;
            $updateWatchlist=Watch_list::where('watch_id','=',$checkedItem->watch_id)->first();

            $serieDetails= 'https://api.themoviedb.org/3/tv/'. $checkedItem->watch_id. '?api_key=662c8478635d4f25ee66abbe201e121d';
            $itemCode = file_get_contents($serieDetails);
            $itemInfo= json_decode($itemCode);
            if($itemInfo->seasons[$updateWatchlist->current_ses]->episode_count > $checkedItem->current_ep){
              $updateWatchlist->current_ep++;
              $this->set('currentSes',$currentSes);
            } else {
              if ($itemInfo->seasons[$updateWatchlist->current_ses]->episode_count !== NULL){
                $updateWatchlist->current_ses++;
                $updateWatchlist->current_ep=1;
              }
            }
            $checkedItem->save();
            $updateWatchlist->save();
            echo json_encode($checkedItem);
          }
        }

      if(!empty($data) && !empty($data['action'])) {
        if($data['action']== 'removeTimeslot'){
          $checkedItem=Planner::where('id', '=', $data['removedItem'])->first();
          $checkedItem->delete();
        }
      }
        exit();
      }

    if(!empty($_POST['action'])) {
      if($_POST['action']== 'checkedTimeslot'){
        $checkedItem=Planner::where('id', '=', $_POST['plannedItem'])->first();
        $checkedItem->watched= 1;
        $updateWatchlist=Watch_list::where('watch_id','=',$checkedItem->watch_id)->first();
         $serieDetails= 'https://api.themoviedb.org/3/tv/'. $checkedItem->watch_id. '?api_key=662c8478635d4f25ee66abbe201e121d';
         $itemCode = file_get_contents($serieDetails);
         $itemInfo= json_decode($itemCode);
         if($itemInfo->seasons[$updateWatchlist->current_ses]->episode_count > $checkedItem->current_ep){
           $updateWatchlist->current_ep++;
           $this->set('currentSes',$currentSes);
         } else {
           if ($itemInfo->seasons[$updateWatchlist->current_ses]->episode_count !== NULL){
            $updateWatchlist->current_ses++;
           $updateWatchlist->current_ep=1;
           }
         }

        $checkedItem->save();
        $updateWatchlist->save();
        $this->set('checkedItem',$checkedItem);
        }
    }
    if(!empty($_POST['action'])) {
      if($_POST['action']== 'removeTimeslot'){
        $checkedItem=Planner::where('id', '=', $_POST['removedItem'])->first();
        $checkedItem->delete();
      }
    }

    $userLogin= User::where('id', $_SESSION['id'])->first();
    $this->set('userLogin', $userLogin);

      $planning= Planner::where('user_id', '=', $_SESSION['id'])->orderBy('time')->get();
      foreach($planning as $item){
        if($item->series == 1){
          $watchItem=Watch_list::where('user_id', '=', $_SESSION['id'])->where('watch_id', '=', $item->watch_id)->first();
          $this->set('watchItem', $watchItem);
        }

      }
      $currentWeek= 0;
      $day=strtotime('monday');
      if(!empty($_GET['week'])){
        $monday=strtotime( $_GET['week']-1 ."week", $day);
      }
      else{
        $monday=strtotime('monday');
        if(strtotime('today') != $monday){
          $monday=strtotime("-1 week", $day);

        }
      }
      if(!empty($_GET['week'])){
        $currentWeek = $_GET['week'];
      }else{

      }
      $daysOfWeekArray=['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];


      $this->set('monday',$monday);
      $this->set('currentWeek',$currentWeek);
      $this->set('daysOfWeekArray',$daysOfWeekArray);

      $this->set('planning', $planning);
    }

    $this->set('title','Home');

  }

  public function overview() {

    $watchlist = Watch_list::where('user_id', '=', $_SESSION['id'])->get();
    if(isset($_SESSION['id'])){
      $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
      if ($contentType === "application/json") {
        $content = trim(file_get_contents("php://input"));
        $data = json_decode($content, true);

     if(!empty($data) && !empty($data['action'])) {
        if($data['action']== 'removeWatchItem'){
          $checkedItem=Watch_list::where('watch_id', '=', $data['removedItem'])->first();
          $checkedItem->delete();
        }
      }
      exit();
    }
    }
    $this->set('watchlist', $watchlist);
    $this->set('title','My watchlist');
  }
  public function detail() {
    //get models
     $user = User::where('id', '=', $_SESSION['id'])->first();
     $watchlist = Watch_list::where('user_id', '=', $_SESSION['id'])->where('watch_id', '=', $_GET['id'])->get();
     $services = Stream_service::where('user_id', '=', $_SESSION['id'])->get();
         //get info of link
     $idDetail = $_GET['id'];
     $typeDetail = $_GET['watch_type'];
     $titleDetail = $_GET['title'];
     //info out of api
      $itemApi = 'https://api.themoviedb.org/3/'. $typeDetail.'/'. $idDetail . '?api_key=662c8478635d4f25ee66abbe201e121d';
      $itemCode = file_get_contents($itemApi);
      $itemInfo= json_decode($itemCode);
      $language = $itemInfo->spoken_languages;
      if(!empty($language)){
        $languageDetail = $language['0']->name;
      }
     //find providers
     $country = $user->country;
      $providerApi = 'https://api.themoviedb.org/3/'. $typeDetail.'/'. $idDetail . '/watch/providers?api_key=662c8478635d4f25ee66abbe201e121d';
      $providerCode = file_get_contents($providerApi);
      $providerInfo= json_decode($providerCode)->results;
      $providerArray = (array) $providerInfo;
      $countries = file_get_contents('http://country.io/names.json');
      $countriesObj= json_decode($countries);
      $countriesArray = (array) $countriesObj;
      $abbrCountry = array_search($country,$countriesArray);
      if(!empty($providerArray[$abbrCountry])){
      $countryService = (array) $providerArray[$abbrCountry];
      $arrayServices = (array) $countryService['flatrate'];
        $servicesList = [];
      foreach($arrayServices as $service){
        array_push($servicesList,  $service->provider_name);
       }
      } else {
        $servicesList= ' ';
      }

      foreach($services as $info){
        foreach($servicesList as $item){
          if($item === 'Netflix' && $info->netflix == 1){
            $serviceItem = '<img class="detail__provider" src="../src/assets/netflix.svg" alt="netflix">';
          }else if($item === 'Disney Plus' && $info->disney == 1){
            $serviceItem = '<img class="detail__provider" src="../src/assets/disney.svg" alt="disney">';
          } else if($item === 'Amazon Prime Video' && $info->amazon_prime == 1){
            $serviceItem = '<img class="detail__provider" src="../src/assets/prime.svg" alt="prime">';
          } else if($item === 'Hulu' && $info->hulu == 1){
            $serviceItem = '<img class="detail__provider" src="../src/assets/hulu.svg" alt="hulu">';
          } else if($item === 'HBO Max' && $info->hbo_max == 1){
            $serviceItem = '<img class="detail__provider" src="../src/assets/hbo.svg" alt="hbo">';
          } else{
            $serviceItem ='';
          }
        }
      }

      $seasons = $itemInfo->seasons;

      if(!empty($_POST['action'])){
        if($_POST['action'] == 'editCurrent'){
          $max = $itemInfo->number_of_seasons;
          $formSeason = '<form method="post" class="detail__edit">
              <input type="hidden" name="action" value="submitSeason">
              <label for="number__season">Which season: </label>
              <input type="number" class="number__season" id="number__season" name="number__season" min="1" max="'.$max. '">
              <input type="submit" class="detail__edit--submit edit" name="edit" value="episodes >">
              </form> ';
        }
      }

        if(!empty($_POST['action'])){
        if($_POST['action'] == 'submitSeason'){
          $numberOfSeason = $_POST['number__season'];
          foreach($seasons as $season){
            if($numberOfSeason == $season->season_number){
              $getSeason = $seasons[$numberOfSeason];
              $episodeNumber = $getSeason->episode_count;
            }
          }

          $formEpisode =  '<form method="post" class="detail__edit">
              <input type="hidden" name="action" value="submitEpisode">
              <label for="number__episode">Which episode: </label>
              <input type="number" class="number__episode" id="number__episode" name="number__episode" min="1" max="'. $episodeNumber. '">
              <input type="hidden" name="number__season" value="'. $numberOfSeason . '">
              <input type="submit" class="detail__edit--submit edit" name="edit" value="episodes >">
              </form>';

         $this->set('numberOfSeason', $numberOfSeason);
        }
      }

      if(!empty($_POST['action'])){
        if($_POST['action'] == 'submitEpisode'){
          $watch = Watch_list::find($watchlist[0]->id);
          $watch->current_ep = $_POST['number__episode'];
          $watch->current_ses = $_POST['number__season'];
          $watch->save();
          header('Refresh:0');
          exit();
      }
    }

     $this->set('watchlist', $watchlist);
     $this->set('seasons', $seasons);
     $this->set('itemInfo', $itemInfo);
     $this->set('formSeason', $formSeason);
     $this->set('formEpisode', $formEpisode);
     $this->set('languageDetail', $languageDetail);
     $this->set('serviceItem', $serviceItem);
     $this->set('servicesList', $servicesList);
     $this->set('abbrCountry', $abbrCountry);
    $this->set('idDetail', $idDetail);
    $this->set('typeDetail', $typeDetail);
    $this->set('titleDetail', $titleDetail);
    $this->set('title','detail ??? ' .$titleDetail.'');
  }


  public function search() {
    if(isset($_SESSION['id'])){
      $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
      if ($contentType === "application/json") {
        $content = trim(file_get_contents("php://input"));
        $data = json_decode($content, true);

       if($_POST['action'] == 'addWatchlist'){
        $newWatch = new Watch_list;
        $newWatch->user_id = $_SESSION['id'];
        $newWatch->watch_id = $_POST['watch__id'];
        $newWatch->title = $_POST['watch__name'];
        $newWatch->duration = intval($_POST['runtime']) * 60;
          if($_POST['watch__type']=='series'){
            $newWatch->series = 1;
            $newWatch->current_ep = 1;
            $newWatch->current_ses = 1;
          }
          if($_POST['watch__type']=='movie'){
            $newWatch->movie = 1;
          }
        $newWatch->save();
        header('Location:index.php?page=overview');
        exit();
       }
      }
    }

      if(!empty($_POST['action'])) {
      if($_POST['action']== 'searchWatchlist'){
          $exists = Watch_list::where('user_id', '=', $_SESSION['id'])->get();
          $data = $_POST;
          $errors = Watch_list::validate($data);
          if(empty($errors)){
          $titleClean = str_replace(' ', '%20', $_POST['title']);
          $seriesSearch = 'https://api.themoviedb.org/3/search/tv?api_key=662c8478635d4f25ee66abbe201e121d&query=' . $titleClean ;
          $moviesSearch = 'https://api.themoviedb.org/3/search/movie?api_key=662c8478635d4f25ee66abbe201e121d&query=' . $titleClean;
          $seriesCode = file_get_contents($seriesSearch);
          $moviesCode = file_get_contents($moviesSearch);
          $resultSeries = json_decode($seriesCode);
          $resultMovies = json_decode($moviesCode);
          $seriesArray = $resultSeries->results;
          $moviesArray = $resultMovies->results;
          $resultList = array_merge($seriesArray, $moviesArray);

           if($_POST['form__type'] == 'movie'){
             $list = $moviesArray;
          } else if($_POST['form__type'] == 'series'){
              $list = $seriesArray;
          } else if($_POST['form__type'] == 'movie/series'){
              $list = $resultList;
          }

          $titleSearch = $_POST['title'];
          $typeSearch = $_POST['form__type'];

         $this->set('list', $list);
          $this->set('exists', $exists);
        } else{
          $list ='';
          $this->set('list', $list);
          $this->set('errors', $errors);
         }

      }
   }

   if(!empty($_POST['title'])){
   $this->set('titleSearch', $titleSearch);
   }

    if(!empty($_POST['action'])) {
      if($_POST['action'] == 'addWatchlist'){
        $newWatch = new Watch_list;
        $newWatch->user_id = $_SESSION['id'];
        $newWatch->watch_id = $_POST['watch__id'];
        $newWatch->title = $_POST['watch__name'];
        $newWatch->duration = intval($_POST['runtime']) * 60;
          if($_POST['watch__type']=='series'){
            $newWatch->series = 1;
            $newWatch->current_ep = 1;
            $newWatch->current_ses = 1;
          }
          if($_POST['watch__type']=='movie'){
            $newWatch->movie = 1;
          }
        $newWatch->save();

      }

    }


    $this->set('title','My watchlist - Search');

  }

  public function apiSearch() {
    $exists = Watch_list::where('user_id', '=', $_SESSION['id'])->get();
    //echo $_GET['watch_id'];
    //echo(json_decode($exists));
    // $watchIds = array();
    // foreach($exists as $exist){
    //   $watch_id = $exist->watch_id;
    // }
    // array_push($watchIds, $watch_id);
    echo $exists;
    exit;
  }

  public function signup() {
    if(!empty($_POST['action'])) {
      if ($_POST['action'] == 'signup') {

        $newUser = new User;
        $newUser->name = $_POST['name'];
        $newUser->surname = $_POST['surname'];
        $newUser->username = $_POST['username'];
        $newUser->email = $_POST['email'];
        $newUser->password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $errors = User::validate($newUser);
        if (empty($errors)) {

           $newUser->save();
           $_SESSION['name']=$_POST['name'];
           $_SESSION['password']=$_POST['password'];
           $_SESSION['id']=$newUser->id;


          header('Location:index.php?page=signup2');
          exit();
        }else{
          $this->set('errors', $errors);
        }
      }

    }
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

        }


          $strServ->save();
          foreach($_POST['country'] as $value){

            $newUser->country = $value;
        }
        $errors = User::validate($newUser);
        if (empty($errors)) {
        $newUser->save();
        header('Location:index.php?page=overview');
          exit();
        }else{
          $this->set('errors', $errors);
        }
      }

    }
    $countries= array("-----","Albania", "Algeria","Argentina","Armenia","Australia","Austria","Azerbaijan","Bahamas","Bangladesh","Belarus","Belgium","Bolivia","Bosnia and Herzegovina","Brazil","Brunei","Bulgaria","Burkina Faso","Canada" ,"Colombia","Costa Rica","Croatia","Cuba","Cyprus","Czechoslovakia","Czech Republic","Denmark","Dominican Republic","Ecuador","Egypt","Estonia","Ethiopia","Finland","France","Georgia","Germany","Ghana","Greece","Guatemala","Honduras","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Israel","Italy","Jamaica","Japan","Jordan","Kazakhstan","Korea","Kosovo","Kuwait","Kyrgyzstan","Latvia","Lebanon" ,"Lithuania","Luxembourg" ,"Malaysia" ,"Mali","Malta","Mexico","Mongolia","Morocco","Netherlands","New Zealand","Nigeria","Norway","Pakistan","Peru","Philippines","Poland","Portugal","Romania","Russia" ,"Saudi Arabia","Senegal","Singapore","Slovakia", "Slovenia", "South Africa","Soviet Union" ,"Spain","Sweden","Switzerland","Syria","Thailand","Tunisia","Turkey","Ukraine","United Arab Emirates", "United Kingdom","United Status","Venezuela","Vietnam");
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

  public function timeslot() {
    unset($watchSuggestions);
    if(!empty($_POST['action'])) {
    if ($_POST['action'] == 'timeslot') {
      $startDateAndTime=$_POST['timeslot--start'];
      $endDateAndTime=$_POST['timeslot--end'];

      $startDateNonFormat = strtotime($startDateAndTime);
      $endDateNonFormat = strtotime($endDateAndTime);
      $this->set('startDateNonFormat', $startDateNonFormat);
      $this->set('endDateNonFormat', $endDateNonFormat);

       $availableTimeNonFormat=$endDateNonFormat-$startDateNonFormat;
       $availableTime=date($availableTimeNonFormat);
       $_SESSION['availableTime']=$availableTime;
       $_SESSION['startTime']=$startDateNonFormat;
       $_SESSION['endTime']=$endDateNonFormat;



      $watchSuggestions= Watch_list::where('user_id', '=', $_SESSION['id'])->where('duration', '<=', $availableTime)->get();

      $overtime=$_POST['limit__radio'];
      $_SESSION['overtime']=$overtime;
      $this->set('overtime', $overtime);

      $this->set('availableTime', $availableTime);
      $this->set('watchSuggestions', $watchSuggestions);

    }
  }
  if(!empty($_POST['action'])) {

    if ($_POST['action'] == 'addWatchItem') {

      $watchArray=array();
      $watchTimes=array();
      $overdueTimes=array();
      $possibleTimes=array();
      $amountEpisodes=array();

        foreach($_POST['multiEps'] as $value){
          $tempEpisodes= explode('-', $value);
          $amountEpisodes[$tempEpisodes[0]]=$tempEpisodes[1];

        }

      foreach($_POST['watchItem'] as $watchItem){

        $watchListItem= Watch_list::where('user_id', '=', $_SESSION['id'])->where('watch_id', '=', $watchItem)->first();
        array_push($watchArray, $watchListItem);
        $selectedEps=$amountEpisodes[$watchItem];

        $newAvailableTime=$_SESSION['availableTime']-($watchListItem->duration*$selectedEps);
        $this->set('newAvailableTime', $newAvailableTime);

      }
      $watchDuration=0;
      foreach($watchArray as $watchItem){
        $watchDuration +=$watchItem->duration*$amountEpisodes[$watchItem->watch_id];
      }
      $this->set('watchDuration', $watchDuration);


        $currentTime=$_SESSION['startTime'];


      if($watchDuration <= $_SESSION['availableTime'] ){
        foreach($watchArray as $watchItem){

          if($watchItem->series==1){
          $itemInfo='https://api.themoviedb.org/3/tv/'. $watchItem->watch_id . '?api_key=662c8478635d4f25ee66abbe201e121d';
          $suggCode = file_get_contents($itemInfo);
          $suggInfo= json_decode($suggCode);
          $currentSeasonChanged=$watchItem->current_ses;
          $currentEpChanged=$watchItem->current_ep;
          for ($i=0; $i < intval($amountEpisodes[$watchItem->watch_id]); $i++) {

            $currentSesEps=$suggInfo->seasons[$currentSeasonChanged - ($suggInfo->seasons[0]->name !=='Specials' ? 1 : 0)]->episode_count;
            $this->set('currentSesEps', $currentSesEps);
              if($currentTime < $_SESSION['endTime']){
              $newTimeslot = new Planner;
              $newTimeslot->user_id = $_SESSION['id'];
              $newTimeslot->watch_id=$watchItem->watch_id;
              $newTimeslot->title=$watchItem->title;

              $newTimeslot->series=1;

              $plannedTime=$currentTime+($watchItem->duration*($i+1));
              array_push($watchTimes, $currentTime);
              $newTimeslot->date= date("Y-m-d", $currentTime);
              $newTimeslot->time= date("H:i", $currentTime);

                if(intval($currentSesEps) < $currentEpChanged){
                  $currentEpChanged=1;
                  $currentSeasonChanged++;
                }
                $newTimeslot->current_ep=$currentEpChanged;

                $newTimeslot->current_ses=$currentSeasonChanged;

              $currentTime=$plannedTime;
              $newTimeslot->save();
            }
            $currentEpChanged++;


          }
          }else if($watchItem->movie==1){
            if($currentTime < $_SESSION['endTime']){
              $newTimeslot = new Planner;
              $newTimeslot->user_id = $_SESSION['id'];
              $newTimeslot->watch_id=$watchItem->watch_id;
              $newTimeslot->title=$watchItem->title;
              $newTimeslot->movie=1;
              $plannedTime=$currentTime+$watchItem->duration;
              array_push($watchTimes, $currentTime);
              $newTimeslot->date= date("Y-m-d", $currentTime);
              $newTimeslot->time= date("H:i", $currentTime);
              $currentTime=$plannedTime;
              $newTimeslot->save();
            }

          }
      }

        $_SESSION['availableTime']='';
        header('Location:index.php?page=home');
          exit();


      }else if($watchDuration > $_SESSION['availableTime']){
        foreach($watchArray as $watchItem){

          if($currentTime+$watchItem->duration < $_SESSION['endTime']){
            array_push($possibleTimes, $watchItem);
            $plannedTime=$currentTime+$watchItem->duration;
            $currentTime=$plannedTime;
          }else{
            array_push($overdueTimes, $watchItem);
          }
        }

      }

      $this->set('watchArray', $watchArray);
      $this->set('watchTimes', $watchTimes);
      $this->set('overdueTimes', $overdueTimes);
      $this->set('possibleTimes', $possibleTimes);
    }
  }

  if(!empty($_SESSION['availableTime'])){
    $availableTime=$_SESSION['availableTime'];
    $this->set('availableTime', $availableTime);
    $watchSuggestions= Watch_list::where('user_id', '=', $_SESSION['id'])->where('duration', '<=', $availableTime)->get();
    $this->set('watchSuggestions', $watchSuggestions);
  }

  $this->set('title','Add a timeslot');
  }

  public function account() {
    $user = User::where('id', '=', $_SESSION['id'])->first();
    $services = Stream_service::where('user_id', '=', $_SESSION['id'])->get();

    $serviceView = [];
    foreach($services as $info){
          if($info->netflix == 1){
            $serviceItem = '<img class="account__provider" src="../src/assets/netflix.svg" alt="netflix">';
            array_push($serviceView, $serviceItem);
          }
          if($info->disney == 1){
            $serviceItem = '<img class="account__provider" src="../src/assets/disney.svg" alt="disney">';
            array_push($serviceView, $serviceItem);
          }
          if($info->amazon_prime == 1){
            $serviceItem = '<img class="account__provider" src="../src/assets/prime.svg" alt="prime">';
            array_push($serviceView, $serviceItem);
          }
          if($info->hulu == 1){
            $serviceItem = '<img class="account__provider" src="../src/assets/hulu.svg" alt="hulu">';
            array_push($serviceView, $serviceItem);
          }
          if($info->hbo_max == 1){
            $serviceItem = '<img class="account__provider" src="../src/assets/hbo.svg" alt="hbo">';
            array_push($serviceView, $serviceItem);
          }

      }

      $date = substr($user->created_at, 0, -8);

      $this->set('date', $date);
      $this->set('serviceView', $serviceView);
      $this->set('user', $user);
      $this->set('title','Account');
  }

}
