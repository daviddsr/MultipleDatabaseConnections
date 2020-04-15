<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends AbstractController
{
    public function findAllProducts()
    {
        $activeEntityManager = $this->getDoctrine()->getManager('one');

        $products = $activeEntityManager
            ->getRepository(Product::class)
            ->setEntityManager($activeEntityManager)
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
