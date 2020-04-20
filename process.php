<?php include "header.php" ; if($_SESSION['username']) {

$db = mysqli_connect('localhost', 'root', '','forum');

$username=$_SESSION['username'];
$name=$_GET['name'];
$barcode=$_GET['barcode'];
$price=$_GET['price'];
$image=$_GET['image'];
$cat=$_GET['cat'];
?>
<?php
$query="insert into wishlist (username,name,barcode,price,quantity,catagory,image) VALUES('$username','$name','$barcode','$price',1,'$cat','$image')";
}?>
<?php
if (mysqli_query($db,$query))
{
	echo "<script type='text/javascript'>alert('The product succesfully added to your wishlist!');window.location.href='".$_SERVER['HTTP_REFERER']."'</script>";
}
else
{
	echo "<script type='text/javascript'>alert('product adding to wishlist faild!');window.location.href='".$_SERVER['HTTP_REFERER']."'</script>";
}

?>
