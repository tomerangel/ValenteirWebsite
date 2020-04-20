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
	<form action="permissions.php" method="post">
	<br>
	<table>
	<th colspan=3>Permissions</th>
	<tr>
	<td>Enter Username:</td>
	<td><input type="text" name="username" /></td>
	<th><select name="rank">
	<option value="0">Regular User</option>
	<option value="1">Stock and Financial Manage</option>
	<option value="2">Content and Media Manage</option>
	</select></th>
	</tr>
	<center>
	<td colspan=2><input type="submit" name="Update"></td>
	</center>
	</form>
<?php }?>
<?php 
	if(isset($_POST['Update']))
	{
			$db=mysqli_connect('localhost','root','','forum');
			$username=$_POST['username'];
			$rank=$_POST['rank'];
			$query="UPDATE users SET rank='$rank' WHERE username='$username'";
			mysqli_query($db,$query);
			if(mysqli_query($db,$query))
				echo "<script type='text/javascript'>alert('Update rank succeed!');window.location.href='home.php'</script>";
			else
				echo "<script type='text/javascript'>alert('Update rank Faild!');window.location.href='home.php'</script>";
			
	}?>