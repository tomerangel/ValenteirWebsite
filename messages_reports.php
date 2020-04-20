<?php include "table.css" ;?>
<?php include "header.php";
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
<a href="messages_reports.php"><p align="right">Back to support messages</p></a>
</center>
<?php if (!isset($_POST['submitid']) and !isset($_POST['submitdate']) and !isset($_POST['submituser'])) {?>
	<br><br><br><br><br>
	<center>
	<form action="messages_reports.php" method="post">
	<table border=1>
	<tr>
	<th colspan=3>Support Messages By Message ID</th>
	</tr>
	<tr>
	<td>Serach by Message ID</td>
	<td><input type="text" name="id" /></td>
	<td><input type="submit" name="submitid" value="By message ID"></td>
	</tr>
	</table>
	<br>
	<table>
	<th colspan=3>Search by date</th>
	</tr>
	<tr>
	<td>Enter Year:</td>
	<td><input type="text" name="year" /></td>
	</tr>
	<td>Month:</td>
	<td><input type="text" name="month" /></td>
	<tr>
	<td>Enter Day:</td>
	<td><input type="text" name="day" /></td>
	</tr>
	<td><input type="submit" name="submitdate" value="Search By Date"></td>
	</table></br>
	<br>
	</table>
	<br>
	<table>
	<center><th colspan=3>Search by username</th></center>
	</tr>
	<tr>
	<td>Enter Username:</td>
	<td><input type="text" name="user" /></td>
	</tr>
	<td><input type="submit" name="submituser" value="Search By Username"></td>
	</table>
	</br></br></br></br></br></br>
	</form>
<?php } else {?>

		<center>
		<table border=5>
		<tr><th colspan=7>Selected Message</th></tr>
		<tr>
		<th>Message ID</th><th>Username</th><th>Message Date</th><th>Email</th><th>Message time</th><th>Message</th><th>Delete</th>
		</tr>
<?php
	$db = mysqli_connect('localhost', 'root', '','admin');
	if(isset($_POST['submitid']))
	{
		$id=$_POST['id'];
		if(empty($id))
		{
			echo "<script type='text/javascript'>alert('You must Fill Message ID!');window.location.href='messages_reports.php'</script>";
		}
		else
		{
		$query="SELECT * FROM support where id='$id'";
		$run=mysqli_query($db,$query) or die('my sqli error');
		$row=mysqli_fetch_array($run);
		if($row)
		{
			$id=$row['id'];
			$username=$row['username'];
			$email=$row['email'];
			$date=$row['day'].'/'.$row['month'].'/'.$row['year'];
			$time=$row['time'];
			$message=$row['message'];
		}
	?>
	<?php if($row){?>
	<tr>
	<td><?php echo '#';echo $id;?></td><td><?php echo $username; ?></td><td><?php echo $email;?></td><td><?php echo $date; ?></td><td><?php echo $time; ?><td><?php echo $message; ?></td>
	<form action="delete_message" method="post">
	<input type="hidden" name="id" value="<?php echo $id;?>">
	<td><input type="submit" name="delete" value="delete message"></td>
	</form>
	</tr>
	</table>
	<?php } else echo "<script type='text/javascript'>alert('id doesnt exists!');window.location.href='messages_reports.php'</script>";?>
<?php }  } 
	if(isset($_POST['submitdate']))
	{
		$db=mysqli_connect('localhost','root','','admin');
		$y=$_POST['year'];
		$m=$_POST['month'];
		$d=$_POST['day'];
		if(empty($y))
			echo "<script type='text/javascript'>alert('You must atleast year!');window.location.href='messages_reports.php'</script>";
		else if(!empty($m) and !empty($d))
			$query="SELECT * FROM support where year='$y' and month='$m' and day='$d'";
		if(!empty($m) and empty($d))
			$query="SELECT * FROM support where year='$y' and month='$m'";
		else if(isset($y) and empty($m) and empty($d))
			$query="SELECT * FROM support where year='$y'";
		
			$run=mysqli_query($db,$query) or die('my sqli error');
			while($row=mysqli_fetch_array($run))
		{
			$id=$row['id'];
			$username=$row['username'];
			$email=$row['email'];
			$date=$row['day'].'/'.$row['month'].'/'.$row['year'];
			$time=$row['time'];
			$message=$row['message'];
			?>
			<tr>
			<td><?php echo '#';echo $id;?></td><td><?php echo $username; ?></td><td><?php echo $email;?></td><td><?php echo $date; ?></td><td><?php echo $time; ?><td><?php echo $message; ?></td>
			<form action="delete_message" method="post">
			<input type="hidden" name="id" value="<?php echo $id;?>">
			<td><input type="submit" name="delete" value="delete message"></td>
			</form>
			</tr>
			
		<?php }?>
		</table>
<?php  } 
	if(isset($_POST['submituser']))
	{
		$db=mysqli_connect('localhost','root','','admin');
		$user=$_POST['user'];
		if(!empty($user))
		{
		$query="SELECT * FROM support where username='$user'";
		$run=mysqli_query($db,$query) or die('my sqli error');
			while($row=mysqli_fetch_array($run))
		{
			$id=$row['id'];
			$username=$row['username'];
			$email=$row['email'];
			$date=$row['day'].'/'.$row['month'].'/'.$row['year'];
			$time=$row['time'];
			$message=$row['message'];
			?>
			<tr>
			<td><?php echo '#';echo $id;?></td><td><?php echo $username; ?></td><td><?php echo $email;?></td><td><?php echo $date; ?></td><td><?php echo $time; ?><td><?php echo $message; ?></td>
			<form action="delete_message" method="post">
			<input type="hidden" name="id" value="<?php echo $id;?>">
			<td><input type="submit" name="delete" value="delete message"></td>
			</form>
			</tr>
			
		<?php }?>
		</table>
		<?php } ?>
	<?php  } 














}?>