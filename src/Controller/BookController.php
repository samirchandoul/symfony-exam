<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class BookController extends AbstractController
{
    /**
     * return all title of books in json format
     * @param BookRepository $bookRepository
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    #[Route('/books/list', name: 'list-of-my-books', methods: ['GET'], format: 'json')]
    public function books(BookRepository $bookRepository,SerializerInterface $serializer): JsonResponse
    {
        $books = $bookRepository->findAll();
        $jsonBooks = $serializer->serialize($books, 'json', ['groups' => 'getBook']);
        return new JsonResponse($jsonBooks, Response::HTTP_OK, [], true);

    }

    /**
     * @param SerializerInterface $serializer
     * @param EntityManagerInterface $entityManager
     * @param BookRepository $bookRepository
     * @return JsonResponse
     */
    #[Route('/books/add-suffix', name: 'add-suffix-on-my-books', methods: ['PATCH'], format: 'json')]
    public function addSuffix(SerializerInterface $serializer, EntityManagerInterface $entityManager,BookRepository $bookRepository)
    {
        $books = $bookRepository->findAll();
        foreach ($books as $book) {
            $book->setTitle($book->getTitle().' - Suffix');
            $entityManager->persist($book);
        }
        $entityManager->flush();
        $jsonBooks = $serializer->serialize($books, 'json', ['groups' => 'getBook']);
        return new JsonResponse($jsonBooks, Response::HTTP_OK, [], true);
    }
}
