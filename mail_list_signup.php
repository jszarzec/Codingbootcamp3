<?php
if (isset($_POST['btnSubmit']))
{
	$name = $_POST['txtName'];
	$phone = $_POST['txtPhone'];
	$email = $_POST['txtEmail'];
	$comments = $_POST['txtComments'];

	if ($name == "")
		$nameMsg = "<br><span style='color:red;'>Your name cannot be blank.</span>";
	else if ($phone == "")
		$phoneMsg = "<br><span style='color:red;'>Your phone number cannot be blank.</span>";
	else if ($email == "")
		$emailMsg = "<br><span style='color:red;'>Your email address cannot be blank.</span>";
	else
	{
		include("includes/dbc_admin.php");
		$query = "insert into mhensonf_gameSite.mailing_list "
		       . "(name, phone, email, comments) "
			   . "values ('$name', '$phone', '$email', '$comments')";
		$success = mysql_query($query, $con);
		if ($success)
			$inserted = "<h2>Thanks!</h2>";
		else
		{
			$errorMsg = mysql_error($con);
			$inserted = "There was an error: $errorMsg";
			exit($inserted);
		}
	}
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

<script type="text/javascript">
	function validateForm()
	{
		var name = document.form1.txtName.value;
		var phone = document.form1.txtPhone.value;
		var email = document.form1.txtEmail.value;
		
		document.getElementById("nameMsg").innerHTML = "";
		document.getElementById("phoneMsg").innerHTML = "";
		document.getElementById("emailMsg").innerHTML = "";
		
		if (name == null || name == "")
		{
			document.getElementById("nameMsg").innerHTML = "Your name cannot be blank.";
			return false;
		}
		if (phone == null || phone == "")
		{
			document.getElementById("phoneMsg").innerHTML = "Your phone number cannot be blank.";
			return false;
		}
		if (email == null || email == "")
		{
			document.getElementById("emailMsg").innerHTML = "Your email address cannot be blank.";
			return false;
		}
		return true;
	}
</script>

</head>

<body>
<?php include('includes/header.inc'); ?>

<?php include('includes/nav.inc'); ?>

<div id="wrapper">


	<?php include('includes/aside.inc'); ?>

	<section>
		<h2>Mailing List Sign-Up</h2>
		<?php 
			if (isset($inserted)) 
				echo $inserted;
			else
			{
		?>
		
		<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" 
		      name="form1" onSubmit="return validateForm();">
		  
		  <!-- Name field -->
		  <p> 
			<label>Name:</label> <br />
			<input type="text" id="txtName" name="txtName">
			<?php 
				if(isset($nameMsg))
				  echo $nameMsg;
			?>
			<br><span id="nameMsg" style="color:red"></span>
		  </p>
		  
		  <!-- Phone number field -->
		  <p> 
			<label>Phone:</label> <br />
			<input type="text" id="txtPhone" name="txtPhone">
			<?php 
				if(isset($phoneMsg))
				  echo $phoneMsg;
			?>
			<br><span id="phoneMsg" style="color:red"></span>
		  </p>

		  <!-- Email address field -->
		  <p> 
			<label>Email:</label> <br />
			<input type="text" id="txtEmail" name="txtEmail">
			<?php 
				if(isset($emailMsg))
				  echo $emailMsg;
			?>
			<br><span id="emailMsg" style="color:red"></span>
		  </p>
		  
		  <!-- Comments area -->
		  <p>
			<label>Comments:</label> <br />
			<textarea id="txtComments" name="txtComments"></textarea><br />
		  </p>
		  
		  <!-- Submit button -->
		  <p>
			<input type="submit" name="btnSubmit" value="Submit">
		  </p>
		  
		</form>
	<?php } ?>
	</section>
</div>

<?php include('includes/footer.inc'); ?>

</body>
</html>
