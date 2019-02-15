<?php
//Prologue of editmyprofile.php:
//This page shows the user the form to update their information.
require "header.php";
// The header will display ontop of the page and provide navigation.

?>

<main>
  <div class="myprofile-container">
    <br><br><br>
    <h2>Update your info</h2><br>
    <?php
    if (isset($_GET['error'])) {
      if ($_GET['error'] == "invalidname") {
        echo '<p class="signuperror">Please fill in a correct name.</p>';
      }
    }
    ?>
    <br><br>
  </p>Update your profile so other users can connect to you.</p><br><br>
  <form class="editprofile" action="includes/editmyprofile.inc.php" method="post"><br>
    <p>First Name*:
      <input class="editprofile" type="text" name="fname" placeholder="Your First Name"></p><br><br>
      <p>Last Name*:
        <input class="editprofile" type="text" name="lname" placeholder="Your Last Name"></p><br><br>
        <p>Gender:
          <input type="radio" name="gender" value="Male"> Male
          <input type="radio" name="gender" value="Female"> Female
          <input type="radio" name="gender" value="Other" checked> Other </p><br><br>
          <p>Phone Number:
            <input class="editprofile" style="border: 1px solid #ccc; border-radius: 4px; float: right;" type="tel" name="tel" placeholder="Your Phone Number"></p><br><br>
            <p>Date of Birth:
              <input class="editprofile" style="border: 1px solid #ccc; border-radius: 4px; float: right;" type="date" name="bday" placeholder="Your Date of Birth"></p><br><br>
              <p>Skill status:
                <select class="editprofile" name="skill">
                  <option value="" selected>Choose one</option>
                  <option value="Professional">Professional</option>
                  <option value="Semi-Professional">Semi-Professional</option>
                  <option value="Amateur">Amateur</option>
                  <option value="Noob">Noob</option>
                </select></p><br><br>
                <p>Feal free to contact us if you have any questions.</p><br><br>
                <button class="button" type="submit" name="update-submit">Update</button>
              </form>
            </div>
          </main>


          <?php
          require "footer.php";
          // The footer will display at the bottom of this page and provide copyright information.
          ?>
