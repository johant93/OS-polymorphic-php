<?php

/**
 * Linux OS class
 */
class LinuxOS extends OSkeysRand implements OS
{
    /** Constructor */
    public function __construct() {
        $this->prefixKey = 'lin_';
    }
}
