<?php include "header.php"; ?>
<?php if (!isset($_SESSION['username'])) { echo "<script type='text/javascript'>alert('You must log in before getting your messages!');window.location.href='login.php'</script>"; }?>
<center>
<table border=5>
<tr><th colspan=7>ההודעות שלי</th></tr>
<tr>
<th>מס הודעה</th><th>תאריך ההודעה</th><th>אימייל</th><th>הודעה</th>
</tr>
<?php
		$db = mysqli_connect('localhost', 'root', '','forum');
		$username=$_SESSION['username'];

		$query="SELECT * FROM support where username='$username'";
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
	<td><?php echo '#';echo $id;?></td><td><?php echo $date;echo ', '; echo $time; ?></td><td><?php echo $email;?><td><?php echo $message; ?></td>
	</tr>
	</table>
	<?php }?>