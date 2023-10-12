/**
 * Searches for article titles associated with the tags retrieved from the html document.
 * 
 * Finally it displays the article titles in the html document.
 */
function searchTags() {
    siteName = location.pathname.split("/")[1];
    tagSearch = document.getElementById("tag-search").value;

    $.ajax({
        method: "POST",
        url: location.origin + "/" + siteName + "/util/php/handleSearch.php",
        data: { tag: tagSearch },
        dataType: "json"
    })
        .then(function (response) {
            tagDisplay = "";

            if (response != null && response.length > 0) {
                tagDisplay = '<ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="display:block !important;">';
            }

            response.forEach(element => {
                tagDisplay += '<li>'+
                '<a class="dropdown-item d-inline-block text-truncate" style="max-width: 200px;" href="' + element[1] + '">' + element[0] + '</a>'+
                '</li>';
            });

            document.getElementById("tags-list").innerHTML = tagDisplay;
        });
}