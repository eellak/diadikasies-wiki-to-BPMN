<?php
/* Set locale to Greek*/
setlocale(LC_ALL, 'el_GR');

$target_dir = "../diagrams/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
echo "<script>alert(</script>$target_file<script>);</script>";
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    //$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
$check = true;
    if($check !== false) {
        echo "<h2>Το αρχείο απεστάλη - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
//if (file_exists($target_file)) {
//    echo "Sorry, file already exists.";
//    $uploadOk = 0;
//}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "bpmn" && $imageFileType != "svg" ) {
    echo "<h2>Sorry, only BPMN, SVG files are allowed.</h2>";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.</h2>";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

echo "<br><br><h2>Returning after 10 secs..</h2>";
header( "refresh:10;url=BPMNedit.php" );


?>