<?php 

session_start();
require "../authentication/config.php";

// collecting data from the typing area submit form
if(isset($_SESSION['unique_id'])){
    $outGoingId = $_POST['outgoing_id'];
    $inComingId = $_POST['incoming_id'];
    $message = $_POST['message'];

    // if the message field is not empty
    if($message != ""){
        // inserting the messages into the data base if the message field is not empty
        $insertMsg = $conn->prepare("INSERT INTO `messages` (`incoming_msg_id`, `outgoing_msg_id`, `message`) VALUES (:incoming_msg_id,
        :outgoing_msg_id, :message)");
        $insertMsg->execute([
            ":incoming_msg_id" => $inComingId,
            ":outgoing_msg_id" => $outGoingId,
            ":message" => $message,
        ]);

    }
}
else{
    // redirecting the user back to the login page
    header("location: http://localhost/ajaxphp/login.php");
}