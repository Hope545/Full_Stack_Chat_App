<?php

session_start();
require "../authentication/config.php";

// collecting data from the typing area submit form
if(isset($_SESSION['unique_id'])){
    $outGoingId = $_SESSION['unique_id'];
    $inComingId = $_SESSION['incoming_msg_id'];

    $output = "";
    // selecting data from the date base such that we fetch messages where only the incoming id matches the outgoing id
    $message = $conn->query("SELECT * FROM `messages` WHERE `outgoing_msg_id` = '$outGoingId' AND `incoming_msg_id` = '$inComingId' OR 
    `outgoing_msg_id` = '$inComingId' AND `incoming_msg_id` = '$outGoingId' ORDER BY `id` ASC");
    $message->execute();
    $allMessages = $message->fetchAll(PDO::FETCH_OBJ);

    // fetching the recievers image from the data base
    $recieverImg = $conn->query("SELECT `image` FROM `users` WHERE `unique_id` = '$inComingId'");
    $recieverImg->execute();
    $rImg = $recieverImg->fetch(PDO::FETCH_OBJ);

    // checking if any messages exist in the data base
    if(count($allMessages) > 0){
        foreach($allMessages as $messages){
            if($messages->outgoing_msg_id === $_SESSION['unique_id']){ // if this is true then that user is a msg sender
                $output .= '
                        <div class="chat outgoing">
                            <div class="details">
                                <p>
                                    '. $messages->message .'
                                </p>
                            </div>
                        </div>
                ';
            }
            else{ // else the user is a msg reciever
                $output .= '
                        <div class="chat incoming">
                            <img src="http://localhost/ajaxphp/authentication/images/'. $rImg->image .'" alt="" />
                            <div class="details">
                                <p>
                                    '. $messages->message .'
                                </p>
                            </div>
                        </div>
                
                ';
            }
        }
    }
    else{
        // display there's no message between the two users
        $output .= "<p class='no_msg' style='
        
                                            color: gray; 
                                            font-style: italic; 
                                            font-weight:600; 
                                            position:absolute; 
                                            top:50%; 
                                            left:50%; 
                                            transform: translate(-50%, -50%); 
                                            font-family:monospace; 
                                            font-size:1.5em;'
                                            
                                            >No messages available</p>";
    }

    echo $output;

   
}
else{
    header("location: http://localhost/ajaxphp/login.php");
}