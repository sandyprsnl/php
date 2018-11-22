<?php
require_once("inc/top.php");
?>
</head>
<body>
<?php require_once("inc/header.php");?>
<div class="jumbotron">
  <div class="container">
    <div id="detailes" class="animated fadeInLeft">
      <h1>Contact
      <span>Us</span>
      </h1>
      <p>We are available 24x7.<br>So feel free to Contact Us</p>
    </div>
  </div>
  <img src="la%20ca%20pics/apple-macbook-air.jpg" alt="top_image">
</div>

<section>
  
  <div class="container">
    <div class="row">
      <div class="col-md-8">
       <div class="row">
         <div class="col-md-12">
           <img src="la ca pics/map.PNG" alt="">
         </div>
         <div class="col-md-12 contact-form">
          <h2>Contact-form</h2>
          <hr>
           <form action="">
             <div class="form-group">
               <label for="full-name">Full-Name*:</label>
               <input type="text" id="full-name" class="form-control" placeholder="Full-Name">
             </div>
              <div class="form-group">
               <label for="email">Email*:</label>
               <input type="email" id="email" class="form-control" placeholder="email">
             </div>
             <div class="form-group">
               <label for="website">Website:</label>
               <input type="text" id="website" class="form-control" placeholder="website">
             </div>
              <div class="form-group">
               <label for="massage">Massage:</label>
               <textarea name="" id="massage" cols="30" rows="10" class="form-control" placeholder="Your massege should be here:"></textarea>
             </div>
             <input type="submit" name="submit" value="Submit" class="btn btn-primary">
           </form>
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