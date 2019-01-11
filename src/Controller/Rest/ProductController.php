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
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Security as SecurityApiDoc;

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
     * Retrieves a Product
     * @Rest\Get("/products/{productId}")
     * @SWG\Tag(name="Product CRUD")
     * @SWG\Parameter(
     *      name="access_token",
     *      in="query",
     *      required=true,
     *      type="string"
     * )
     * @SWG\Response(
     *      response="200",
     *      description="Product retrieved successfuly",
     * )
     */
    public function getObject(int $productId): Response
    {
        return parent::getObject($productId);
    }

    /**
     * Creates a Product
     * @Rest\Post("/products")
     * @param Request $request
     * @return Response
     * @SWG\Tag(name="Product CRUD")
     * @SWG\Parameter(
     *      name="access_token",
     *      in="query",
     *      required=true,
     *      type="string"
     * )
     * @SWG\Parameter(
     *      name="data",
     *      in="body",
     *      required=true,
     *      @SWG\Schema(
     *          @SWG\Property(property="product_form[name]", type="string", description="The name of the Product")
     *      )
     * )
     * @SWG\Response(
     *      response="200",
     *      description="Product created successfuly",
     * )
     */
    public function postObject(Request $request): Response
    {
        return parent::postObject($request);
    }

    /**
     * Retrieves a list of Products
     * @Rest\Get("/products")
     * @SWG\Tag(name="Product CRUD")
     * @SWG\Parameter(
     *      name="access_token",
     *      in="query",
     *      required=true,
     *      type="string"
     * )
     * @SWG\Response(
     *      response="200",
     *      description="Get Products list",
     * )
     */
    public function getObjects(): Response
    {
        return parent::getObjects();
    }

    /**
     * Updates an existing Product
     * @Rest\Post("/products/{objectId}")
     * @SWG\Tag(name="Product CRUD")
     * @SWG\Parameter(
     *      name="access_token",
     *      in="query",
     *      required=true,
     *      type="string"
     * )
     * @SWG\Response(
     *      response="200",
     *      description="Product updated successfuly",
     * )
     */
    public function putObject(int $objectId, Request $request): Response
    {
        return parent::putObject($objectId, $request);
    }

    /**
     * Deletes an existing Product
     * @Rest\Delete("/products/{objectId}")
     * @SWG\Tag(name="Product CRUD")
     * @SWG\Parameter(
     *      name="access_token",
     *      in="query",
     *      required=true,
     *      type="string"
     * )
     * @SWG\Response(
     *      response="200",
     *      description="Product deleted successfuly",
     * )
     */
    public function deleteObject(int $objectId): Response
    {
        return parent::deleteObject($objectId);
    }
}
