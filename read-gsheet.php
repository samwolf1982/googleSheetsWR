<?php
include_once __DIR__.'/vendor/autoload.php';
//$datetime = new DateTime('2015-06-22T10:40:25', new DateTimeZone('Europe/London'));

// I wonder how that SAME moment-in-time would
// be described in other places around the world.
//$datetime->setTimezone(new DateTimeZone('Europe/London'));
//date_default_timezone_set('Europe/Kiev');
//var_dump(date("Y-m-d h:i:s")); die();
$file_credentials=  __DIR__.'/files/credentials.json';

$client =new Google_Client();
$client->setApplicationName('G Sheet n php');
$client->setScopes([Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig($file_credentials);

$services= new Google_Service_Sheets($client);
$spreadSheetId="1aVgPmVJBaORfwm36pPaqhdGpMq3NIUBWz6kufJNY9TE";


$range="congress!D2:F";     // congress - название таблицы  D2:F8 - диапазон координаты
$range="congress!D2:F8";     // congress - название таблицы  D2:F8 - диапазон координаты

$response=$services->spreadsheets_values->get($spreadSheetId,$range);
$values=$response->getValues();

if(empty($values)){
    print_r('No data found');
}else{
    $mask="%10s %-10s %s\r\n";
    foreach ($values as $row) {
        echo  sprintf($mask,$row['2'],$row['1'],$row['0']);
    }
}


echo PHP_EOL."FIN".PHP_EOL;