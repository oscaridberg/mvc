<?php

namespace App\Controller;


use App\Entity\Library;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\LibraryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LibraryController extends AbstractController
{
    #[Route('/library', name: 'app_library')]
    public function index(): Response
    {
        return $this->render('library.html.twig', [
            'controller_name' => 'LibraryController',
        ]);
    }

    /**
     * @Route("/library/create", name="create_library")
     */
    public function createBook(
        ManagerRegistry $doctrine
    ): Response {
        // print_r($_POST);
        $title = $_POST['ftitle'];
        $isbn = $_POST['fisbn'];
        $author = $_POST['fauthor'];
        $img = $_POST['fimg'];

        // print_r($author);
        $entityManager = $doctrine->getManager();

        $book = new Library();
        $book->setTitle($title);
        $book->setIsbn($isbn);
        $book->setAuthor($author);
        $book->setImage($img);

        // tell Doctrine you want to (eventually) save the Product
        // (no queries yet)
        $entityManager->persist($book);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        $data = [
            "title" => "Add book",
            'message' => 'Saved new book with title: '.$book->getTitle(),
            "dTitle" => '',
            "dIsbn" => '',
            "dAuthor" => '',
            "dImage" => '',
            "dAction" => "/library/create"
        ];
        // return new Response('Saved new book with title '.$book->getTitle());
        return $this->render('library/addbook.html.twig', $data);
    }

    /**
    * @Route("/library/add", name="library_add")
    */
    public function addBook(
        LibraryRepository $libraryRepository
    ): Response {

        $data = [
            "title" => "Add book",
            "message" => '',
            "dTitle" => '',
            "dIsbn" => '',
            "dAuthor" => '',
            "dImage" => '',
            "dAction" => "/library/create"
        ];
        
        return $this->render('library/addbook.html.twig', $data);
    }

    /**
    * @Route("/library/show", name="library_show_all")
    */
    public function showAllBooks(
        LibraryRepository $libraryRepository
    ): Response {
        $library = $libraryRepository
            ->findAll();

        $jsonData = $this->json($library)->getContent();
        $books = json_decode($jsonData, true);
        $data = [
            'books' => $books,
            'title' => 'Books'
        ];

        return $this->render('library/librarytable.html.twig', $data);
    }

    /**
     * @Route("/library/show/{id}", name="library_show_one")
     */
    public function showBookByid(
        LibraryRepository $libraryRepository,
        int $id
    ): Response {
        $book = $libraryRepository
            ->find($id);

        // print_r($book);
        $data = [
            'title' => $book->getTitle(),
            'author' => $book->getAuthor(),
            'isbn' => $book->getIsbn(),
            'img' => $book->getImage(),

        ];
        return $this->render('library/onebook.html.twig', $data);
    }

    /**
     * @Route("/library/delete/{id}", name="library_delete_by_id")
     */
    public function deleteBookById(
        ManagerRegistry $doctrine,
        int $id
    ): Response {
        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Library::class)->find($id);

        if (!$book) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $entityManager->remove($book);
        $entityManager->flush();

        return $this->redirectToRoute('library_show_all');
    }

    /**
     * @Route("/library/change/{id}", name="library_update_one")
     */
    public function changeBook(
        LibraryRepository $libraryRepository,
        int $id
    ): Response {
        $book = $libraryRepository
            ->find($id);

        // print_r($book);
        $data = [
            "title" => "Update book",
            "message" => '',
            "dTitle" => $book->getTitle(),
            "dIsbn" => $book->getIsbn(),
            "dAuthor" => $book->getAuthor(),
            "dImage" => $book->getImage(),
            "id" => $book->getId(),
            "dAction" => "/library/update/{$book->getId()}"
        ];
        return $this->render('library/addbook.html.twig', $data);
    }

    /**
     * @Route("/library/update/{id}", name="book_update")
     */
    public function updateBook(
        ManagerRegistry $doctrine,
        int $id
    ): Response {
        $title = $_POST['ftitle'];
        $isbn = $_POST['fisbn'];
        $author = $_POST['fauthor'];
        $img = $_POST['fimg'];

        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Library::class)->find($id);

        if (!$book) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        $book->setTitle($title);
        $book->setIsbn($isbn);
        $book->setAuthor($author);
        $book->setImage($img);

        $entityManager->flush();

        return $this->redirectToRoute('library_show_all');
    }

}