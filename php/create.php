<?php
	require 'conn.php';	

	$tresc = $_POST['tresc'];
	$nazwa = $_POST['nazwa'];

	$sql = "INSERT INTO `komentarz`(`nazwa_uzytkownika`, `tekst`) VALUES ('$nazwa','$tresc')";

	if ($mysqli->query($sql) === TRUE) {
  		echo "<script>alert('oK');";
	} 
	else {
  		echo "Error: " . $sql . "<br>" . $mysqli->error;
	}
?>