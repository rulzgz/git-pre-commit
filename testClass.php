<?php

class testClass
{
    private static $FOO = 2; // Unused
    private $i = 5; // Unused
    private $j = 6;
    public function addOne()
    {
        return $this->j++;
    }
}