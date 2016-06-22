<html>
<head>
  <meta charset="utf-8">
  <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css" media="screen" />

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="theme-color" content="#98d2d4" />
  <title>LiveDraft</title>

</head>
<body>

  <?php

  $teamname = $_GET['teamname'];


  $string = file_get_contents('https://api.steampowered.com/IDOTA2Match_570/GetLiveLeagueGames/V001/?key=2CB8C64B96196F9963327CD1E1890B94');

  $json = json_decode($string, true,512,JSON_BIGINT_AS_STRING);
  $validgame = false;
  $string2 = file_get_contents('heroes.json');
  $json2 = json_decode($string2, true);


      foreach ($json['result']['games'] as $item) {

        $radiant_team = $item['radiant_team']['team_name'];
        $dire_team = $item['dire_team']['team_name'];
        $dire_logo = $item ['dire_team']['team_logo'];
        $radiant_logo = $item['radiant_team']['team_logo'];


          if ($radiant_team==$teamname) {


            $url = "http://api.steampowered.com/ISteamRemoteStorage/GetUGCFileDetails/v1/?key=2CB8C64B96196F9963327CD1E1890B94&appid=570&ugcid=$radiant_logo";

            $stringlogo = file_get_contents($url);

            $jsonlogo = json_decode($stringlogo, true);
            $logo = "<img id='logoup' src=".$jsonlogo['data']['url'].">";


              echo '<h1>'.$radiant_team.'</h1>';
              echo $logo;
              echo "<br>";

              for ($i=0; $i < 5 ; $i++) {
                $hero = $item['scoreboard']['radiant']['picks'][$i]['hero_id'];

                foreach ($json2['heroes'] as $key) {
                  if ($key['id'] == $hero) {
                    $heroname = $key['localized_name'];
                    $heroid = $key['name'];

                  }
                }

                foreach ($item['players'] as $key2) {
                    if ($hero == $key2['hero_id']) {
                    $playername = $key2['name'];
                    }
                }


                  $image = "<img src=http://cdn.dota2.com/apps/dota2/images/heroes/".$heroid."_vert.jpg style='border:4px solid black'>";
                  echo '<div class="image">', $image ,' <h2><span id="titles">'.$playername.'</span></h2> <h3><span id="titles">'.$heroname.'</span></h3>  </div>'  ,'&nbsp; ';

              }
              echo "<br>";
              echo "<br>";
              echo "<h1>Vs.</h1>";
              echo "<br>";
              echo "<br>";

              for ($i=0; $i < 5 ; $i++) {
                  $hero = $item['scoreboard']['dire']['picks'][$i]['hero_id'];

                  foreach ($json2['heroes'] as $key) {
                    if ($key['id'] == $hero) {
                      $heroname = $key['localized_name'];
                      $heroid = $key['name'];
                    }
                  }

                  foreach ($item['players'] as $key) {
                      if ($hero == $key['hero_id']) {
                      $playername = $key['name'];
                      }
                  }

                  $image = "<img src=http://cdn.dota2.com/apps/dota2/images/heroes/".$heroid."_vert.jpg style='border:2px solid black'>";
                echo '<div class="image">', $image ,' <h2><span id="titles">'.$playername.'</span></h2> <h3><span id="titles">'.$heroname.'</span></h3>  </div>'  ,'&nbsp; ';

              }
              echo '<br> <h1>'.$dire_team.'</h1>';
              $stringlogo = file_get_contents("http://api.steampowered.com/ISteamRemoteStorage/GetUGCFileDetails/v1/?key=2CB8C64B96196F9963327CD1E1890B94&appid=570&ugcid=$dire_logo");

              $jsonlogo = json_decode($stringlogo, true);
              $logo = "<img id='logodown' src=".$jsonlogo['data']['url'].">";
              echo $logo;
              echo "<br>";

              $validgame = true;
          } elseif ($dire_team==$teamname) {
            $url = "http://api.steampowered.com/ISteamRemoteStorage/GetUGCFileDetails/v1/?key=2CB8C64B96196F9963327CD1E1890B94&appid=570&ugcid=$radiant_logo";

            $stringlogo = file_get_contents($url);

            $jsonlogo = json_decode($stringlogo, true);
            $logo = "<img id='logoup' src=".$jsonlogo['data']['url'].">";


              echo '<h1>'.$radiant_team.'</h1>';
              echo $logo;
              echo "<br>";

              for ($i=0; $i < 5 ; $i++) {
                $hero = $item['scoreboard']['radiant']['picks'][$i]['hero_id'];

                foreach ($json2['heroes'] as $key) {
                  if ($key['id'] == $hero) {
                    $heroname = $key['localized_name'];
                    $heroid = $key['name'];
                  }
                }

                foreach ($item['players'] as $key2) {
                    if ($hero == $key2['hero_id']) {
                    $playername = $key2['name'];
                    }
                }


                  $image = "<img src=http://cdn.dota2.com/apps/dota2/images/heroes/".$heroid."_vert.jpg style='border:2px solid black'>";
                  echo '<div class="image">', $image ,' <h2><span>'.$playername.'</span></h2> <h3><span>'.$heroname.'</span></h3>  </div>'  ,'&nbsp; ';

              }
              echo "<br>";
              echo "<br>";
              echo "<h1>Vs.</h1>";
              echo "<br>";
              echo "<br>";
              for ($i=0; $i < 5 ; $i++) {
                  $hero = $item['scoreboard']['dire']['picks'][$i]['hero_id'];

                  foreach ($json2['heroes'] as $key) {
                    if ($key['id'] == $hero) {
                      $heroname = $key['localized_name'];
                      $heroid = $key['name'];
                    }
                  }

                  foreach ($item['players'] as $key) {
                      if ($hero == $key['hero_id']) {
                      $playername = $key['name'];
                      }
                  }

                  $image = "<img src=http://cdn.dota2.com/apps/dota2/images/heroes/".$heroid."_vert.jpg style='border:2px solid black'>";
                echo '<div class="image">', $image ,' <h2><span>'.$playername.'</span></h2> <h3><span>'.$heroname.'</span></h3>  </div>'  ,'&nbsp; ';

              }
              echo '<br> <h1>'.$dire_team.'</h1>';
              $stringlogo = file_get_contents("http://api.steampowered.com/ISteamRemoteStorage/GetUGCFileDetails/v1/?key=2CB8C64B96196F9963327CD1E1890B94&appid=570&ugcid=$dire_logo");

              $jsonlogo = json_decode($stringlogo, true);
              $logo = "<img id='logodown' src=".$jsonlogo['data']['url'].">";
              echo $logo;
              echo "<br>";

              $validgame = true;
          }
      }
if (!$validgame) {
    echo '<h1 align="center">Invalid search, try again.</h1>';
}

  ?>

<script type="text/javascript" src="jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="materialize/js/materialize.min.js"></script>
</body>

</html>
