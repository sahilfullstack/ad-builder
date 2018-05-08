<?php

namespace App\Services\SlideMaker;

class Slot
{

    protected $x;
    protected $y;
    protected $element;

    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
        $this->element = null;
    }

    public function setElement(Element $element)
    {
        $this->element = $element;
    }

    public function getX()
    {
        return $this->x;
    }

    public function getY()
    {
        return $this->y;
    }

    public function getElement()
    {
        return $this->element;
    }

    public function isConsumed()
    {
        return ! is_null($this->element);
    }
}