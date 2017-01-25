<?php
function user_auth_curl() {
    if (function_exists("user_auth")) {
        return user_auth();
    }
    
    $ch = curl_init();
    
    $auth_url = "http://localhost/myskift/resources/library/wallkit/call_user_auth.php";
    
    
    $headers = array(
        "Content-type: application/x-www-form-urlencoded",
        "Accept: application/json"
    );
    
    $payload = "token=" . $_COOKIE['usr'];

    curl_setopt_array($ch, array(
        CURLOPT_URL => $auth_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_POSTFIELDS => $payload,
        CURLOPT_POST => true
    ));
 
    $response = curl_exec($ch);
    
    if (!empty($response) && $response !== "false") {
        $response = (array)json_decode($response);
    } else {
        $response = false;
    }
/*
    
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $response["httpcode"] = $httpcode;
*/

    // close curl resource to free up system resources 
    curl_close($ch);
    
    return $response;
}
?>