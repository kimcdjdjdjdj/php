<?php
	function get_connection ($host, $user, $pass, $db) {
		$hostname = $host;
		$username =	$user;
		$password = $pass;
		$dbname = $db;
		$conn = mysqli_connect($hostname, $username, $password, $dbname);
		mysqli_query($conn, "SET NAMES 'utf8'");
		return ($conn);
	}	
?>