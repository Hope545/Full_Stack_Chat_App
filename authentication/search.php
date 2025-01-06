<?php 
session_start();
require "../authentication/config.php";

if("searchTerm"){
    $searchTerm = $_POST['searchTerm']; // storing the search term in a variable
    
    // fetching related search from the data base excluding the user in session
    $search = $conn->query("SELECT * FROM `users` WHERE `unique_id` != '$_SESSION[unique_id]' AND (`firstname` LIKE '%{$searchTerm}%' OR `lastname` LIKE '%{$searchTerm}%')");
    $search->execute();
    $allsearches = $search->fetchAll(PDO::FETCH_OBJ);

    // checking if the search term matches any name in the database
    $output = "";
    if($search->rowCount() > 0){
        require "../authentication/data.php";
    }
    else{
        $output .= "No user found related to your search - $searchTerm";
    }

    echo $output; // returing the result to ajax

}