<?php

include_once '/var/www/NetflixManager/app/global.php';

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
    }
    switch ($action) {
      case 'sign_up':
        $this->sign_up();
        break;
    }
    switch ($action) {
      case 'register':
        echo "\n\nRegistering\n";
        $db = new Db();
        $fn = $db->quote($_POST['fn']);
        $ln = $db->quote($_POST['ln']);
        $em = $_POST['em'];
        $pw = $_POST['pw'];
        echo "REG\n";
        $this->sign_in();
        echo "\n REG with $db test\n";
        break;

	#$this->register($fn, $ln, $em, $pw);
        #break;
    }
    switch ($action) {
      case 'sign_in':
        $this->sign_in();
        break;
    }
    switch ($action) {
      case 'process_sign_in':
        $em = $_POST['em'];
        $pw = $_POST['pw'];
        $this->process_sign_in($em, $pw);
        break;
    }
    switch ($action) {
      case 'sign_out':
        $this->sign_out();
        break;
    }
    switch ($action) {
      case 'playlist':
        $this->playlist();
        break;
    }
    switch ($action) {
      case 'add_playlist':
        $this->add_playlist();
        break;
    }
 
   switch ($action)  {
       default:
       $this->home();
       
       break;
    }
  }

  public function home() {
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
      header('Location: '.BASE_URL.'sign_up');
    }
    else {
      $em = $db->quote($em);
      $pw = $db->quote($pw);

      $result = $db->query("INSERT INTO `users` (`first_name`,`last_name`, `email`, `password`) VALUES (" . $fn . "," . $ln . "," . $em ."," . $pw .")");

      if($result) {
        $_SESSION['user'] = $fn;
        header('Location: '.BASE_URL);
      }
      else {
        header('Location: '.BASE_URL.'sign_up');
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
      header('Location: '.BASE_URL.'sign_in');
    }
  }

  public function sign_out() {
    session_unset();
    session_destroy();
    header('Location: '.BASE_URL);
    exit();
  }

  public function playlist() {
    include_once SYSTEM_PATH.'/view/header.tpl';
    include_once SYSTEM_PATH.'/view/playlist.tpl';
    include_once SYSTEM_PATH.'/view/footer.tpl';
  }

  public function add_playlist() {
    include_once SYSTEM_PATH.'/view/header.tpl';
    include_once SYSTEM_PATH.'/view/add_playlist.tpl';
    include_once SYSTEM_PATH.'/view/footer.tpl';
  }

}
