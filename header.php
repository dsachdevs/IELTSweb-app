<?php
require_once 'getMenuLiat.php';
?>

<div class="bg-saffron header-bg-radius sticky-top">
<!-- Navigation-bar starts here -->
<nav class="navbar navbar-expand-md navbar-dark bg-dark header-radius sticky-top py-0 nav-fontsize">

  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#myNavbar" aria-controls="myNavbar" aria-expanded="false"
  aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>

  <a class="navbar-brand ml-3" href="index.php"><div class="w100"><img src="./images/logo_white.png" alt="prep4test logo" class="img img-fluid"></div></a>


    <div class="collapse navbar-collapse ml-5" id="myNavbar">
      <ul class="navbar-nav mr-auto mt-2 mt-md-0">
        <?php getContent::displayHeaderMenu();?>
      </ul>

      <ul class="navbar-nav navbar-right mr-2">
        <li class="nav-item">
          <a class="nav-link mx-2" href="./register.php">
            Sign Up
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link mx-2" href="./login.php">
            Login
          </a>
        </li>
      </ul>
    </div>
  <!-- </div> -->
</nav>
</div>
