<?php

namespace App\Services\SlideMaker;

class Element
{
    protected $width;
    protected $height;
    protected $content;

    public function __construct($width, $height, $content = null)
    {
        $this->width = $width / Slot::WIDTH;
        $this->height = $height / Slot::HEIGHT;
        $this->content = $content;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function getPixelWidth()
    {
        return $this->width * Slot::WIDTH;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function getPixelHeight()
    {
        return $this->height * Slot::HEIGHT;
    }

    public function getContent()
    {
        return $this->content;
    }
}