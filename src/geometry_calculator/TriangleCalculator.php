<?php

namespace App\geometry_calculator;

use App\Service\TriangleCalculatorInterface;

class TriangleCalculator implements TriangleCalculatorInterface
{
    private string $type = 'triangle';
    private float $a;
    private float $b;
    private float $c;

    public function setEdges($a, $b, $c): TriangleCalculatorInterface
    {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;

        return $this;
    }

    protected function calcSurface(): float
    {
        $circumference = $this->calcCircumference() / 2;

        $surface = sqrt($circumference * ($circumference - $this->a) * ($circumference - $this->b) * ($circumference - $this->c));

        return round($surface, 2);
    }

    protected function calcCircumference(): float
    {
        return round($this->a + $this->b + $this->c, 2);
    }

    public function calculate(): array
    {
        return [
            'type' => $this->type,
            'a' => $this->a,
            'b' => $this->b,
            'c' => $this->c,
            'surface' => $this->calcSurface(),
            'circumference' => $this->calcCircumference()
        ];
    }
}
