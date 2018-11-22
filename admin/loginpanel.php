<?php
session_start();
ob_start();
require_once("../inc/db.php");
if(isset($_REQUEST['submit'])){
   $username=mysqli_real_escape_string($con,strtolower($_REQUEST['username']));
     $password=mysqli_real_escape_string($con,$_REQUEST['password']);
  $check_username_query="SELECT * FROM users WHERE username='$username'";
  $check_username_run=mysqli_query($con,$check_username_query);
  if(mysqli_num_rows($check_username_run)>0){
    $row=mysqli_fetch_array($check_username_run);
    
    $db_username=$row['username'];
    $db_password=$row['password'];
    $db_role=$row['role'];
    
    if($username==$db_username && $password==$db_password){
    
	header('location:index.php');
      $_SESSION['username']=$db_username;
   $_SESSION['role']=$db_role;
}
    
  }
  
  else{
    $error=" wrong username or password";
    
  }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <meta name="viewport" content="width=device-width">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
		   
		   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		   <link rel="stylesheet" href="loginpanel.css">
		   
		    <link rel="stylesheet" href="animate.css">
</head>

  <body>
    <form class="form-signin " action="" method="post">
      <div class="text-center mb-4">
       
       <a href="index.php"><img class="mb-4 animated bounceInDown" src="la ca pics/w3newbie.png" alt=" logo(2)" ></a>
        <h1 class="h3 mb-3 font-weight-bold text-danger">Please Log In </h1>
       <?php if(isset($error)){
      echo "<h3 class='text-danger'>$error</h3>";
        }
      ?>
      </div>

      <div class="form-label-group animated swing">
       <label for="inputEmail">Username</label>
        <input type="text" id="inputEmail" class="form-control" placeholder="username" required autofocus name="username">
        
      </div>

      <div class="form-label-group animated swing">
       <label for="inputPassword">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required  name="password">
        
      </div><br>

     
     <input type="submit" name="submit" class="btn btn-lg btn-primary btn-block" value="Sign In">
      <p class="mt-5 mb-3 text-muted text-center text-success">&copy; 2017-<?php echo date('Y');?></p>
    </form>
  </body>
  
  
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</html>
