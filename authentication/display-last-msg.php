<?php


// displaying the last message between the users on each account
// selecting data from the date base such that we fetch messages where only the incoming id matches the outgoing id
$message = $conn->query("SELECT * FROM `messages` WHERE (`outgoing_msg_id` = '$_SESSION[unique_id]' AND `incoming_msg_id` = '$user->unique_id') OR 
(`outgoing_msg_id` = '$user->unique_id' AND `incoming_msg_id` = '$_SESSION[unique_id]') ORDER BY `id` DESC LIMIT 1");
$message->execute();
$lastMessage = $message->fetch(PDO::FETCH_OBJ);

if($message->rowCount() > 0){
    // display messages yet
    $result = $lastMessage->message;
}
else{
    // display no messages yet
    $result = "No messages available";
}

// trimming message
(strlen($result) > 28) ? $msg = substr($result, 0, 60) . '...' : $msg = $result;

// adding a you vaiable to the message
if ($lastMessage && isset($lastMessage->outgoing_msg_id)) {
    ($_SESSION['unique_id'] == $lastMessage->outgoing_msg_id && $result !== "No messages available") ? $you = "You: " : $you = "";
} else {
    $you = ""; // Set a default value when $lastMessage is NULL or outgoing_msg_id is not set
}