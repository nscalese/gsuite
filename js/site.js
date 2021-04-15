var search = ""; //Search variable
var gameIteration = 0; //Current game iteration (pagination)
var inProgress = false; //Whether or not there's an update game list in progress

var globalAchievements = null; //Global achievements for a steam game
var playerCount = null; //Player count for a steam game

var grid; //The masonry grid that contains all of the games

window.onload = function(){

    grid = $('#games .row').masonry({
        itemSelecter: '.card',
        percentPosition: true
    });
    
    var searchForm = document.getElementById("search-form");

    searchForm.addEventListener("submit", function(e){
        e.preventDefault();

        //Grab the search value (the game name) from the search input
        search = $('#search').val().trim();

        gameIteration = 0;

        updateGameList();
    });

    $(".trigger_popup_fricc").click(function(){
        $('.hover_bkgr_fricc').show();
     });
     
     $('.hover_bkgr_fricc').click(function(){
         $('.hover_bkgr_fricc').hide();
     });
     
     $('.popupCloseButton').click(function(){
         $('.hover_bkgr_fricc').hide();
     });

    //When the window hits the bottom of the page, load new products
    $(window).scroll(function () {
        if (Math.round($(window).scrollTop() + 10) >= Math.round($(document).height()) - Math.round($(window).height())) {
            console.log('here');
            ++gameIteration;
            updateGameList();
        }
    });

    $('#close-button').click(function(){
        $('#results-modal').modal('hide');
    });

    $(document).on('click', "#games .card-img-top", function(){

        var card = $(this).parents('.card');
        var appID = parseInt(card.data('appid'));

        if(appID > -1){
            $.ajax({
                type: "GET",
                url: `http://api.steampowered.com/ISteamUserStats/GetGlobalAchievementPercentagesForApp/v0002/?gameid=${appID}`,
                dataType: 'json',
                error: function(){
                    globalAchievements = null;

                    $.ajax({
                        type: "GET",
                        url: `http://api.steampowered.com/ISteamUserStats/GetNumberOfCurrentPlayers/v0001/?appid=${appID}`,
                        dataType: 'json',
                        error: function(){
                            playerCount = null;
                            updateGameModal(card);
                        },
                        success: function(playerResults){
                            playerCount = playerResults.response.player_count;
                            updateGameModal(card);
                        }
                    });
                },
                success: function(achievementResults){
                    globalAchievements = formatAchievements(achievementResults.achievementpercentages.achievements);

                    $.ajax({
                        type: "GET",
                        url: `http://api.steampowered.com/ISteamUserStats/GetNumberOfCurrentPlayers/v0001/?appid=${appID}`,
                        dataType: 'json',
                        error: function(){
                            updateGameModal(card);
                        },
                        success: function(playerResults){
                            playerCount = playerResults.response.player_count;
                            updateGameModal(card);
                        }
                    });
                }
            });
        } else {
            globalAchievements = null;
            playerCount = null;
            updateGameModal(card);
        }
    });
}

function updateGameModal(card){
    var resultsModal = $('#results-modal');

    var html = "";

    if(card.data('url') != null){
        html += `<a href="${card.data('url')}">Main Website</a>`;
    }

    if(card.data('release-date') != null){
        html += `<span>${card.data('release-date')}</span>`
    }

    if(card.data('description') != null){
        html += `<p>${card.data('description')}</p>`
    }

    if(globalAchievements != null || playerCount != null){
        html += `<div class="accordion" id="steam-accordion">
                    <div class="accordion-item">
                    <h2 class="accordion-header" id="steam-heading">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#steam-collapse" aria-expanded="false" aria-controls="steam-collapse">
                            Steam Information
                        </button>
                    </h2>
                    <div id="steam-collapse" class="accordion-collapse collapse" aria-labelledby="steam-heading" data-bs-parent="#steam-accordion">
                        <div class="accordion-body">
                            ${`<a class="mb-3 d-block" href="https://store.steampowered.com/app/${card.data('appid')}">Store Page</a>`}
                            ${(playerCount != null ? `<hr></hr><span class="mb-3 d-block">Number of concurrent players: ${playerCount}</span>` : "")}
                            ${(globalAchievements != null ? `<hr></hr><p><h5 class="mb-3">Global Achievement Percentages</h5> ${globalAchievements}</p>` : "")}
                        </div>
                    </div>
                    </div>
                </div>`
    }

    resultsModal.find('.modal-title').text(card.find('.card-title').text());

    resultsModal.find('.modal-body').empty().append(html);

    resultsModal.modal('show');
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
                        grid.empty();

                    html = $(html);

                    //Append the html to the games row
                    grid.append(html)
                    .masonry('appended', html);
                }

                inProgress = false;
            }
        });    
    }    
}

function formatAchievements(achievements){
    var html = "";

    achievements.forEach(function(achievement){
        var names = achievement.name.split('_');
        var name = "";
        names.forEach(function(item){
            item = item.toLowerCase();
            name += item.substring(0, 1).toUpperCase() + item.substring(1) + " ";
        })
    
        html += `<span class="d-flex mb-2 justify-content-between">${name.trim()}: <span>${achievement.percent.toFixed(2)}%</span></span>`
    })

    return html;
}