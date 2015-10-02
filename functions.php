<?php


	require_once("../configGLOBAL.php");
	$database = "if15_vitamak";
	$mysqli = new mysqli($servername, $username, $password, $database);
	 // paneme ühenduse kinni
	$mysqli->close();

	
	//lisamine kasutaja abˇi
	function createUser(){
		
		$mysqli = new mysqli($servername, $username, $password, $database);
		$password_hash = hash("sha512", $create_password);
				echo "<br>";
				echo $password_hash;
				
				$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES (?, ?)");
				
				//echo $mysqli->error;
				//echo $stmt->error;
				//asendame ? märgid muutujate väärtuste
				// ss - s tähendab string iga muutuja kohta
				$stmt->bind_param("ss", $create_email, $password_hash);
				$stmt->execute();
				$stmt->close();
			$mysqli->close();
			
		}




	function LoginUser(){
		$mysqli = new mysqli($servername, $username, $password, $database);
				$password_hash = hash("sha512", $password);
				
				$stmt = $mysqli->prepare("SELECT id, email FROM user_sample WHERE email=? AND password=?");
				$stmt->bind_param("ss", $email, $password_hash);
				
				//paneme vastuse muutujatesse
				$stmt->bind_result($id_from_db, $email_from_db);
				$stmt->execute();
				
				//küsima kas AB'ist saime kätte
				if($stmt->fetch()){
					//leidis
					echo "kasutaja id=".$id_from_db;
				}else{
					// tühi, ei leidnud , ju siis midagi valesti
					echo "Wrong password or email!";
					$mysqli->close();
	}
	}
	
?>