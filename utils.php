<?php

function getConnection() {
  $dbhost = "mysqlsvr74.world4you.com";
  $dbuser = "sql4504066";
  $dbpass = "g@wjt7w";
  $db = "4773441db1";

  // Create connection
  $conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
  mysqli_set_charset($conn, 'utf8');
  
  return $conn;
}

?>