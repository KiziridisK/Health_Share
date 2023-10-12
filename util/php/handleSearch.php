<?php

// Initialize the session
session_start();

// Include config file
require_once "../../db_config.php";

// Define variables and initialize with empty values
$tag = "";
$response = "";
$matching_tag_ids = [];
$matching_articles_ids = [];
$matching_articles = [];

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["tag"]))) {
        $response = "Oops! Something went wrong. Please try again later.";
    } else {
        $tag = $_POST["tag"];

        // Prepare a select statement
        $sql = "SELECT id, tag_name FROM tags";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);
                mysqli_stmt_bind_result($stmt, $id, $tag_name);
                while (mysqli_stmt_fetch($stmt)) {
                    if (stripos($tag_name, $tag) !== FALSE) {
                        array_push($matching_tag_ids, $id);
                    }
                }
            } else {
                $response = "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }

        foreach ($matching_tag_ids as $tag_id) {
            // Prepare a select statement
            $sql = "SELECT article_id FROM article_tags WHERE tag_id = ?";

            if ($stmt = mysqli_prepare($link, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "i", $param_tag_id);

                // Set parameters
                $param_tag_id = $tag_id;

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    /* store result */
                    mysqli_stmt_store_result($stmt);
                    mysqli_stmt_bind_result($stmt, $article_id);
                    while (mysqli_stmt_fetch($stmt)) {
                        if (!in_array($article_id, $matching_articles_ids))
                            array_push($matching_articles_ids, $article_id);
                    }
                } else {
                    $response = "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
        }

        foreach ($matching_articles_ids as $article_id) {
            // Prepare a select statement
            $sql = "SELECT title, article_url FROM articles WHERE id = ?";

            if ($stmt = mysqli_prepare($link, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "i", $param_article_id);

                // Set parameters
                $param_article_id = $article_id;

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    /* store result */
                    mysqli_stmt_store_result($stmt);
                    mysqli_stmt_bind_result($stmt, $article_title, $article_url);
                    while (mysqli_stmt_fetch($stmt)) {
                        if (!in_array([$article_title, $article_url], $matching_articles))
                            array_push($matching_articles, [$article_title, $article_url]);
                        // if (!in_array($article_title, $matching_articles_titles))
                        //     array_push($matching_articles_titles, $article_title);
                        // if (!in_array($article_url, $matching_articles_urls))
                        //     array_push($matching_articles_urls, $article_url);
                    }
                } else {
                    $response = "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
    }

    echo json_encode($matching_articles);
}
