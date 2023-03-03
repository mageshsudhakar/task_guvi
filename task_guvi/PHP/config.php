<?php
  
  


  $dbhost = "127.0.0.1:4306";
  $username = "root";
  $password = "";
  $dbname="login_cred";
  
  $conn = new mysqli($dbhost, $username,$password,$dbname);    
    if ($conn->connect_error){
        die("could not connect to the dadtabase!".$conn->connect_error);
    }
    echo "success";
?>