<?php

namespace App\Services\SlideMaker;

class Canvas
{
    protected $width;
    protected $height;
    protected $slots = [];
    protected $elements = [];

    public function __construct($width, $height)
    {
        $this->width = $width / 480;
        $this->height = $height / 540;

        for ($i = 0; $i < $this->height; $i++) {
            $this->slots[$i] = [];
            for ($j = 0; $j < $this->width; $j++) {
                $this->slots[$i][$j] = new Slot($i, $j);
            }
        }
    }

    public function fitElement(Element $element)
    {
        foreach ($this->getEmptySlots() as $emptySlot) {
            $slots = $this->getLocalSlots();
            $cannotFit = false;
            for ($x = $emptySlot->getX(); $x < $emptySlot->getX() + $element->getHeight(); $x++) {
                for ($y = $emptySlot->getY(); $y < $emptySlot->getY() + $element->getWidth(); $y++) {
                    if (!isset($slots[$x][$y])) {
                        $cannotFit = true;
                        break;
                    }
                    if (!$slots[$x][$y]->isConsumed()) $slots[$x][$y]->setElement($element);
                    else $cannotFit = true;
                }

                if ($cannotFit) break;
            }

            if (!$cannotFit) {
                $this->slots = $slots;
                return true;
            }
        }

        return false;
    }

    public function slotsLeft()
    {
        $slotsLeft = 0;

        foreach ($this->slots as $row) {
            foreach ($row as $slot) {
                if (!$slot->isConsumed()) $slotsLeft++;
            }
        }

        return $slotsLeft;
    }

    public function hasEmptySlots()
    {
        return count($this->getEmptySlots()) > 0;
    }

    protected function getEmptySlots()
    {
        $emptySlots = [];

        for ($i = 0; $i < $this->height; $i++) // down
        {
            for ($j = 0; $j < $this->width; $j++) // across
            {
                if (!$this->slots[$i][$j]->isConsumed()) {
                    $emptySlots[] = clone $this->slots[$i][$j];
                }
            }
        }

        return $emptySlots;
    }

    private function getLocalSlots()
    {
        $slots = [];
        foreach ($this->slots as $index => $row) {
            $slots[$index] = [];
            foreach ($row as $slot) {
                $slots[$index][] = clone $slot;
            }
        }

        return $slots;
    }

}