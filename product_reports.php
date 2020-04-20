<?php include "table.css" ;?>
<?php 
include "header.php" ;
if(!isset($_SESSION['username']))
{
	echo "<script type='text/javascript'>alert('Permission Denied');window.location.href='home.php'</script>";
}
if ($_SESSION['rank']!=2)
{
	echo "<script type='text/javascript'>alert('Permission Denied');window.location.href='home.php'</script>";
}?>
<a href="home.php"><p align="right">Home Page</p></a>
<center>
<table border=1>
<tr><th colspan=9>All the products on store</th></tr>
<tr>
<th>Id</th><th>barcode</th><th>name</th><th>image</th><th>size</th>
</tr>
<?php
$db = mysqli_connect('localhost', 'root', '','forum');
$query="SELECT * FROM `product`";

	if($query)
	{
		$run=mysqli_query($db,$query);
		while($row=mysqli_fetch_array($run))
		{
			$id=$row['id'];
			$barcode=$row['barcode'];
			$name=$row['name'];
			$image=$row['image'];
			$size=$row['size'];
			$quantity=$row['quantity'];
			@$total+=$quantity;


		?>
		<tr>
		<td><?php echo '#';echo $id;?></td><td><?php echo '#';echo $barcode; ?><td><?php echo $name; ?></td><td><img src="image/<?php echo $image ?>" width=50 height=50 /></td>
		<td><?php echo $size; ?></td>
		</tr>
<?php 	}
}?>
</table>
