<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>כניסה</h2>
  </div>
	 
  <form method="post" action="login.php" dir="rtl">
  	<?php include('errors.php'); ?>
	
  		<label>שם משתמש</label>
  		<input type="text" name="username" >
		<br/><br/>

  		<label>סיסמה</label>
  		<input type="password" name="password">
	    <br/><br/>

  		<button type="submit" class="btn" name="login_user">כניסה</button>
	    <br/>

  	<p>
  		לא חבר ? <a href="register.php">להירשם</a><br/>
		תחזור ל<a href="home.php">עמוד הבית</a><br/>
  	</p>
	
  </form>
</body>
</html>