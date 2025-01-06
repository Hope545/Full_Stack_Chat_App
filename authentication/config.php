<?php  
// creating the connection between the pages and the database

try{
    // defining the host
    define("HOST", "localhost");

    // defining the database name
    define("DBNAME", "ajax-php");

    // defining the user
    define("USER", "root");
    
    // defining the password
    define("PASS", "");


    // establishing the connection
    $conn = new PDO("mysql:host=".HOST.";dbname=".DBNAME."", USER, PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

catch(PDOException $Exception){
        echo $Exception->getMessage();
    }
    


