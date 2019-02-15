<?php
//Prologue of createpost.php:
//This page displays the form for the user to create a post with a subject ad a body.
require "header.php";
// The header will display ontop of the page and provide navigation.

?>

<main>
  <div class="about-container">
    <br><br><br><h2>Create a new Blog Post!</h2><br><br>
  </p>Why not publish your ideas and so the world can read them</p><br><br>
  <form class="create-post" action="includes/createpost.inc.php" method="post">
    <p>Title:</p>
    <input type="text" name="post-title" placeholder="Subject">
    <p>Body:</p>
    <textarea class="createpostfield" id="subject" name="post-message" placeholder="Write something of your post..."></textarea>
    <input class="button" type="submit" name="create-post" value="Publish">
  </form>
</div>
</main>




<?php
require "footer.php";
// The footer will display at the bottom of this page and provide copyright information.
?>
