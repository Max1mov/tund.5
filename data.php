<?php

//siia lisame auto nr. märgi
//kontrollin, kas kasutaja ei ole sisseligunud+
	require_once("functions.php");
	if(!isset($_SESSION["id_from_db"])){
		//suunan data lehele
		header("Location: login.php");
	}

?>
rdfg