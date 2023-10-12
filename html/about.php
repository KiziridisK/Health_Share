<?php
// Initialize the session
session_start();

$login_style = $logout_style = "";

// Check if the user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  $logout_style = "style='display:none;'";
} else {
  $login_style = "style='display:none;'";
}
?>

<!DOCTYPE html>

<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Health and well being - SDG no. 3" />
  <meta name="keywords" content="SDG,Health, Well being, United Nations, UN" />
  <meta name="author" content="Konstantinos Kiziridis,Theodoros Dougalis ,Nikolaos Diamantis, Vasilis Andritsoudis " />

  <!-- Tab icon -->
  <link rel="icon" href="../img/logo.png">

  <!-- Bootstrap CSS -->
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"> -->

  <!--Javscript imports-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="../util/javascript/handleSearch.js" type="text/javascript"></script>

  <title>Health Share</title>
</head>

<body>
  <!--Navigation bar-->
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container-fluid">
      <a href="../index.php" class="navbar-brand mb-0 h1">
        <img class="d-inline-block align top rounded" src="../img/logo.png" width="30" height="30" />
        Health Share
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="../index.php">Home</a>
          </li>

          <li class="nav-item">
            <a class="nav-link active" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./contact.php">Contact us</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Topics
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li>
                <a class="dropdown-item" href="./marketisationOfHealthCare.php">Marketisation of Healthcare</a>
              </li>
              <li>
                <a class="dropdown-item" href="./hivAids.php">HIV/AIDS</a>
              </li>
              <li>
                <a class="dropdown-item active" href="./roadAccidents.php">Road Accidents</a>
              </li>
              <li>
                <a class="dropdown-item" href="./covidImpact.php">The Impact of Covid-19</a>
              </li>
            </ul>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item" <?php echo $login_style; ?>>
            <a class="nav-link" href="./signIn.php">Sign In</a>
          </li>
          <li class="nav-item" <?php echo $login_style; ?>>
            <a class="nav-link" href="./signUp.php">Sign Up</a>
          </li>

          <li class="nav-item dropdown" <?php echo $logout_style; ?>>
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Account
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li>
                <a class="dropdown-item" href="./resetPassword.php">Reset Password</a>
              </li>
              <li>
                <a class="dropdown-item" href="./signOut.php">Sign Out</a>
              </li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <input class="form-control mr-lg-2" id="tag-search" type="search" placeholder="Search" aria-label="Search" onkeyup="searchTags();" />
            <div id="tags-list"></div>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="row align-items-center">
      <div class="col-sm">
        <div class="text-center">
          <h1>The People:</h1>
          <p>
            We are undergraduate students of the Computer Science Department
            of the Aristotle University of Thessaloniki, Greece.
          </p>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="text-center">
          <img class="img-fluid" src="../img/about/csdlogo.png" alt="The logo of the Computer Science Department of Aristotle University of Thessaloniki, Greece" />
        </div>
      </div>
      <div class="col-sm">
        <div class="text-center">
          <h1>The Project:</h1>
          <p>
            This is a team project dedicated on spreading awareness about
            various issues concerning the current state of public health and
            well-being, as it is during the early months of 2021. Information
            shared was found in our research and all sources are displayed
            below each article.
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row align-items-center">
      <div class="col-sm">
        <div class="text-center">
          <img class="img-fluid" src="../img/about/auth-logo.png" alt="The logo of Aristotle University of Thessaloniki, Greece" />
        </div>
      </div>
      <div class="col-sm">
        <div class="text-center">
          <p>
            This project was part of our evaluation in our undergraduate “Web
            Information Systems” course during 2021 spring semester.
          </p>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-dark text-center text-lg-start text-white">
    <!-- Grid container -->
    <div class="container p-4">
      <!--Grid row-->
      <div class="row">
        <!--Grid column-->
        <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
          <h5 class="text-uppercase">About</h5>

          <p>
            This website is dedicated to presenting information about several
            matters that are disturbing the well-being of humanity in our era.
          </p>
        </div>
        <!--Grid column-->
        <!--Grid column-->
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
          <h5 class="text-uppercase">Contributors</h5>

          <ul class="list-unstyled mb-0">
            <li>
              <p>Kiziridis Konstantinos</p>
            </li>
          </ul>
        </div>
        <!--Grid column-->
        <!--Grid column-->
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
          <h5 class="text-uppercase mb-2">Find us on</h5>

          <ul class="list-unstyled">
            <li class="mb-2">
              <a href="#" target="_blank">
                <img src="../img/media/facebook.png" alt="facebook img" style="width:30px;" />
              </a>
            </li>
            <li class="mb-2">
              <a href="#" target="_blank">
                <img src="../img/media/insta.png" alt="facebook img" style="width:30px;" />
              </a>
            </li>
            <li class="mb-2">
              <a href="#" target="_blank">
                <img src="../img/media/twitter.png" alt="facebook img" style="width:30px;" />
              </a>
            </li>
          </ul>
        </div>
        <!--Grid column-->
      </div>
      <!--Grid row-->
    </div>
    <!-- Grid container -->
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
      © 2021 Copyright:
      <a class="text-white" href="../index.php">Health Share</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
</body>

</html>