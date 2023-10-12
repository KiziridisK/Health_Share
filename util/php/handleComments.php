<?php

require_once "../../db_config.php";

session_start();

$logged_in_style = "";
$logged_out_message = "";
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    $logged_in_style = 'style="display:none;"';
    $logged_out_message = "Sign In to post comments.";
}

// Below function will convert datetime to time elapsed string
function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);
    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;
    $string = array('y' => 'year', 'm' => 'month', 'w' => 'week', 'd' => 'day', 'h' => 'hour', 'i' => 'minute', 's' => 'second');
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }
    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

// This function will populate the comments and comments replies using a loop
function show_comments($comments, $parent_id = -1)
{
    global $logged_in_style;

    $html = '';
    if ($parent_id != -1) {
        // If the comments are replies sort them by the "submit_date" column
        array_multisort(array_column($comments, 'submit_date'), SORT_ASC, $comments);
    }
    // Iterate the comments using the foreach loop
    foreach ($comments as $comment) {
        if ($comment['parent_id'] == $parent_id) {
            // Add the comment to the $html variable
            $html .= '
            <div class="comment">
                <div>
                    <h3 class="name">' . htmlspecialchars($comment['name'], ENT_QUOTES) . '</h3>
                    <span class="date">' . time_elapsed_string($comment['submit_date']) . '</span>
                </div>
                <p class="content">' . nl2br(htmlspecialchars($comment['content'], ENT_QUOTES)) . '</p>
                <a class="reply_comment_btn" id="reply_comment_btn" href="#" data-comment-id="' . $comment['id'] . '" ' . $logged_in_style . '>Reply</a>
                ' . show_write_comment_form($comment['id']) . '
                <div class="replies">
                ' . show_comments($comments, $comment['id']) . '
                </div>
            </div>
            ';
        }
    }
    return $html;
}

// This function is the template for the write comment form
function show_write_comment_form($parent_id = -1)
{
    $html = '
    <div class="write_comment" id="write_comment" data-comment-id="' . $parent_id . '">
        <form>
            <input name="parent_id" type="hidden" value="' . $parent_id . '">
            <textarea name="content" placeholder="Write your comment here..." required></textarea>
            <button type="submit">Submit Comment</button>
        </form>
    </div>
    ';
    return $html;
}

$comments = [];
$comments_info = [];

// Page ID needs to exist, this is used to determine which comments are for which page
if (isset($_POST['article_id'])) {
    // Check if the submitted form variables exist
    if (isset($_POST['content'])) {
        // POST variables exist, insert a new comment into the MySQL comments table (user submitted form)

        $sql = 'INSERT INTO comments (article_id, parent_id, name, content, submit_date) VALUES (?,?,?,?,?)';

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "iisss", $param_article_id, $param_parent_id, $param_name, $param_content, $param_submit_date);
            $param_article_id = $_POST['article_id'];
            $param_parent_id = $_POST['parent_id'];
            $param_name = $_SESSION["first_name"] . " " . $_SESSION["last_name"];
            $param_content = $_POST['content'];
            $param_submit_date = date("Y-m-d H:i:s");

            // Attempt to execute the prepared statement
            if (!mysqli_stmt_execute($stmt)) {
                exit("Oops! Something went wrong. Please try again later.");
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Get all comments by the Page ID ordered by the submit date
    $sql = 'SELECT * FROM comments WHERE article_id = ? ORDER BY submit_date DESC';

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_article_id);
        $param_article_id = $_POST['article_id'];

        if (mysqli_stmt_execute($stmt)) {
            /* store result */
            mysqli_stmt_store_result($stmt);

            // Check if article title exists, if yes then fetch its data and exit
            if (mysqli_stmt_num_rows($stmt) > 0) {
                mysqli_stmt_bind_result($stmt, $id, $article_id, $parent_id, $name, $content, $date);
                while (mysqli_stmt_fetch($stmt)) {
                    $comment["id"] = $id;
                    $comment["article_id"] = $article_id;
                    $comment["parent_id"] = $parent_id;
                    $comment["name"] = $name;
                    $comment["content"] = $content;
                    $comment["submit_date"] = $date;
                    array_push($comments, $comment);
                }
            }
        }
    }

    $sql = 'SELECT COUNT(*) AS total_comments FROM comments WHERE article_id = ?';

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_article_id);
        $param_article_id = $_POST['article_id'];

        if (mysqli_stmt_execute($stmt)) {
            /* store result */
            mysqli_stmt_store_result($stmt);
            // Check if article title exists, if yes then fetch its data and exit
            if (mysqli_stmt_num_rows($stmt) > 0) {
                mysqli_stmt_bind_result($stmt, $total_comments);
                if (mysqli_stmt_fetch($stmt)) {
                    $comments_info["total_comments"] = $total_comments;
                }
            }
        }
    }
} else {
    exit('No page ID specified!');
}
?>

<div class="comment_header">
    <span class="total"><?= $comments_info['total_comments'] ?> comments</span>
    <a href="#" class="write_comment_btn" id="write_comment_btn" data-comment-id="-1" <?= $logged_in_style ?>>Write Comment</a>
    <span><?= $logged_out_message ?></span>
</div>

<?= show_write_comment_form() ?>

<?= show_comments($comments) ?>