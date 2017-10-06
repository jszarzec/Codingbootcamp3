<!DOCTYPE html>
<!-- 
	mailing_list.php

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
		<h2>The Mailing List</h2>
		<table width="100%" cellpadding="5">
			<tr>
				<th>Name</th>
				<th>Phone</th>
				<th>Email</th>
				<th>Comments</th>
			</tr>
			<?php
				include("includes/dbc.php");
				$query = "select * from mhensonf_gameSite.mailing_list";
				$result = mysql_query($query, $con);
				if ($result == false)
					echo "<p>An error occured: " . mysql_error($con) . "</p>";
				if (mysql_num_rows($result) == 0)
					echo "<p>No one has subscribed to the mailing list.</p>";
				
				while($row = mysql_fetch_assoc($result))
				{
					echo "<tr>";
					echo "<td>" . $row['name'] . "</td>";
					echo "<td>" . $row['phone'] . "</td>";
					echo "<td>" . $row['email'] . "</td>";
					echo "<td>" . $row['comments'] . "</td>";
					echo "</tr>";
				}
			?>
		</table>
	</section>

</div>

<?php include('includes/footer.inc'); ?>

</body>
</html>
