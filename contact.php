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
	function checkForm()
	{
		var name = document.frmContact.name.value;
		var email = document.frmContact.email.value;
		var message = document.frmContact.message.value;
		
		document.getElementById("namespan").innerHTML = "";
		document.getElementById("emailspan").innerHTML = "";
		document.getElementById("messagespan").innerHTML = "";
		
		if (name == null || name == "")
		{
			document.getElementById("namespan").innerHTML = "Your name cannot be blank.";
			document.frmContact.name.focus();
			return false;
		}
		if (email == null || email == "")
		{
			document.getElementById("emailspan").innerHTML = "Your email address cannot be blank.";
			document.frmContact.email.focus();
			return false;
		}
		if (message == null || message == "")
		{
			document.getElementById("mesagespan").innerHTML = "Your message cannot be blank.";
			document.frmContact.message.focus();
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
		<h2>Contact Us!</h2>
		<?php
			if (isset($_POST['btnSendEmail']))
			{
				// get the form input
				$name    = $_POST['name'];
				$email   = $_POST['email'];
				$phone   = $_POST['phone'];
				$message = $_POST['message'];
				
				// set up the SMTP email properties
				// Simple Mail Transfer Protocol
				$to = "mhenson@devry.edu";
				$subject = "Contact form submission";
				$headers = "From: $email";
				
				// send the email
				try
				{
					mail($to, $subject, $message, $headers);
					$msg = "<b>Email sent!</b>";
				}
				catch (Exception $e)
				{
					$msg = "<b>An error occured: " . $e->getMessage() . "</b><br />";
				}
			}
		?>
		<?php
			if (isset($msg))
			{
				$msg .= "<br><a href='home.php'>Return to Home Page</a>";
				echo $msg;
			}
		?>
		<table align="left">
			<form name="frmContact" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"
			      onsubmit="return checkForm()">
			<tr><th>Name:</th>
			    <td>
				     <input type="text" name="name" id="name" /><br />
				     <span style="color:red;" id="namespan"></span>
		        </td>
			</tr>
			<tr><th>Email:</th>
			    <td>
				     <input type="text" name="email" id="email" /><br />
				     <span style="color:red;" id="emailspan"></span>
		        </td>
			</tr>
			<tr><th>Phone:</th>
			    <td>
				     <input type="text" name="phone" id="phone" /><br />
		        </td>
			</tr>
			<tr><th>Message:</th>
			    <td>
				     <textarea name="message" id="message"></textarea><br />
				     <span style="color:red;" id="messagespan"></span>
		        </td>
			</tr>
			<tr><td></td>
				<td>
					<input type="submit" name="btnSendEmail" value="Send Email Message" />
				</td>
			</tr>
			</form>
		</table>
	</section>

</div>

<?php include('includes/footer.inc'); ?>

</body>
</html>
