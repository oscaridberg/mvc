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
        return new Response('Saved new book with title '.$book->getTitle());
    }

    /**
    * @Route("/library/add", name="library_add")
    */
    public function addBook(
        LibraryRepository $libraryRepository
    ): Response {

        $data = [
            "title" => "Add book"
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
            'title' => 'All books'
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
     * @Route("/product/delete/{id}", name="product_delete_by_id")
     */
    public function deleteProductById(
        ManagerRegistry $doctrine,
        int $id
    ): Response {
        $entityManager = $doctrine->getManager();
        $product = $entityManager->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $entityManager->remove($product);
        $entityManager->flush();

        return $this->redirectToRoute('product_show_all');
    }


    /**
     * @Route("/product/update/{id}/{value}", name="product_update")
     */
    public function updateProduct(
        ManagerRegistry $doctrine,
        int $id,
        int $value
    ): Response {
        $entityManager = $doctrine->getManager();
        $product = $entityManager->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $product->setValue($value);
        $entityManager->flush();

        return $this->redirectToRoute('product_show_all');
    }

}