<?php

include_once '../global.php';

// get the identifier for the page we want to load
$action = $_GET['action'];

// instantiate a SiteController and route it
$pc = new SiteController();
$pc->route($action);

class SiteController {

  public function route($action) {
    switch ($action) {
      case 'home':
        $this->home();
        break;

      case 'sign_up':
        $this->sign_up();
        break;

      case 'register':
        $db = new Db();
        $fn = $db->quote($_POST['fn']);
        $ln = $db->quote($_POST['ln']);
        $em = $_POST['em'];
        $pw = $_POST['pw'];
				$this->register($fn, $ln, $em, $pw);
        break;

      case 'sign_in':
        $this->sign_in();
        break;

      case 'process_sign_in':
        $em = $_POST['em'];
        $pw = $_POST['pw'];
        $this->process_sign_in($em, $pw);
        break;

      case 'sign_out':
        $this->sign_out();
        break;

      case 'playlist':
        $playlist_id = $_GET['playlist_id'];
        $this->playlist($playlist_id);
        break;

      case 'add_playlist':
        $this->add_playlist();
        break;

      case 'create_playlist':
        $playlist_name = $_POST['playlist_name'];
        $this->create_playlist($playlist_name);
        break;

      case 'search':
        $query = $_POST['search_query'];
        $this->search($query);
        break;

      case 'add_to_playlist':
        $playlist_id = $_GET['playlist_id'];
        $title = $_GET['title'];
        $content_id = $_GET['content_id'];
        $this->add_to_playlist($playlist_id, $title, $content_id);
        break;

      case 'content_preview':
        $content_id = $_GET['content_id'];
        $this->content_preview($content_id);
        break;

      case 'delete_item':
        $playlist_id = $_GET['playlist_id'];
        $content_id = $_GET['content_id'];
        $this->delete_item($playlist_id, $content_id );

      case 'script':
        // $db = new Db();
        //
        // $files = scandir('json/');
        // foreach($files as $file) {
        //   $str = file_get_contents('json/'.$file.'');
        //   $json = json_decode($str, true);
        //
        //
        //   $content_id = $db->quote($json['video']['id']);
        //   $title = $db->quote($json['video']['title']);
        //   $rating = $db->quote($json['video']['rating']);
        //   $year = $db->quote($json['video']['seasons'][0]['year']);
        //
        //   $l = 0;
        //   if($json['video']['type'] == 'show') {
        //     for($i = 0; $i < count($json['video']['seasons']); $i++) {
        //       for($j = 0; $j < count($json['video']['seasons'][$i]['episodes']); $j++)
        //         $l += $json['video']['seasons'][$i]['episodes'][$j]['runtime'];
        //     }
        //   }
        //   else {
        //     $l = $json['video']['runtime'];
        //   }
        //
        //   $length = $db->quote($l);
        //
        //   $synopsis = $db->quote($json['video']['synopsis']);
        //   $artwork = $db->quote($json['video']['boxart'][1]['url']);
        //
        //   $result = $db->query("INSERT INTO `content` (`content_id`,`title`,`rating`,`year`,`length`,`synopsis`,`artwork`) VALUES (" . $content_id . "," . $title . "," . $rating . "," . $year . "," . $length . "," . $synopsis . "," . $artwork . ")");
        // }

    }
  }

  public function home() {
    $db = new Db();

    if(isset($_SESSION['user'])) {
      $rows = $db->select("SELECT * FROM `users` WHERE email='".$_SESSION['user']."'");
      $user_id = $rows[0]['id'];

      $rows = $db->select("SELECT * FROM `playlists` WHERE user_id='".$user_id."'");
      $rows2 = [];

      for($i = 0; $i < count($rows); $i++) {
        $id = $rows[$i]['playlist_id'];
        $rows2[$i] = $db->select("SELECT * FROM `playlist_content` WHERE playlist_id='".$id."'");
      }

      $artwork = [];

      for($i = 0, $j = 0; $i < count($rows2); $i++) {
        if(count($rows2[$i]) > 0) {
          $id = $rows2[$i][0]['content_id'];
          $artwork[$j] = $db->select("SELECT * FROM `content` WHERE content_id='".$id."'");
          $j++;
        }
      }

    }

    include_once SYSTEM_PATH.'/view/header.tpl';
    include_once SYSTEM_PATH.'/view/home.tpl';
    include_once SYSTEM_PATH.'/view/footer.tpl';
  }

  public function sign_up() {
    include_once SYSTEM_PATH.'/view/header.tpl';
    include_once SYSTEM_PATH.'/view/sign_up.tpl';
    include_once SYSTEM_PATH.'/view/footer.tpl';
  }

  public function register($fn, $ln, $em, $pw) {
    $db = new Db();

    $rows = $db->select("SELECT * FROM `users` WHERE email='".$em."' and password='".$pw."'");

    if(count($rows) > 0) {
      header('Location: '.BASE_URL.'/sign_up');
    }
    else {
      $em = $db->quote($em);
      $pw = $db->quote($pw);

      $result = $db->query("INSERT INTO `users` (`first_name`,`last_name`, `email`, `password`) VALUES (" . $fn . "," . $ln . "," . $em ."," . $pw .")");

      if($result) {
        $_SESSION['user'] = $fn;
        $_SESSION['email'] = $em;
        header('Location: '.BASE_URL);
      }
      else {
        header('Location: '.BASE_URL.'/sign_up');
      }
    }
  }

  public function sign_in() {
    include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/sign_in.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
  }

  public function process_sign_in($em, $pw) {
    $db = new Db();

    $rows = $db->select("SELECT * FROM `users` WHERE email='".$em."' and password='".$pw."'");

    if (count($rows) > 0) {
      $_SESSION['user'] = $em;
      header('Location: '.BASE_URL);
    }
    else {
      header('Location: '.BASE_URL.'/sign_in');
    }
  }

  public function sign_out() {
    session_unset();
    session_destroy();
    header('Location: '.BASE_URL);
    exit();
  }

  public function playlist($playlist_id) {
    $db = new Db();

    $rows = $db->select("SELECT * FROM `playlist_content` WHERE playlist_id='".$playlist_id."'");
    $name = $db->select("SELECT * FROM `playlists` WHERE playlist_id='".$playlist_id."'");
    $rows2 = [];

    for($i = 0; $i < count($rows); $i++) {
      $id = $rows[$i]['content_id'];
      $rows2[$i] = $db->select("SELECT * FROM `content` WHERE content_id='".$id."'");
      $rows2[$i][0]['length'] = $this->seconds_to_time($rows2[$i][0]['length']);
    }

    $user = $db->select("SELECT * FROM `users` WHERE email='".$_SESSION['user']."'");
    $playlists = $db->select("SELECT * FROM `playlists` WHERE user_id='".$user[0]['id']."'");

    include_once SYSTEM_PATH.'/view/header.tpl';
    include_once SYSTEM_PATH.'/view/playlist.tpl';
    include_once SYSTEM_PATH.'/view/footer.tpl';
  }

  public function seconds_to_time($seconds){
     // extract hours
    $hours = floor($seconds / (60 * 60));

    // extract minutes
    $divisor_for_minutes = $seconds % (60 * 60);
    $minutes = floor($divisor_for_minutes / 60);

    // extract the remaining seconds
    $divisor_for_seconds = $divisor_for_minutes % 60;
    $seconds = ceil($divisor_for_seconds);

    //create string HH:MM:SS
    $ret = "";
    if($hours > 0)
      $ret = $hours.":";

    if($minutes <= 9)
      $ret = $ret."0".$minutes;
    else
      $ret = $ret."".$minutes;

    if($seconds > 9) {
      $ret = $ret.":".$seconds;
      return($ret);
    }
    else {
      $ret = $ret.":0".$seconds;
      return($ret);
    }
  }

  public function add_playlist() {
    include_once SYSTEM_PATH.'/view/header.tpl';
    include_once SYSTEM_PATH.'/view/add_playlist.tpl';
    include_once SYSTEM_PATH.'/view/footer.tpl';
  }

  public function create_playlist($playlist_name) {
    $db = new Db();

    $rows = $db->select("SELECT * FROM `users` WHERE email='".$_SESSION['user']."'");

    $user_id = $db->quote($rows[0]['id']);
    $playlist_name = $db->quote($playlist_name);

    $result = $db->query("INSERT INTO `playlists` (`user_id`,`playlist_name`) VALUES (" . $user_id . "," . $playlist_name . ")");

    if($result) {
      header('Location: '.BASE_URL);
    }
    else {
      echo "failed to create playlist";
    }
  }

  public function search($query) {
    $db = new Db();

    $rows;
    if($query === '')
      $rows = $db->select("SELECT * FROM `content`");
    else
      $rows = $db->select("SELECT * FROM `content` WHERE title LIKE CONCAT('%', '".$query."', '%')");

    if(count($rows) > 0 ) {
      $user = $db->select("SELECT * FROM `users` WHERE email='".$_SESSION['user']."'");
      $playlists = $db->select("SELECT * FROM `playlists` WHERE user_id='".$user[0]['id']."'");

      include_once SYSTEM_PATH.'/view/header.tpl';
      include_once SYSTEM_PATH.'/view/search.tpl';
      include_once SYSTEM_PATH.'/view/footer.tpl';
    }
    else {
      echo "failed search query";
    }
  }

  public function add_to_playlist($playlist_id, $title, $content_id) {
    $db = new Db();

    $playlist_id = $db->quote($playlist_id);
    $title = $db->quote($title);
    $content_id = $db->quote($content_id);

    $result = $db->query("INSERT INTO `playlist_content` (`playlist_id`,`title`, `content_id`) VALUES (" . $playlist_id . "," . $title . "," . $content_id . ")");

    if($result) {
      header('Location: '.BASE_URL);
    }
    else {
      echo "failed to add to playlist";
    }
  }

  public function content_preview($content_id) {
      $db = new Db();

      $rows = $db->select("SELECT * FROM `content` WHERE content_id='".$content_id."'");

      if(count($rows) > 0 ) {
        $user = $db->select("SELECT * FROM `users` WHERE email='".$_SESSION['user']."'");
        $playlists = $db->select("SELECT * FROM `playlists` WHERE user_id='".$user[0]['id']."'");

        if($rows[0]['length'] > 0)
          $rows[0]['length'] = $this->seconds_to_time($rows[0]['length']);
        else {
          $rows[0]['length'] = "N/A";
        }

        if($rows[0]['year'] < 1)
          $rows[0]['year'] = "N/A";

        include_once SYSTEM_PATH.'/view/header.tpl';
        include_once SYSTEM_PATH.'/view/content.tpl';
        include_once SYSTEM_PATH.'/view/footer.tpl';
      }
      else {
        echo "failed";
      }
  }

  public function delete_item($playlist_id, $content_id) {
    $db = new Db();

    $result = $db->query("DELETE FROM `playlist_content` WHERE playlist_id='".$playlist_id."' and content_id='".$content_id."'");

    if($result) {
      $this->playlist($playlist_id);
    }
    else {
      echo "failed to delete item";
    }

  }

}
