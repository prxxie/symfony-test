<?php

namespace App\Controller;

use App\Service\CircleCalculatorInterface;
use App\Service\TriangleCalculatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GeometryController extends AbstractController
{

    #[Route('/triangle/{a}/{b}/{c}', name: 'app_geometry_triangle')]
    public function calculateTriangle($a, $b, $c, TriangleCalculatorInterface $triangleCalculator): Response
    {
        $data = $triangleCalculator->setEdges($a, $b, $c)->calculate();

        return $this->json($data);
    }

    #[Route('/circle/{radius}', name: 'app_geometry_circle')]
    public function calculateCircle($radius, CircleCalculatorInterface $circleCalculator): Response
    {
        $data = $circleCalculator->setRadius($radius)->calculate();

        return $this->json($data);
    }

    // curl --location --request POST 'http://localhost:8000/sum' \
    // --header 'Content-Type: application/json' \
    // --data-raw '[
    //     {
    //         "type": "triangle",
    //         "a": 3,
    //         "b": 4,
    //         "c": 5,
    //         "surface": 6,
    //         "circumference": 12
    //     },
    //     {
    //         "type": "circle",
    //         "radius": 2,
    //         "surface": 12.57,
    //         "circumference": 12.57
    //     }
    // ]'
    #[Route('/sum', name: 'app_sum_geometry', methods: ["POST"])]
    public function sum(Request $request)
    {
        $arObject = json_decode($request->getContent());

        $sumSurface = 0;
        $sumCircumference = 0;

        foreach ($arObject as $obj) {
            $sumSurface += $obj->surface;
            $sumCircumference += $obj->circumference;
        }

        return $this->json([
            'sumSurface' => $sumSurface,
            'sumCircumference' => $sumCircumference,
        ]);
    }
}
