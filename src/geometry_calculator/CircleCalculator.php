<?php

namespace App\geometry_calculator;

use App\Service\CircleCalculatorInterface;

class CircleCalculator implements CircleCalculatorInterface
{
    private string $type = 'circle';
    private float $radius;

    public function setRadius(float $radius): CircleCalculatorInterface
    {
        $this->radius = $radius;

        return $this;
    }

    protected function calcSurface(): float
    {
        return round($this->radius * $this->radius * pi(), 2);
    }

    protected function calcCircumference(): float
    {
        return round(2 * $this->radius * pi(), 2);
    }

    public function calculate(): array
    {
        return [
            'type' => $this->type,
            'radius' => $this->radius,
            'surface' => $this->calcSurface(),
            'circumference' => $this->calcCircumference(),
        ];
    }
}
