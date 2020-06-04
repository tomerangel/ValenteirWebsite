<?php 
include "header.php" ;
if(!isset($_SESSION['username']))
{
	echo "<script type='text/javascript'>alert('Permission Denied');window.location.href='home.php'</script>";
}
if(isset($_SESSION['rank']))
{
if ($_SESSION['rank']!=2)
{
	echo "<script type='text/javascript'>alert('Permission Denied');window.location.href='home.php'</script>";
}
if ($_SESSION['rank']==1) { ?>

<?php if (!isset($_POST['submit']))
{ ?>
	<a href="home.php"><p align="right">Home Page</p></a>
	<center>
	<form action="edit_product.php" method="post">
	<table border=1>
	<tr>
	<th colspan=2>Update Products</th>
	</tr>
	<tr>
	<td>Product Barcode:</td>
	<td><input type="text" name="barcode"/></td>
	</tr>
	<td>Size:</td>
	<th><select name="size">
		<option value="XS">XS</option>
		<option value="S">S</option>
		<option value="M">M</option>
		<option value="L">L</option>
		<option value="XL">XL</option>
	</select></th>
	<tr><td colspan=2 align="center"><input type="submit" name="submit" value="submit" /> </td></tr>
	</table>
	</form>
<?php } ?>
	<?php if(isset($_POST['submit'])) {
		$db = mysqli_connect('localhost', 'root', '','cart');
		
		$barcode=$_POST['barcode'];
		$size=$_POST['size'];

		$query="SELECT * FROM stock WHERE barcode='$barcode' AND size='$size'";
		$res=mysqli_query($db,$query);
		if(mysqli_num_rows($res)==0)
		{
			echo "<script type='text/javascript'>alert('Product or Size of the product doesnt exists!');window.location.href='edit_product.php'</script>";
		}
		else
		{
			$row=mysqli_fetch_array($res);
			$quantity=$row['quantity'];
			$image=$row['image'];
			$price=$row['price'];
			$name=$row['name'];
		?>
		<center>
		<br><img src="image/<?php echo $image ; ?>" width="300" height="200" ?></br><br><?php echo 'Barcode: #';echo $barcode; ?></br><br><?php echo $name;?></br><br><?php echo 'Size:'; echo $size; ?></br>
		<br><?php echo 'Current Quantity:'; echo $quantity; ?></br><br><?php echo 'Current Price:'; echo $price; echo '$';?></br>
		</center>
		<form action="edit_product.php" method="post">
		<tr>
		<br><td>Edit Name:</td>
		<td><input type="text" name="name"/></td>
		</tr></br>
		<tr>
		<br><td>Edit Barcode:</td>
		<td><input type="text" name="barcode" /></td>
		</tr></br>
		<tr>
		<br><td>Edit Quantity:</td>
		<td><input type="text" name="quantity" /></td>
		</tr><br>
		<tr>
		<br><td>Edit price:</td>
		<td><input type="text" name="price" /></td>
		</tr></br>
		<input type="hidden" name="barcode" value="<?php echo $barcode;?>">
		<input type="hidden" name="size" value="<?php echo $size;?>">
		<center>
		<input type="submit" name="update" value="Update Product">
		</center>
		</form>
		<?php }}?>
		<?php
		if(isset($_POST['update']))
		{
			$barcode=$_POST['barcode'];
			$size=$_POST['size'];
			$db = mysqli_connect('localhost', 'root', '','cart');
			$n=$_POST['name'];
			$b=$_POST['barcode'];
			$q=$_POST['quantity'];
			$p=$_POST['price'];

			if(!empty($n))
			{
				$update="UPDATE stock SET name='$n' WHERE barcode='$barcode' AND size='$size'";
				mysqli_query($db,$update) or die('SQL ERROR1');
			}
			if(!empty($b))
			{
				$update="UPDATE stock SET barcode='$b' WHERE barcode='$barcode' AND size='$size'";
				mysqli_query($db,$update) or die('SQL ERROR2');
			}
			if(!empty($q))
			{
				$update="UPDATE stock SET quantity='$q' WHERE barcode='$barcode' AND size='$size'";
				mysqli_query($db,$update)or die('SQL ERROR3');
			}
			if (!empty($p))
			{
				$update="UPDATE stock SET price='$p' WHERE barcode='$barcode' AND size='$size'";
				mysqli_query($db,$update)or die ('SQL ERROR4');
			}
			if(mysqli_query($db,$update))
			{
				echo "<script>alert('Update Succesfully'); window.location.href='edit_product.php'</script>";
			}
		}
		?>
		<?php
}}else 
	echo "<script type='text/javascript'>alert('Permission Denied');window.location.href='home.php'</script>";
?>
