<?php
include_once __DIR__.'/vendor/autoload.php';

$file_credentials=  __DIR__.'/files/upload/account2.json';

$client = new Google_Client();
$client->setAuthConfig($file_credentials);
$client->setScopes(array('https://www.googleapis.com/auth/drive','https://www.googleapis.com/auth/drive.file'));
$client->setRedirectUri('urn:ietf:wg:oauth:2.0:oob');

$service = new Google_Service_Drive($client);
$fileMetadata = new Google_Service_Drive_DriveFile(array(
    'name' => 'petsName',
    'parents' => array('1VA6T_D7YLXs2NB23lTQdW3Twib89-wLE'),
   'mimeType' => 'application/vnd.google-apps.folder'
));

$folder = $service->files->create($fileMetadata, array(
    'fields' => 'id'));
printf("Directory ID: %s\n", $folder->id); // Your file id

echo PHP_EOL."FIN Directory".PHP_EOL;

foreach (range(1,10) as $item) {
    // create file
    $service = new Google_Service_Drive($client);
    $fileMetadata = new Google_Service_Drive_DriveFile(array(
        'name' => 'spanchbob-color2.jpg',
        //  'parents' => array('1VA6T_D7YLXs2NB23lTQdW3Twib89-wLE')
        'parents' => array($folder->id)
    ));
    $content = file_get_contents("files/upload/spanchbob-color.jpg");
    $file = $service->files->create($fileMetadata, array(
        'data' => $content,
        //  'mimeType' => 'image/jpeg',
        'uploadType' => 'multipart',
        'fields' => 'id'));
    printf("File ID: %s\n", $file->id); // Your file id
}




echo PHP_EOL."FIN".PHP_EOL;

