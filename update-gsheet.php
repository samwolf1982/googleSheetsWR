<?php
include_once __DIR__.'/vendor/autoload.php';

$file_credentials=  __DIR__.'/files/credentials.json';

$client =new Google_Client();
$client->setApplicationName('G Sheet n php');
$client->setScopes([Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig($file_credentials);

$services= new Google_Service_Sheets($client);
$spreadSheetId="1aVgPmVJBaORfwm36pPaqhdGpMq3NIUBWz6kufJNY9TE";


$range="congress!E2:F2";     // congress - название таблицы  D2:F8 - диапазон координаты
$values=[
  ['Sam', 'Biryukow']
];

$body=new Google_Service_Sheets_ValueRange(['values'=>$values]);

$params=['valueInputOption'=>'RAW'];

$result=$services->spreadsheets_values->update($spreadSheetId,$range,$body,$params);

var_dump($result);

echo PHP_EOL."FIN".PHP_EOL;