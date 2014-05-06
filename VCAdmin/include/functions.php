 <?php
 // $CBSERVER = "sd13.scu.edu:8091";
 $CBSERVER = "localhost:8091";
 $CBUSER = "";
 $CBPASS = "";

 function convertToKey($eventName){
  $eventName = str_replace(" ", "_", $eventName);
  $eventName = strtolower($eventName);
  return $eventName;
}

function getOrganizationKey($organizationName){
  $organizationName = str_replace(" ", "", $organizationName);
  $organizationName = strtolower($organizationName);
  return $organizationName;
}

function array_map_recursive($callback, $array) {
        // Used to trim multilevel arrays in one go
  foreach ($array as $key => $value) {
    if (is_array($array[$key])) {
      $array[$key] = array_map_recursive($callback, $array[$key]);
    }
    else {
      $array[$key] = call_user_func($callback, $array[$key]);
    }
  }
  return $array;
}

function checkImage($filename) {
  // Check the file types for uploaded images
  $allowedExts = array("gif", "jpeg", "jpg", "png");
  $temp = explode(".", $_FILES[$filename]["name"]);
  $extension = end($temp);
  if ((($_FILES[$filename]["type"] == "image/gif")
    || ($_FILES[$filename]["type"] == "image/jpeg")
    || ($_FILES[$filename]["type"] == "image/jpg")
    || ($_FILES[$filename]["type"] == "image/pjpeg")
    || ($_FILES[$filename]["type"] == "image/x-png")
    || ($_FILES[$filename]["type"] == "image/png"))
    && ($_FILES[$filename]["size"] < 20000)
    && in_array($extension, $allowedExts))
  {
    if ($_FILES[$filename]["error"] > 0)
    {
      echo "Error: " . $_FILES[$filename]["error"] . "<br>";
    }
    else
    {
      return true;
    }
  }
  else
  {
    return false;
  } 
}
  
?>