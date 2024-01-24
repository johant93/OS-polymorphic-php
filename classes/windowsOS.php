<?php
/**
 * Windows OS class
 */
class WindowsOS implements OS {
    
    /**
     * Method to get the OS key name
     *
     * @return string
     */
    public function get_os_key() : string {
        return "win";
    }
}