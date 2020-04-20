<?php
if(isset($_POST['delete']))
{
	$id=$_POST['id'];
	$db = mysqli_connect('localhost', 'root', '','forum');
	$query="DELETE from support WHERE id='$id'";
	if(mysqli_query($db,$query))
	{
		echo "<script type='text/javascript'>alert('Message deleted');window.location.href='".$_SERVER['HTTP_REFERER']."'</script>";
	}
	else
	{
		echo "<script type='text/javascript'>alert('Message delete faild');window.location.href='".$_SERVER['HTTP_REFERER']."'</script>";
	}
	
}?>