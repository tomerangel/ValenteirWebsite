<?php
session_start();
    if(!isset($_SESSION["user"])){
        header("location:index.php");
    }


        $MySQLdb = new PDO("mysql:host=127.0.0.1;dbname=forum", "root", "");
        $MySQLdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $user=$_SESSION["user"];
    $user_id=$_SESSION["user_id"];
    $cursor = $MySQLdb->prepare("SELECT * FROM users WHERE username=:username");
      $cursor->execute(array(":username"=>$_SESSION["user"]));
   $balance=$_SESSION["balance"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bank Mazrahi</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/custom.css">

    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="Home.php">Home Page</a>
        </div>

        <ul class="nav navbar-nav" style="float: left">
            <li><a href="main.php" id="Profile page">Profile page</a></li>
            <li><a href="transfer.php" id="Transfer cash">Transfer Money</a></li>
            <li><a href="#" id="logout">Logout</a></li>

        </ul>
    </div>
</nav>

<div class="container">
    <div class="row" id="page" hidden>
        <div class="col-md-3">
            <div class="panel panel-default">
                    <div class="panel-heading">Welcome  : <?php echo $user?></div>
                    <div class="panel-heading">Your Current Money now is : <?php
                            $row=$cursor->fetch();
                            echo $row["balance"];

                     ?></div>
                <div class="panel-body"style="float:left; width:400px">
                    <ul class="list-group" >
                        <li class="list-group-item" style="height:100px" >
                            <p>
                                <kbd>Password</kbd>
                                <span style="float:right;">

                                    <button id="updatePassword">Update Password</button>
                                    <input type="password" id="div3" style="display:none;"><br>
                                    <button id="update_Password" style="display:none;">Update!!</button><br><br>
                                </span>
                            </p>
                        </li>
                        <li class="list-group-item" style="height:100px" >
                            <p >
                                <kbd id="balance">Balance:</kbd>
                                <span style="float:right;">

                                    <button id="updateBalance">Update Balance</button>
                                    <input type="text" id="div1" style="display:none;"><br>
                                    <button id="update_Balance" style="display:none;">Update!!</button><br><br>
                                </span>
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script>


	$("#page").slideDown("slow");

    $.post("api.php",{"action":"get_all"},function(data){
    console.log(data);
   })


   $(document).ready(function(){
      $("#updatePassword").click(function(){
        $("#div3").fadeIn();
         $("#update_Password").fadeIn();
      });
    });


    $(document).ready(function(){
      $("#updateBalance").click(function(){
        $("#div1").fadeIn();
         $("#update_Balance").fadeIn();
      });
    });

    $("#update_Password").click(function(){
        $.post("api.php",{"action":"update_Password","password":$("#div3").val()},function(data){
            location.href="main.php";
            console.log(data);
        });
    });



    $("#update_Balance").click(function(){
          $.post("api.php",{"action":"update_Balance","balance":$("#div1").val()},function(data){
              location.href="main.php";
          console.log(data);
              });
          });

    $("#logout").click(function(){
        $.post("api.php",{"action":"logout"},function(data){
        console.log("a");
        if(data == "logged-out"){
             console.log("b");
            location.href="index.php";
            alert("you looged out");
        }

        });
    });
      $("#send_post").click(function(){
            $.post("api.php",{"action":"new_post","data":$("#msg").val()},function(data){
                if(data=="true"){
                location.reload();
                }

            });
        });



</script>
</body>
</html>
