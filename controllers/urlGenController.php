<?php
require_once __DIR__ . '/../includes/autoloader.inc.php';
/**
 * URL generator class controller
 */
class UrlGenController {
    /**
     * properties
     */
    private $originalParams;
    private $originalUrl;

    /**
     * methods
     */

     /** constructor */
     public function __construct(string $originalfullURl) {
        if(empty($originalfullURl)) {
            throw new \InvalidArgumentException("Empty URL.");
        }
        /** extract url and params */
        $urlParts = parse_url($originalfullURl);

        if($urlParts === false) {
            throw new \InvalidArgumentException("Malformed URL.");
        }
        $this->originalUrl = $urlParts['scheme'] . '://' . $urlParts['host'] . $urlParts['path'];
        $this->originalParams = empty($urlParts['query']) ? '' : $urlParts['query'];
     }

     /** generate the new url according to the OS */
     public function generate_url(string $osName) : string {
            switch ($osName) {
                case 'windows':
                    $osObj = new WindowsOS();
                    break;
                case 'linux':
                    $osObj = new LinuxOS();
                    break;  
                default:
                    throw new \InvalidArgumentException("Invalid OS name.");
                    break;
            }

            $newParams = !empty($this->originalParams) ? $this->originalParams . $this->new_os_param($osObj) : $this->new_os_param($osObj);
            return $this->originalUrl . '?' . $newParams;
     }

     private function new_os_param(OS $obj) : string {
        $newKey = $obj->get_os_key();
        /** check if the key doesn't exist in the original url */
        if(strpos($this->originalParams, $newKey) === false) {
            /** if the key doesn't exist , return the new GET param with randomized value */ 
            return (!empty($this->originalParams) ? '&' : '') . $newKey . '=' . rand(100, 999);
        } else {
            /** return any params */
            return '';
        }
     }

     /** 
      * Static method to validate the url using preg_match function
      */
     public static function url_validation($url){
        if (preg_match('/^(http|https):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}'.'((:[0-9]{1,5})?\/.*)?$/i', $url)) {
            return true;
        } else {
            return false;
        }
     }
}