<?php

namespace App\Controller;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Request\ParamFetcher;
use Nelmio\ApiDocBundle\Annotation\Model;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use FOS\RestBundle\Controller\Annotations\Get;
use OpenApi\Attributes as OA;

class AuthorController extends AbstractController
{
    /**
     * @param AuthorRepository $authorRepository
     * @param SerializerInterface $serializer
     * @param ParamFetcher $paramFetcher
     * @return JsonResponse
     */
    #[Route('/api/author/list', name: 'author-list', methods: ['GET'])]
    #[QueryParam(name:"search")]
    public function getAuthorList(AuthorRepository $authorRepository,SerializerInterface $serializer,ParamFetcher $paramFetcher): JsonResponse
    {
        $search = $paramFetcher->get('search');
        $authorList = $authorRepository->findBySearch($search);
        $jsonBookList = $serializer->serialize($authorList, 'json', ['groups' => 'getAuthors']);
        return new JsonResponse($jsonBookList, Response::HTTP_OK, [], true);

    }

    /**
     * @param SerializerInterface $serializer
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @param Author $author
     * @return JsonResponse
     */
    #[Route('/author/new', name: 'add-new-author', methods: ['POST'], format: 'json')]
    #[OA\RequestBody( content: new OA\JsonContent(ref: new Model(type: Author::class, groups: ['create'])))]
    #[ParamConverter("author",converter: "fos_rest.request_body")]
    public function new(SerializerInterface $serializer,EntityManagerInterface $entityManager, Request $request,Author $author): JsonResponse
    {
        $entityManager->persist($author);
        $entityManager->flush();
        $jsonBookList = $serializer->serialize($author, 'json', ['groups' => 'getAuthors']);
        return new JsonResponse($jsonBookList, Response::HTTP_OK, [], true);
    }

}
