<?php include "table.css" ;?>
<?php include "header.php" ;
if(!isset($_SESSION['username']))
{
	echo "<script type='text/javascript'>alert('Permission Denied!');window.location.href='home.php'</script>";
}
if(isset($_SESSION['rank']))
{
if ($_SESSION['rank']!=2)
{
	echo "<script type='text/javascript'>alert('Permission Denied!');window.location.href='home.php'</script>";
}}?>
<center>
</center>
<?php if (!isset($_POST['submit'])) {?>
	<br><br><br><br><br>
	<center>
	<form action="delete_user.php" method="post">
	<br>
	<table>
	<th colspan=3>Delete User</th>
	<tr>
	<td>Enter Username:</td>
	<td><input type="text" name="username" /></td>
	</tr>
	<center>
	<td colspan=2><input type="submit" name="Delete" value="Delete"></td>
	</center>
	</form>
<?php }?>
<?php 
	if(isset($_POST['Delete']))
	{
			$db=mysqli_connect('localhost','root','','forum');
			$username=$_POST['username'];
			$query="DELETE FROM users WHERE username='$username'";
			mysqli_query($db,$query);
			if(mysqli_query($db,$query))
				echo "<script type='text/javascript'>alert('User Deleted');window.location.href='home.php'</script>";
			else
				echo "<script type='text/javascript'>alert('User Delete Faild!');window.location.href='home.php'</script>";
			
	}?>