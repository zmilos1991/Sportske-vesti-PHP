<?php
echo "strana za brisanje";
if(isset($_GET['vid'])){
	$id = $_GET['vid'];
	require "../config.php";
	$conn = mysqli_connect(System::_DBHOST,System::_DBUSER,System::_DBPASS,System::_DBNAME);
	$q = "DELETE FROM news WHERE id = {$id}";
	mysqli_query($conn, $q);
	header ("Location: ../home.php");
}