<?php
require_once("inc/top.php");
  ?>
     <?php
  if(!isset($_SESSION['username'])){
    header('location:loginpanel.php');
  }
else if(isset($_SESSION['username']) && $_SESSION['role'] !='admin' )  
{
  header('location:index.php');
}
  
 if(isset($_REQUEST['del'])){
    $del_id=$_REQUEST['del'];
    $del_check_query="SELECT* FROM users WHERE id=$del_id";
    $del_check_run=mysqli_query($con,$del_check_query);
    if(mysqli_num_rows($del_check_run)>0){
          $del_query= "DELETE FROM `users` WHERE `users`.`id` = $del_id";
  if(isset($_SESSION['username']) && $_SESSION['role'] =='admin'){
      if(mysqli_query($con,$del_query)){
      $msg="Users has Been Deleted";
    }
    else{
      $error="Users has not been Deleted";
    }
}
      
    }
else{
  header('location:index.php');

}
    
  }
if(isset($_REQUEST['checkboxes'])){
  foreach($_REQUEST['checkboxes'] as $user_id){
   $bulk_option=$_REQUEST['bulk-options'];
    if($bulk_option=='delete'){
       $bul_del_query="DELETE FROM `users` WHERE `users`.`id` = $user_id";
      mysqli_query($con,$bul_del_query);
    }
    else if($bulk_option=='auther'){
      $bulk_auther_query="UPDATE `users` SET `role` = 'auther' WHERE `users`.`id` = $user_id";
      mysqli_query($con,$bulk_auther_query);
    }
    else if($bulk_option=='admin'){
      $bulk_admin_query="UPDATE `users` SET `role` = 'admin' WHERE `users`.`id` = $user_id";
      mysqli_query($con,$bulk_admin_query);
    }
    
  }
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
      
      <h1><span class="fa fa-users"></span>
    Users <small>Statistics Overview</small></h1>
    <hr>
    <ol class="breadcrumb">
  <li><a href="admin.php"><i class="fa fa-refresh"></i> Dashboard</a></li>
  <li><a href="categories.php"><i class="fa fa-folder-open"></i>Category</a></li>
  <li class="active"><i class=" fa fa-users"></i> Users</li>
  
</ol>
<?php 
        $query="SELECT * FROM users ORDER BY id DESC";
      $run=mysqli_query($con, $query);
      if(mysqli_num_rows($run)>0)
      {
      ?>
      <form action="" method="post">
<div class="row">
  <div class="col-sm-8">
    
      <div class="row">
        <div class="col-xs-4">
          <div class="form-group">
          <select class="form-control" name="bulk-options" id="">
            <option value="delete">Delete</option>
            <option value="auther">Change to Auther</option>
            <option value="admin">Change to Admin</option>
          </select>
          </div>
        </div>
        <div class="col-xs-8">
          <input type="submit" class="btn btn-warning" value="Apply">
          <a href="add_user.php" class="btn btn-primary">Add New</a>
        </div>
      </div>
    
  </div>
</div>
   <?php
        if(isset($error)){
          echo "<span style='color:red;' class='pull-right'>$error</span>";
          
        }
        else if(isset($msg)){
          echo "<span style='color:green;' class='pull-right'>$msg</span>";
        }
      ?>
   <table class="table table-bordered table-hover table-striped">
     <thead>
       <tr>
        <th><input type="checkbox" id="selectallboxes"></th>
         <th>Sr. no.</th>
         <th>Date</th>
         <th>Name</th>
         <th>User<br>name</th>
         <th>Email</th>
         <th>Image</th>
         <th>Pass<br>word</th>
         <th>Role</th>
         <th>Posts</th>
         <th>Edit</th>
         <th>Delete</th>
       </tr>
     </thead>
     <tbody>
      <?php
        while($row=mysqli_fetch_array($run)){
          $id=$row['id'];
          $date=getdate($row['date']);
          $day=$date["mday"];
            $month=substr($date["month"],0,3);
            $year=$date["year"];
          $first_name=ucfirst($row['first_name']);
          $last_name=$row['last_name'];
          $username=$row['username'];
          $email=$row['email'];
        $img=$row['img'];
          
          $role=ucfirst($row['role']);
          
          
          
          
        
       
       ?>
       <tr>
        <td><input type="checkbox" class="checkboxes" name="checkboxes[]" value="<?php echo $id;?>"></td>
         <td><?php echo $id;?></td>
         <td><?php echo "$day $month $year";?></td>
         <td><?php echo $first_name."<br>".$last_name;?></td>
         <td><?php echo $username;?></td>
         <td><?php echo $email;?></td>
         <td><img src="<?php echo "la ca pics/$img";?>"  width="30px;"></td>
         <td>***..</td>
         <td><?php echo $role;?></td>
         <td>12</td>
         <td><a href="edit_user.php?edit=<?php echo $id;?>"><i class="fa fa-pencil"></i></a>
         </td>
         <td>
           <a href="users.php?del=<?php echo $id;?>"><i class="fa fa-times"></i></a>
         </td>
       </tr>
       <?php
       }
       ?>
     </tbody>
   </table>
  <?php
        }
      else{
        echo"<center><h2>NO Users Available Now<h2></center>";
      }
      ?>
      </form>
    </div>
  </div>
</div>

<?php
  require_once("inc/footer.php");
  ?>