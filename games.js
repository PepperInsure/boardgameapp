$(document).ready(function()
{
    /*
    objectname The game's name
    objectid BGGs internal id for games
    average average rating by all BGG users
    avgweight average weight as ranked by BGG users
    rank overall standing of the game on BGG, 1 is best, 0 is an expansion and doesn't count
    minplayers minimum allowable number of players
    maxplayers maximum number of players
    playingtime number of minutes to play the game (in the worst case)
    bggbestplayers recommended number of players (three versions, NA is no guidance, a single number is the only recommended number of players, a-- b-- c means a b and c are recommended for this game)

    */
    var games_list = [];
    var inputs = 
    {
        objectid : 0,
        average : 0,
        avgweight : 0,
        rank : 0,
        minplayers : 0,
        maxplayers : 0,
        playingtime : 0,
        bggbestplayers : 0
    };
    var $num_games = 10; //number of games
    var indexname = 0; //id of input box
    var $resultsize = 0; //total results returned
    var $gamenumber = 0; //the game to be printed
    //If one of the textboxes has text entered
    $(".input-wrapper").keyup(function(event)
    {
        indexname = event.target.id;
        
        //Checking input no longer needed, the id is the same name as the array "index"
        //if (changeinput == "average-text")
        //{
            inputs[indexname] = $(event.target).val();
        //}
    });
    
    //PHP doesn't need to know how many games are needed
    $(".input-wrapper-games").keyup(function(event)
    {
        $num_games = $(event.target).val();
    });
    
    $('#select_button').click(function()
    {
        $("#present").empty();
        $.post("api/index.php", {user_input: inputs}, function(data)
        {
            games_list = data;
            $resultsize = data.length;
            if ($resultsize < $num_games)
            {
                $num_games = $resultsize;
            }
            for (var i = 0; i < $num_games; i++) 
            {
                $gamenumber = Math.floor(Math.random() * $resultsize)
                $('#present').append("<li>" + data[$gamenumber].objectname + "</li>");
            };
        });
    });
    

});