<?php

namespace App\Service;

interface TriangleCalculatorInterface
{
    public function setEdges($a, $b, $c): self;
    public function calculate(): array;
}
