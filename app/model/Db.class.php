<?php

class Db {
  // The database connection
  protected static $connection;

  /**
  * Connect to the database
  *
  * @return bool false on failure / mysqli MySQLi object instance on success
  */
  public function connect() {
    $host = DB_HOST;
    $database = DB_DATABASE;
    $username = DB_USER;
    $password = DB_PASS;

    // Try and connect to the database
    if(!isset(self::$connection)) {
      // Load configuration as an array. Use the actual location of your configuration file
      self::$connection = new mysqli($host, $username, $password, $database);
    }

    // If connection was not successful, handle the error
    if(self::$connection === false) {
      // Handle error - notify administrator, log to a file, show an error screen, etc.
      return false;
    }
    return self::$connection;
  }

  /**
  * Query the database
  *
  * @param $query The query string
  * @return mixed The result of the mysqli::query() function
  */
  public function query($query) {
    // Connect to the database
    $connection = $this -> connect();

    // Query the database
    $result = $connection -> query($query);
    

    /* Log every query and response for debugging purposes */
    ob_start();
    var_dump($connection);
    $output = ob_get_clean();
    $outputFile = "/logs/db/output.txt";
    $filehandle = fopen($outputFile, 'a') or die("FIle creation error.");
    fwrite($filehandle, "\n".time()."\n".$query."\n");
    fwrite($filehandle, $output);
    fclose($fileHandle); 
    /* End logging. */
    
    return $result;
  }

  /**
  * Fetch rows from the database (SELECT query)
  *
  * @param $query The query string
  * @return bool False on failure / array Database rows on success
  */
  public function select($query) {
    $rows = array();
    $result = $this -> query($query);

    if($result === false) {
      return false;
    }

    while ($row = $result -> fetch_assoc()) {
      $rows[] = $row;
    }

    return $rows;
  }

  /**
  * Fetch the last error from the database
  *
  * @return string Database error message
  */
  public function error() {
    $connection = $this -> connect();
    return $connection -> error;
  }

  /**
  * Quote and escape value for use in a database query
  *
  * @param string $value The value to be quoted and escaped
  * @return string The quoted and escaped string
  */
  public function quote($value) {
    $connection = $this -> connect();
    return "'" . $connection -> real_escape_string($value) . "'";
  }


  /**
   *  Add a new user to the user database and return the result of
   *  the query
   *
   * @param $fn First Name
   * @param $ln Last Name
   * @param $em Email
   * @param $pw Password
   */
  public function register($fn, $ln, $em, $pw) {

    $rand = rand(); /* Please don't be a duplicate */
    $query = "INSERT into users (id, first_name, last_name, email, password) VALUES (".$rand.", ".$fn.", ".$ln.", ".$em.", ".$pw.");";

    return $this -> query($query);
  }
}
