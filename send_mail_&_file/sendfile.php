<?php
if(isset($_REQUEST["submit"])){
          $to = "bsandeep650@gmail.com";
            $subject = "Subject Of The Mail";
            $message = "Resume from Website";

            $headers = "From: From-Name<from@gmail.com>";
// boundary
            $semi_rand = md5(time());
            $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

// headers for attachment
            $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";

// multipart boundary
            $message = "This is a multi-part message in MIME format.\n\n" . "--{$mime_boundary}\n" . "Content-Type: text/html; charset=ISO-8859-1\"\n" . "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n";

                $message .= "--{$mime_boundary}\n";
                $filepath = 'uploads/'.$_FILES['resume']['name'];
                move_uploaded_file($_FILES['resume']['tmp_name'], $filepath); //upload the file
                $filename = $_FILES['resume']['name'];
                $file = fopen($filepath, "rb");
                $data = fread($file, filesize($filepath));
                fclose($file);
                $data = chunk_split(base64_encode($data));
                $message .= "Content-Type: {\"application/octet-stream\"};\n" . " name=\"$filename\"\n" .
                        "Content-Disposition: attachment;\n" . " filename=\"$filename\"\n" .
                        "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
                $message .= "--{$mime_boundary}\n";

mail($to, $subject, $message, $headers);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
  <input type="file" accept=".docx" class="form-control" id="Resume" name="resume">
   <input type="submit"  id="Resume" name="submit">
  </form>  
</body>
</html>