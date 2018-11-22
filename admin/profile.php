<?php
require_once("inc/top.php");
  
  if(!isset($_SESSION['username'])){
    header('location:loginpanel.php');
  }

 $session_username=$_SESSION['username'];
$query="SELECT * FROM users WHERE username='$session_username'";
$run=mysqli_query($con,$query);
$row=mysqli_fetch_array($run);
 $img=$row['img'];
$id=$row['id'];
$date=getdate($row['date']);
$day=$date['mday'];
  $month=substr($date['month'],0,3);
  $year=$date['year'];
$first_name=$row['first_name'];
$last_name=$row['last_name'];
$username=$row['username'];

$email=$row['email'];
$role=$row['role'];
$details=$row['details'];

?>
		    
</head>
<body id="profile">
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
    Profile <small>Personal details</small></h1>
    <hr>
    <ol class="breadcrumb">
  <li ><a href="index.php">Dashboard</a></li>
  <li class="active"><span class="fa fa-user"></span> Profile</li>
  
</ol>
 <div class="row">
   <div class="xs-12"> <center> <img src='<?php echo "la ca pics/".$img;?>' id="profile-img" alt='' width='200px' class="img-circle img-thumbnail"></center><br>
   <a href="edit_profile.php?edit=<?php echo $id;?>" class="btn btn-success pull-right">Edit-profile</a><br><hr>
   <center>
     <h3>Profile-details</h3>
   </center><br>
   <table class="table  table-bordered">
     <tr>
       <td width="25%"><b>User Id:</b></td>
       <td width="25%"><?php echo $id;?></td>
       <td width="25%"><b>Sign-up Date:</b></td>
       <td width="25%"><?php echo "$day $month $year";?></td>
     </tr>
     <tr>
       <td width="25%"><b>first Name:</b></td>
       <td width="25%"><?php echo $first_name;?></td>
       <td width="25%"><b>Last-Name:</b></td>
       <td width="25%"><?php echo $last_name;?></td>
     </tr>
     <tr>
       <td width="25%"><b>User-Name:</b></td>
       <td width="25%"><?php echo $username;?></td>
       <td width="25%"><b>Email:</b></td>
       <td width="25%"><?php echo $email;?></td>
     </tr>
     <tr>
       <td width="25%"><b>Role:</b></td>
       <td width="25%"><?php echo $role;?></td>
       <td width="25%"><b></b></td>
       <td width="25%"></td>
     </tr>
   </table>
   <div class="row">
     <div class="col-md-8 col-sm-12">
       <b>Details</b>
       <div>
        <?php echo $details;?>
         
       </div>
     </div>
   </div>
   </div>
 </div>
    </div>
  </div>
  
</div>

<?php
  require_once("inc/footer.php");
  ?>







