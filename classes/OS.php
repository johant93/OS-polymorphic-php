<?php
/**
 * OS interface
 */
interface OS
{
    /*
     * Method to generate new OS keys 
     */
    public function get_rand_os_keys(): array;
}
