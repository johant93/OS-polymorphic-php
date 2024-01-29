<?php

/**
 * OS interface
 */
interface OS
{
    /*
     * Method to get the OS key name
     */
    public function get_rand_os_keys(): array;
}
