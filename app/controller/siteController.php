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

      // case 'script':
      //   $db = new Db();
      //
      //   $files = scandir('json/');
      //   foreach($files as $file) {
      //     $str = file_get_contents('json/'.$file.'');
      //     $json = json_decode($str, true);
      //
      //     if($json['video']['type'] == 'movie') {
      //       $movie_id = $db->quote($json['video']['id']);
      //       $title = $db->quote($json['video']['title']);
      //       $rating = $db->quote($json['video']['rating']);
      //       $year = $db->quote($json['video']['year']);
      //       $length = $db->quote($json['video']['runtime']);
      //       $synopsis = $db->quote($json['video']['synopsis']);
      //       $artwork = $db->quote($json['video']['boxart'][1]['url']);
      //
      //       $result = $db->query("INSERT INTO `movies` (`movie_id`,`title`,`rating`,`year`,`length`,`synopsis`,`artwork`) VALUES (" . $movie_id . "," . $title . "," . $rating . "," . $year . "," . $length . "," . $synopsis . "," . $artwork . ")");
      //     }
      //   }

    }
  }

  public function home() {
    $db = new Db();

    if(isset($_SESSION['user'])) {
      $rows = $db->select("SELECT * FROM `users` WHERE email='".$_SESSION['user']."'");
      $user_id = $rows[0]['id'];

      $rows = $db->select("SELECT * FROM `playlists` WHERE user_id='".$user_id."'");
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

    if($db) {
      header('Location: '.BASE_URL);
    }
    else {
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
    $user = $db->select("SELECT * FROM `users` WHERE email='".$_SESSION['user']."'");
    $playlists = $db->select("SELECT * FROM `playlists` WHERE user_id='".$user[0]['id']."'");

    include_once SYSTEM_PATH.'/view/header.tpl';
    include_once SYSTEM_PATH.'/view/playlist.tpl';
    include_once SYSTEM_PATH.'/view/footer.tpl';
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
    $playlist_id = rand();

    $result = $db->query("INSERT INTO `playlists` (`playlist_id`,`user_id`,`playlist_name`) VALUES (" . $playlist_id . "," . $user_id . "," . $playlist_name . ")");

    if($result) {
      header('Location: '.BASE_URL);
    }
    else {
      echo "failed to create playlist";
    }
  }

  public function search($query) {
    $db = new Db();

    $rows = $db->select("SELECT * FROM `movies` WHERE title LIKE CONCAT('%', '".$query."', '%')");

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

      $rows = $db->select("SELECT * FROM `movies` WHERE content_id='".$content_id."'");

      if(count($rows) > 0 ) {
        $user = $db->select("SELECT * FROM `users` WHERE email='".$_SESSION['user']."'");
        $playlists = $db->select("SELECT * FROM `playlists` WHERE user_id='".$user[0]['id']."'");

        include_once SYSTEM_PATH.'/view/header.tpl';
        include_once SYSTEM_PATH.'/view/content.tpl';
        include_once SYSTEM_PATH.'/view/footer.tpl';
      }
      else {
        echo "failed";
      }
  }

}
