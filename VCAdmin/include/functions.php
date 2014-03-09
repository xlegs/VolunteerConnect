 <?php
      $CBSERVER = "sd13.scu.edu:8091";
      $CBUSER = "";
      $CBPASS = "";

      function convertToKey($eventName){
        $eventName = str_replace(" ", "_", $eventName);
        $eventName = strtolower($eventName);
        return $eventName;
      }

      function getOrganizationUsername($organizationName){
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
      ?>