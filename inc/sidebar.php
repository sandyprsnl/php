 <div class="widgets">
         <form action="index.php" method="post" >
          <div class="input-group">
          
            
          
      <input type="text" name="search-title" class="form-control" placeholder="Search for...">
      <span class="input-group-btn">
        <input type="submit" value="GO!" class="btn btn-default" name="search">
      </span>
    </div><!-- /input-group -->
        </form>
         </div><!--widgets close -->
         <div class="widgets">
           <div class="popular">
           
            
             <h4>Popular Posts</h4>
             <hr>
              <?php
             $p_query="SELECT * FROM posts WHERE status='publish' ORDER BY views DESC  LIMIT 5";
             $p_run=mysqli_query($con,$p_query);
             
             if(mysqli_num_rows($p_run)>0)
             {
               while($p_row=mysqli_fetch_array($p_run))
               {
                 $p_id=$p_row['id'];
                  $p_date=getdate($p_row['date']);
                 $p_day=$p_date['mday'];
                   $p_year=$p_date['year'];
                   $p_month=$p_date['month'];
                 $p_title=$p_row['title'];
                 $p_img=$p_row['img'];
                 
              
               
             ?>
             <div class="row">
              
               <div class="col-xs-4">
                
             <a href="post.php?post_id=<?php echo $p_id;  ?>">    <img src="<?php echo $p_img;  ?>" alt=""></a>
               </div>
               <div class="col-xs-8  detailes">
                 <a href="post.php?post_id=<?php echo $p_id;  ?>">      <h5><?php echo $p_title;  ?></h5></a>
                 <p><i class="fa fa-clock-o"></i> <?php echo "$p_day $p_month $p_year";  ?></p>
               </div>
               
             </div>
             <?php
                  }
             }
             else
               echo"<h3>NO Posts Available</h3>"
             ?>
             
           </div>
         </div>
           
         <div class="widgets">
           <div class="popular">
           
            
             <h4>Recent Posts</h4>
             <hr>
             <?php
             $p_query="SELECT * FROM posts WHERE status='publish' ORDER BY id DESC  LIMIT 5";
             $p_run=mysqli_query($con,$p_query);
             
             if(mysqli_num_rows($p_run)>0)
             {
               while($p_row=mysqli_fetch_array($p_run))
               {
                 $p_id=$p_row['id'];
                 $p_date=getdate($p_row['date']);
                 $p_day=$p_date['mday'];
                   $p_year=$p_date['year'];
                   $p_month=$p_date['month'];
                 $p_title=$p_row['title'];
                 $p_img=$p_row['img'];
                 
              
               
             ?>
             <div class="row">
              
               <div class="col-xs-4">
                
             <a href="post.php?post_id=<?php echo $p_id;?>">    <img src="<?php echo $p_img;  ?>" alt=""></a>
               </div>
               <div class="col-xs-8  detailes">
                 <a href="post.php?post_id=<?php echo $p_id;?>">      <h5><?php echo $p_title;  ?></h5></a>
                 <p><i class="fa fa-clock-o"></i> <?php echo "$p_day $p_month $p_year";  ?></p>
               </div>
               
             </div>
             <?php
                  }
             }
             else
               echo"<h3>NO Posts Available</h3>"
             ?>
            
           </div>
         </div>
          <div class="widgets">
           <div class="popular">
           
            
             <h4>Category</h4>
             <hr>
                <div class="row">
            <div class="col-xs-6">
              <ul>
                <?php
               $c_query="SELECT * FROM categories";
             $c_run=mysqli_query($con,$c_query);
             if(mysqli_num_rows($c_run)>0)
             {$count=2;
               while($c_row=mysqli_fetch_array($c_run))
             {
               $c_id=$c_row['id'];
               $c_category=ucfirst($c_row['category']);
                 $count=$count+1;
                 if(($count%2)==1)
                 {echo" <li><a href='index.php?cat=".$c_id."'>$c_category</a></li>";}
               
               
             }
               
             }
             else{
               echo"<p>No Categories</p>";
             }
               ?>
              </ul>
            </div>
            <div class="col-xs-6">
              <ul>
                <?php
               $c_query="SELECT * FROM categories";
             $c_run=mysqli_query($con,$c_query);
             if(mysqli_num_rows($c_run)>0)
             {$count=2;
               while($c_row=mysqli_fetch_array($c_run))
             {
               $c_id=$c_row['id'];
               $c_category=ucfirst($c_row['category']);
                 $count=$count+1;
                 if(($count%2)==0)
                 {echo" <li><a href='index.php?cat=".$c_id."'>$c_category</a></li>";}
               
               
             }
               
             }
             else{
               echo"<p>No Categories</p>";
             }
               ?>
              </ul>
            </div>
          </div>
           </div>
         </div>
         
         <div class="widgets">
           <div class="categories">
           
            
             <h4>Social Icons</h4>
             <hr>
              <div class="row">
                <div class="col-xs-4">
                  <a href="https//:www.facebook.com"><img src="la ca pics/fb.png" alt="Facebook"></a>
                </div>
                <div class="col-xs-4">
                   <a href="https//:www.twitter.com"><img src="la ca pics/twitter.png" alt="twitter"></a>
                </div>
                <div class="col-xs-4">
                   <a href="https//:www.google.com"><img src="la%20ca%20pics/google.png" alt="google"></a>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-4">
                  <a href="https//:www.linkedin.com"><img src="la ca pics/linkeden.png" alt="linkedin"></a>
                </div>
                <div class="col-xs-4">
                   <a href="https//:www.Instagram.com"><img src="la ca pics/insta.jpg" alt="Instagram"></a>
                </div>
                <div class="col-xs-4">
                   <a href="https//:www.whatsapp.com"><img src="la%20ca%20pics/whatsapp.png" alt="Whatsapp"></a>
                </div>
              </div>
           </div>
         </div>