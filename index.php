<?php 

require "includes/header.php"

?>

  <body>
    <div class="wrapper">
      <section class="form signup">
        <header>Realtime Chat App</header>

        <form action="authentication/register.php" method="POST" enctype="multipart/form-data">
          <div class="error-text"></div>
          <div class="name-details">
            <div class="field input">
              First Name
              <input type="text" name="firstname" placeholder="First Name" required/>
            </div>
            <div class="field input">
              Last Name
              <input type="text" name="lastname" placeholder="Last Name" required/>
            </div>
          </div>
          <div class="field input">
            Email Address
            <input type="email" name="email" placeholder="Enter your email" required/>
          </div>
          <div class="field input">
            Password
            <input
              type="password"
              name="password"
              placeholder="Enter your password" required
            />
            <i class="mdi mdi-eye-off"></i>
          </div>
          <div class="field image">
          Password
            <input type="file" name="image" required/>
          </div>
          <div class="field button">
            <input type="submit" name="register" value="Continue to chat" />
          </div>
          <div class="link">Already signed up? <a href="<?php echo APPURL;?>login.php">Login now</a></div>
        </form>
      </section>
    </div>


<?php 

require "includes/footer.php"

?>