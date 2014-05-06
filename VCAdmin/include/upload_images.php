<?php 
if(!checkImage("profileimage")){
  if (isset($_POST["clear_profile"])) {
    $encodedImage = base64_encode(file_get_contents("profile.gif", FILE_USE_INCLUDE_PATH));
    echo "Profile Image reset. </br>";
    unset($newEntry["clear_profile"]);
  } else {
    $encodedImage = $r["profileimage"];
    echo "Profile Image ignored. </br>";
  }
  

}else{
  $encodedImage = base64_encode(file_get_contents($_FILES["profileimage"]["tmp_name"]));
  echo '<img src="data:image/jpg;base64,'.$encodedImage.'" />';
}
$newEntry["profileimage"] = $encodedImage;

if(!checkImage("coverimage")){
  if (isset($_POST["clear_cover"])) {
    $encodedImage = base64_encode(file_get_contents("cover.gif", FILE_USE_INCLUDE_PATH));
    echo "Cover Image reset. </br>";
    unset($newEntry["clear_cover"]);
  } else {
    $encodedImage = $r["coverimage"];
    echo "Cover Image ignored. </br>";
  }

}else{
  $encodedImage = base64_encode(file_get_contents($_FILES["coverimage"]["tmp_name"]));
  echo '<img src="data:image/jpg;base64,'.$encodedImage.'" />';
}

$newEntry["coverimage"] = $encodedImage;
?>