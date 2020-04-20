<?php include "server.php"; ?>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>

* {
    box-sizing: border-box;
}

body {
    margin: 0;
}

body {
  background-color: #d3d3d3;
}

.navbar {
    overflow: hidden;
    background-color: white;
    font-family: MS Gothic, MS Gothic, MS Gothic;
    align:"right";
}

.navbar a {
    float: left;
    font-size: 18px;
    color: black;
    text-align: center;
    padding: 12px 16px;
    text-decoration: none;
    align:"right";
}

.dropdown {
    float: left;
    overflow: hidden;
}

.dropdown .dropbtn {
    font-size: 18px;
    border: none;
    outline: none;
    color: black;
    padding: 12px 16px;
    background-color: inherit;
    font: inherit;
    margin: 0;
}

.navbar a:hover, .dropdown:hover .dropbtn {
    background-color: #d3d3d3;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #d3d3d3;
    width: 100%;
    left: 0;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    font-family: Dotum;
}

.dropdown-content .header {
    background: #d3d3d3;
    padding: 16px;
    color: black;
    font-family: Dotum;
}

.dropdown:hover .dropdown-content {
    display: block;
}

/* Create three equal columns that floats next to each other */
.column {
    float: left;
    width: 33.33%;
    padding: 10px;
    background-color: white;
    height: 500px;
}

.column a {
    float: none;
    color: black;
    padding: 19px;
    text-decoration: none;
    display: block;
    text-align: left;
}

.column a:hover {
    background-color: #ddd;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}


</style>
</head>
<body>
<div class="navbar" dir="rtl">
    <div >
        <a href="home.php" >עמוד הבית</a>
  	<?php if (isset($_SESSION['username'])) {
	$username=$_SESSION['username'];
	$db = mysqli_connect('localhost', 'root', '','forum');
	$rank=mysqli_query($db,"SELECT rank from users where username='$username'");
	$result = mysqli_fetch_array($rank);
	$_SESSION['rank']=$result['rank'];
	if ($result['rank']==0||$result['rank']==2) {
	?>
	<div class="dropdown" dir="rtl">
    <button class="dropbtn"><?php echo $username; ?>
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content" dir="rtl">
      <div class="row" align="right">
        <div class="column" align="right">
          <h3>הזמנות</h3>
          <a href="customer_orders.php" align="right">הזמנות שלי</a>
          <h3>ההודעות שלי</h3>
          <a href="user_messages.php" align="right">הודעות</a>
        </div>
          <div class="column">
              <h3>Cart</h3>
              <a  href="cart.php">העגלה שלי</a>
              <a href="wishlist.php">רשימת הקניות</a>
          </div>
	   </div>
    </div>
  </div>
	<?php
		}
	} ?>
  <div class="dropdown" align="right">
    <button class="dropbtn">בגדי יד 2
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <div class="header">
        <h2>תפריט</h2>
      </div>
      <div class="row" align="right">
        <div class="column" align="right">
          <h3>בגדים</h3>
          <a href="tops.php">חולצות </a>
          <a href="dresses.php">שמלות</a>
          <a href="bottoms.php">חצאית</a>
        </div>
        <div class="column">
          <h3>נעליים</h3>
          <a href="heels.php">עקבים</a>
          <a href="flats.php">שטוח</a>
        </div>
        <div class="column" align="right">
          <h3>כללי</h3>
          <a href="sunglasses.php" align="right">משקפיים</a>
          <a href="bags.php">תיקים</a>
        </div>
      </div>
    </div>
  </div>
    <a href="contact.php">התנדבות</a>
	<a href="about.php">קצת עלינו</a>
	<a href="cart.php">עגלה</a>
	<?php if (isset($_SESSION['username'])) {
	$username=$_SESSION['username'];
	$db = mysqli_connect('localhost', 'root', '','forum');
	$rank=mysqli_query($db,"SELECT rank from users where username='$username'");
	$result = mysqli_fetch_array($rank);
	$_SESSION['rank']=$result['rank'];

	if ($result['rank']==1) {
	?>
	<div class="dropdown">
    <button class="dropbtn">ניהול ופיננסים
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <div class="row">
        <div class="column">
          <h3>דוחות</h3>

		  <a href="order_reports.php">דוח הזמנות</a>
		  <a href="shippments_reports.php">דוח עגלה</a>
		  <a href="lack.php">דוחות חוסר</a>
        </div>


		</div>
    </div>
	  </div>
	<?php
		}
	} ?>
  	<?php if (isset($_SESSION['rank'])) {
	if($_SESSION['rank']==2) {
	?>
	<div class="dropdown">
    <button class="dropbtn">צור קשר וניהול האתר
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <div class="row">
        <div class="column">
          <h3>מוצרים</h3>
          <a href="add_product.php">הוספת מוצר חדש</a>

		  <a href="delete_product.php">מחיקת מוצר</a>
		  <a href="product_reports.php">מוצרים בחנות</a>
        </div>
        <div class="column">
          <h3>תמיכה</h3>
          <a href="messages_reports.php">הודעות לקוח</a>
		  <a href="search_user.php">חיפוש לקוח</a>
		  <a href="delete_user.php">מחיקת לקוח</a>
        </div>
		<div class="column">
          <h3>Permissions</h3>
          <a href="permissions.php">שינוי גישה </a>
        </div>

	<?php
		}
	} ?>
      </div>
    </div>
  </div>
</div>

<div style="padding:16px">
</div>
</div>
</body>
</html>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* Full-width input fields */
input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

/* Set a style for all buttons */
button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
    position: relative;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
    position: absolute;
    right: 25px;
    top: 0;
    color: #000;
    font-size: 35px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: red;
    cursor: pointer;
}

/* Add Zoom Animation */
.animate {
    -webkit-animation: animatezoom 0.6s;
    animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
    from {-webkit-transform: scale(0)}
    to {-webkit-transform: scale(1)}
}

@keyframes animatezoom {
    from {transform: scale(0)}
    to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
</style>
</head>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {box-sizing: border-box}
body {font-family: Verdana, sans-serif; margin:0}
.mySlides {display: none}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/* Caption text */
.text {
  color: black;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: black;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .prev, .next,.text {font-size: 11px}
}
</style>
</head>
<body>

<div class="slideshow-container">
<div style="font-size: 21px">יש לכן/ם בגדים מיותרים במצב טוב? תרמו אותם לעמותת ״לעצב מהלב״ וכל ההכנסות ייתרמו למרכז לנפגעות תקיפה מינית</div>
<div class="mySlides fade">
    <img src="11.jpg" style="width:100%">
</div>


</div>
<br>

<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}
</script>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* Full-width input fields */
input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}
b{
    font-size: 50px;
    font-weight: bold;

}
/* Set a style for all buttons */
button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
    position: relative;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
    position: absolute;
    right: 25px;
    top: 0;
    color: #000;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: red;
    cursor: pointer;
}

/* Add Zoom Animation */
.animate {
    -webkit-animation: animatezoom 0.6s;
    animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
    from {-webkit-transform: scale(0)}
    to {-webkit-transform: scale(1)}
}

@keyframes animatezoom {
    from {transform: scale(0)}
    to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
</style>
</head>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

/* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
</style>
</head>
<body>
<?php if(!isset($_SESSION["username"])){ ?>
<button class="open-button" onclick="openForm()">כניסה</button>

<div class="form-popup" id="myForm">

  <form action="/action_page.php" class="form-container">

    <a href="login.php">
    <button type="button" class="btn">להיכנס לחשבון</button>
	</a>

    <button type="button" class="btn cancel" onclick="closeForm()">לסגור</button>
  </form>
</div>
<?php } ?>

<?php if(isset($_SESSION["username"])){ ?>

<a href="logout.php">
<button type="button" class="open-button">יציאה</button>
</a>

<?php } ?>


<script>
function openForm() {
    document.getElementById("myForm").style.display = "block";
}

function closeForm() {
    document.getElementById("myForm").style.display = "none";
}


</script>

</body>
</html>
