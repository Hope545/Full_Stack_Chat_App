<?php

foreach($allsearches as $searches){

// displaying the last message between the users on each account
// selecting data from the date base such that we fetch messages where only the incoming id matches the outgoing id
$message = $conn->query("SELECT * FROM `messages` WHERE (`outgoing_msg_id` = '$_SESSION[unique_id]' AND `incoming_msg_id` = '$searches->unique_id') OR 
(`outgoing_msg_id` = '$searches->unique_id' AND `incoming_msg_id` = '$_SESSION[unique_id]') ORDER BY `id` DESC LIMIT 1");
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

// adding a you referene to the message
if ($searches && isset($searches->unique_id)) {
    ($_SESSION['unique_id'] != $searches->unique_id && $result !== "No messages available") ? $you = "You: " : $you = "";
} else {
    $you = ""; // Set a default value when $lastMessage is NULL or outgoing_msg_id is not set
}

// checking if the user is offline or online
($searches->status == "Offline Now") ? $offline = "offline" : $offline = "";


    $output .= '

<a href="http://localhost/ajaxphp/chat.php?unique_id='. $searches->unique_id .'">
    <div class="content">
        <img src="authentication/images/' . $searches->image . '" alt="" />
        <div class="details">
        <span>'. $searches->firstname . " " . $searches->lastname .'</span>
        <p>'. $you . $msg .'</p>
        </div>
    </div>
    <div class="status-dot '. $offline .'"><i class="mdi mdi-circle"></i></div>
</a>

';
}

