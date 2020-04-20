<?php include "table.css" ;?>
<?php include "header.php" ;if(isset($_SESSION['username']) and isset($_SESSION['rank'])) if($_SESSION['rank']==1) {?>

  <a href="home.php"><p align="right">Home Page</p></a>
  <center>
  <table border=1>
  <h2><th colspan=8>Products Lack</th></h2>
  <tr><th>Name:</th>
  <th>barcode</th>
  <th>Image</th>
  <th>Price</th>
  <th>Size</th>
  <th>Quantity</th>
  <th>Edit Product</th>
    <th>Delete Product</th>
  </tr>
<?php
$db=mysqli_connect('localhost','root','','forum');
$query="SELECT * FROM stock where quantity<'50'";
$res=mysqli_query($db,$query);
while($row=mysqli_fetch_array($res))
{
  $quantity=$row['quantity'];
  $barcode=$row['barcode'];
  $name=$row['name'];
  $image=$row['image'];
  $price=$row['price'];
  $size=$row['size'];
  $quantity=$row['quantity'];
  $cat=$row['catagory'];
?>
<tr><th><?php echo $name; ?></th><th><?php echo $barcode; ?></th>
<th><img src="image/<?php echo $image ; ?>" width="200" height="200" ?></th>
<th><?php echo $price; echo '$'; ?></th><th><?php echo $size; ?></th>
<th><?php echo $quantity; ?></th>
<form action="edit_product.php" method="post">
<input type="hidden" name="bar" value="<?php echo $barcode; ?>">
<th><input type="submit" name="editp" value="Edit Prouct"></th>
</form>
<form action="delete_product.php" method="post">
<th><input type="submit" name="delete" value="Delete Product"></th>
</form>
</tr>

<?php }} else {
	echo "<script type='text/javascript'>alert('Permission Denied');window.location.href='home.php'</script>";
}

 ?>
