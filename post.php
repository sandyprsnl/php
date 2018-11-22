<?php
require_once("inc/top.php");
?>

</head>
<body>
<?php require_once("inc/header.php");?>
 
  <?php 
   if(isset($_REQUEST["post_id"]))
   {
    $post_id =$_REQUEST["post_id"];
     
     $views_query="UPDATE `posts` SET `views` = views+1 WHERE `posts`.`id` = $post_id";
     mysqli_query($con,$views_query);
     
     $query="SELECT * FROM posts WHERE status='publish' and id= $post_id";
     $run=mysqli_query($con,$query);
     if(mysqli_num_rows($run)>0)
     {
       $row=mysqli_fetch_array($run);
       $id=$row['id']; 
            
            $date= getdate($row['date']);
            $day=$date['mday'];
              $month=$date['month'];
              $year=$date['year'];
            
            $title=$row['title'];
            
            $author=$row['author'];
            
            $auther_img=$row['auther_img'];
            
            $img=$row['img'];
          
            $category=$row['category'];
            
            
            
            $post_data=$row['post_data'];
     }
     else{
       header("location:index.php");
     }
   }
  ?>
<div class="jumbotron">
  <div class="container">
    <div id="detailes" class="animated fadeInLeft">
      <h1>Custom
      <span>Post</span>
      </h1>
      <p>Here you con put yuor own pst</p>
     
    </div>
  </div>
  <img src="la ca pics/apple-macbook-air.jpg" alt="top_image">
</div>

<section>
  
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <div class="post">
       <div class="row">
         <div class="col-md-2 post-date">
           <div class="day"><?php echo $day;?></div>
           <div class="month"><?php echo $month;?></div>
            
           <div class="year"><?php echo $year;?></div>
         </div>
         <div class="col-md-8 post-title">
          <a href="post.php?post_id=<?php echo $id; ?>"> <h2><?php echo $title;?></h2></a>
          <p>Written by: <span><?php echo $author; ?></span></p>
         </div>
         <div class="col-md-2 profile-pic">
           <img class="img-circle" src="<?php echo $auther_img; ?>" alt="profile-pic">
         </div>
       </div>
    <a href="<?php echo $img; ?>"><img src="<?php echo "$img"; ?>" alt=""></a> 
    <p class="desc">
      <?php echo $post_data; ?>
    </p>
    
    <div class="bottem">
      <span class="first" ><i class="	fa fa-folder-open-o"></i><a href="#"> <?php echo $category; ?></a></span>|
      
      <span class="second"><i class="fa fa-commenting-o"></i><a href="#"> Comment</a></span>
    </div>
     </div>
      <div class="related-posts">
      
       <h3>Related-posts</h3>
       <hr>
       
        <div class="row">
             <?php
          
          $r_query="SELECT * FROM posts WHERE status='publish' and title LIKE '%$title%' LIMIT 3";
          $r_run=mysqli_query($con,$r_query);
          while($r_row=mysqli_fetch_array( $r_run)){
            $r_id=$r_row['id'];
            $r_title=$r_row['title'];
            $r_img=$r_row['img'];
          
          ?>
         
          <div class="col-sm-4">
            <a href="post.php?post_id=<?php echo $r_id;?>">
              <img src="<?php echo $r_img;?>" alt="img11">
              <h4><?php echo $r_title;?></h4>
            </a>
          </div>
          
         <?php
            }
          ?>
        </div>
      </div>
<div class="author">
  <div class="row">
    <div class="col-sm-3">
      <img src="<?php echo "$auther_img";?>" alt="profile pic" class="img-circle">
    </div>
    <div class="col-sm-9">
      <h4><?php echo $author; ?></h4>
      <?php 
      $bio_query="SELECT * FROM users WHERE username='$author'";
      $bio_run= mysqli_query($con,$bio_query) ;
     
      if(mysqli_num_rows($bio_run)>0){
        $bio_row=mysqli_fetch_array($bio_run);
        $auther_details=$bio_row['details'];

      
      ?>
      <p><?php echo $auther_details; ?></p>
      <?php
      }
        ?>
    </div>
  </div>
</div>
    <?php
        $c_query="SELECT * FROM comments WHERE status='approve' and post_id=$post_id ORDER BY id DESC";
        $c_run=mysqli_query($con,$c_query);
        if(mysqli_num_rows($c_run)>0){
          
        
        ?>
    
     <div class="comment">
     <h3>Comments</h3>
     <?php
          while($c_row=mysqli_fetch_array($c_run))
          {
            $c_id=$c_row['id'];
            $c_name=ucfirst($c_row['name']);
            $c_username=$c_row['username'];
            $c_img=$c_row['img'];
            $c_comment=$c_row['comment'];
          
       ?>
     <hr>
      <div class="row single-comment">
       <div class="col-sm-2">
         <img src="<?php echo $c_img;?>" alt="profile pic" class="img-rounded">
       </div>
       <div class="col-sm-10">
         <h4><?php echo $c_name;?></h4>
         <p><?php echo $c_comment;?></p>
       </div>
     </div>
      <?php
      }  
        ?>
    </div>
     <?php
      }  
        
        if(isset($_REQUEST['submit'])){
          $cs_name=$_REQUEST['name'];
          $cs_email=$_REQUEST['email'];
          $cs_website=$_REQUEST['website'];
          $cs_comment=$_REQUEST['comment'];
          $cs_date=time();
          if(empty($cs_name) ||empty($cs_email) ||empty($cs_comment)){
            $error_msg="ALL (*) FIELD ARE REQUIORED";
          }
          else{
            $cs_query="INSERT INTO `comments` ( `date`, `name`, `username`, `post_id`, `email`, `website`, `img`, `comment`, `status`) VALUES ( '$cs_date', '$cs_name', 'user', '$post_id', '$cs_email', '$cs_website', 'la ca pics/team1.png', ' $cs_comment', 'pending')";
            if(mysqli_query($con,$cs_query)){
              $msg="comment submitted and waiting for approval";
              $cs_name="";
          $cs_email="";
          $cs_website="";
          $cs_comment="";
          
            }
            else{
              $error_msg="comment has not been submitted";
            }
          }
        }
        ?>
     <div class="comment-box">
       <div class="row">
         <div class="col-xs-12">
           <form action="" method="post">
             <div class="form-group">
               <label for="full name">
                 Full Name:*
               </label>
               <input type="text" value="<?php if(isset($cs_name)){
  echo $cs_name;
}
?>" id="full name" name="name" class="form-control"
               placeholder="Full Name" >
             </div>
             <div class="form-group">
               <label for="email">
                 Email:*
               </label>
               <input type="email" name="email" id="email" class="form-control"
               placeholder="email" value="<?php if(isset($cs_email)){
  echo $cs_email;
}
?>">
             </div>
             <div class="form-group">
               <label for="website">
                 Website:
               </label>
               <input type="text" name="website" id="website" class="form-control"
               placeholder="website URL" value="<?php if(isset($cs_website)){
  echo $cs_website;
}
?>">
             </div>
             <div class="form-group">
               <label for="comment">
                 Comments:
               </label>
               <textarea  name="comment" class="form-control" id="comment" cols="30" rows="10" placheholder="Your comments should bre here"><?php if(isset($cs_comment)){
  echo $cs_comment;
}
?></textarea>
             </div>
             
             <input type="submit" name="submit" class="btn btn-primary" value="Submit Comment">
             <?php
             
             
             if(isset($error_msg))
             {
               echo"<span style='color:red;' class='pull-right'><b>Error:<br><b>".$error_msg."<br></span>";
             }
             else if(isset($msg)){
                echo"<span style='color:green;' class='pull-right'>".$msg."<br></span>";
             }
             ?>
           </form>
           
         </div>
       </div>
     </div>
      </div>
      
       <div class="col-md-4">
        <?php
         require_once("inc/sidebar.php");?>
       </div>
    </div>
  </div>
</section>
<?php require_once("inc/footer.php")?>








<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>