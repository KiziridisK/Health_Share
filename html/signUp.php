<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if so redirect to home page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  header("location: ../index.php");
  exit;
}

// Include config file
require_once "../db_config.php";

// Define variables and initialize with empty values
$first_name = $last_name = $email = $password = $confirm_password = $gender = $date_of_birth = "";
$first_name_err = $last_name_err = $email_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Validate first_name
  if (empty(trim($_POST["first_name"]))) {
    $first_name_err = "Please enter your first name.";
  } elseif (!preg_match('/^[a-zA-Z]+$/', trim($_POST["first_name"]))) {
    $first_name_err = "Name can only contain letters";
  } else {
    $first_name = trim($_POST["first_name"]);
  }

  // Validate last_name
  if (empty(trim($_POST["last_name"]))) {
    $last_name_err = "Please enter your last name.";
  } elseif (!preg_match('/^[a-zA-Z]+$/', trim($_POST["last_name"]))) {
    $last_name_err = "Name can only contain letters";
  } else {
    $last_name = trim($_POST["last_name"]);
  }

  // Validate email
  $sanitized_email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
  if (empty($sanitized_email)) {
    $email_err = "Please enter an email.";
  } elseif (!filter_var($sanitized_email, FILTER_VALIDATE_EMAIL)) {
    $email_err = "Please enter a valid email.";
  } else {
    // Prepare a select statement
    $sql = "SELECT id FROM users WHERE email = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "s", $param_email);

      // Set parameters
      $param_email = trim($_POST["email"]);

      // Attempt to execute the prepared statement
      if (mysqli_stmt_execute($stmt)) {
        /* store result */
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) == 1) {
          $email_err = "This email is already taken.";
        } else {
          $email = trim($_POST["email"]);
        }
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }

      // Close statement
      mysqli_stmt_close($stmt);
    }
  }

  // Validate password
  if (empty(trim($_POST["password"]))) {
    $password_err = "Please enter a password.";
  } elseif (strlen(trim($_POST["password"])) < 6) {
    $password_err = "Password must have atleast 6 characters.";
  } else {
    $password = trim($_POST["password"]);
  }

  // Validate confirm password
  if (empty(trim($_POST["confirm_password"]))) {
    $confirm_password_err = "Please confirm password.";
  } else {
    $confirm_password = trim($_POST["confirm_password"]);
    if (empty($password_err) && ($password != $confirm_password)) {
      $confirm_password_err = "Password did not match.";
    }
  }

  // Validate date_of_birth
  if (!empty(trim($_POST["date_of_birth"]))) {
    $date_of_birth = trim($_POST["date_of_birth"]);
  }

  // Validate gender
  if (!empty(trim($_POST["gender"]))) {
    $gender = trim($_POST["gender"]);
  }

  // Check input errors before inserting in database
  if (
    empty($first_name_err) && empty($last_name_err) && empty($email_err) &&
    empty($password_err) && empty($confirm_password_err)
  ) {

    // Prepare an insert statement
    $sql = "";

    if (!empty($date_of_birth) && !empty($gender)) {
      $sql = "INSERT INTO users (first_name, last_name, email, password, gender, date_of_birth) VALUES (?, ?, ?, ?, ?, ?)";
    } else if (!empty($gender)) {
      $sql = "INSERT INTO users (first_name, last_name, email, password, gender) VALUES (?, ?, ?, ?, ?)";
    } else if (!empty($date_of_birth)) {
      $sql = "INSERT INTO users (first_name, last_name, email, password, date_of_birth) VALUES (?, ?, ?, ?, ?)";
    } else {
      $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";
    }

    if ($stmt = mysqli_prepare($link, $sql)) {
      // Bind variables to the prepared statement as parameters
      if (!empty($date_of_birth) && !empty($gender)) {
        mysqli_stmt_bind_param(
          $stmt,
          "ssssss",
          $param_first_name,
          $param_last_name,
          $param_email,
          $param_password,
          $param_gender,
          $param_date_of_birth
        );
        $param_gender = $gender;
        $param_date_of_birth = $date_of_birth;
      } else if (!empty($gender)) {
        mysqli_stmt_bind_param(
          $stmt,
          "sssss",
          $param_first_name,
          $param_last_name,
          $param_email,
          $param_password,
          $param_gender
        );
        $param_gender = $gender;
      } else if (!empty($date_of_birth)) {
        mysqli_stmt_bind_param(
          $stmt,
          "sssss",
          $param_first_name,
          $param_last_name,
          $param_email,
          $param_password,
          $param_date_of_birth
        );
        $param_date_of_birth = $date_of_birth;
      } else {
        mysqli_stmt_bind_param($stmt, "ssss", $param_first_name, $param_last_name, $param_email, $param_password);
      }

      // Set parameters
      $param_first_name = $first_name;
      $param_last_name = $last_name;
      $param_email = $email;
      $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

      // Attempt to execute the prepared statement
      if (mysqli_stmt_execute($stmt)) {
        session_start();

        // Store data in session variables
        $_SESSION["loggedin"] = true;
        $_SESSION["first_name"] = $first_name;
        $_SESSION["last_name"] = $last_name;
        $_SESSION["email"] = $email;
        if (!empty($gender)) {
          $_SESSION["gender"] = $gender;
        }
        if (!empty($date_of_birth)) {
          $_SESSION["date_of_birth"] = $date_of_birth;
        }

        // Redirect user to home page
        header("location: ../index.php");
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }

      // Close statement
      mysqli_stmt_close($stmt);
    }
  }

  // Close connection
  mysqli_close($link);
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
  <link href="../css/forms.css" rel="stylesheet">
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
            <a class="nav-link " href="signIn.php">Sign in</a>
          </li>
          <li>
            <a class="nav-link active" href="#">Sign Up</a>
          </li>
          <li class="nav-item dropdown">
            <input class="form-control mr-lg-2" id="tag-search" type="search" placeholder="Search" aria-label="Search" onkeyup="searchTags();" />
            <div id="tags-list"></div>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!--Sign up form-->
  <div class="text-center mb-5">
    <form style="max-width:500px; margin:auto" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
      <img class="mt-4 " src="../img/logo.png" height="75" alt="Health Share" />

      <h1 class="h3 mb-3 font-weight-normal">Please sign up</h1>

      <label for="first_name" class="sr-only required">First name</label>
      <input type="text" name="first_name" class="form-control <?php echo (!empty($first_name_err)) ? 'is-invalid' : ''; ?>" placeholder="First Name" value="<?php echo $first_name; ?>" />
      <span class="invalid-feedback"><?php echo $first_name_err; ?></span>

      <label for="last_name" class="sr-only required">Last Name</label>
      <input type="text" name="last_name" class="form-control <?php echo (!empty($last_name_err)) ? 'is-invalid' : ''; ?>" placeholder="Last Name" value="<?php echo $last_name; ?>" />
      <span class="invalid-feedback"><?php echo $last_name_err; ?></span>

      <label for="email" class="sr-only required">Email</label>
      <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" placeholder="Email" value="<?php echo $email; ?>" />
      <span class="invalid-feedback"><?php echo $email_err; ?></span>

      <label for="password" class="sr-only required">Password</label>
      <input type="password" name="password" class="form-control mt-1 <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" placeholder="Type your password" />
      <span class="invalid-feedback"><?php echo $password_err; ?></span>

      <label for="confirm_password" class="sr-only required">Confirm Password</label>
      <input type="password" name="confirm_password" class="form-control mt-1 <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" placeholder="Confirm your password" />
      <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>

      <label for="date_of_birth" class="sr-only">Date of birth</label>
      <input type="date" name="date_of_birth" class="form-control" value="<?php echo $date_of_birth; ?>" />

      <label for="gender" class="sr-only">Gender</label>
      <select name="gender" class="form-select" >
        <option selected value="<?php echo $gender ?>"><?php echo (!empty($gender)) ? $gender : 'Choose gender'; ?></option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
      </select>

      <div class="mt-3">
        <button class="btb btn-lg btn-primary col-12">Sign up</button>
      </div>
      <a href="./signIn.php" class="h6 font-weight-normal mb-5">
        Already have an account? Sign in!
      </a>

    </form>
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