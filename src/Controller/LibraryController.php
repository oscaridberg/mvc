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
        ManagerRegistry $doctrine,
        $title,
        $isbn,
        $author,
        $img
    ): Response {
        $entityManager = $doctrine->getManager();

        $book = new Book();
        $book->setName($title);
        $book->setIsbn($isbn);
        $book->setAuthor($author);
        $book->setImg($img);

        // tell Doctrine you want to (eventually) save the Product
        // (no queries yet)
        $entityManager->persist($book);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        return new Response('Saved new book with title '.$book->getTitle());
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
     * @Route("/library/show/{title}", name="library_show_one")
     */
    public function showBookByTitle(
        LibraryRepository $libraryRepository,
        str $title
    ): Response {
        $book = $libraryRepository
            ->find($title);

        return $this->json($book);
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