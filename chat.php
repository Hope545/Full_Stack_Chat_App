<?php 
session_start();
require "includes/header.php";
require "authentication/config.php";


// getting the id of the clicked user
if(isset($_GET["unique_id"])){
  $clickedUserId = $_GET['unique_id'];

  // fetching the main users details from the data base
  $clickedUser = $conn->query("SELECT * FROM `users` WHERE `unique_id` = '$clickedUserId'");
  $clickedUser->execute();
  $clickedUserCredentials = $clickedUser->fetch(PDO::FETCH_OBJ);

  $_SESSION['incoming_msg_id'] = $_GET['unique_id'];
}
?>

  <body>
    <div class="wrapper">
      <section class="chat-area">
        <header>
          <a href="<?php echo APPURL; ?>users.php" class="back-icon"><i class="mdi mdi-arrow-left"></i></a>
          <img src="<?php echo APPURL; ?>authentication/images/<?php echo $clickedUserCredentials->image; ?>" alt="" />
          <div class="details">
            <span><?php echo $clickedUserCredentials->firstname . " " . $clickedUserCredentials->lastname; ?></span>
            <p><?php echo $clickedUserCredentials->status ?></p>
          </div>
        </header>
        <div class="chat-box">
          
        </div>
        <form action="authentication/messages.php">
          <input type="text" name="outgoing_id" value="<?php echo $_SESSION['unique_id']; ?>" hidden>
          <input type="text" name="incoming_id" value="<?php echo $clickedUserId; ?>" hidden>
            <div class="typing-area">
                <input type="text" placeholder="Type a message here..." name="message">
                <button><i class="mdi mdi-telegram"></i></button>
            </div>
        </form>
    </div>
        
      </section>
    </div>


<?php 

require "includes/footer.php"

?>
