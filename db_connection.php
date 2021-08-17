<?php

     $database = "localhost";
     $username = "root";
     $password = "";
     $database_name = "activspace_database";

     $connection = new mysqli($database, $username, $password, $database_name);
     if($connection->connect_error){
        die("Failed to connect!". $connection->connect_error);
     }
?>