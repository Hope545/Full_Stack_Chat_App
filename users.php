<?php 
session_start();
require "includes/header.php";
require "authentication/config.php";



// preventing the user from accessing theis page if the user is not logged in
if(!isset($_SESSION['unique_id'])){
  header("location: ".APPURL."login.php");
}

// fetching the users details using the unique id
$account = $conn->query("SELECT * FROM `users` WHERE `unique_id` = '$_SESSION[unique_id]'");
$account->execute();
$accountDetails = $account->fetch(PDO::FETCH_OBJ);

// fetching all other users except the main user



?>

  <body>
    <div class="wrapper">
      <section class="users">
        <header>
          <div class="content">
            <img src="<?php echo APPURL; ?>authentication/images/<?php echo $accountDetails->image; ?>" alt="" />
            <div class="details">
              <span><?php echo $accountDetails->firstname . " " . $accountDetails->lastname; ?></span>
              <p><?php echo $accountDetails->status; ?></p>
            </div>
            <a href="<?php echo APPURL; ?>authentication/logout.php?unique_id=<?php echo $accountDetails->unique_id; ?>" class="logout">Logout</a>
          </div>
        </header>

        <div class="search">
          <span>Select a user to start a chat</span>
          <input
            type="text"
            placeholder="Enter name to search... "
            name="search_bar"
          />
          <button name="search"><i class="mdi mdi-magnify"></i></button>
        </div>
        <div class="users-list">
          
        </div>
      </section>
    </div>


<?php 

require "includes/footer.php"

?>