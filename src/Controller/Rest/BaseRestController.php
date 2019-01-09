<?php

namespace App\Controller\Rest;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ObjectRepository;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception;
use App\Form\ProductFormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Form\AbstractType;

class BaseRestController extends FOSRestController
{
    /**
     * @var ObjectRepository
     */
    private $objectRepository;

    private $class;

    private $serializer;

    private $formTypeClass;

    public function __construct(
        ObjectRepository $objectRepository,
        string $class = null,
        string $formTypeClass = null
    ) {
        $this->objectRepository = $objectRepository;
        $this->class = $class;
        $this->formTypeClass = $formTypeClass;

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $this->serializer = new Serializer($normalizers, $encoders);
    }

    protected function postObject(Request $request)
    {
        $object = new $this->class();
        $form = $this->createForm($this->formTypeClass, $object);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->objectRepository->save($object);
            $response = new Response();
            $response->setContent(json_encode(array(
                'status' => Response::HTTP_CREATED,
                'message' => sprintf('%s created Successfuly', $this->class),
                'data' => null
            )));
            $response->headers->set('Content-Type', 'application/json');
            
            return $response;
        }
        throw new Exception('The content could not be saved');
    }

    protected function getObject(int $objectId): Response
    {
        $object = $this->objectRepository->findOneById($objectId);
        
        if (null !== $object) {
            $jsonContent = $this->serializer->serialize($object, 'json');
            $response = new Response();
            $response->setContent(json_encode(array(
                'status' => Response::HTTP_OK,
                'message' => sprintf('%s retrieved Successfuly', $this->class),
                'data' => $jsonContent
            )));
            $response->headers->set('Content-Type', 'application/json');
            
            return $response;
        }
        throw new Exception(sprintf('No %s with given id', $this->class));
    }

    protected function getObjects(): Response
    {
        $objects = $this->objectRepository->findAll();
        
        if (null !== $objects) {
            $jsonContent = $this->serializer->serialize($objects, 'json');

            $response = new Response();
            $response->setContent(json_encode(array(
                'status' => Response::HTTP_OK,
                'message' => sprintf('%s retrieved Successfuly', $this->class),
                'data' => $jsonContent
            )));
            $response->headers->set('Content-Type', 'application/json');
            
            return $response;
        }
        throw new Exception('No Products present in database');
    }

    protected function putObject(int $objectId, Request $request): Response
    {
        $object = $this->objectRepository->findOneById($objectId);

        $form = $this->createForm($this->formTypeClass, $object);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->objectRepository->save($object);
            $response = new Response();
            $response->setContent(json_encode(array(
                'status' => Response::HTTP_CREATED,
                'message' => sprintf('%s Updated Successfuly', $this->class),
                'data' => null
            )));
            $response->headers->set('Content-Type', 'application/json');
            
            return $response;
        }
        throw new Exception('The content could not be saved');
    }

    public function deleteObject(int $objectId): Response
    {
        $object = $this->objectRepository->findOneById($objectId);

        if (null !== $product) {
            try {
                $this->objectRepository->delete($object);

                $response = new Response();
                $response->setContent(json_encode(array(
                    'status' => Response::HTTP_OK,
                    'message' => sprintf('%s  deleted Successfuly', $this->class)
                )));
                $response->headers->set('Content-Type', 'application/json');

                return $response;
            } catch (Exception $e) {
                throw new Exception('Error deleting object');
            }
        }
        // In case our DELETE was a success we need to return a 204 HTTP NO CONTENT response. The object is deleted.
        throw new Exception('No content could not be deleted');
    }
}
