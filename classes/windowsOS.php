<?php
/**
 * Windows OS class
 */
class WindowsOS extends OSkeysRand implements OS {
    
    /** Constructor */
    public function __construct() {
        $this->prefixKey = 'win_';
    }
}