siteName = location.pathname.split("/")[1];

/**
 * @param {string} comments_article_id the article id to which the comment should be linked.
 * 
 * Recursively retrieves or saves comments to the database.
 */
function recursiveRender(comments_article_id) {
  document.querySelectorAll("#write_comment").forEach(element => element.style.display = 'none');
  document.querySelectorAll("#write_comment_btn,#reply_comment_btn").forEach(element => {
    element.onclick = event => {
      event.preventDefault();
      document.querySelectorAll("#write_comment").forEach(element => element.style.display = 'none');
      document.querySelector("div[data-comment-id='" + element.getAttribute("data-comment-id") + "']").style.display = 'block';
      document.querySelector("div[data-comment-id='" + element.getAttribute("data-comment-id") + "'] input[name='name']").focus();
    };
  });
  document.querySelectorAll("#write_comment form").forEach(element => {
    element.onsubmit = event => {
      event.preventDefault();

      formData = new FormData(element);
      postData = [];
      for (var pair of formData.entries()) {
        postData[pair[0]] = pair[1];
      }

      $.ajax({
        method: 'POST',
        url: location.origin + "/" + siteName + "/util/php/handleComments.php",
        data: {
          article_id: comments_article_id,
          ...postData
        },
      })
        .done(data => {
          document.querySelector("#comments").innerHTML = data;
          recursiveRender(comments_article_id);
        });
    };
  });
}

/**
 * @param {string} comments_article_id the article id to which the comment should be linked.
 * 
 * Saves or retrieves comments from the page the function is called to the database.
 * User must be logged in, in order to post comments.
 */

function handleComments(comments_article_id) {
  if (comments_article_id == null || comments_article_id == "") {
    return;
  }

  $.ajax({
    method: 'POST',
    url: location.origin + "/" + siteName + "/util/php/handleComments.php",
    data: {
      article_id: comments_article_id
    }
  })
    .done(data => {
      document.querySelector("#comments").innerHTML = data;
      document.querySelectorAll("#write_comment").forEach(element => element.style.display = 'none');
      recursiveRender(comments_article_id);
    });
}