<?php
/**
 * Windows OS class
 */
class WindowsOS implements OS {
    /**
     * Method to get the OS key name
     */
    public function get_os_key() : string {
        return "windows";
    }
}