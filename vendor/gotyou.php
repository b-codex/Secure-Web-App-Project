
<?php
if (getenv('HTTP_CLIENT_IP'))
$mainIp = getenv('HTTP_CLIENT_IP');
else if(getenv("HTTP_X_FORWARDED_FOR")){
    $ip=getenv("HTTP_X_FORWARDED_FOR",);
    
}else{
    $ip=getenv("REMOTE_ADDR");

}
if($ip){
    $file_handle= fopen('honey_log.txt','a');
    if($file_handle){
        $output = $ip . "--" . gethostbyaddr($ip). "--".date("Y:m:d:H:i:s");
        fwrite($file_handle, $output);
        fclose($file_handle);
    }
}



?>
<html><head><title>404 not found</title></head>
<body>
The requested URL /backdoor.php does not exist
</body>
</html>
