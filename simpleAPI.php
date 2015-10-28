<?php
/*

This is a simple PHP API that returns data in JSON

*/

// INCLUDE files (if required) ...
require_once("./include/global.php");
require_once("./include/functions.php");

// declare global variables 
//global $hostedAddress; // the current hosted URL - full path to the working website's root


$error = 0;

// START ------------- FETCH THE VARIABLES SENT IN THE REQUEST ----------------------

//echo "<pre>".print_r($_REQUEST,true)."</pre>";
// extract the "token" from the data
if(isset($_REQUEST['token']) && trim($_REQUEST['token'])!="")
    $token = $_REQUEST['token'];
    // TODO: check if token is correct ?? (if required)
else{
    $error = 1001; // always return suitable errors
    printJSONandDIE($error, "TOKEN not set", "", array());
}

if(isset($_REQUEST['action']) && trim($_REQUEST['action'])!=""){
    $action = $_REQUEST['action'];
    if(!in_array($action, array('getCurrentTime', 'action2', /* other actions ... */))){
        $error = 1002;
        printJSONandDIE($error, "Unknown action...", "", array());        
    }

    if($action=='getCurrentTime'){
        // check for the REQUEST variables, for other "getCurrentTime" types
        if(isset($_REQUEST['timezone']) && trim($_REQUEST['timezone'])!=""){
            $timezone = $_REQUEST['timezone'];
        }else{
            $error = 1003;
            printJSONandDIE($error, "timezone not set", "", array());
        }
    }
    /* 
        SIMILARLY, check for the REQUEST variables, for other "action" types ...
    elseif($action=='searchPeople'){
        ...
    }
    */
}else{ // no "action" is set. die gracefully...
    $error = 1006;
    printJSONandDIE($error, "Action not set", "", array());
}
// END ------------- FETCH THE VARIABLES SENT IN THE REQUEST ----------------------

switch ($action) { // do something based on user's action
    case 'getCurrentTime':
        list($error, $html, $str, $arrData) = getServerTime($timezone);
        //print_r(checkLogin($login, $pwd)); // DEBUG
        $data = $arrData;
        break;
}
// return the data - end of API call
printJSONandDIE($error, $str, $html, $data);
die();



// START ------------- functions used in this API ----------------------
function getServerTime($timezone){
    // do something
    // right now something Simple

    // Defaults - All is well!
    $error = 0; $html = ""; $str = "";

    switch (strtolower($timezone)){ // convert to lower case
        case 'ist':
            $time = get_current_time_string_in_IST();
            $data = array('time'=>$time,);
            $html = "Server time in <strong>$timezone</strong>";$str="Current server time is $time";
            break;
        default:
            $error = 1007; // unknown timezone
            printJSONandDIE($error, "unknown timezone", "", array()); // die on error.
            break;
    }
    return array($error, $html, $str, $data);
}
?>