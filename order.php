<?php include "header.php" ; if(isset($_SESSION["username"]) and isset($_POST['checkout'])) { ?>
<a href="home.php"><p align="right">עמוד הבית</p></a>
<center>
<table border=1>
<tr><th colspan=8>פרטי ההזמנה</th></tr>
<tr>
<th>ברקוד</th><th>שם</th><th>תמונה</th><th>מידה</th><th>כמות</th><th>סך הכל</th>
</tr>
<?php $_SESSION['pay']=1 ?>
<?php
$username=$_SESSION["username"];
$db = mysqli_connect('localhost', 'root', '','forum');
$query="SELECT * from cart WHERE username='$username'";

	if($query)
	{
		$run=mysqli_query($db,$query);
		while($row=mysqli_fetch_array($run))
		{
			$id=$row['id'];
			$barcode=$row['barcode'];
			$name=$row['p_name'];
			$image=$row['p_image'];
			$price=$row['p_price'];
			$quantity=$row['p_quantity'];
			$size=$row['p_size'];
			$t_p=$row['p_price']*$quantity;
			@$total+=$row['p_price']*$quantity;
	?>
	<td><?php echo '#';echo $barcode; ?><td><?php echo $name; ?></td><td><img src="image/<?php echo $image ?>" width=50 height=50 /></td>
	<td><?php echo $size; ?></td><td><?php echo $quantity; ?></td><td><?php echo $t_p; echo '$'; ?></td>
	</tr>
<?php
		}
	}
?>
<?php {?>
<form action="payment.php" method="post">
<tr><th colspan=8><?php echo 'מחיר:'; echo $total;echo '$';?></th></tr>
<tr><th colspan=8><input type="submit" name="continue" value="להמשיך לתשלום" /></th></tr>
</form>
</table>
<?php }?>
<?php } else {?>
<center>
<h1>אין גישה</h1>
</center>
<?php }?>
