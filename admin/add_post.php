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
      
      <h1><span class="fa fa-plus-square"></span>
   Add Post<small> Add new post</small></h1>
    <hr>
    <ol class="breadcrumb">
  <li > <a href="index.php">Dashboard</a></li>
  <li class="active"><span class="fa fa-plus-square"></span> Add Post</li>
  
</ol>
  <div class="row">
    <div class="col-xs-12">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="title">Title:*</label>
          <input type="text" id="title" name="title" placeholder="Type Post Title Here" class="form-control">
        </div>
        <div class="form-group">
         <a href="media.php" class="btn btn-primary">Add Media</a>
        </div>
        <div class="form-group">
          
          <textarea name="Post-data" id="textarea" class="form-control"  rows="10"></textarea>
        </div>
        <div class="row">
          <div class="col-sm-6">
           <div class="form-group">
          <label for="file">Post Image:*</label>
          <input type="file" id="file" name="image"  >
        </div>
          </div>
          <div class="col-sm-6">
             <div class="form-group">
          <label for="categories">Categories:*</label>
          <select class="form-control" name="categories" id="categories">
            <?php
        $cat_queruy="SELECT * FROM categories ORDER BY id DESC";
      $cat_run=mysqli_query($con,$cat_queruy);
      if(mysqli_num_rows($cat_run)>0){
        while($cat_row=mysqli_fetch_array($cat_run)){
          $cat_name=ucfirst($cat_row['category']);
          echo"<option value='".$cat_name."'><h6>$cat_name</h6></option> ";
        }
      }
      else{
        echo"<center><h6>NO Categories Available</h6></center>";
      }
        ?>
        
          </select>
        </div>
            
          </div>
        </div>
         <div class="row">
          <div class="col-sm-6">
           <div class="form-group">
          <label for="tags">Tags:*</label>
          <input type="text" id="tags" name="tags" placeholder="Your tags here" class="form-control" >
        </div>
          </div>
          <div class="col-sm-6">
             <div class="form-group">
          <label for="status">Status:*</label>
          <select class="form-control" name="status" id="status">
            <option value="publish"> Publish</option>
            <option value="draft"> Draft</option>
          </select>
        </div>
            
          </div>
          <input type="submit" class="btn btn-primary" value="Add Post" name="submit">
        </div>
      </form>
    </div>
  </div>
    </div>
  </div>
</div>

<?php
  require_once("inc/footer.php");
  ?>







