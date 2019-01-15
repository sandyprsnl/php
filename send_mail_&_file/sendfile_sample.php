<?php

if (isset($_FILES) && (bool) $_FILES) {
    # code...
 
    $allowext=array("pdf","doc","docx","gif","txt" );

    $files=array();
    foreach ($_FILES as $name => $file) {
       $file_name=$file["name"];
       $temp_name=$file["tmp_name"];
       $file_type=$file["type"];
       $path_parts=pathinfo($file_name);
       $ext=$path_parts["extension"];

    if(!in_array($ext,$allowext )) {
        die("files not allowext");
    }  
    array_push($files, $file);
    }

    $to="testmailw45@gmail.com";
    $from="testmailw45@gmail.com";
    $subject="hallo";
    $message="hllo";
    $header="From : ".$from;


    $semi_rend=md5(time());
    $mime_boundry="==Multipart_Boundary_x{$semi_rend}x";

    $header.="\nMIME-Version: 1.0\n"."Content-Type:Multipart/mixed;\n"."boundary=\"{$mime_boundry}\"";
    $message= "this is a multipart msg in mime formet .\n\n"."--{$mime_boundry}\n"."Content-Type:text/plain; charset=\"iso-8859-1\"\n"."Content-Transfer-Encoding:7bit\n\n".$message."\n\n";
    $message.="---{$mime_boundry}\n";

    for ($x=0; $x <count($files) ; $x++) { 

        $file=fopen($files[$x]["tmp_name"], "rb");
        $data=fread($files, filesize($files[$x]["tmp_name"]));
        fclose($file);
        $data=chunk_split(base64_encode($data));
        $name=$files[$x]["name"];
        $message.="Content-Type{\"application/octet-stream\"};\n"."name=\"$name\"\n"."Content-Disposition: attachment;\n"."filename=\"$name\"\n"."Content-Transfer-Encoding:bsae64\n\n".$data."\n\n";
        $message.="--{$mime_boundry}\n";

        # code...
    }
$ok= mail($to, $subject, $message,$header);
if ($ok) {
    echo "great";
}
else
{
    echo "nott";
}
}
















?>