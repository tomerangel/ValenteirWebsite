<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>הרשמה</h2>
  </div>


  <form method="post" action="register.php"dir="rtl">
  	<?php include('errors.php'); ?>

  	  <label >שם משתמש</label>
  	  <input type="text" name="username">
	  <br/><br/>


  	  <label>אי מייל</label>
  	  <input type="email" name="email">
	  <br/><br/>


  	  <label >סיסמה</label>
  	  <input type="password" name="password_1">
	  <br/><br/>


  	  <label>סיסמה שנית</label>
  	  <input type="password" name="password_2">
	  <br/><br/>

  	  <button type="submit" class="btn" name="reg_user">הירשם</button>
	  <br/><br/>

  	<p>
  		יש לך חשבון? <a href="login.php">כנס</a><br/>
		תחזור ל <a href="home.php">עמוד הבית</a><br/>
  	</p>
  </form>
</body>
</html>
