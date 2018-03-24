<?php
	if (!$_SESSION['active'] && FALSE) {
	  include 'content_newgame.php';
	  exit();
	}
?>

<h1>Aktuelles Spiel</h1>
<?php
  $round = new simplexmlelement('log.xml',NULL,TRUE);
  $game = new game(-2,3,4,5);
  add_game($round,$game);
  
  echo htmlspecialchars($round->asXML());
?>

    
