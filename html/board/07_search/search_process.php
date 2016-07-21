<?php
	if(isset($_GET['search'])){
		$board = $_GET['board'];
		$search = $_GET['search'];
		
		if(isset($_GET['user_name'])){
			$user_name = $_GET['user_name'];
		}		
	}