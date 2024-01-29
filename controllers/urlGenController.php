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

     /**
      * Class constructor
      *
      * @param string $originalfullURl
      * @return void
      */
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
        $this->originalParams = $urlParts['query'] ?? '';
     }

     /**
      * generate the new url according to the OS
      *
      * @param string $osName
      * @return string
      */
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

            $newParams = !empty($this->originalParams) ? $this->originalParams . $this->new_os_params($osObj) : $this->new_os_params($osObj);
            return $this->originalUrl . '?' . $newParams;
     }
     
     /**
      * generation of a new GET parameter with the corresponding OS key and with a random value
      *
      * @param OS $obj (interface)
      * @return string
      */
     private function new_os_params(OS $obj) : string {
        /** get the new OS keys */
        $newKeys = $obj->get_rand_os_keys();
        
        $paramsArr = [];
        /** parse the original url query to array */
        if(!empty($this->originalParams)){
            /** transform the query url to array */
            parse_str($this->originalParams, $paramsArr);
        } 

        /** Filter the OS keys that already exist in the original url. */
        $newKeys = array_diff_key($newKeys, $paramsArr);

        /** fill the value randomaly for each new key */
        if(!empty($newKeys)){

            $newKeys = array_map(function($val) {
                return  rand(100, 999);
            }, $newKeys);

            return (!empty($this->originalParams) ? '&' : '') . http_build_query($newKeys);
        } else {
            return '';
        }
     }

   
     /**
      * Static method to validate the url using preg_match function
      *
      * @param mixed $url
      * @return bool
      */
     public static function url_validation($url){
        if (preg_match('/^(http|https):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}'.'((:[0-9]{1,5})?\/.*)?$/i', $url)) {
            return true;
        } else {
            return false;
        }
     }
}