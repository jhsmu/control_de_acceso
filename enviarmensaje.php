<?php

$authorizationToken = "52f97fa25373410494e1826376f257bf";
$fromNumber = "447520651269";
$toNumbers = ["573007405540"];
$messageBody = "hola como estas";

$url = "https://sms.api.sinch.com/xms/v1/22c486ef0a1540769d7de50d52dec44f/batches";

$data = [
    "from" => $fromNumber,
    "to" => $toNumbers,
    "body" => $messageBody
];

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer " . $authorizationToken,
    "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
echo "responde: ->".$response."<br><br><br>";
if ($response === false) {
    echo "Error: " . curl_error($ch);
} else {
    echo "Response: " . $response;
}

curl_close($ch);

?>
