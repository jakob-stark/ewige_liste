<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Doppelkopf Eintrag</title>
  </head>
  <body>
	  <a href="index.php">Hier geht's zur ewigen Liste</a><br>
	  
	  <?php
		function proc_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		
		function test_name($data) {
			if ( $data == "") {
				return false;
			} else {
				// check if name only contains letters and whitespace
				if (!preg_match("/^[a-zA-Z]*$/",$data)) {
					return false;
				}
			}
			return true;
		}
		
		function test_score($data) {
			if ( $data == "") {
				return false;
			} else {
				// check if score only contains integer (+-)
				if (!preg_match("/^(-?)[0-9]+$/",$data)) {
					return false;
				}
			}
			return true;
		}
		
		function test_number($data) {
			if ( $data == "") {
				return false;
			}
			return preg_match("/^[0-9]+$/",$data);
		}
		
		//Read input
		if( $_SERVER["REQUEST_METHOD"] == "POST" ) {
			$p1 = proc_input($_POST["Spieler1"]);
			$p2 = proc_input($_POST["Spieler2"]);
			$p3 = proc_input($_POST["Spieler3"]);
			$p4 = proc_input($_POST["Spieler4"]);
			
			$s1 = proc_input($_POST["Punkte1"]);
			$s2 = proc_input($_POST["Punkte2"]);
			$s3 = proc_input($_POST["Punkte3"]);
			$s4 = proc_input($_POST["Punkte4"]);
			
			$n = proc_input($_POST["Spiele"]);
		}
		
		$ep1 = !test_name($p1);
		$ep2 = !test_name($p2);
		$ep3 = !test_name($p3);
		$ep4 = !test_name($p4);
			
		$es1 = !test_score($s1);
		$es2 = !test_score($s2);
		$es3 = !test_score($s3);
		$es4 = !test_score($s4);
		
		if( !test_number($n) ) {
			$n = 1;
		}
		
		$submitted = false;
		
		$error = $ep1 || $ep2 || $ep3 || $ep4 || $es1 || $es2 || $es3 || $es4;
		
		
		if ($error) {
			$err_msg = "Fehler bei der Eingabe";
		} else if( $s1 + $s2 + $s3 + $s4 != 0 ) { //Prüfe Quersumme
				$error = true;
				$es1 = $es2 = $es3 = $es4 = true;
				$err_msg = "Quersumme muss Null ergeben";
		} else if ($file = fopen("doppelkopf_raw.dat", "a")) { //Speichere Daten
				fwrite($file, $p1 . " " . $s1 . "\t" . $p2 . " " . $s2 . "\t" . $p3 . " " . $s3 . "\t" . $p4 . " " . $s4 . "\n");
				for( $i = 0; $i < $n-1 ; $i++ )
					fwrite($file, $p1 . " 0\t". $p2 . " 0\t" . $p3 . " 0\t" . $p4 . " 0\n");
				fclose($file);
				$submitted = true;
		} else {
				$error = true;
				$err_msg = "Could not open file <br>";
		}
	  ?>
	  
	  
	  <?php if( $error ) { echo $err_msg. "<br>"; } ?>
	  
	  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
		  <table>
			  <tr>
				  <th><input class="input_name<?php if ($ep1){ echo "_err"; } ?>" type="text"
						name="Spieler1" value="<?php echo $p1; ?>"></th>
				  <th><input class="input_name<?php if ($ep2){ echo "_err"; } ?>" type="text"
						name="Spieler2" value="<?php echo $p2; ?>"></th>
				  <th><input class="input_name<?php if ($ep3){ echo "_err"; } ?>" type="text"
						name="Spieler3" value="<?php echo $p3; ?>"></th>
				  <th><input class="input_name<?php if ($ep4){ echo "_err"; } ?>" type="text"
						name="Spieler4" value="<?php echo $p4; ?>"></th>
			  </tr>
			  <tr>
				  <th><input class="input_score<?php if ($es1){ echo "_err"; } ?>" type="text"
						name="Punkte1" value="<?php if (!$submitted){ echo $s1; } ?>"></th>
				  <th><input class="input_score<?php if ($es2){ echo "_err"; } ?>" type="text"
						name="Punkte2" value="<?php if (!$submitted){ echo $s2; } ?>"></th>
				  <th><input class="input_score<?php if ($es3){ echo "_err"; } ?>" type="text"
						name="Punkte3" value="<?php if (!$submitted){ echo $s3; } ?>"></th>
				  <th><input class="input_score<?php if ($es4){ echo "_err"; } ?>" type="text"
						name="Punkte4" value="<?php if (!$submitted){ echo $s4; } ?>"></th>
			  </tr>
		  </table>
		  Spiele Anzahl (lass hier die 1 stehn ausser du weisst was du tust !) <input  type="text" name="Spiele" value="1">
		  <input type="submit" value="Eintragen">
	  </form>
	  
  </body>
</html>

