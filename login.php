<?php 

require "includes/header.php"

?>

  <body>
    <div class="wrapper">
      <section class="form login">
        <header>Realtime Chat App</header>
        <form action="authentication/sign-in.php" method="POST">
          <div class="error-text"></div>
          <div class="field input">
            Email Address
            <input type="email" name="email" placeholder="Enter your email" />
          </div>
          <div class="field input">
            Password
            <input
              type="password"
              name="password"
              placeholder="Enter your password"
            />
            <i class="mdi mdi-eye-off"></i>
          </div>

          <div class="field button">
            <input type="submit" name="login" value="Continue to chat" />
          </div>
          <div class="link">
            Not yet signed up?
            <a href="<?php echo APPURL;?>index.php">Signup now</a>
          </div>
        </form>
      </section>
    </div>


<?php 

require "includes/footer.php"

?>

