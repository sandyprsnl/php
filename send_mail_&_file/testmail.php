
 <?php
 if (isset($_REQUEST["submit"])) {
 	$name=$_REQUEST["name"];
 	$email=$_REQUEST["email"];
 	$mobile=$_REQUEST["mobile"];
 	$msg=$_REQUEST["massage"];

 	$filename = $_REQUEST["resume"];

if(file_exists($filename)){

    //Get file type and set it as Content Type
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    header('Content-Type: ' . finfo_file($finfo, $filename));
    finfo_close($finfo);

    //Use Content-Disposition: attachment to specify the filename
    header('Content-Disposition: attachment; filename='.basename($filename));

    //No cache
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');

    //Define file size
    header('Content-Length: ' . filesize($filename));

    ob_clean();
    flush();
    readfile($filename);
    exit;
}
 	if(empty($name) || empty($email) || empty($mobile) || empty($msg)){
 		$error="<h1> All * Field are Required </h1>";
 	}
else{
$to = "testmailw45@gmail.com";
$subject = "HTML email";

$message = "Name :".$name. "<br>";
$message .= "Email :".$email. "<br>";
$message .= "Mobile :".$mobile. "<br>";
$message .= "Massage :".$msg. "<br>";
$message .= "resume :".$filename. "<br>";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <webmaster@example.com>' . "\r\n";
$headers .= 'Cc: myboss@example.com' . "\r\n";

mail($to,$subject,$message,$headers);
}
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2> <?php if(isset($error)){ echo $error;}?>Inline form with .sr-only class</h2>
  <p>Make the viewport larger than 768px wide to see that all of the form elements are inline, left aligned, and the labels are alongside.</p>
  <form class="form-inline" method="post" action="">
    <div class="form-group">
      <label class="sr-only" for="name">Name*:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter Name"  name="name">
    </div>
    <div class="form-group">
      <label class="sr-only" for="email">Email*:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email"  name="email">
    </div>
    <div class="form-group">
      <label class="sr-only" for="Mobile">Mobile*:</label>
      <input type="Mobile" class="form-control" id="Mobile" placeholder="Enter Mobile"  name="mobile">
    </div>
    <div class="form-group">
      <label class="sr-only" for="Resume">Upload Resume*:</label>
      <input type="file" accept=".docx" class="form-control" id="Resume" name="resume">
    </div>
    <div class="form-group">
      <label class="sr-only" for="Massage">Massage:</label>
      <textarea class="form-control" id="Massage" placeholder="Massage" name="massage"></textarea>
    </div>
    
    <div class="checkbox">
      <label><input type="checkbox" name="resu"> Remember me</label>
    </div>
    <input type="submit" name="submit" value="Submit" class="btn btn-default">
  </form>
</div>

</body>
</html>

