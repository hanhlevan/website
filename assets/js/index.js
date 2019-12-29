var templateRow = '\
<div class="row">\
    <div class="col-md-12 mt-2">\
        <h5><a href="{0}"><strong class="name">{1}</strong></a></h5> \
        <p class="content">{2}</p> \
    </div>\
</div>';
var eContents = document.getElementById("contents")
var ecurrentPage = document.getElementById("current_page");
var emaxPage = document.getElementById("max_page");
var ePagePrev = document.getElementById("pagePrev");
var ePageNext = document.getElementById("pageNext");
var perPage = 6;
var currentPage = 0, maxPage = 0;
// Initialize all
$(document).ready(function(){
    initialize();
});
String.prototype.format = function() {
    a = this;
    for (k in arguments) {
      a = a.replace("{" + k + "}", arguments[k])
    }
    return a
}
function createElementFromHTML(htmlString) {
    var div = document.createElement('div');
    div.innerHTML = htmlString.trim(); 
    // Change this to div.childNodes to support multiple top-level nodes
    return div.firstChild; 
}
function initialize(){
    if (count > 0){
        currentPage = 1;
        maxPage = Math.floor(count / perPage) + (count % perPage > 0);
    }
    emaxPage.innerHTML = maxPage;
    setPage(1);
}
function setCurrentPage(pageNumber){
    ecurrentPage.innerHTML = pageNumber;
    ePagePrev.classList.remove("disabled");
    ePageNext.classList.remove("disabled");
    if (pageNumber == 1) {
        ePagePrev.classList.remove("active");
        ePagePrev.classList.add("disabled");
    }
    if (pageNumber == maxPage){
        ePageNext.classList.remove("active");
        ePageNext.classList.add("disabled");
    }
}
function nextPage(){
    if (currentPage + 1 > maxPage){
        return ;
    }
    currentPage += 1;
    setPage(currentPage);
}
function prevPage(){
    if (currentPage - 1 < 1){
        return ;
    }
    currentPage -= 1;
    setPage(currentPage);
}
function setPage(pageNumber){
    setCurrentPage(pageNumber);
    eContents.innerHTML = "";
    var left = Math.max(0, (pageNumber - 1) * perPage);
    var right = Math.min(pageNumber * perPage, posts.length);
    eContents.innerHTML = ""; 
    var pagePosts = posts.slice(left, right);
    pagePosts.forEach(element => {
        let URL = prefixURL + element["id"];
        let rowContent = templateRow.format(URL, element["title"], element["content"]);
        eContents.appendChild(createElementFromHTML(rowContent));
    });
}