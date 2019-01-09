<?php

namespace App\Controller\Rest;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Product;
use App\Repository\ProductRepository;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Controller\Rest\BaseRestController;

class ProductController extends BaseRestController
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(
        ProductRepository $productRepository
    ) {
        parent::__construct($productRepository, 'App\Entity\Product', 'App\Form\ProductFormType');
    }

    /**
     * Retrieves a Product resource
     * @Rest\Get("/products/{productId}")
     */
    public function getObject(int $productId): Response
    {
        return parent::getObject($productId);
    }

    /**
     * Creates a Product resource
     * @Rest\Post("/products")
     * @param Request $request
     * @return Response
     */
    public function postObject(Request $request): Response
    {
        return parent::postObject($request);
    }

    /**
     * Retrieves a Product resource
     * @Rest\Get("/products")
     */
    public function getObjects(): Response
    {
        return parent::getObjects();
    }

    /**
     * Updates a Product resource
     * @Rest\Post("/products/{objectId}")
     */
    public function putObject(int $objectId, Request $request): Response
    {
        return parent::putObject($objectId, $request);
    }

    /**
     * Updates a Product resource
     * @Rest\Delete("/products/{objectId}")
     */
    public function deleteObject(int $objectId): Response
    {
        return parent::deleteObject($objectId);
    }
}
