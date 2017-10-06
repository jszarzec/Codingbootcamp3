<?php
	session_start();
	$user = $_SESSION['user'];
	if (!isset($user))
		header("Location:admin_login.php");
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
	$("document").ready(
		function()
		{
			$("#sendData").click(
				function()
				{
					var theId = $("#id").val();
					var newTitle = $("#title").val();
					var newContent = $("#message").val();
					
					$.post("ajax/ajax_update.php",
					        {table:"home_page", id:theId, title:newTitle, message:newContent},
						    function(response, textStatus, jqXHR)
						    {
								if (response)
								{
									$("#updateResults").html(
									        "Response: " + response + 
											"<b>" + textStatus + "</b>");
											
									$("#updateResults").append(
									    "<br><a href='home.php'>Return to Home</a>");
								}
								else
									$("#updateResults").html("There was an error.");
									
						    }
						  );
				}
			);
		}
	);
</script>
</head>

<body>
<?php include('includes/header.inc'); ?>

<?php include('includes/nav.inc'); ?>

<div id="wrapper">


	<?php include('includes/aside.inc'); ?>

	<section>
		<h2>Update Home Page</h2>
		<?php
			if (isset($_POST['btnSubmit']))
			{
				include("includes/dbc_admin.php");
				
				$table = $_POST['table'];
				$id = $_POST['id'];
				$title = $_POST['title'];
				$message = $_POST['message'];
				
				$sql = "update mhensonf_gameSite.$table set title='$title', message='$message' where id='$id'";
					 
				$result = mysql_query($sql, $con);
				
				if ($result != 0)
				    $msg = "<h2>Your content was successfully updated.</h2>";
			}
			
			if (isset($msg))
				echo $msg;
		?>
		<div id="updateResults">
			<?php
				$id = $_GET['id'];
				$table = $_GET['table'];
				
				include("includes/dbc_admin.php");
				$sql = "select * from mhensonf_gameSite.$table where id='$id'";
				$result = mysql_query($sql, $con);

				while ($row = mysql_fetch_assoc($result))
				{
					echo '<input type="hidden"  name="id"    id="id"    value="' . $id. '">';
					echo '<input type="hidden"  name="table" id="table" value="' . $table . '">';
					echo '<p><input type="text" name="title" id="title" value="' . $row['title'] . '"></p>';
					echo '<p><textarea name="message" id="message" rows="20" cols="75">' . $row['message']
					     . '</textarea></p>';
				}
			?>
			<p><input type="button" id="sendData" name="btnSubmit" value="Update"></p>
		</div>
	</section>

</div>

<?php include('includes/footer.inc'); ?>

</body>
</html>
