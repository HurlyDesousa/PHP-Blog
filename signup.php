<?php
//Prologue of signup.php:
//This page shows the user the signup form.
include "header.php";
// The header will display ontop of the page and provide navigation.
?>

<main class="main-body">
  <div class="form">
    <section class="signup-form">
      <h1 class="heading">SignUp!</h1>
      <?php
      if (isset($_GET['error'])) {
        if ($_GET['error'] == "emptyfieldssignup") {
          echo '<p class="signuperror">All fields must be filled in!</p>';
        }
        elseif ($_GET["error"] == "invalidmailuid") {
          echo '<p class="signuperror">Invalid username and e-mail!</p>';
        }
        elseif ($_GET["error"] == "invaliduid") {
          echo '<p class="signuperror">Invalid username!</p>';
        }
        elseif ($_GET["error"] == "invalidmail") {
          echo '<p class="signuperror">Invalid e-mail!</p>';
        }
        elseif ($_GET["error"] == "passwordcheck") {
          echo '<p class="signuperror">Your passwords do not match!</p>';
        }
        elseif ($_GET["error"] == "usertaken") {
          echo '<p class="signuperror">Username is already taken!</p>';
        }
      }
      else  {
        if (isset($_GET['signup'])) {

          if ($_GET['signup'] == "success") {
            echo '<p class="suc">Success!</p><br><p>We sent you an email with your login details.<p>';
          }
        } else {
          echo '<p class="">Fill in the form below.</p>';
        }
      }
      ?>
      <form action="includes/signup.inc.php" method="post" autocomplete="on">
        <input style="width:230px;" type="text" name="uid" placeholder="Username" autocomplete="on"><br>
        <input style="width:230px;"  type="text" name="mail" placeholder="E-Mail" autocomplete="on"><br>
        <input style="width:230px;"  type="password" name="pwd" placeholder="Password"><br>
        <input style="width:230px;"  type="password" name="pwd-repeat" placeholder="Repeat password"><br>
        <button class="button" type="submit" name="signup-submit">Sign Up</button>
      </form>

    </section>
  </div>
</main>


<?php
require "footer.php";
// The footer will display at the bottom of this page and provide copyright information.
?>
