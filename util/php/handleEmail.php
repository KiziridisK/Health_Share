<?php
error_reporting(E_ERROR | E_PARSE);

// Check if the user is already logged in, if so redirect to home page
if (isset($_SESSION["emailSent"]) && $_SESSION["emailSent"] === true) {
  exit;
}

// Include config file
require_once "../../db_config.php";

// Define variables and initialize with empty values
$email = "";
$response = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Check if email is empty
  $sanitized_email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
  if (empty($sanitized_email)) {
    $response = "Please enter an email.";
  } else if (!filter_var($sanitized_email, FILTER_VALIDATE_EMAIL)) {
    $response = "Please enter a valid email.";
  } else {
    $email = trim($_POST["email"]);
  }

  if (!empty($response)) {
    echo $response;
    exit;
  }

  // Prepare a select statement
  $sql = "SELECT id FROM users WHERE email = ?";

  if ($stmt = mysqli_prepare($link, $sql)) {
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "s", $param_email);

    // Set parameters
    $param_email = $email;

    // Attempt to execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
      // Store result
      mysqli_stmt_store_result($stmt);

      // Check if email exists, if yes then verify password
      if (mysqli_stmt_num_rows($stmt) == 1) {
        // Bind result variables
        mysqli_stmt_bind_result($stmt, $id);
        if (mysqli_stmt_fetch($stmt)) {
          // Password is correct, so start a new session
          session_start();

          // Store data in session variables
          $_SESSION["uncofirmed_id"] = $id;
        }
      } else {
        // Email doesn't exist, display a generic error message
        $response = "Email does not exist.";
      }
    } else {
      $response = "Oops! Something went wrong. Please try again later.";
    }

    // Close statement
    mysqli_stmt_close($stmt);
  }
}

// Close connection
mysqli_close($link);

if (!empty($response)) {
  echo $response;
  exit;
}

$to = $email;
$subject = "Password Reset";

$code = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);

$message = "Your confirmation code is: " . $code;

$header = "From:support@healthshare.com \r\n";

$retval = mail($to, $subject, $message, $header);

if ($retval == true) {
  $response = "Email sent.";
} else {
  $response = "Oops! Something went wrong. Please try again later.";
}

$_SESSION["code"] = $code;

echo $response;
