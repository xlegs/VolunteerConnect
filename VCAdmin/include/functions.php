 <?php
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
      ?>