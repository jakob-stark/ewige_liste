<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Doppelkopf Liste</title>
  </head>
  <body>
	  <a href="eingabe.php">Hier geht's zur Eingabe</a><br>
	  <a href="Doppelkopfregeln.pdf">Regeln Kurzfassung</a><br>
	  
	  <?php
		function cmp( $a, $b) {
			return $b[1]-$a[1];
		}
	  
	  
	  
		$file = fopen("doppelkopf_raw.dat", "r") or die("blub");
		
		
		while( $line = fgets($file) ) {
			$pairs = explode("\t", $line);
			foreach( $pairs as $pair ) {
				$name_point = explode(" ", $pair);
				$list[$name_point[0]][0] += $name_point[1];
				$list[$name_point[0]][1] += 1;
			}
		}
		fclose($file);
		
		uasort( $list, "cmp")
	  ?>
	  <table class="result_table">
			<tr><th>Name</th><th>Spiele</th><th>Punkte</th><th>Punkte pro Spiel</th></tr>
			<?php
				foreach( $list as $name => $info )
					echo "<tr><th>",$name,"</th><th>",$info[1],"</th><th>",$info[0],"</th><th>",number_format($info[0]/$info[1],2,".",","),"</th></tr>";
			?>
	  </table>
	  </table>
  </body>
</html>
