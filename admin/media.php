<?php
require_once("inc/top.php");
  
  if(!isset($_SESSION['username'])){
    header('location:loginpanel.php');
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
      
      <h1><span class="fa fa-database"></span>
    Media <small>Add or View Media  Files</small></h1>
    <hr>
    <ol class="breadcrumb">
  <li class=""><a href="index.php"><span class="fa fa-refresh"></span> Dashboard</a></li>
  <li class="active"> <span class="fa fa-database"></span>Media</li>
  
</ol>
  
  <?php
      if(isset($_POST['submit'])){
        if(count($_FILES['media'] ['name'])>0){
          for($i=0;$i<count($_FILES['media'] ['name']);$i++){
            $img=$_FILES['media'] ['name'][$i];
            $tmp_name=$_FILES['media'] ['tmp_name'][$i];
            $query="INSERT INTO `media`(`img`) VALUES ('$img')";
            if(mysqli_query($con,$query)){
              move_uploaded_file($tmp_name,"media/$img");
            }
            
          }
          
        }
      }
      ?>
  
 <form action="" method="post" enctype="multipart/form-data">
   <div class="row">
     <div class="col-sm-4 col-xs-8">
      <input type="FILE" name="media[]" required multiple>
       
     </div>
     <div class="col-sm-4 col-xs-4">
       <input type="submit" name="submit" class="btn btn-primary btn-sm" value="Add Media">
       
     </div>
   </div>
 </form>
 <hr>
 <div class="row">
  <?php
   $get_query="SELECT * FROM `media` ORDER BY id DESC";
   $get_run=mysqli_query($con,$get_query);
   if(mysqli_num_rows($get_run)>0){
     while($get_row=mysqli_fetch_array($get_run)){
       $get_img=$get_row['img'];
     

   ?>
   <div class="col-lg-2 col-md-3 col-xs-6 thumb ">
     <a href="media/<?php echo $get_img;?>" class="thumbnail">
       <img src="media/<?php echo $get_img;?>" width="100%" alt="">
     </a>
   </div>
   <?php
       }
        }
   else{
     echo"<center> <h3>No Media Available</h3></center>";
   }
   ?>
   
 </div>
  
    </div>
  </div>
</div>

<?php
  require_once("inc/footer.php");
  ?>







