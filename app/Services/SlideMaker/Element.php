<?php

namespace App\Services\SlideMaker;

class Element
{

    protected $width;
    protected $height;
    protected $content;

    public function __construct($width, $height, $content = null)
    {
        $this->width = $width / 480;
        $this->height = $height / 540;
        $this->content;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function getHeight()
    {
        return $this->height;
    }
}