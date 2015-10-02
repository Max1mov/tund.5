<?php


	require_once("../configGLOBAL.php");
	$database = "if15_vitamak";
	require_once("functions.php");
	
	//paneme sessioni käema, saame kasutada $_SESSION 
	session_start();
	
	//lisamine kasutaja abˇi
	function createUser($create_email, $password_hash){
	
		//globals on muutuja kõigis php failidest mis on ühendadud
				$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
				
				$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES (?, ?)");
				$stmt->bind_param("ss", $create_email, $password_hash);
				$stmt->execute();
				$stmt->close();
				$mysqli->close();
			
		}




	function LoginUser($email, $password_hash){
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
				
				
				$stmt = $mysqli->prepare("SELECT id, email FROM user_sample WHERE email=? AND password=?");
				$stmt->bind_param("ss", $email, $password_hash);
				$stmt->bind_result($id_from_db, $email_from_db);
				$stmt->execute();
				if($stmt->fetch()){
					echo "kasutaja id=".$id_from_db;
					
					$_SESSION["id_from_db"] = $id_from_db;
					$_SESSION["user_email"] = $email_from_db;
					
					//suunan kasutaja data.php lehele
					header("Location: data.php");
					
					
					
				}else{
					echo "Wrong password or email!";
					}
					$stmt->close();

					$mysqli->close();
	
	}
	
?>