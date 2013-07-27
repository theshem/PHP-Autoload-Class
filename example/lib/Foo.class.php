<?php

/**
* Foo Class
*/
class Foo
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