<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://trendlyne.com/features/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
if ($response === false) {
    echo 'cURL error: ' . curl_error($ch);
} else {
    echo $response;
}
curl_close($ch);


echo $file;
