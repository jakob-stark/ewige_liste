<?php
  
  class game {
    public $score1;
    public $score2;
    public $score3;
    public $score4;
    
    function __construct($_score1, $_score2, $_score3, $_score4) {
      $this->score1 = $_score1;
      $this->score2 = $_score2;
      $this->score3 = $_score3;
      $this->score4 = $_score4;
    }
  }
  
  class round {
    public $date;
    public $player1;
    public $player2;
    public $player3;
    public $player4;
   
   function __construct($_player1, $_player2, $_player3 ,$_player4, $_date = '') {
      if ($_date == '')
	$_date = date('d.m.y H:i');
      $this->date = $_date;
      $this->player1 = $_player1;
      $this->player2 = $_player2;
      $this->player3 = $_player3;
      $this->player4 = $_player4;
    }
  }
    
    
  //$round
  function add_round($_xml, $_round) {
    $round = $_xml->addChild('round');
    $round->addAttribute('player1',$_round->player1);
    $round->addAttribute('player2',$_round->player2);
    $round->addAttribute('player3',$_round->player3);
    $round->addAttribute('player4',$_round->player4);
    $round->addAttribute('date',$_round->date);
    return $round;
  }
  
  //void
  function add_game($_round, $_game) {
    $game = $_round->addChild('game');
    $game->addChild('score1',$_game->score1);
    $game->addChild('score2',$_game->score2);
    $game->addChild('score3',$_game->score3);
    $game->addChild('score4',$_game->score4);
  }
  
  //void



  session_start();
?>

<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Doppelkopf Eintrag</title>
  </head>
  <body>
	  <?php include 'content.php'; ?>  
  </body>
</html>
