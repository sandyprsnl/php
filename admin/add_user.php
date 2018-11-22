<?php
require_once("inc/top.php");

if(!isset($_SESSION['username'])){
    header('location:loginpanel.php');
  }
if(isset($_SESSION['username']) && $_SESSION['role'] !='admin' )  
{
  header('location:index.php');
}
?>
      
</head>
<body>
<div id="wrapper">
  <?php
   
  
  
  require_once("inc/header.php");
  ?>
<div class="container-fluid body-section">
  <div class="row">
   
    <div class="col-md-3">
<?php
      require_once("inc/sidebar.php")
      ?>
    </div>
    <div class="col-md-9">
      
      <h1><span class="fa fa-user-plus"></span>
   Add Users <small>Add New-Users</small></h1>
    <hr>
    <ol class="breadcrumb">
  <li><a href="admin.php"><i class="fa fa-refresh"></i> Dashboard</a></li>
  <li><a href="categories.php"><i class="fa fa-folder-open"></i>Category</a></li>
  
  <li class="active"><i class=" fa fa-user-plus"></i>Add New-Users</li>
  
</ol>
<?php
      if(isset($_REQUEST['submit']))
      {
        $date=time();
        $first_name=mysqli_real_escape_string($con,$_REQUEST['first-name']);
        $last_name=mysqli_real_escape_string($con,$_REQUEST['last-name']);
        $user_name=mysqli_real_escape_string($con,strtolower($_REQUEST['user-name'])); //strtolwer=string to lower 
        $username_trim=preg_replace("/\s+/", "", $user_name);
        $email=mysqli_real_escape_string($con,strtolower($_REQUEST['email']));
        $password=mysqli_real_escape_string($con,$_REQUEST['password']);
        $role=$_REQUEST['role'];
        $img= $_FILES['img']['name'];
         $img_tmp= $_FILES['img']['tmp_name'];
        
        $check_query="SELECT * FROM users WHERE username='$user_name' or email= '$email'";
                        // encrypt password
         $check_run=mysqli_query($con,$check_query) ;
        
        //$salt_query="SELECT *FROM users ORDER BY id DESC LIMIT 1";
       // $salt_run=mysqli_query($con,$salt_query);
      //  $salt_row=mysqli_fetch_array($salt_run);
       //  $salt=$salt_row['salt'];
        
       // $password=crypt($password,$salt);
        
        if(empty($first_name) or empty($last_name) or empty($email) or empty($password) or empty($img)){
          $error="All (*) Fields are Required";
        }
       else if($user_name != $username_trim){ 
         
         $error="Don't use spaces in Username";
       }
        else if(mysqli_num_rows($check_run)>0){
          $error="Username and email already Exist";
        }
        else{
          
          $insert_query="INSERT INTO `users`
          (`id`, `date`, `first_name`, `last_name`, `username`, `email`, `img`, `password`, `role`)
          VALUES 
          (NULL, '$date', '$first_name', '$last_name', '$user_name', '$email', '$img','$password', ' $role')";
          if(mysqli_query($con,$insert_query)){
            
            $msg="Added Successfully";
            $target="web_assignments";
            move_uploaded_file($img_tmp,$target);
            $img_check="SELECT * FROM users ORDER BY id DESC LIMIT 1 ";
            $img_run=mysqli_query($con,$img_check);
            $img_row=mysqli_fetch_array($img_run);
            $check_img=$img_row['img'];
            $first_name="";
            $last_name="";
            $user_name="";
             $email="";
            
            
          }
          else{
            $error=" Not Added Successfully";
          }
          
            }

      }
      
      ?>
<div class="row">
  <div class="col-md-8">
    <form action="" method="post" enctype="multipart/form-data">
     <?php
if(isset($error)){
  echo"<span style='color:green;' class='pull-right'>".$error."<br></span>";
}
     else if(isset($msg)){
  echo"<span style='color:green;' class='pull-right'>".$msg."<br></span>";
}
   
   ?>
 <div class="form-group">

  <label for="first-name">First-Name:*</label>
               <input value="<?php if(isset($first_name)){echo $first_name; }?>" type="text" id="first-name" name="first-name" class="form-control" placeholder="First-Name">
 </div>
  <div class="form-group">
  <label for="last-name">Last-Name:*</label>
               <input type="text" value="<?php if(isset($last_name)){echo $last_name; }?>" id="last-name" name="last-name" class="form-control" placeholder="Last-Name">
 </div>
 <div class="form-group">
  <label for="user-name">Username:*</label>
               <input type="text" name="user-name" value="<?php if(isset($user_name)){echo $user_name; }?>"  id="user-name" class="form-control" placeholder="Username">
 </div>
 <div class="form-group">
  <label for="email">Email:*</label>
               <input type="text" name="email" value="<?php if(isset($email)){echo $email; }?>" id="email" class="form-control" placeholder="Email Address">
 </div>
 <div class="form-group">
  <label for="password">Password:*</label>
               <input type="password" name="password" id="password" class="form-control" placeholder="Password">
 </div>
  <div class="form-group">
  <label for="role">Role:*</label>
               <select name="role" id="role" class="form-control">
                 <option value="auther">Auther</option>
                 <option value="admin">Admin</option>
               </select>
 </div>
  <div class="form-group">
  <label for="file">Profile-Image:*</label>
               <input type="file" name="img"  id="file"  >
 </div>
  <input type="submit" class="btn btn-primary" value="Add-User" name="submit">
  
</form>
  </div>
  <div class="col-md-4">
    <?php
    if(isset($check_img)){
      echo"<img src='la ca pics/$check_img' alt='' width='100%'>";
    }
    
    ?>
    
  </div>
</div>
    </div>
  </div>
</div>

<?php
  require_once("inc/footer.php");
  ?>