 <?php
       $target_dir = "dbbackups/";
    //    $target_dir = dirname(__FILE__) . dbbackups;
$target_file = $target_dir.rand(200,29999900000).basename($_FILES["fileToUpload"]["name"]);
// $target_file=encodeURI($target_file);
$send_target= chop($target_file,$target_dir);
//$send_target= str_replace($target_dir,rand(234,29999900000),$target_file);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 8000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "sql" ) {
    echo "Sorry, only SQL files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file)) {

        header("Location: dbbackups/import.php?filebd=".basename($send_target));
        // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your Back up file.";
        echo "<p>".$target_dir;
        echo "<p>".$target_file;
        echo "<p>".basename($send_target);
    }
}


// if (move_uploaded_file) {
//     echo $_FILES['uploadFile'];
// //    header("Location: dbbackups/import?filebd=".$_FILES['filebd']);
// }else {
//     echo 'file can not be copied for Import';
// }

?>