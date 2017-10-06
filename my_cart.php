<?php
session_start();
$cart = $_COOKIE['MyGameProducts'];
if (isset($_POST['clear'])) // Clear the shopping cart.
{
	$expire = time() - 60 * 60 * 24 * 365;
	setcookie("MyGameProducts", $cart, $expire);
	header("Location:my_cart.php");
}
if ($cart && $_GET['id']) // Add product to cart.
{
	$cart .= ',' . $_GET['id'];
	$expire = time() + 60 * 60 * 24 * 365;
	setcookie("MyGameProducts", $cart, $expire);
	header("Location:my_cart.php");	
}
if (!$cart && $_GET['id']) // Start a new cart.
{
	$cart = $_GET['id'];
	$expire = time() + 60 * 60 * 24 * 365;
	setcookie("MyGameProducts", $cart, $expire);
	header("Location:my_cart.php");	
}
if ($cart && $_GET['remove_id']) // Remove item from cart.
{
	$removed_item = $_GET['remove_id'];
	$arr = explode(",", $cart);
	unset($arr[$removed_item-1]);
	$new_cart = implode(",", $arr);
	$new_cart = rtrim($new_cart, ",");
	$expire = time() + 60 * 60 * 24 * 365;
	setcookie("MyGameProducts", $new_cart, $expire);
	header("Location:my_cart.php");		
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
		<h2>My Cart</h2>
		<table width="100%">
			<tr>
				<th>Item Name</th>
				<th>Description</th>
				<th>Price</th>
				<th>Actions</th>
			</tr>
			<?php
				$cart = $_COOKIE['MyGameProducts'];
				if ($cart)
				{
					$i = 1; // Start with the first item.
					include("includes/dbc.php");
					$items = explode(",", $cart);
					foreach($items as $item)
					{
						$sql = "select * from mhensonf_gameSite.products where id='$item'";
						$result = mysql_query($sql, $con);
						if ($result == false)
							echo "Error executing query.";
						else
						{
							while ($row = mysql_fetch_assoc($result))
							{
								echo "<tr>";
								echo "<td align='left'>" . $row['title'] . "</td>";
								echo "<td align='left'>" . $row['description'] . "</td>";
								echo "<td align='left'>" . $row['price'] . "</td>";
								echo "<td align='left'><a href='my_cart.php?remove_id=" 
								     . $i . "'>Remove</a></td>";
								echo "</tr>";
							}
							$i++;
						}
					}
				}
			?>
		</table>
		<br />
		<form method="post" action="my_cart.php">
			<input type="submit" name="clear" value="Empty Cart"
			       style="margin-left: 40px">
		</form>
	</section>

</div>

<?php include('includes/footer.inc'); ?>

</body>
</html>
