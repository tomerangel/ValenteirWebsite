<?php include "table.css" ;include "header.php" ;?>
<center>
<a href="home.php">Return Home Page</p></a>
<a href="search.php">Return Search</p></a>
</center>
<center>
<table border=1>
<h2><th colspan=8>Search Results</th></h2>
<tr><th>Name:</th>
<th>Image</th>
<th>Price</th>
<th>Size</th>
<th>Add to cart</th>
</tr>


<?php
$db = mysqli_connect('localhost', 'root', '','forum');
$barcode=$_POST['barcode'];
$name=$_POST['item_name'];

if(empty($barcode) and empty($name))
{
	echo "<script>alert('You must fill at least one field!'); window.location.href='search.php'</script>";
}
$query="SELECT * FROM product WHERE barcode='$barcode' or name='$name'";
$run=mysqli_query($db,$query);
while ($row =mysqli_fetch_array($run))
{
	$id=$row['id'];
	$quantity=$row['quantity'];
	$barcode=$row['barcode'];
	$name=$row['name'];
	$image=$row['image'];
	$price=$row['price'];
	$size=$row['size'];
	$cat=$row['catagory'];
	?>
	<tr><th><?php echo $name; ?></th>
	<th><img src="image/<?php echo $image ; ?>" width="300" height="200" ?></th>
	<th><?php echo $price; echo '$'; ?></th>
	<form action="tops.php" method="post">
		<th><select name="size">
		<option value="XS">XS</option>
		<option value="S">S</option>
		<option value="M">M</option>
		<option value="L">L</option>
		<option value="XL">XL</option>
		</select></th>
	<input type="hidden" value="<?php echo $id; ?>" name="id" />
	<input type="hidden" value="<?php echo $barcode; ?>" name="barcode" />
	<?php if($quantity>0) {?>
	<th><input type="submit" name="submit" value="Add to cart"></th>

	<?php } else {?>
	<th><?php echo "Item out of stock!"; ?></th>
<?php }?>

	</form></tr>
<?php }?>
