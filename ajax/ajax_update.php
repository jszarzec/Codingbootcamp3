<?php
	if (isset($_POST['id']))
	{
		include("../includes/dbc_admin.php");

		$table   = $_POST['table'];
		$id      = $_POST['id'];
		$title   = $_POST['title'];
		$message = $_POST['message'];
		
		$sql = "update mhensonf_gameSite.$table set "
		     . "title='$title', "
			 . "message='$message' "
			 . "where id=$id;";
		
		$result = mysql_query($sql, $con);
		
		if ($result)
			echo "Your content was successfully updated.<br>";
		else
			echo "There was an error.<br>";			
	}
?>