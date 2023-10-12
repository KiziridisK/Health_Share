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
  <meta name="author" content="Konstantinos Kiziridis,Theodoros Dougalis ,Nikolaos Diamantis,  Vasilis Andritsoudis" />

  <!-- Tab icon -->
  <link rel="icon" href="./img/logo.png">

  <!-- Bootstrap CSS -->
  <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css" rel="stylesheet" /> -->
  <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="./css/parallax.css" rel="stylesheet">
  <link href="./css/index.css" rel="stylesheet">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"> -->

  <!--Javscript imports-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="./util/javascript/handleSearch.js" type="text/javascript"></script>

  <title>Health Share</title>
</head>

<body>
  <!--Navigation bar-->
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container-fluid">
      <a href="#" class="navbar-brand mb-0 h1">
        <img class="d-inline-block align top rounded" src="./img/logo.png" width="30" height="30" />
        Health Share
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="./html/about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./html/contact.php">Contact us</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Topics
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li>
                <a class="dropdown-item" href="./html/marketisationOfHealthCare.php">Marketisation of Healthcare</a>
              </li>
              <li>
                <a class="dropdown-item" href="./html/hivAids.php">HIV/AIDS</a>
              </li>
              <li>
                <a class="dropdown-item" href="./html/roadAccidents.php">Road Accidents</a>
              </li>
              <li>
                <a class="dropdown-item" href="./html/covidImpact.php">The Impact of Covid-19</a>
              </li>
            </ul>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item" <?php echo $login_style; ?>>
            <a class="nav-link" href="./html/signIn.php">Sign In</a>
          </li>
          <li class="nav-item" <?php echo $login_style; ?>>
            <a class="nav-link" href="./html/signUp.php">Sign Up</a>
          </li>
          <li class="nav-item dropdown" <?php echo $logout_style; ?>>
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Account
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li>
                <a class="dropdown-item" href="./html/resetPassword.php">Reset Password</a>
              </li>
              <li>
                <a class="dropdown-item" href="./html/signOut.php">Sign Out</a>
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

  <div class="parallax hs_bg">
    <div class="parallax_text">
      <h1 class="text-center parallax_header hs_header_first">
        <span class="hs_header_first">HEALTH</span>
        <span class="hs_header_second">SHARE</span>
      </h1>
    </div>
  </div>

  <!--Previews-->
  <br>
  <br>

  <div class="container">
    <div class="row">
      <div class="col-sm mx-1 py-2 border border border-3 rounded-1">
        <h4>Marketisation of Healthcare</h4>
        <p>
          Some years ago, major corporations realised that they needed to move beyond the traditional means of
          making money, the production of goods that people would buy, to the provision of services.
          The problem was that many of the key services that people depended on, such as health, education, and
          social care, were being provided by the state, at least in Western Europe.
        </p>

        <a href="./html/marketisationOfHealthCare.php" class="btn bnt-lg btn-dark">
          Read More
        </a>
      </div>

      <div class="col-sm mx-1 py-2 border border border-3 rounded-1">
        <h4>HIV/AIDS</h4>
        <p>
          HIV (human immunodeficiency virus) is a virus that attacks the body’s immune system.
          If HIV is not treated, it can lead to AIDS (acquired immunodeficiency syndrome).
          Learning the basics about HIV can keep you healthy and prevent HIV transmission.
          You can also download materials to share or watch videos on basic information about HIV.
        </p>

        <a href="./html/hivAids.php" class="btn bnt-lg btn-dark">
          Read More
        </a>
      </div>
      <div class="col-sm mx-1 py-2 border border border-3 rounded-1">
        <h4>Road Accidents</h4>
        <p>
          According to World Health Organization (WHO) road traffic crashes result in the deaths of approximately 1.35
          million people around the world, while leaving between 20 and 50 million people with non-fatal injuries each
          year.
          Road traffic accidents have managed to reach a high ranking on the leading causes of death lists globally for
          several years now, while they are the leading cause of death of people between 5-29 years of age.
        </p>

        <a href="./html/roadAccidents.php" class="btn bnt-lg btn-dark">
          Read More
        </a>
      </div>
      <div class="col-sm mx-1 py-2 border border border-3 rounded-1">
        <h4>The Impact of Covid-19</h4>
        <p>
          Since the first case of novel coronavirus disease 2019 (COVID-19) was diagnosed in December 2019, it has swept
          across the world and galvanized global action.
          This has brought unprecedented efforts to institute the practice of physical distancing (called in most cases
          “social distancing”) in countries all over the world, resulting in changes in national behavioral patterns and
          shutdowns of usual day-to-day functioning.
        </p>

        <a href="./html/covidImpact.php" class="btn bnt-lg btn-dark">
          Read More
        </a>
      </div>
    </div>
  </div>

  <br>
  <br>

  <!--Carousel slider-->
  <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="parallax marketisation_bg">
          <div class="parallax_carousel_text">
            <h3 class="text-dark">Marketization of Healthcare</h3>
            <a href="./html/marketisationOfHealthCare.php" class="btn bnt-lg btn-dark">
              See topic
            </a>
          </div>
        </div>
      </div>

      <div class="carousel-item">
        <div class="parallax road_accidents_bg">
          <div class="parallax_carousel_text">
            <h3 class="text-dark">Road Accidents</h3>
            <a href="./html/roadAccidents.php" class="btn bnt-lg btn-dark">
              See topic
            </a>
          </div>
        </div>
      </div>

      <div class="carousel-item">
        <div class="parallax hiv_bg">
          <div class="parallax_carousel_text">
            <h3 class="text-dark">The Course of HIV/AIDS</h3>
            <a href="./html/hivAids.php" class="btn bnt-lg btn-dark">
              See topic
            </a>
          </div>
        </div>
      </div>

      <div class="carousel-item">
        <div class="parallax covid_bg">
          <div class="parallax_carousel_text">
            <h3 class="text-dark">The Impact of the Pandemic <br> on Mental/Physical Health</h3>
            <a href="./html/covidImpact.php" class="btn bnt-lg btn-dark">
              See topic
            </a>
          </div>
        </div>
      </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
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
                <img src="./img/media/facebook.png" alt="facebook img" style="width:30px;" />
              </a>
            </li>
            <li class="mb-2">
              <a href="#" target="_blank">
                <img src="./img/media/insta.png" alt="facebook img" style="width:30px;" />
              </a>
            </li>
            <li class="mb-2">
              <a href="#" target="_blank">
                <img src="./img/media/twitter.png" alt="facebook img" style="width:30px;" />
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
      <a class="text-white" href="#">Health Share</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
</body>

</html>