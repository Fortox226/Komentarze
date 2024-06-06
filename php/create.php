<?php
	include 'conn.php';	

	$tresc = $_POST['tresc'];
	$nazwa = $_POST['nazwa'];

	$sql = "INSERT INTO `komentarz`(`nawza_użytkownika`, `tekst`) VALUES ('$nazwa','$tresc')";

	if ($mysqli->query($sql) === TRUE) {
  		echo "<script>alert('oK');history.back();";
	} 
	else {
  		echo "Error: " . $sql . "<br>" . $mysqli->error;
	}
?>