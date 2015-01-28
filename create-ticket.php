<?php

    require_once 'Config.php';
    require_once 'lib/Utility_Class.php';
    require_once 'lib/Display_Manager.php';
        
    $utilityClass = new Utility_Class();  // intializing the Utility_Class to provides basic functionality to this script
    $utilityClass->processArgs($argv);    
?>
