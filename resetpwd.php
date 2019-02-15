<?php
//Prologue of signup.php:
//This page shows the user the signup form.
include "header.php";
// The header will display ontop of the page and provide navigation.
?>

<main class="main-body">
  <div class="form">
    <section class="signup-form">
      <h1 class="heading">Reset your Password!</h1>
      <p>An email will be sent to you, with instructions on how to reset your password. </p>

      <form class="" action="includes/resetpwdrequest.inc.php" method="post">
        <input class="pwdresetemail" type="email" name="email" value="" placeholder="Your Email..." required><br>
        <button class="button" type="sumbit" name="reset-request-sumbit">Reset Now.</button>
        <?php
        if (isset($_GET['reset'])) {
          if ($_GET['reset'] == "success") {
            echo '<p class="suc">Check your E-mail !</p>';
          }
        }
        ?>
      </form>
<hr>
    </section>
  </div>
</main>


<?php
require "footer.php";
// The footer will display at the bottom of this page and provide copyright information.
?>
