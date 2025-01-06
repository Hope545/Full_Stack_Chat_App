<?php 
session_start();
require "../authentication/config.php";

// if the users is not logged in
if(!isset($_SESSION['unique_id'])){
    header("location: http://localhost/ajaxphp/login.php");
}

// fetching the data of all other users except the main user
$users = $conn->query("SELECT * FROM `users` WHERE `unique_id` != '$_SESSION[unique_id]'");
$users->execute();
$allUsers = $users->fetchAll(PDO::FETCH_OBJ);



// checking if some other users exist in the data base
$output = "";
if($users->rowCount() == 0){
    $output .= "No users available!";
}
else if ($users->rowCount() > 0){
    foreach($allUsers as $user){


        // display last message between users
        require "../authentication/display-last-msg.php";

        // checking if the user is offline or online
        ($user->status == "Offline Now") ? $offline = "offline" : $offline = "";

        $output .= '
    
    <a href="http://localhost/ajaxphp/chat.php?unique_id='. $user->unique_id .'">
        <div class="content">
            <img src="authentication/images/' . $user->image . '" alt="" />
            <div class="details">
            <span>'. $user->firstname . " " . $user->lastname .'</span>
            <p>'. $you . $msg .'</p>
            </div>
        </div>
        <div class="status-dot '. $offline .'"><i class="mdi mdi-circle"></i></div>
    </a>
    
    ';
    }
    echo $output;
}

