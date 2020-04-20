<?php include "table.css" ;?>
<?php
include "header.php";
if(isset($_SESSION["username"]))
$username=$_SESSION["username"];
?>
<a href="cart.php"><p align="right">צפייה בעגלה</p></a>
<a href="home.php"><p align="right">עמוד הבית</p></a>
<center>
    <table border=1>
        <h2><th colspan=8>חולצות</th></h2>
        <tr><th>שם:</th>
            <th>תמונה</th>
            <th>מחיר</th>
            <th>גודל</th>
            <th>להוסיף לעגלה</th>
            <th>רשימת קניות</th>
        </tr>


<?php
$db = mysqli_connect('localhost', 'root', '','forum');
$query="SELECT * FROM product WHERE size='All' and catagory='tops'";
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
	<th><img src="image/<?php echo $image ; ?>" width="200" height="300" ?></th>
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
	<th><input type="submit" name="submit" value="להוסיף לעגלה"></th>
	<th>
	<a href='process.php?name=<?php echo $name;?>&barcode=<?php echo $barcode;?>&image=<?php echo $image;?>&cat=<?php echo $cat;?>&price=<?php echo $price;?>'> רשימת קניות </a>
	</th>
	</form></tr>

	<?php }?>
	<?php if(isset($_POST['submit']) and isset($_SESSION['username']))
	{

		$size=$_POST['size'];
		$barcode=$_POST['barcode'];

		$db = mysqli_connect('localhost', 'root', '','forum');
		$result=mysqli_query($db,"SELECT quantity from stock WHERE barcode='$barcode' AND size='$size'");
		$row=mysqli_fetch_assoc($result);
		$res=$row['quantity'];
		
		$res1=mysqli_query($db,"SELECT * from cart WHERE username='$username' AND p_size='$size' AND barcode='$barcode'");
		if(mysqli_num_rows($res1)!=0)
			echo "<script>alert('The product choosen is already in the cart!'); window.location.href='tops.php'</script>";

		else if($res<1)
			echo "<script>alert('The product choosen is out of Stock!'); window.location.href='tops.php'</script>";
		else
		{
		$query="SELECT * from stock WHERE barcode='$barcode' AND size='$size'";
		$run=mysqli_query($db,$query);

	while($row=mysqli_fetch_array($run))
		{
			$barcode=$row['barcode'];
			$name=$row['name'];
			$image=$row['image'];
			$price=$row['price'];
			$size=$row['size'];
			$catagory=$row['catagory'];
			$query="insert into cart (barcode,username,p_name,p_image,p_price,p_size,p_quantity,p_catagory) VALUES('$barcode','$username','$name','$image','$price','$size',1,'$catagory')";
		}
			if (mysqli_query($db,$query))
				echo "<script type='text/javascript'>alert('The product successfully added to cart!')</script>";
			else
				echo "<script type='text/javascript'>alert('Adding product failed, try again!')</script>";
		}
	}
	?>
	<?php if(isset($_POST['submit']) and (!isset($_SESSION['username'])))
	{
		echo "<script type='text/javascript'>alert('You must log in before Adding to cart!');window.location.href='login.php'</script>";
	}
	?>
<?php
?>
</table>
</center>
