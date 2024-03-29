<?php
require_once __DIR__ . '/../includes/autoloader.inc.php';
$os = $_POST['os'] ?? '';
$url = $_POST['url'] ?? '';

/** Url validation using the static method of UrlGenController */
if(UrlGenController::url_validation($url) === false){
    exit('invalid url');
}

/** Use the controler to generate the new url according to the os */
$urlGenContr = new UrlGenController($url);
try {
    echo $urlGenContr->generate_url($os);
} catch (\InvalidArgumentException $e) {
    echo $e->getMessage();
}
