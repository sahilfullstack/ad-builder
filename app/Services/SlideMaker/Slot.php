<?php

namespace App\Services\SlideMaker;

class Slot
{

    protected $x;
    protected $y;
    protected $element;

    const WIDTH = 480;
    const HEIGHT = 540;

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

    public function getPositionTop()
    {
        return $this->x * self::HEIGHT;
    }

    public function getY()
    {
        return $this->y;
    }

    public function getPositionLeft()
    {
        return $this->y * self::WIDTH;
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