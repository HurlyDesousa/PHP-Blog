<?php
//Prologue of signup.php:
//This page shows the user the signup form.
include "header.php";
// The header will display ontop of the page and provide navigation.
?>

<main class="main-body">
  <div class="form">
    <section class="signup-form">

      <?php

      $selector = $_GET["selector"];
      $validator = $_GET["validator"];

      if (empty($selector) || empty($validator)) {
        echo "Could not validate request!";
      } else {
        if (ctype_Xdigit($selector) !== false && ctype_Xdigit($validator) !== false) {

          ?>
          <form class="contactform" action="includes/resetpwd.inc.php" method="post">
            <input class="contactforminput" type="hidden" name="selector" value="<?php echo $selector ?>">
            <input class="contactforminput" type="hidden" name="validator" value="<?php echo $validator ?>">
            <input class="contactforminput" type="password" name="pwd" placeholder="Enter New Password..." required>
            <input class="contactforminput" type="password" name="pwd-repeat" placeholder="Repeat New Password..." required>
            <button class="button" type="submit" name="resetpwd-submit">Reset Password</button>
          </form>
          <?php
        }
      }

      ?>

    </section>
  </div>
</main>


<?php
require "footer.php";
// The footer will display at the bottom of this page and provide copyright information.
?>
