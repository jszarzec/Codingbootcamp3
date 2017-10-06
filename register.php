<?php
	if (isset($_POST["btnSubmit"]))
	{
		$email = $_POST["email"];
		$pwd = md5($_POST["password"]);
		
		include("includes/dbc_admin.php");
		
		$sql = "insert into mhensonf_gameSite.users (email, password) values "
		     . "('$email', '$pwd');";

		$result = mysql_query($sql, $con);
		
		if ($result)
			$msg = "<p><b>New user successfully inserted.</b>"
		         . "<br><a href='admin_login.php'>Log In</a></p>";
		else
			$msg = "<p>An error occured.</p>";
	}
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
		<h2>Registration Form</h2>
		<form id="frmRegister" name="frmRegister" method="post"
		      action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<p>Email Address:<br />
			<input type="text" name="email"></p>
			<p>Password:<br />
			<input type="password" name="password"></p>
			<p><input type="submit" value="Submit" name="btnSubmit"></p>
		</form>
		<?php
			if (isset($msg))
				echo $msg;
		?>
	</section>

</div>

<?php include('includes/footer.inc'); ?>

</body>
</html>
