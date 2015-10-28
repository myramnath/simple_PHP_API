<?php
/*

global header for all files

*/
global $server_name, $db_username, $db_pwd, $db_name;
// DB connection details here

date_default_timezone_set('Asia/Calcutta'); // REQUIRED: set the current timezone 

// ******* get the current file's name - to perform something specific to files (i.e., APIs)
// global $curFileName;
// $currentFile = $_SERVER["PHP_SELF"];
// //die('$_SERVER["PHP_SELF"] : ' .$_SERVER["PHP_SELF"]);
// $parts = Explode('/', $currentFile);
// function chopExtension($filename){return substr($filename, 0, strrpos($filename, '.'));}
// $curFileName = strtolower(chopExtension($parts[count($parts) - 1]));
// //die($curFileName);


function get_current_time_string_in_IST(){
/** utility function to get the current timestamp in IST
 *    needed when the server is not in INDIA, and the customer is in India!
*/
    $t = new DateTime();
    //$t->setTimeZone(new DateTimeZone("Asia/Calcutta"));
    $t->setTimestamp( $time=time() );
    $var_t = $t->format('Y-m-d H:i:s' );
    return $var_t;
}

function printJSONandDIE($error, $str, $html, $data){
    // handy function to return JSON properly
    header("content-type: application/json"); // set headers to JSON
    $rtnjsonobj = new stdClass();   //instantiate an empty class
    // construct the object to be returned: $rtnjsonobj
    $rtnjsonobj->error = $error;
    $rtnjsonobj->str = $str;
    $rtnjsonobj->html = $html;
    $rtnjsonobj->data = $data;

    // return the json-encoded object. Wrap the callback function around it
    echo $_GET['callback']. '('. json_encode($rtnjsonobj) . ')';
    die();
}
?>