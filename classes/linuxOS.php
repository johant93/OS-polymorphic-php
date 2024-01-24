<?php
/**
 * Linux OS class
 */
class LinuxOS implements OS {
    /**
     * Method to get the OS key name
     */
    public function get_os_key() : string {
        return "linux";
    }
}