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
		<h2>Products</h2>
		<table width="100%">
			<tr>
				<th>Item Name</th>
				<th>Description</th>
				<th>Price</th>
				<th>Buy</th>
			</tr>
			<?php include("includes/dbc.php");
				$sql = "select * from mhensonf_gameSite.products order by id";
				$result = mysql_query($sql, $con);
				if ($result == false)
					echo "<p>Error executing query.</p>";
				else if (mysql_num_rows($result) == 0)
					echo "<tr><td colspan='4'>No products to display.</td></tr>";
				else
				{
					while ($row = mysql_fetch_assoc($result))
					{
						echo "<tr>";
						echo "<td align='center'>" . $row['title'] . "</td>";
						echo "<td align='center'>" . $row['description'] . "</td>";
						echo "<td align='center'>" . $row['price'] . "</td>";
						echo "<td align='center'><a href='my_cart.php?id=" . $row['id'] . "'>Add to Cart</a></td>";
						echo "</tr>";
					}
				}
			?>
		</table>		
	</section>

</div>

<?php include('includes/footer.inc'); ?>

</body>
</html>
