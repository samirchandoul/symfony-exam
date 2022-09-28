<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    /**
     * return all namme of books in json format
     *
     */
    #[Route('/books/list', name: 'list-of-my-books', methods: ['POST'], format: 'json')]
    public function book()
    {
        $book = $this->container->get('doctrine.orm.default_entity_manager')->getRepository("App\Entity\Book")->findBy(['id' => 1]);

        $template = $this->container->get('twig')->load('book/index.html.twig');

        return $template->render([
            'return' => json_encode([
                'data' => json_encode($book[0]['name'])
            ]),
        ]);
    }

    /**
     * parcour all books and add sufix on name
     */
    #[Route('/books/add-sufix', name: 'add-sufix-on-my-books', methods: ['GET'], format: 'json')]
    public function addSufix(string $suffix)
    {
        $books = $this->container->get('doctrine.orm.default_entity_manager')->getRepository("App\Entity\Book")->findBy([]);

        foreach ($books as $book) {
            $book->name .= ' - Sufix';
            $this->container->get('doctrine.orm.default_entity_manager')->persist($book);
            $this->container->get('doctrine.orm.default_entity_manager')->flush();
        }


        $template = $this->container->get('twig')->load('book/index.html.twig');

        return $template->render([
            'return' => json_encode([
                'data' => json_encode('ok'),
                'books' => json_encode($books)
            ]),
        ]);
    }
}
