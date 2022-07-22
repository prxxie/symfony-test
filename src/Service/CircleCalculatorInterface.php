<?php

namespace App\Service;

interface CircleCalculatorInterface
{
    public function setRadius(float $radius): self;
    public function calculate(): array;
}
