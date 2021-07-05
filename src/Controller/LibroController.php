<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Libro;
use App\Repository\LibroRepository;
use App\Entity\Autor;


class LibroController extends AbstractController
{
    /**
     * @Route("/form-libro", name="form-libro")
     */
    public function formLibro(): Response
    {
        return $this->render('libro/form-libro.html.twig');
    }


    /**
     * @Route("/crear-libro", name="crear-libro")
     */
    public function crearLibro(
        LibroRepository $libroRepository,
        Request $request,
        EntityManagerInterface $em
    ): Response
    {

        $isbn = $request->request->get('isbn');
        $titulo = $request->request->get('titulo');
        $nombreAutor = $request->request->get('autor');
        $editorial = $request->request->get('editorial');

        $autor = new Autor();
        $autor -> setNombre($nombreAutor);

        $libro = new Libro();
        $libro -> setIsbn($isbn);
        $libro -> setTitulo($titulo);
        $libro -> addAutor($nombreAutor);
        $libro -> setEditorial($editorial);

        $em->persist($libro);
        $em->flush();

        $libros = $libroRepository->findAll();

        return $this->render('home/index.html.twig', [
            'libros' => $libros
        ]);
    }
}
