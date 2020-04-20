<?php include "table.css" ;?>
<?php include "header.php" ;
if(!isset($_SESSION['username']))
{
	header('location:home.php');
}
if(isset($_SESSION['rank']))
{
if ($_SESSION['rank']!=1)
{
	header('location:home.php');
}}?>
<center>
<a href="home.php"><p align="right">Home Page</p></a>
<a href="order_reports.php"><p align="right">Back to orders search</p></a>
</center>
<?php if (!isset($_POST['submit'])) {?>
	<br><br><br><br><br>
	<center>
	<form action="order_reports.php" method="post">
	<table border=1>
	<tr>
	<th colspan=3>Order Reports</th>
	</tr>
	<tr>
	<td>Enter Year:</td>
	<td><input type="text" name="year" /></td>
	</tr>
	<td>Month:</td>
	<td><input type="text" name="month" /></td>
	<tr>
	<td>Enter Day:</td>
	<td><input type="text" name="day" /></td>
	</tr>
	<tr><td colspan=2 align="center"><input type="submit" name="submit" value="submit" /> </td></tr>
	</table>
	</form></br></br></br></br></br>
<?php } else {?>
<?php
	$db = mysqli_connect('localhost', 'root', '','forum');
	$y=$_POST['year'];
	$m=$_POST['month'];
	$d=$_POST['day'];
	if(empty($y))
		echo "<script type='text/javascript'>alert('You must Enter atleast year!');window.location.href='order_reports.php'</script>";
	if(!empty($y) and !empty($m))
	{
		$query="SELECT * from orders WHERE year='$y' and month='$m'";
	}
	if(!empty($y) and !empty($m) and !empty($d))
	{
		$query="SELECT * from orders WHERE year='$y' and month='$m' and day='$d'";
	}
	if(empty($m) and empty($d))
	{
		$query="SELECT * from orders WHERE year='$y'";
	}
	if(!empty($y) and !empty($d) and empty($m))
	{
		echo "<script type='text/javascript'>alert('You can't combine between year and days without month!');window.location.href='order_reports.php'</script>";
	}

	if($query)
	{
		?>
		<center>
		<table border=1>
		<tr><th colspan=9>Selected Orders</th></tr>
		<tr>
		<th>Order ID</th><th>Username</th><th>Order Date</th><th>Item Barcode</th><th>Name</th><th>Image</th><th>Size</th><th>Quantity</th><th>Total</th>
		</tr>
<?php
	$db = mysqli_connect('localhost', 'root', '','forum');
	if($query)
	{
		$tt=0;
		$qq=0;
		$run=mysqli_query($db,$query);
		while($row=mysqli_fetch_array($run))
		{
			$id=$row['id'];
			$barcode=$row['barcode'];
			$name=$row['name'];
			$image=$row['image'];
			$price=$row['price'];
			$quantity=$row['quantity'];
			$size=$row['size'];
			$t_p=$price*$quantity;
			$d=$row['day'];
			$m=$row['month'];
			$y=$row['year'];
			@$total+=$row['price']*$quantity;
			$qq+=$quantity;
			$tt+=$total;
			$user=$row['username'];
	?>
	<?php $date=$d.'/'.$m.'/'.$y; ?>
	<tr>
	<td><?php echo '#';echo $id;?></td><td><?php echo $user; ?></td><td><?php echo $date;?></td><td><?php echo '#';echo $barcode; ?></td><td><?php echo $name; ?></td><td><img src="image/<?php echo $image ?>" width=50 height=50 /></td>
	<td><?php echo $size; ?></td><td><?php echo $quantity; ?></td><td><?php echo $t_p; echo '$';?></td>
	</tr>

<?php
		}?>
		</table>
		<center>
		<br><th>Total Sales Quantity: <?php echo $qq;?></th></br>
		<br><th>Total Sales Balance: <?php echo $tt; echo '$'; ?> </th></br>
		</center>
	<?php }
}
	else
	{
		echo "<script type='text/javascript'>alert('Your input is doesn't exists in the system!');window.location.href='order_reports.php'</script>";
	}
}?>
