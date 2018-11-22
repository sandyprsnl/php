    <?php
    require_once("inc/top.php");
    ?>
    </head>
    <body>
    <?php require_once("inc/header.php");
  
  $no_of_posts=3;
  if($_GET['page'])
  {
    $page_id=$_GET['page'];
  }
  else{
    $page_id=1;
  }
  if(isset($_GET['cat']))
  {
    $cat_id=$_GET['cat'];
    $cat_query="SELECT * FROM categories WHERE id=$cat_id";
    $cat_run=mysqli_query($con,$cat_query);
    $cat_row=mysqli_fetch_array($cat_run);
    $cat_name=$cat_row['category'];
  }
  
 if(isset($_REQUEST["search"]))
 {
   $search=$_REQUEST['search-title'];
               $all_posts_query="SELECT * FROM posts WHERE status='publish'";
         
                $all_posts_query.="and tags LIKE'%$search%'";
              
            
            $all_posts_run=mysqli_query($con,$all_posts_query);
            $all_posts=mysqli_num_rows($all_posts_run);
            $total_pages= ceil ( $all_posts/$no_of_posts);
            $post_start_from=($page_id-1)*$no_of_posts;
   
 }
      else{
         $all_posts_query="SELECT * FROM posts WHERE status='publish'";
         if(isset($cat_name))
              {
                $all_posts_query."and category='$cat_name'";
              }
            $all_posts_query.= "ORDER BY id DESC LIMIT $no_of_posts";
            $all_posts_run=mysqli_query($con,$all_posts_query);
            $all_posts=mysqli_num_rows($all_posts_run);
            $total_pages= ceil ( $all_posts/$no_of_posts);
            $post_start_from=($page_id-1)*$no_of_posts;
      }
      
  ?>
<div class="jumbotron">
  <div class="container">
    <div id="detailes" class="animated fadeInLeft">
      <h1>Newbie
      <span>Blog</span>
      </h1>
      <p>best website for devolopers</p>
    </div>
  </div>
  <img src="la ca pics/bg.gif" alt="top_image">
</div>

<section>
  
  <div class="container">
    <div class="row">
      <div class="col-md-8">
       <?php 
        $slider_query= "SELECT * FROM `posts` WHERE status ='publish' ORDER BY id DESC LIMIT $no_of_posts";
        
         $slider_run =mysqli_query($con,$slider_query);
        if(mysqli_num_rows($slider_run)>0)
        {
          $count=mysqli_num_rows($slider_run);
        
        ?>
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
   <?php
          for($i=0;$i<$count;$i++)
          {
            if($i==0)
            {
              echo"<li data-target='#myCarousel' data-slide-to='".$i."' class='active'></li>";
            }
            else
            {
              echo"<li data-target='#myCarousel' data-slide-to='".$i."'></li>";
            }
          }
          ?>
  
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
   <?php
          $check=0;
          while($slider_row= mysqli_fetch_array($slider_run))
          {
            $slider_id=$slider_row['id'];
            
            $slider_img=$slider_row['img'];
            
            $slider_title=$slider_row['title'];
            
            $slider_author=$slider_row['author'];
            
            $check=$check+1;
            if($check==1) {  
                            echo"<div class='item active'>";
              
          }
            else
            {
             echo"<div class='item'>"; 
            }
         
    ?>
    
      <a href="post.php?post_id=<?php echo$slider_id; ?>"><img src="<?php echo$slider_img; ?>" alt="slide 1"></a>
      <div class="carousel-caption">
        <h3><?php echo$slider_author; ?></h3>
        <p><?php echo$slider_title; ?></p>
      </div>
    </div>
 
    <?php
             }
          ?>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<?php
        }
  if(isset($_REQUEST['search']))
  {
    $search=$_REQUEST['search-title'];
    $query="SELECT * FROM `posts` WHERE status ='publish'";
       
          $query.="and tags LIKE '%$search%'";
       
        $query.= "ORDER BY id DESC LIMIT $post_start_from ,$no_of_posts";
    
  }
        else
        {
           $query="SELECT * FROM `posts` WHERE status ='publish'";
        if(isset($cat_name))
        {
          $query.="and category='$cat_name'";
        }
        $query.="ORDER BY id DESC LIMIT $post_start_from ,$no_of_posts";
        }
         $run= mysqli_query($con,$query);
        
        if(mysqli_num_rows($run)>0)
        {
          while( $row= mysqli_fetch_array($run))
          {
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
            
            $tags=$row['tags'];
            
            $post_data=$row['post_data'];
            
            $views=$row['views'];
            
            $status=$row['status'];
            
          
       
?>
     <div class="post">
       <div class="row">
         <div class="col-md-2 post-date">
           <div class="day"><?php echo $day;?></div>
           <div class="month"><?php echo $month;?></div>
           <div class="year"><?php echo $year;?></div>
         </div>
         <div class="col-md-8 post-title">
          <a href="post.php?post_id=<?php echo $id;?>"> <h2>
          <?php echo$title;?></h2></a>
          
          <p>Written by: <span><?php echo ucfirst($author) ;?></span></p>
         </div>
         <div class="col-md-2 profile-pic">
           <img class="img-circle" src="<?php echo $auther_img;?>" alt="profile-pic">
         </div>
       </div>
    <a href="post.php?post_id=<?php echo $id;?>"><img src="<?php echo $img;?>" alt=""></a> 
    <p class="desc">
      <?php echo substr($post_data,0,300 )."........";?>
    </p>
    <a href="post.php?post_id=<?php echo $id;?>" class="btn btn-primary">Read more...</a>
    <div class="bottem">
      <span class="first" ><i class="	fa fa-folder-open-o"></i>
      <a href="index.php?cat=<?php echo $id;?>"> 
      
      <?php echo ucfirst($category);?></a></span>|
      
      <span class="second"><i class="fa fa-commenting-o"></i><a href="#"> Comment</a></span>
    </div>
     </div>
     <?php
            }
        }
         else
        {
          echo"<center><h2>No Posts Available <?h2></center>";
        }
        ?>
     
     <center>
     <nav aria-label="Page navigation  ">
  <ul class="pagination justify-content-center">
   <?php
    for($i=1;$i<=$total_pages;$i++)
      
      echo"<li class='".($page_id == $i ? 'active' : '')."'>
                         
                         
                         <a class='page-link ' href='index.php?page=".$i."&".(isset($cat_name)?"cat=$cat_id":"")."'>$i</a></li>";
    ?>
 
  </ul>
</nav>
     </center>
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