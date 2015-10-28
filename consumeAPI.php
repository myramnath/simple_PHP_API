<!DOCTYPE html>
<html>
<head>
    <title>Demo API usage</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<script type="text/javascript">
    var baseURL = ""; // URL of the API service
    var URLgetTime = "simpleAPI.php"; 
    var data = {'token':1, action: 'getCurrentTime', 'timezone': 'IST'};
    $(document).ready(function(){
        $.ajax({
            url: baseURL + URLgetTime, 
            data: data, 
            dataType: "jsonp" /* JSONP lets you handle cross-domain requests */,
            timeout: 10*1000, // 10 sec timeout
            jsonp : "callback", 
            jsonpCallback : "ret_callback",
            error: function(x, t, m) {
                alert('error accessing the API');
            }
        });
        $("#result").click(function(){
            $(this).hide();
        });
    });

function ret_callback(rtndata){
    console.log('Inside fn ret_callback() with rtndata:');
    console.log(rtndata);
    if(rtndata.error == 0){ // All is well!
        alert(rtndata.str);
        $("#html").html(rtndata.html);
        $("#time").html(rtndata.data.time);
    }else{
        checkForceLogout(rtndata);
        alert("Server busy. Please try after a while");
    }
    return;
}
</script>
<body>
<h1>Simple Demo usage of the API</h1>
<div id="html"></div>
<div id="time"></div>
</body>
</html>

