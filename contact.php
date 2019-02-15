<?php
//Prologue of contact.php:
//This page allows any user to contact the website without having to be logged in ,and will take the browser to the contact page.
require "header.php";
// The header will display ontop of the page and provide navigation.
?>

<main>
  <div class="contactform-container">
    <br><h2>Send us an E-Mail!</h2><br>
    <?php
    if (isset($_GET['error'])) {
      if ($_GET['error'] == "mailnotsent") {
        echo '<p class="required">An error has occured, and you message was not sent!</p>';
      }
    } elseif (isset($_GET['success'])) {
      if ($_GET['success'] == "mailsent") {
        echo '<p class="suc">Message Sent!</p>';
      }
    }
    ?>
    <form class="contactform" id="form" action="includes/contact.inc.php" method="post" autocomplete="on">
      <input class="contactforminput" type="text" name="name" placeholder="Full Name*" autocomplete="on" required>
      <input class="contactforminput" type="text" name="subject" placeholder="Subject*" autocomplete="on" required>
      <input class="contactforminputmail" type="email" name="mail" placeholder="Your E-Mail*" autocomplete="on" required>
      <textarea class="contactforminput" name="message" rows="8" cols="80" placeholder="Your Message*" required></textarea>
      <button class="button" type="submit" name="submit_contact">Send E-Mail</button>
    </form>
  </div>
</main>

<script src="javascript/app.js"></script>



<?php
require "footer.php";
// The footer will display at the bottom of this page and provide copyright information.
?>
