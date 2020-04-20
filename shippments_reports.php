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
<a href="shippments_reports.php"><p align="right">Back to Shippments Reports</p></a>
</center>
<?php if (!isset($_POST['submitdate'])) {?>
	<br><br><br><br><br>
	<center>
	<form action="shippments_reports.php" method="post">
	<br>
	<table>
	<th colspan=3>Search by date</th>
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
	<td><input type="submit" name="submitdate" value="Search"></td>
	</table></br>
	</form>
<?php } else {?>

		<center>
		<table border=5>
		<tr><th colspan=7>Shippment Reports</th></tr>
		<tr>
		<th>Order ID</th><th>Customer name</th><th>Date</th><th>City</th><th>State</th><th>Address</th><th>Zip</th>
		</tr>
<?php 
	if(isset($_POST['submitdate']))
	{
		$db=mysqli_connect('localhost','root','','forum');
		$y=$_POST['year'];
		$m=$_POST['month'];
		$d=$_POST['day'];
		if(empty($y))
			echo "<script type='text/javascript'>alert('You must atleast year!');window.location.href='shippments_reports.php'</script>";
		else if(!empty($m) and !empty($d))
			$query="SELECT * FROM shippments where year='$y' and month='$m' and day='$d'";
		if(!empty($m) and empty($d))
			$query="SELECT * FROM shippments where year='$y' and month='$m'";
		else if(isset($y) and empty($m) and empty($d))
			$query="SELECT * FROM shippments where year='$y'";
		
			$date=$d.'/'.$m.'/'.$y;
			$run=mysqli_query($db,$query) or die('my sqli error');
			$count=0;
			while($row=mysqli_fetch_array($run))
		{
			$id=$row['id'];
			$fname=$row['full_name'];
			$city=$row['city'];
			$state=$row['state'];
			$address=$row['address'];
			$zip=$row['zip'];
			$count++;
			?>
			<tr>
			<td><?php echo '#';echo $id;?></td><td><?php echo $fname; ?></td><td><?php echo $date;?></td><td><?php echo $city; ?></td><td><?php echo $state; ?><td><?php echo $address; ?></td><td><?php echo $zip; ?></td>
			</tr>
		<?php }?>
		</table>
		<center>
		<p>Total Shippments : <?php echo $count; ?></p>
		</center>
<?php  } 
}?>