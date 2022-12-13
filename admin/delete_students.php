<?php
require_once 'include/config.php';

if(isset($_GET['id'])){

	$id = $_GET['id'];

	$find = "SELECT * FROM students_tab WHERE username='$id'";
	$result = mysqli_query($link, $find);
		if (mysqli_num_rows($result) == 0) {
				header("location:students_list.php?msg1=failed");
			}
			else{

	$query = "DELETE FROM students_tab WHERE username='$id'";
		if(mysqli_query($link, $query)){
			header("location:students_list.php?msg1=success");
		} else {
		    header("location:students_list.php?msg1=failed");
		}

		}
	

	}
	else{
		header("location:students_list.php?msg1=notfound");
	}

?>