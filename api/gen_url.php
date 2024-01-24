<?php
require_once __DIR__ . '/../includes/autoloader.inc.php';
$os = $_POST['os'] ?? '';
$url = $_POST['url'] ?? '';

if(UrlGenController::url_validation($url) === false){
    exit('invalid url');
}

$urlGenContr = new UrlGenController($url);
try {
    // echo "<li>$os, $url => " .$urlGenContr->generate_url($os) ;
    echo $urlGenContr->generate_url($os);
} catch (\InvalidArgumentException $e) {
    echo $e->getMessage();
}
// $os = 'linux'; 

