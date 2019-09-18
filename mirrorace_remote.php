<?php
/*
@author gusmanu
@link github.com/gusmanu
@Mirrorace Remote Upload
*/

$api_key = "insertyourapi"; //your api key
$api_token = "insertyourtoken"; // yourapitoken
$url = "https://example.com/file.zip"; //url file

//step 1 get server remote url, cTacker and upload key
$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://mirrorace.com/api/v1/file/upload");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, [
        'api_key' => $api_key,
        'api_token' => $api_token
    ]);
    curl_setopt($ch, CURLOPT_HEADER, 0); 
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    $res = curl_exec($ch);
    $response = json_decode($res, true);
    curl_close($ch);
    $ch = null;

//step 2 upload file
    if($response[status] == "success"){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $response[result][server_remote]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, [
        'api_key' => $api_key,
        'api_token' => $api_token,
        'cTracker' => $response[result][cTracker],
        'upload_key' => $response[result][upload_key],
        'url' => $url,
        'mirrors[1]' => 13,  //you can edit this number with other mirrorace server number
        'mirrors[2]' => 63,
        'mirrors[3]' => 42,
        'mirrors[4]' => 72,
        'mirrors[5]' => 20
           
    ]);
    curl_setopt($ch, CURLOPT_HEADER, 0); 
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    $resp = curl_exec($ch);
    $response2 = json_decode($resp, true);
    print_r($response2);
    } else { print_r($response[status]); }
    
    
?>
