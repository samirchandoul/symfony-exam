<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 5; $i++) {
            $author = new Author();
            $author->setFirstName('firstName author_' . $i);
            $author->setLastName('lastName author_' . $i);
            $manager->persist($author);
            $listAuthor[] = $author;
        }
        for ($i = 0; $i < 20; $i++) {
            $book = new Book();
            $book->setTitle('title  book_' . $i);
            $book->setResume('resume book_' . $i);
            $book->setAuthor($listAuthor[array_rand($listAuthor)]);
            $manager->persist($book);
        }

        $manager->flush();
    }
}
