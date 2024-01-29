<?php
abstract class OSkeysRand
{
    /**
     * Properties
     */
    protected $prefixKey = '';
    protected $defaultValParam = true;
    protected $maxKeys = 10;

    /**
     * Method to generate new OS keys
     * Return an array of a random lenght from 1 to 10 with the OS keys and the same default value assigned to each key;
     *
     * @return array
     */
     public function get_rand_os_keys(): array
    {
        $nbKeys = rand(1, $this->maxKeys);
        /** generate an array from 1 to 10 */
        $keys = array_map(function ($key) {
            return $this->prefixKey . $key;
        }, range(1, $nbKeys));
        $osKeys = array_fill_keys($keys, $this->defaultValParam);
        return $osKeys;
    }
}
