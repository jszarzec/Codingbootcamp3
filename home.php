<?php
	session_start();
	$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<!-- 
	mhensonf_wrt  password410
	mhensonf_rdo  password410
-->
<html>
<head>
<title>My Gaming Products Site</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php include('includes/header.inc'); ?>

<?php include('includes/nav.inc'); ?>

<div id="wrapper">


	<?php include('includes/aside.inc'); ?>

	<section>
		<?php include('includes/dbc.php'); 
	
			$query = "select * from mhensonf_gameSite.home_page order by id desc;";
			$result = mysql_query($query, $con);
			
			if ($result == false)
				echo "<p>Error executing query.</p>";
			
			if (mysql_num_rows($result) == 0)
				echo "<p>No data returned.</p>";
			
			while ($row = mysql_fetch_assoc($result))
			{
				if (isset($user))
				{
					echo "<div style='float:right; padding:10px'>";
					echo "<a href='ajax_edit.php?id=" . $row["id"] . "&table=home_page'>Edit</a>";
					echo "</div>";
				}
				echo "<h2>" . $row["title"] . "</h2>";
				echo "<p>" . $row["message"] . "</p>";
			}
			
			mysql_free_result($result);
			mysql_close($con);
		?>
	</section>

</div>

<?php include('includes/footer.inc'); ?>

</body>
</html>
