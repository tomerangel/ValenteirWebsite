<?php include "table.css" ;?>
<?php session_start();
include "header.php" ;
if(!isset($_SESSION['username']))
{
	header('location:home.php');
}
if ($_SESSION['rank']!=2)
{
	header('location:home.php');
}?>
<a href="home.php"><p align="right">Home Page</p></a>
<center>
<table border=1>
<tr><th colspan=9>All users</th></tr>
<tr>
<th>Id</th><th>username</th><th>email</th><th>password</th><th>rank</th>
</tr>
<?php
$db = mysqli_connect('localhost', 'root', '','forum');
$query="SELECT * FROM `users` WHERE 1";
@$total=0;
	if($query)
	{
		$run=mysqli_query($db,$query);
		while($row=mysqli_fetch_array($run))
		{
			$id=$row['id'];
			$username=$row['username'];
			$email=$row['email'];
			$password=$row['password'];
			$rank=$row['rank'];
			@$total+=1;


		?>
		<tr>
		<td><?php echo '#';echo $id;?></td><td><?php echo '#';echo $username; ?><td><?php echo $email; ?></td>
		<td><?php echo $password; ?></td><td><?php echo $rank; ?></td>
		</tr>
<?php 	}
}?>
		<center>
		<br><th>Total Quantity: <?php echo $total;?></th></br>
		</center>
</table>
