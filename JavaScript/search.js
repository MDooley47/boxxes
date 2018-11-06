function searchThrough() {
    var searchTxt = $("input[name='searchBuddies']").val();
    getSearchResults(searchTxt);
    }
function getSearchResults(searchTxt) {
    $.post("./PHP/search.php", {searchVal: searchTxt}, function(output) {
        output = output.replace(/(<([^>]+)>)/ig,"");
        output = output.replace(/\n\n+/g, "\n");
        output = output.replace(/\n/g, "<br />");


       if (output == "") {
           $(this).hide();           }
       else {
           $("#searchResults_output").html(output);
           }
        });
    }