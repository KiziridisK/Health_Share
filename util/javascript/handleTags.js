/**
 * @param {string} article_id the id of the article the tags are to be associated with.
 * 
 * Saves or retrieves the tags from the page the function is called to the database.
 * User must be logged in, in order for the tags to be saved to the database.
 * If the tags are already saved it retireves their data from the database.
 * 
 * It also associates the tags with the article the function is called from.
 * 
 * Finally the tags are displayed in the html file the function was called from.
 */
function saveTags(article_id) {
    siteName = location.pathname.split("/")[1];

    tags = document.getElementById("tags");

    if (tags == null) {
        alert("Tags save error. Please define valid 'tags' id.");
        return;
    }

    tags = document.getElementById("tags").innerHTML;

    return $.ajax({
        method: "POST",
        url: location.origin + "/" + siteName + "/util/php/handleTags.php",
        data: { 
            tags: tags,
            article_id: article_id 
        },
    })
        .then(function (response) {
            if (response != "") {
                alert(response);
            }

            tags_html = "<h6>Tags</h6><ul class='list-group list-group-horizontal-sm'>";

            tags.split(" ").forEach(element => {
                tags_html += "<li class='list-group-item'>" + element + "</li>";
            });

            tags_html += "</ul>";

            document.querySelector("#tag-display").innerHTML = tags_html;
        });
}