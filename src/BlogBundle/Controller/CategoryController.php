<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use BlogBundle\Form\CategoryType;
use BlogBundle\Entity\Category;
use Symfony\Component\HttpFoundation\Session\Session;

class CategoryController extends Controller {

    private $session;

    public function __construct() {
        $this->session = new Session();
    }

    public function indexAction() {

        $em = $this->getDoctrine()->getManager();
        $category_repo = $em->getRepository("BlogBundle:Category");
        $categories = $category_repo->findAll();

        return $this->render("BlogBundle:Category:index.html.twig", array(
                    "categories" => $categories
        ));
    }

    public function addAction(Request $request) {
        $category = new Category();
        $form = $this->createForm(new CategoryType(), $category);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {

                $category = new Category();
                $category->setName($form->get("name")->getData());
                $category->setDescription($form->get("description")->getData());

                $em = $this->getDoctrine()->getManager();
                $em->persist($category);
                $flush = $em->flush();
                if ($flush == null) {
                    $status = "La categoria se a creado Correctamente";
                } else {
                    $status = "Error al añadir la categoria";
                }
            } else {
                $status = "Formulario no valido, ingrese datos correctamente!";
            }
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("blog_index_category");
        }
        return $this->render("BlogBundle:Category:add.html.twig", array(
                    "form" => $form->createView()
        ));
    }

    public function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $category_repo = $em->getRepository("BlogBundle:Category");
        $categories = $category_repo->find($id);
        if (count($categories->getEntries()) == 0) {
            $em->remove($categories);
            $flush = $em->flush();
            if ($flush == null) {
                $status = "La categoria se a Borrado Correctamente";
            } else {
                $status = "Error al Borrar la categoria";
            }
            $this->session->getFlashBag()->add("status", $status);
        }
        return $this->redirectToRoute("blog_index_category");
    }

    public function editAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $category_repo = $em->getRepository("BlogBundle:Category");
        $category = $category_repo->find($id);

        $form = $this->createForm(new CategoryType(), $category);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {

                $category->setName($form->get("name")->getData());
                $category->setDescription($form->get("description")->getData());

                $em = $this->getDoctrine()->getManager();
                $em->persist($category);
                $flush = $em->flush();
                if ($flush == null) {
                    $status = "La categoria se a Editado Correctamente";
                } else {
                    $status = "Error al Editar la categoria";
                }
            } else {
                $status = "Formulario no valido, ingrese datos correctamente!";
            }
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("blog_index_category");
        }

        return $this->render("BlogBundle:Category:edit.html.twig", array(
                    "form" => $form->createView()
        ));
    }

    public function categoryAction($id, $page) {
        $em = $this->getDoctrine()->getManager();
        $category_repo = $em->getRepository("BlogBundle:Category");
        $category = $category_repo->find($id);

        $entry_repo = $em->getRepository("BlogBundle:Entry");
        $entries = $entry_repo->getCategoryEntries($category, 5, $page);

        $totalItems = count($entries);
        $pagesCount = ceil($totalItems /5);

        return $this->render("BlogBundle:Category:category.html.twig", array(
                    "category" => $category,
                    "categories" => $category_repo->findAll(),
                    "entries" => $entries,
                    "totalItems" => $totalItems,
                    "pagesCount" => $pagesCount,
                    "page" => $page,
                    "page_m" => $page
        ));
    }

}
