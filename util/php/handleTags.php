<?php

// Initialize the session
session_start();

// Include config file
require_once "../../db_config.php";

// Define variables and initialize with empty values
$tags = "";
$response = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty(trim($_POST["tags"]))) {
    $response = "Tags save error. Please add article tags";
  } else {
    $tags = trim($_POST["tags"]);
    $tags_list = explode(" ", $tags);

    $sql = "SELECT tag_name FROM tags";

    if ($stmt =  mysqli_prepare($link, $sql)) {
      // Attempt to execute the prepared statement
      if (mysqli_stmt_execute($stmt)) {
        /* store result */
        mysqli_stmt_store_result($stmt);

        mysqli_stmt_bind_result($stmt, $tag_name);
        while (mysqli_stmt_fetch($stmt)) {
          // Keep the not saved tags
          if (($key = array_search($tag_name, $tags_list)) !== false) {
            unset($tags_list[$key]);
          }
        }
      } else {
        $response = "Oops! Something went wrong. Please try again later.";
      }

      // Close statement
      mysqli_stmt_close($stmt);
    }

    if ((!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) && !empty($tags_list)) {
      $response = "Tags save error. Please sign in to save the tags.";
      echo $response;
      exit;
    }

    foreach ($tags_list as $unsaved_tag) {
      $sql = "INSERT INTO tags (tag_name) VALUES (?)";

      if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $param_tag_name);
        $param_tag_name = $unsaved_tag;

        // Attempt to execute the prepared statement
        if (!mysqli_stmt_execute($stmt)) {
          $response = "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
      }

      // Find the saved tag id
      $sql = "SELECT id FROM tags WHERE tag_name = ?";
      $tag_id = -1;

      if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_tag_name);

        // Set parameters
        $param_tag_name = $unsaved_tag;

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
          /* store result */
          mysqli_stmt_store_result($stmt);
          mysqli_stmt_bind_result($stmt, $id);
          if (mysqli_stmt_fetch($stmt)) {
            $tag_id = $id;
          }
        } else {
          $response = "Oops! Something went wrong. Please try again later.";
          break;
        }

        // Close statement
        mysqli_stmt_close($stmt);
      }

      if ($tag_id == -1) {
        $response = "Tags could not be saved";
        break;
      }

      // Link the tag with the article
      $sql = "INSERT INTO article_tags (article_id, tag_id) VALUES (?, ?)";

      if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "ii", $param_article_id, $param_tag_id);
        $param_article_id = $_POST["article_id"];
        $param_tag_id = $tag_id;

        // Attempt to execute the prepared statement
        if (!mysqli_stmt_execute($stmt)) {
          $response = "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
      }

      $response = "Tags saved successfully.";
    }
  }

  echo $response;
}
