<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css" media="screen" />

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="theme-color" content="#222222" />
  <title>LiveDraft</title>
</head>
<body >

  <nav>
    <div class="nav-wrapper" style="background-color:#8e0000">
      <a class="brand-logo center">LiveDraft</a>
    </div>
  </nav>


       <!-- Teal page content  -->

       <div class="container">
         <div class="section">
           <div class="row">


        <?php

        $livegames = file_get_contents('https://api.steampowered.com/IDOTA2Match_570/GetLiveLeagueGames/V001/?key=2CB8C64B96196F9963327CD1E1890B94');
        $jsonlivegames = json_decode($livegames, true);
        $leagues = file_get_contents('https://api.steampowered.com/IDOTA2Match_570/GetLeagueListing/V001/?key=2CB8C64B96196F9963327CD1E1890B94');
        $jsonleagues = json_decode($leagues, true);
        $oldleaguename;

        foreach ($jsonlivegames['result']['games'] as $item) {

            $radiant_team = $item['radiant_team']['team_name'];
            $dire_team = $item['dire_team']['team_name'];
            $currenttime = round($item['scoreboard']['duration'] / 60);

            if ($radiant_team != null && $dire_team != null) {
                $radiant_score = $item['scoreboard']['radiant']['score'];
                $dire_score = $item['scoreboard']['dire']['score'];
                $leagueid = $item['league_id'];

                foreach ($jsonleagues['result']['leagues'] as $item) {
                    if ($item['leagueid'] == $leagueid){
                      $leaguename = str_replace(array("#DOTA_Item_","_")," ",$item['name']);
                      break;
                    }
                }

                if ($leaguename != $oldleaguename) {
                  echo '<div class="col l12 m12 s12">';
                  echo "<br>";
                  echo "<p>".$leaguename."</p>";
                  echo "</div>";
                  $oldleaguename = $leaguename;
                }

                echo '<div class="col l6 m12 s12">';
                echo '<div class="card" style="background-color:#131313;">';
                echo "<div class='card-content white-text'> ";
                echo "<span class='truncate'> <a id='teamlinks' href='search.php?teamname=".$radiant_team."&?tournament=".$leaguename."'>";
                echo $radiant_team.' Vs. '.$dire_team.'</a> </span>';
                echo "<p style='font-size:14px'> Score: ".$radiant_score." - ".$dire_score.", Time: ".$currenttime." minutes </p>";
                echo $leaguename;
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        }  ?>

  </div>
  </div>
  </div>


  <script type="text/javascript" src="jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="materialize/js/materialize.min.js"></script>
</body>

</html>
