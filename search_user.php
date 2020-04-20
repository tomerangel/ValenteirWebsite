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
<?php if (!isset($_POST['search'])) {?>
	<br><br><br><br><br>
	<center>
	<form action="search_user.php" method="post">
	<br>
	<table>
	<th colspan=3>Search User</th>
	<tr>
	<td>Enter Username:</td>
	<td><input type="text" name="username" /></td>
	</tr>
	<center>
	<td colspan=2><input type="submit" name="search" value="Search"></td>
	</center>
	</form>
<?php }?>
<?php 
	if(isset($_POST['search']))
	{
			$db=mysqli_connect('localhost','root','','forum');
			$username=$_POST['username'];
			$query="SELECT * FROM users WHERE username='$username' LIMIT 1";
			$res=mysqli_query($db,$query);
			while($row=mysqli_fetch_array($res))
			{
				$id=$row['id'];
				$email=$row['email'];
				$rank=$row['rank'];
			}?>
		<center>
		<table>
		<th colspan=3>Result Search User</th>
		<tr>
		<td>id:<?php echo $id; ?> </td>
		<td>Username:<?php echo $username; ?> </td>
		<td>Email: <?php echo $email; ?></td>
		<td>Rank:<?php echo $rank; ?> </td>
		</table>
		</tr>
		</center>
			
<?php }?>