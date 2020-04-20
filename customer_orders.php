<?php include "table.css" ;?>
<?php include "header.php" ; if(isset($_SESSION["username"])) { ?>
<a href="home.php"><p align="right">Home Page</p></a>
<center>
<table border=1>
<tr><th colspan=9 >כל הזמנות שלי</th></tr>
<tr>
<th>מס הזמנה</th><th>תאריך הזמנה</th><th>ברקוד</th><th>שם</th><th>תמונה</th><th>מידה</th><th>כמות</th><th>סך הכל</th><th>כל הפרטים</th>
</tr>
<?php
$username=$_SESSION["username"];
$db = mysqli_connect('localhost', 'root', '','forum');
$query="SELECT * from orders WHERE username='$username'";
$total=0;
	if($query)
	{
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
	?>
	<?php $date=$d.'/'.$m.'/'.$y; ?>
	<td><?php echo '#';echo $id;?></td><td><?php echo $date;?></td><td><?php echo '#';echo $barcode; ?><td><?php echo $name; ?></td><td><img src="image/<?php echo $image ?>" width=50 height=50 /></td>
	<td><?php echo $size; ?></td><td><?php echo $quantity; ?></td><td><?php echo $t_p; echo '$'; ?></td>
	<form action="full_details.php" method="post">
	<input type="hidden" value="<?php echo $id; ?>" name="id">
	<td><input type="submit" name="full_details" value="פרטי המוצר"></td>
	</form>
	</tr>
<?php
		}
	}
}
?>
<?php {?>
<tr><th colspan=9><?php echo 'כמות תשלום:'; echo $total;echo '$';?></th></tr>
</table>
<?php }?>
