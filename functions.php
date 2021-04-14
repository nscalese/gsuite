<?php
    require_once('config.php');

    function getGames($search = "", $game_iteration = 0, $game_count = 6) {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        $error = mysqli_connect_error();
        if($error != null){
            exit("<p>Unable to connect to database</p>".$error);
        } else {
            $where_clause = $search != "" ? sprintf("WHERE Name LIKE '%%s%'", $search) : "";

            $games_sql = sprintf("SELECT * FROM games %s ORDER BY NAME LIMIT %d, %d;", $where_clause, $game_iteration * $game_count, $game_count);

            $games = mysqli_query($conn, $games_sql);

            $games_html = "";

            if($games->num_rows > 0){
                while($row = $games->fetch_assoc()){
                    $games_html.=sprintf("<div class=\"col-4\">
                        <div class=\"card bg-dark text-white text-center\" data-appid=\"%d\" data-url=\"%s\">
                            <div class=\"card-header\">
                                <img class=\"card-img-top\" src=\"Images/Games/%s\">
                            </div>
                            <div class=\"card-body\">
                                <h5 class=\"card-title\">%s</h5>
                            </div>
                        </div>
                    </div>", $row["AppID"], $row["URL"], $row["Image"], $row["Name"]);
                }
            }

            mysqli_close($conn);

            return $games_html;
        }
    }
?>