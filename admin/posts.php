<?php

require_once("inc/top.php");
  ?>
     <?php
  if(!isset($_SESSION['username'])){
    header('location:loginpanel.php');
  }

 echo $session_username=$_SESSION['username'];

 if(isset($_REQUEST['del'])){
    $del_id=$_REQUEST['del'];
    if($_SESSION['role']=='admin'){
      $del_check_query="SELECT* FROM posts WHERE id=$del_id";
    $del_check_run=mysqli_query($con,$del_check_query);
    }
   else if($_SESSION['role']=='auther'){
      $del_check_query="SELECT* FROM posts  WHERE id=$del_id && auther='$session_username'";
    $del_check_run=mysqli_query($con,$del_check_query);
   }
    if(mysqli_num_rows($del_check_run)>0){
          $del_query= "DELETE FROM `posts` WHERE `posts`.`id` = $del_id";
  
      if(mysqli_query($con,$del_query)){
      $msg="Post has been Deleted";
    }
    else{
      $error="Post has not been Deleted";
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
       $bul_del_query="DELETE FROM `posts` WHERE `posts`.`id` = $user_id";
      mysqli_query($con,$bul_del_query);
    }
    else if($bulk_option=='publish'){
      $bulk_auther_query="UPDATE `posts` SET `status` = 'publish' WHERE `posts`.`id` = $user_id";
      mysqli_query($con,$bulk_auther_query);
    }
    else if($bulk_option=='draft'){
      $bulk_admin_query="UPDATE `posts` SET `status` = 'draft' WHERE `posts`.`id` = $user_id";
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
      
      <h1><span class="fa fa-file-text-o"></span>
    Posts <small>View All Posts</small></h1>
    <hr>
    <ol class="breadcrumb">
  <li><a href="admin.php"><i class="fa fa-refresh"></i> Dashboard</a></li>

  <li class="active"><i class=" fa fa-file-text-o"></i> Posts</li>
  
</ol>
<?php 
        if($_SESSION['role']=='admin'){
          $query="SELECT * FROM posts ORDER BY id DESC";
      $run=mysqli_query($con, $query);
          
        }
      else if($_SESSION['role']=='auther'){
     
        $query="SELECT * FROM `posts` WHERE `auther`='$session_username' ORDER BY id DESC";
       $run=mysqli_query($con, $query);
        
      }
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
            <option value="publish">Publish</option>
            <option value="draft">Draft</option>
          </select>
          </div>
        </div>
        <div class="col-xs-8">
          <input type="submit" class="btn btn-warning" value="Apply">
          <a href="add_post.php" class="btn btn-primary">Add New</a>
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
         <th>Title</th>
         <th>Author</th>
         <th>Image</th>
         <th>Categories</th>
         <th>Views</th>
         <th>Status</th>
         <th>Posts</th>
         <th>Edit</th>
         <th>Delete</th>
         
       </tr>
     </thead>
     <tbody>
      <?php
        while($row=mysqli_fetch_array($run)){
          $id=$row['id'];
        $title=$row['title'];
          $auther=$row['author'];
           
        $img=$row['img'];
          $status=ucfirst($row['status']);
          $views=$row['views'];
          $category=$row['category'];
            $date=getdate($row['date']);
          $day=$date["mday"];
            $month=substr($date["month"],0,3);
            $year=$date["year"];
          
          
        
       
       ?>
       <tr>
        <td><input type="checkbox" class="checkboxes" name="checkboxes[]" value="<?php echo $id;?>"></td>
         <td><?php echo $id;?></td>
         <td><?php echo "$day $month $year";?></td>
         <td><?php echo $title;?></td>
         <td><?php echo $auther;?></td>
         <td><img src="<?php echo "$img";?>"  width="30px;"></td>
         <td><?php echo $category;?></td>
         <td><?php echo $views;?></td>
         <td style="color:<?php if($status=='publish') {echo"green"; } else if($status=='draft'){echo"red"; }
           ?>;"><span ><?php echo $status;?></span></td>
         <td>12</td>
         <td><a href="edit_post.php?edit=<?php echo $id;?>"><i class="fa fa-pencil"></i></a>
         </td>
         <td>
           <a href="posts.php?del=<?php echo $id;?>"><i class="fa fa-times"></i></a>
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