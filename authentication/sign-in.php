<?php 
session_start();
require "../authentication/config.php";

// collecting data from the login form
if(empty($_POST['email']) AND empty($_POST['password'])){
    // displaying error if all the input fields are empty
    echo "All input fields are empty";
}
else if(empty($_POST['email'])){
    // displaying error if the email field is empty
    echo "Email field empty";
}
else if(empty($_POST['password'])){
    // displaying error if the password field is empty
    echo "Password field empty";
}
else{
    // storing the user credentials in variables
    $email = $_POST['email'];
    $password = $_POST['password'];

    // fetching the users details with the email provided
    $credentials = $conn->query("SELECT * FROM `users` WHERE `email` = '$email'");
    $credentials->execute();
    $userCredentials = $credentials->fetch(PDO::FETCH_ASSOC);

    // checking if the email exists in the data base
    if($credentials->rowCount() > 0){
        // checking if the email matches what we have in the data base
        if($email == $userCredentials['email']){
            // checking if the password is correct
            if(password_verify($password, $userCredentials['password'])){

                $status = "Active Now";

                // when the user login, the status of the user should be updated to active
                $update = $conn->query("UPDATE `users` SET `status` = '$status' WHERE `unique_id` = '$userCredentials[unique_id]' ");
                $update->execute();

                if($update){
                     // making sessions to access the users details with the users unique id in the next page
                    $_SESSION['unique_id'] = $userCredentials['unique_id'];

                    echo "Success";
                }
            }
            else{
                // if the password is wrong
                echo "Email or password is incorrect!";
            }
        }
        else{
            // if the email is wrong
            echo "Email or password is incorrect!";
        }
    }
    else{
        // if the email does not exist 
        echo "Email or password is does not exist";
    }
}