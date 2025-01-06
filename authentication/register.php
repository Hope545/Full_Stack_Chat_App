<?php 

require "../authentication/config.php";

// when the register button is clicked
if (empty($_POST['firstname']) && empty($_POST['lastname']) && empty($_POST['email']) && empty($_POST['password'])){
    echo "All fields are empty";
}
else if(empty($_POST['firstname'])){
    echo "Firstname field is empty";
}
else if(empty($_POST['lastname'])){
    echo "Lastname field is empty";
}
else if (empty($_POST['email'])){
    echo "Email field is empty";
}
else if (empty($_POST['password'])){
    echo "Password field is empty";
}
else{
    // storing the form details in variables thus if the input fields are not empty
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password =password_hash( $_POST['password'], PASSWORD_DEFAULT); // hashing the password before storing it in the data base

    // checking if email is valid
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        // checking if the users email already exist in our data base
        $loginEmail = $conn->query("SELECT `email` FROM `users` WHERE `email` = '$email'");
        $loginEmail->execute();
        $newEmail = $loginEmail->fetch(PDO::FETCH_ASSOC);

        if($loginEmail->rowCount() > 0){
            // display error message  for the email that it already exists
            echo "$email - already exists!";
        }
        else{
            // lets check the users uploaded image file 
            if(isset($_FILES['image'])){
                $img_name = $_FILES['image']['name'];
                $tmp_name = $_FILES['image']['tmp_name'];

                // checking the extension of the uploaded image
                $img_explode = explode( ".", $img_name);
                $img_extension = end($img_explode);

                // defining some extensions that tells the format we want the image
                $extensions = ["jpg", "jpeg", "png"];

                // comparing the image's extension to the pre defined extension we have
                if(in_array($img_extension, $extensions) === true){
                    $time = time() * 10; 

                    // assigning a new name to the uploaded image
                    $new_image_name = $time.$img_name;

                    // moving the users uploaded image to our particular folder
                    if(move_uploaded_file($tmp_name, "images/" . $new_image_name)){
                        $status = "Active Now"; // giving the new user an actuve attribute

                        // creating a unique id for the user
                        $unique_id = rand(time(), 10000000);

                        // inserting all the data we expected from the user into the database
                        $insert = $conn->prepare("INSERT INTO `users` (`firstname`, `lastname`, `email`, `password`, `image`, `status`, `unique_id`)
                                                    VALUES (:firstname, :lastname, :email, :password, :image, :status, :unique_id)");
                        $insert->execute([
                            ":firstname" => $firstname,
                            ":lastname" => $lastname,
                            ":email" => $email,
                            ":password" => $password, 
                            ":image" => $new_image_name,
                            ":status" => $status,
                            ":unique_id" => $unique_id,
                        ]);
                        
                        echo "Success";
                    }
                }
                else{
                     // display error message about the uploaded image
                    echo "Please enter an image with ext - (.jpg .png .jpeg)";
                }

            }
            else{
                // display error message about the uploaded image
                echo "Sorry please enter an image";
            }
        }
    }
    else{
        // display error message for the email
        echo "$email - is invalid!";
    }


}