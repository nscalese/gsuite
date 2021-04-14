var search = "";
var gameIteration = 0;
var currentSearch = "";
var resetList = false;
var inProgress = false;

window.onload = function(){
    var searchForm = document.getElementById("search-form");

    searchForm.addEventListener("submit", function(e){
        e.preventDefault();

        //Grab the search value (the game name) from the search input
        search = $('#search').val().trim();

        gameIteration = 0;

        updateGameList();
    });

    //When the window hits the bottom of the page, load new products
    $(window).scroll(function () {
        if (Math.round($(window).scrollTop()) === Math.round($(document).height()) - Math.round($(window).height())) {
            ++gameIteration;
            updateGameList();
        }
    });

    $(document).on('click', "#games .card", function(){

    })
}

function httpGetAsync(url, callback)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() { 
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
            callback(xmlHttp.responseText);
    }
    xmlHttp.open("GET", url, true); // true for asynchronous 
    xmlHttp.send(null);
}

function updateGameList(){
    if(!inProgress){
        inProgress = true;

        $.ajax({
            type: "POST",
            url: 'ajax_functions.php',
            dataType: 'json',
            data: {search: search, game_iteration: gameIteration},    
            success: function (result) {
                var games = result.games;


                var html = "";

                //If there are no more games, set the html to be appended to a no games indicator. Otherwise, append the games html returned by the function
                html = (games == null || games.trim() == "") ? '<h3 id="no-games">There are no more games to load.</h3>' : games;

                if($('#no-games').length == 0){
                    //If it's the first iteration, we reset the entries in the row
                    if(gameIteration == 0)
                        $('#games .row').empty();

                    //Append the html to the games row
                    $('#games .row').append(html);
                }

                inProgress = false;
            }
        });    
    }    
}