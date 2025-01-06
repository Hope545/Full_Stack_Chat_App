<?php

session_start();
require "../authentication/config.php";

if(isset($_GET['unique_id'])){
    $logoutID = $_GET['unique_id'];

    // fetching the details of the user we want to logout
   $logout = $conn->query("SELECT * FROM `users` WHERE `unique_id` = '$_GET[unique_id]'");
   $logout->execute();
   $logoutUser = $logout->fetch(PDO::FETCH_OBJ);

    if($logout->rowCount() > 0){
        $status = "Offline Now";

        // when the user logout, the status of the user should be offline
        $update = $conn->query("UPDATE `users` SET `status` = '$status' WHERE `unique_id` = '$logoutID' ");
        $update->execute();

        if($update){
            session_unset();
            session_destroy();
            // redirecting the user to the login page
            header("location: http://localhost/ajaxphp/login.php");
        }
    }
    else{
        // redirecting the user to the users page
        header("location: http://localhost/ajaxphp/users.php");
    }
}
else{
    // redirecting the user to the login page   
    header("location: http://localhost/ajaxphp/login.php");
}