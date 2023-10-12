<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if so redirect to home page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  header("location: ../index.php");
  exit;
}

// Define variables and initialize with empty values
$code = $email = "";
$code_confirm_err = $email_err = $validate_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Check if email is empty
  $sanitized_email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
  if (empty($sanitized_email)) {
    $email_err = "Please enter an email.";
  } elseif (!filter_var($sanitized_email, FILTER_VALIDATE_EMAIL)) {
    $email_err = "Please enter a valid email.";
  } else {
    $email = trim($_POST["email"]);
  }

  // Validate code
  if (empty(trim($_POST["code"]))) {
    $code_confirm_err = "Please enter your code.";
  } else {
    $code = trim($_POST["code"]);
  }

  if (empty($code_confirm_err)) {
    // Check if user codes matches generated code
    if ($_SESSION["code"] === $code) {
      $_SESSION["id"] = $_SESSION["uncofirmed_id"];
      $_SESSION["reset"] = true;
      header("location: resetPassword.php");
    } else {
      $validate_err = "Incorrect code.";
    }
  }
}
?>

<!DOCTYPE html>

<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Health and well being - SDG no. 3" />
  <meta name="keywords" content="SDG,Health, Well being, United Nations, UN" />
  <meta name="author" content="Konstantinos Kiziridis,Theodoros Dougalis ,Nikolaos Diamantis, Vasilis Andritsoudis " />

  <!-- Tab icon -->
  <link rel="icon" href="../img/logo.png">

  <!-- Bootstrap CSS -->
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"> -->

  <!--Javscript imports-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="../util/javascript/handleSearch.js" type="text/javascript"></script>
  <script src="../util/javascript/handleEmail.js"></script>

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
            <a class="nav-link" href="./about.php">About</a>
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
                <a class="dropdown-item" href="../html/marketisationOfHealthCare.php">Marketisation of Healthcare</a>
              </li>
              <li>
                <a class="dropdown-item" href="../html/hivAids.php">HIV/AIDS</a>
              </li>
              <li>
                <a class="dropdown-item" href="../html/roadAccidents.php">Road Accidents</a>
              </li>
              <li>
                <a class="dropdown-item" href="../html/covidImpact.php">The Impact of Covid-19</a>
              </li>
            </ul>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="signIn.php">Sign in</a>
          </li>
          <li>
            <a class="nav-link" href="signUp.php">Sign Up</a>
          </li>
          <li class="nav-item dropdown">
            <input class="form-control mr-lg-2" id="tag-search" type="search" placeholder="Search" aria-label="Search" onkeyup="searchTags();" />
            <div id="tags-list"></div>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!--Sign in form-->
  <div class="text-center">
    <img class="mt-4 mb-4" src="../img/logo.png" height="75" alt="Health Share" />
    <h1 class="h3 mb-3 font-weight-normal">Confirm Email</h1>
    <?php
    if (!empty($validate_err)) {
      echo '<div class="alert alert-danger">' . $validate_err . '</div>';
    }
    ?>
    <form style="max-width:500px; margin:auto;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

      <label for="email" class="sr-only mb-1">Email</label>
      <div class="input-group mt-1">
        <input type="text" name="email" id="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" placeholder="Type your email" value="<?php echo $email; ?>" required autofocus />
        <button onclick="handleEmail()" class="btn btn-outline-secondary rounded-end" type="button" id="send_code">Send Code</button>
      </div>
      <span class="<?php echo (!empty($email_err)) ? 'invalid-feedback' : ''; ?> d-block" id="email_prompt"><?php echo $email_err; ?></span>

      <label for="code" class="sr-only mt-4 mb-1">Confirmation Code</label>
      <input type="text" name="code" class="form-control mt-1 <?php echo (!empty($code_confirm_err)) ? 'is-invalid' : ''; ?>" placeholder="Type your confirmation code" />
      <span class="invalid-feedback d-block"><?php echo $code_confirm_err; ?></span>

      <div class="mt-3">
        <button class="btb btn-lg btn-primary col-12">Confirm</button>
      </div>
    </form>
  </div>

  <!-- Footer -->
  <footer class="bg-dark text-center text-lg-start text-white mt-5">
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