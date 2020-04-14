<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LuckyController extends AbstractController
{
    public function number(Request $request, EntityManagerInterface $em)
    {
        /*
        $activeEntityManager = $this->getDoctrine()->getManager('default');

        $products = $activeEntityManager
            ->getRepository(Product::class)
            ->setEntityManager($activeEntityManager)
            ->findAll();

        */


        $products = $this->getDoctrine()
            ->getRepository(Product::class, "one")
            ->findAll();

        $responseArray = [];

        /** @var Product $product */
        foreach ($products as $product) {
            $object = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'price' => $product->getPrice()
            ];

            $responseArray[]= $object;
        }

        return new JsonResponse($responseArray);
    }
}
