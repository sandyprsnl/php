<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.php"><img src="la ca pics/w3newbie.png" alt="logo" width="120px"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php"><span class="fa fa-home "></span> Home</a></li>
       
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
          <span class="	fa fa-list-alt "></span>  
          Categories <span class="caret"></span></a>
          <ul class="dropdown-menu">
          
  <?php 
            $query= "SELECT * FROM `categories` ORDER BY id DESC";
            
            $run= mysqli_query($con,$query);
            
            if(mysqli_num_rows($run)>0)
            {
              while($row= mysqli_fetch_array($run))
              {
                $category=ucfirst($row['category']);
                $id=$row['id'];
                echo"<li><a href='index.php?cat=".$id." '>$category</a></li>";
                
              }
              }
            else{
              echo"<li><a href='#'>No Categories Yet</a></li>";
            }
            ?>
           
            
          </ul>
        </li>
        <li><a href="contactsus.php"><span class="glyphicon glyphicon-earphone"></span> Contacts Us</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="admin/loginpanel.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>