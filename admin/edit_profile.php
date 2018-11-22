<?php
require_once("inc/top.php");

if(!isset($_SESSION['username'])){
    header('location:loginpanel.php');
  }

  $session_username=$_SESSION['username'];
if(isset($_GET['edit'])){
  
  $edit_id=$_GET['edit'];
  $edit_query="SELECT * FROM users WHERE id=$edit_id";
  $edit_query_run=mysqli_query($con,$edit_query);
  if(mysqli_num_rows($edit_query_run)>0){
    $edit_row=mysqli_fetch_array($edit_query_run);
    $e_username=$edit_row['username'];
    if($e_username==$session_username){
      $e_first_name=$edit_row['first_name'];
    $e_last_name=$edit_row['last_name'];
    
    $e_img=$edit_row['img'];
    $e_details=$edit_row['details'];
    }
    else{
       header('location:index.php');
}
    
  }
  else{
    header('location:index.php');
      }
  
}
else{
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
      
      <h1><span class="fa fa-user"></span>
   Edit Profile <small>Edit-Profile Details</small></h1>
    <hr>
    <ol class="breadcrumb">
  <li><a href="admin.php"><i class="fa fa-refresh"></i> Dashboard</a></li>
  <li><a href="categories.php"><i class="fa fa-folder-open"></i>Category</a></li>
  
  <li class="active"><i class=" fa fa-user"></i> Edit-profile</li>
  
</ol>
<?php
      if(isset($_REQUEST['submit']))
      {
        
        $first_name=mysqli_real_escape_string($con,$_REQUEST['first-name']);
        $last_name=mysqli_real_escape_string($con,$_REQUEST['last-name']);
      
        $password=mysqli_real_escape_string($con,$_REQUEST['password']);
        
        $img= $_FILES['img']['name'];
         $img_tmp= $_FILES['img']['tmp_name'];
        
      $details=mysqli_real_escape_string($con,$_REQUEST['details']);
        if(empty($img)){
          $img=$e_img;
          
        }
        
        
                        // encrypt password
       //  $check_run=mysqli_query($con,$check_query) ;
        
        //$salt_query="SELECT *FROM users ORDER BY id DESC LIMIT 1";
       // $salt_run=mysqli_query($con,$salt_query);
      //  $salt_row=mysqli_fetch_array($salt_run);
       //  $salt=$salt_row['salt'];
        
       // $insert_password=crypt($password,$salt);
        
        if(empty($first_name) or empty($last_name)  or empty($img)){
          $error="All (*) Fields are Required";
        }
       
       else{
        $update_query="UPDATE `users` SET `first_name` = '$first_name', `last_name` = '$last_name', `img` = '$img', `password` = '$password', `details` = '$details' WHERE `users`.`id` =$edit_id";
        //if(isset($password)){ $update_query.="`password` = '$password'";}
       //  $update_query.="`id` =$edit_id";
         
         if(mysqli_query($con,$update_query)){
           $msg="User has been updated";
           header("refresh:1; url=edit_profile.php?edit_profile=$$edit_id");
           }
         else{
           $error="User has not been updated";
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
               <input value="<?php echo $e_first_name; ?>" type="text" id="first-name" name="first-name" class="form-control" placeholder="First-Name">
 </div>
  <div class="form-group">
  <label for="last-name">Last-Name:*</label>
               <input type="text" value="<?php echo $e_last_name; ?>" id="last-name" name="last-name" class="form-control" placeholder="Last-Name">
 </div>


 <div class="form-group">
  <label for="password">Password:*</label>
               <input type="password" name="password" id="password" class="form-control" placeholder="Password">
 </div>
  <div class="form-group">

 </div>
  <div class="form-group">
  <label for="file">Profile-Image:*</label>
               <input type="file" name="img"  id="file"  >
 </div>
 
  <div class="form-group">
  <label for="details">Details:*</label>
               <textarea name="details" id="details" cols="30" rows="10" class="form-control" ><?php
                 echo $e_details;
                 ?></textarea>
 </div>
  <input type="submit" class="btn btn-primary" value="Update-User" name="submit">
  
</form>
  </div>
  <div class="col-md-4">
    <?php
   
      echo"<img src='la ca pics/$e_img' alt='' width='100%'>";
   
    
    ?>
    
  </div>
</div>
    </div>
  </div>
</div>

<?php
  require_once("inc/footer.php");
  ?>