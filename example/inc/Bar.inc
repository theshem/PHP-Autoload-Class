<?php

/**
* Bar Class
*/
class Bar
{
    private $_property;

    public function __construct($value = null)
    {
        $this->_property = $value;
    }

    public function getProperty()
    {
        return $this->_property;
    }
}