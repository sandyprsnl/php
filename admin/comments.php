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
$session_username=$_SESSION['username'];
  
  if(isset($_REQUEST['del'])){
    $del_id=$_REQUEST['del'];
    $del_check_query="SELECT* FROM comments WHERE id=$del_id";
    $del_check_run=mysqli_query($con,$del_check_query);
    if(mysqli_num_rows($del_check_run)>0){
          $del_query= "DELETE FROM `comments` WHERE `comments`.`id` = $del_id";
  if(isset($_SESSION['username']) && $_SESSION['role'] =='admin'){
      if(mysqli_query($con,$del_query)){
      $msg="Comments has Been Deleted";
    }
    else{
      $error="Comments has not been Deleted";
    }
}
      
    }
else{
  header('location:index.php');

}
    
  }

 if(isset($_REQUEST['approve'])){
    $approve_id=$_REQUEST['approve'];
    $approve_check_query="SELECT* FROM comments WHERE id=$approve_id";
    $approve_check_run=mysqli_query($con,$approve_check_query);
    if(mysqli_num_rows($approve_check_run)>0){
          $approve_query= "UPDATE `comments` SET `status` = 'approve' WHERE `comments`.`id` = $approve_id";
  if(isset($_SESSION['username']) && $_SESSION['role'] =='admin'){
      if(mysqli_query($con,$approve_query)){
      $msg="Comment has Been Approve";
    }
    else{
      $error="Comment has not been Approve";
    }
}
      
    }
else{
  header('location:index.php');

}
    
  }

 if(isset($_REQUEST['unapprove'])){
    $unapprove_id=$_REQUEST['unapprove'];
    $unapprove_check_query="SELECT* FROM comments WHERE id=$unapprove_id";
    $unapprove_check_run=mysqli_query($con,$unapprove_check_query);
    if(mysqli_num_rows($unapprove_check_run)>0){
          $unapprove_query= "UPDATE `comments` SET `status` = 'pending' WHERE `comments`.`id` = $unapprove_id";
  if(isset($_SESSION['username']) && $_SESSION['role'] =='admin'){
      if(mysqli_query($con,$unapprove_query)){
      $msg="Comment has Been Approve";
    }
    else{
      $error="Comment has not been Approve";
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
       $bul_del_query="DELETE FROM `comments` WHERE `comments`.`id`  = $user_id";
      mysqli_query($con,$bul_del_query);
    }
    else if($bulk_option=='approve'){
      $bulk_auther_query="UPDATE `comments` SET `status` = 'approve' WHERE `comments`.`id` = $user_id";
      mysqli_query($con,$bulk_auther_query);
    }
    else if($bulk_option=='pending'){
      $bulk_admin_query="UPDATE `comments` SET `status` = 'pending' WHERE `comments`.`id` = $user_id";
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
      
      <h1><span class="fa fa-comments-o"></span>
    Comments <small>View All Comments</small></h1>
    <hr>
    <ol class="breadcrumb">
  <li><a href="admin.php"><i class="fa fa-refresh"></i> Dashboard</a></li>
  <li><a href="categories.php"><i class="fa fa-folder-open"></i>Category</a></li>
  <li class="active"><i class=" fa fa-comments-o"></i> Comments</li>
  
</ol>
<?php
        if(isset($_GET['reply'])){
          $reply_id=$_GET['reply'];
         $reply_check_query="SELECT * FROM comments WHERE post_id=$reply_id";
          $reply_check_run=mysqli_query($con,$reply_check_query);
          if(mysqli_num_rows($reply_check_run)>0){
            
            if(isset($_POST['reply']))
            {
              
              $comment_data=$_POST['comment'];
              if(empty($comment_data)){
                $comment_error="Must fill  this field";
              }
              else{
                $get_user_data="SELECT * FROM users WHERE username='$session_username'";
                $get_user_run=mysqli_query($con,$get_user_data);
                $get_user_row=mysqli_fetch_array($get_user_run);
                
                $date=time();
                  $first_name=$get_user_row['first_name'];
                $last_name=$get_user_row['last_name'];
                $full_name="$first_name $last_name";
                  $email=$get_user_row['email'];
                $img=$get_user_row['img'];
                
                $insert_comment_query="INSERT INTO `comments`(`date`, `name`, `username`, `post_id`, `email`, `img`, `comment`, `status`) VALUES ('$date','$full_name','$session_username','$reply_id','$email','$img','$comment_data','approve')";
                
                
                
                
                if(mysqli_query($con,$insert_comment_query)){
                  $comment_msg="Comment has been Submitted";
                  header('location:comments.php');
             }
                else{
                  $comment_error="Comment has not been Submitted";
                }
                
}
              
              
            }

      ?>
<div class="row">
  <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
  <form action="" method="post">
   <div class="form-group">
     <label for="comment">Comment:*</label>
     <?php
     if(isset($comment_msg)){
       echo"<span class='text-success pull-right'>$comment_msg</span>";
     }
             if(isset($comment_error)){
       echo"<span class='text-danger pull-right'>$comment_error</span>";
     }
            
     ?>
     
     <textarea name="comment" id="comment" cols="30" rows="10" class="form-control" placeholder="Your comment here"></textarea><br>
     <input type="submit" name="reply" value="Reply" class="btn btn-success">
   </div>
    
  </form>
  </div>
</div>
<hr>
<?php
            }
          
        }
            
            
        $query="SELECT * FROM comments ORDER BY id DESC";
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
            <option value="approve">Approve</option>
            <option value="pending">Un-Approve</option>
          </select>
          </div>
        </div>
        <div class="col-xs-8">
          <input type="submit" class="btn btn-warning" value="Apply">
          
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
        <th>User<br>name</th>
         <th>Comment</th>
         <th>Status</th>
         <th>Approve</th>
         <th>Un-Approve</th>
         <th>Reply</th>
          <th>Delete</th>
         
       </tr>
     </thead>
     <tbody>
      <?php
        while($row=mysqli_fetch_array($run)){
           
          $username=$row['username'];
          $status=ucfirst($row['status']);
          $comment=$row['comment'];
          $post_id=$row['post_id'];
          $id=$row['id'];
          $date=getdate($row['date']);
          $day=$date["mday"];
            $month=substr($date["month"],0,3);
            $year=$date["year"];
          
          
          
        ?>
       <tr>
        <td><input type="checkbox" class="checkboxes" name="checkboxes[]" value="<?php echo $id;?>"></td>
         <td><?php echo $id;?></td>
         <td><?php echo "$day $month $year";?></td>
        
         <td><?php echo $username;?></td>
         
         
         
        
         <td><?php echo $comment;?></td>
         <td><span style="color:<?php if($status=='approve') {echo"green"; } else if($status=='pending'){echo"red"; }
           ?>;"><?php echo $status;?></span></td>
         <td><a href="comments.php?approve=<?php echo $id;?>"> Approve</a>
         </td>
         <td><a href="comments.php?unapprove=<?php echo $id;?>">Un-Approve</a>
         </td>
         <td><a href="comments.php?reply=<?php echo $post_id;?>"><i class="  fa fa-reply"></i></a>
         </td>
         <td>
           <a href="comments.php?del=<?php echo $id;?>"><i class="fa fa-times"></i></a>
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