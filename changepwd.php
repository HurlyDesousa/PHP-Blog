<?php
//Prologue of changepwd.php:
//This page provides the user with a form to change an update their password to a new one.
require "header.php";
// The header will display ontop of the page and provide navigation.

?>

<head>
  <script type="text/javascript">
  function validatePassword() {
    var defaultcurrentPass,changenewPass,RetypePassword,output = true;

    defaultcurrentPass = document.frmChange.defaultcurrentPass;
    changenewPass = document.frmChange.changenewPass;
    RetypePassword = document.frmChange.RetypePassword;

    if(!defaultcurrentPass.value) {
      defaultcurrentPass.focus();
      document.getElementById("defaultcurrentPass").innerHTML = "required";
      output = false;
    }

    else if(!changenewPass.value) {
      changenewPass.focus();
      document.getElementById("changenewPass").innerHTML = "required";
      output = false;
    }

    else if(!RetypePassword.value) {
      RetypePassword.focus();
      document.getElementById("RetypePassword").innerHTML = "required";
      output = false;
    }

    if(changenewPass.value != RetypePassword.value) {
      changenewPass.value="";
      RetypePassword.value="";
      changenewPass.focus();
      document.getElementById("RetypePassword").innerHTML = "Both Password are not same";
      output = false;
    }
    return output;
  }

  </script>
</head>
<body>


  <main>
    <div class="about-container">
      <br><br><br><h2>Change Password</h2><br><br>
    </p>Update your password in the fields below:</p><br><br>
    <form class="pwdfrom" name="frmChange" action="includes/updatepwd.inc.php" method="post" onSubmit="return validatePassword()">
      <label>Current Password: <span id="defaultcurrentPass"  class="required"></span></label>
      <input class="pwdform" type="password" name="defaultcurrentPass" value="" placeholder="Your old password...">
      <label>New Password: <span id="changenewPass" class="required"></span></label>
      <input class="pwdform" type="password" name="changenewPass" value="" placeholder="Your new password...">
      <label>New Password Repeat: <span id="RetypePassword" class="required"></span></label>
      <input  class="pwdform" type="password" name="RetypePassword" value="" placeholder="Your new password repeated..."><hr>
      <button class="button" type="submit" name="updatepass" value="Update Password">Change</button>
      <?php
      if (isset($_GET['error'])) {
        if ($_GET['error'] == "currentpwdincorrect") {
          echo '<p class="required">The current password is incorrect!</p>';
        }
        elseif ($_GET["error"] == "sqlerror") {
          echo '<p class="required">Invalid Field Input!</p>';
        }
      } elseif (isset($_GET['changed'])) {
        if ($_GET['changed'] == "successpwdchange") {
          echo '<p class="suc" style="float: right; margin-top: 20px;">Password was changed!</p>';
        }
      }?>
    </form>
    <?php
    if (isset($_GET['newpwd'])) {
      if ($_GET['newpwd'] == 'updated') {
        echo '<p class="suc">Your password has been reset!</p>';
      }
    }

     ?>

    <a class="forgottenpwd" href="resetpwd.php">forgot password?</a>
  </div>
</main>
</body>



<?php
require "footer.php";
// The footer will display at the bottom of this page and provide copyright information.
?>
