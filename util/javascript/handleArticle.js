/**
 * @returns the ajax async object.
 * 
 * Saves or retrieves an article from the page the function is called to the database.
 * User must be logged in, in order to be assosiated with the article as the author in the database.
 * If the article is already saved it retireves its data from the database.
 */
function saveArticle() {
    siteName = location.pathname.split("/")[1];

    title = document.getElementById("article-title");

    if (title == null) {
        alert("Article save error. Please define valid 'article-title' id.");
        return;
    }

    title = document.getElementById("article-title").innerHTML;

    return $.ajax({
        method: "POST",
        url: location.origin + "/" + siteName + "/util/php/handleArticle.php",
        data: { 
            title: title,
            url: window.location.href
        },
    })
        .then(function (response) {
            if (response != "") {
                alert(response);
            }
        });
}