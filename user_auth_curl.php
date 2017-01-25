<?php
function user_auth_curl() {
    if (function_exists("user_auth")) {
        return user_auth();
    }
    
    $ch = curl_init();
    
    $auth_url = "http://localhost/myskift/resources/library/wallkit/call_user_auth.php";
    
    curl_setopt_array($ch, array(
        CURLOPT_URL => $auth_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'GET'
    ));
 
    $response = (array)json_decode(curl_exec($ch));
/*
    
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $response["httpcode"] = $httpcode;
*/

    // close curl resource to free up system resources 
    curl_close($ch);
    
    return $response;
}
?>