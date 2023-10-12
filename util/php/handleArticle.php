<?php

// Initialize the session
session_start();

// Include config file
require_once "../../db_config.php";

// Define variables and initialize with empty values
$title = "";
$response = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Validate title
  if (empty(trim($_POST["title"]))) {
    $response = "Article save error. Title cannot be empty.";
  } else {
    // Prepare a select statement
    $sql = "SELECT id, created_by_id, created_at FROM articles WHERE title = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "s", $param_title);

      // Set parameters
      $param_title = trim($_POST["title"]);

      // Attempt to execute the prepared statement
      if (mysqli_stmt_execute($stmt)) {
        /* store result */
        mysqli_stmt_store_result($stmt);

        // Check if article title exists, if yes then fetch its data and exit
        if (mysqli_stmt_num_rows($stmt) == 1) {
          mysqli_stmt_bind_result($stmt, $id, $created_by_id, $created_at);
          if (mysqli_stmt_fetch($stmt)) {
            $_SESSION["article_id"] = $id;
            $_SESSION["article_title"] = trim($_POST["title"]);
            $_SESSION["created_by_id"] = $created_by_id;
            $_SESSION["created_at"] = $created_at;

            exit;
          }
        } else {
          $title = trim($_POST["title"]);
        }
      } else {
        $response = "Oops! Something went wrong. Please try again later.";
      }

      // Close statement
      mysqli_stmt_close($stmt);
    }
  }

  if (!empty($response)) {
    echo $response;
    exit;
  }

  // Prepare an insert statement
  $sql = "INSERT INTO articles (title, article_url, created_by_id) VALUES (?, ?, ?)";

  if ($stmt = mysqli_prepare($link, $sql)) {
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "ssi", $param_title, $param_article_url, $param_created_by_id);

    // Check if the user is logged in
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
      $response = "Article save error. Please sign in to save the article.";
    } else {
      // Set parameters
      $param_title = $title;
      $param_created_by_id = $_SESSION["id"];
      $param_article_url = $_POST["url"];

      // Attempt to execute the prepared statement
      if (mysqli_stmt_execute($stmt)) {
        // Redirect to home page
        $response = "Article saved successfully.";

        $sql = "SELECT id, created_by_id, created_at FROM articles WHERE title = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
          // Bind variables to the prepared statement as parameters
          mysqli_stmt_bind_param($stmt, "s", $param_title);

          // Set parameters
          $param_title = $title;

          // Attempt to execute the prepared statement
          if (mysqli_stmt_execute($stmt)) {
            /* store result */
            mysqli_stmt_store_result($stmt);

            // Check if article title exists, if yes then fetch its data and exit
            mysqli_stmt_bind_result($stmt, $id, $created_by_id, $created_at);
            if (mysqli_stmt_fetch($stmt)) {
              $_SESSION["article_id"] = $id;
              $_SESSION["article_title"] = $title;
              $_SESSION["created_by_id"] = $created_by_id;
              $_SESSION["created_at"] = $created_at;

              echo $response;
              exit;
            }
          } else {
            $response = "Oops! Something went wrong. Please try again later.";
          }

          // Close statement
          mysqli_stmt_close($stmt);
        }
      } else {
        $response = "Oops! Something went wrong. Please try again later.";
      }
    }

    // Close statement
    mysqli_stmt_close($stmt);
  }

  // Close connection
  mysqli_close($link);
}

echo $response;
