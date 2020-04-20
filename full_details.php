<?php include "table.css" ;?>
<?php include "header.php" ;
if(!isset($_SESSION['username']))
{
	header('location:home.php');
}
if(isset($_SESSION['rank']))
{
if ($_SESSION['rank']!=2)
{
	header('location:home.php');
}}?>
<center>
<a href="home.php"><p align="right">Home Page</p></a>
<a href="customer_orders.php"><p align="right">Back to your orders</p></a>
</center>
<?php if (!isset($_POST['full_details'])) {?>
<center>
<h1>Permission Denied</h1>
</center>
<?php }if (isset($_POST['full_details'])) { ?>
		<center>
		<table border=1>
		<tr><th colspan=7>Order:<?php echo '   '; echo '#';echo $id=$_POST['id']; ?></th></tr>
		<tr>
		<th>Barcode</th><th>Name</th><th>Image</th><th>Price</th><th>Size</th><th>Quantity</th><th>Total Price</th>
		</tr>
<?php }?>
<?php 
	if(isset($_POST['full_details']))
	{
			$db=mysqli_connect('localhost','root','','forum');
			$query="SELECT * FROM orders,shippments,payments WHERE orders.id='$id' and shippments.id='$id' and payments.id='$id'";
			$run=mysqli_query($db,$query) or die('my sqli error');
			$t=0;
			while($row=mysqli_fetch_array($run))
		{
			$username=$row['username'];
			$d=$row['day'];
			$m=$row['month'];
			$y=$row['year'];
			$bar=$row['barcode'];
			$name=$row['name'];
			$image=$row['image'];
			$price=$row['price'];
			$size=$row['size'];
			$quantity=$row['quantity'];
			$t_p=$price*$quantity;
			$customer=$row['full_name'];
			$city=$row['city'];
			$state=$row['state'];
			$add=$row['address'];
			$zip=$row['zip'];
			$card=$row['card'];
			$cvv=$row['cvv'];
			$exp=$row['exp'];
			$t=$row['tprice'];
			$str=substr($card,15,20);
			$cstring='****-****-****-'.$str;
			?>
			<tr>
			<td><?php echo '#';echo $bar;?></td><td><?php echo $name; ?></td><td><img src="image/<?php echo $image ; ?>" width="80" height="80"></td><td><?php echo $price; ?></td><td><?php echo $size; ?></td>
			<td><?php echo $quantity;?></td><td><?php echo $t_p;?></td>
			</tr>
		<?php }?>
			<?php if(mysqli_num_rows($run)!=0) { ?>
			<tr><td colspan=8>
			<?php echo 'Full Address: '; echo 'City: '; echo $city; echo ', State: '; echo $state; echo ' ,Address: '; echo $add; echo ', Zip Code: '; echo $zip;?>
			</tr></td>
			<tr><td colspan=8>
			<?php echo 'Payment info: '; echo 'Credit Card:'; echo $cstring; echo ', cvv: '; echo $cvv; echo ' ,exp: '; echo $exp; echo ' , Total Paid: '; echo $t; echo '$';?>
			</tr></td>
			<tr><td colspan=8>
			<?php echo 'Username: '; echo $username; echo '   ,Date purchase: '; echo $d; echo '-'; echo $m; echo '-'; echo $y;?>
			</tr></td>
			</table>
			<?php }?>
<?php  } ?>