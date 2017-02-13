<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use BlogBundle\Form\TagType;
use BlogBundle\Entity\Tag;
use Symfony\Component\HttpFoundation\Session\Session;

class TagController extends Controller {

    private $session;

    public function __construct() {
        $this->session = new Session();
    }

    public function indexAction() {

        $em = $this->getDoctrine()->getManager();
        $tag_repo = $em->getRepository("BlogBundle:Tag");
        $tags = $tag_repo->findAll();

        return $this->render("BlogBundle:Tag:index.html.twig", array(
                    "tags" => $tags
        ));
    }

    public function addAction(Request $request) {
        $tag = new Tag();
        $form = $this->createForm(new TagType(), $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {

                $tag = new Tag();
                $tag->setName($form->get("name")->getData());
                $tag->setDescription($form->get("description")->getData());

                $em = $this->getDoctrine()->getManager();
                $em->persist($tag);
                $flush = $em->flush();
                if ($flush == null) {
                    $status = "La etiqueta se a creado Correctamente";
                } else {
                    $status = "Error al añadir la etiqueta";
                }
            } else {
                $status = "Formulario no valido, ingrese datos correctamente!";
            }
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("blog_index_tag");
        }
        return $this->render("BlogBundle:Tag:add.html.twig", array(
                    "form" => $form->createView()
        ));
    }

    public function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $tag_repo = $em->getRepository("BlogBundle:Tag");
        $tags = $tag_repo->find($id);
        if (count($tags->getEntryTag()) == 0) {
            $em->remove($tags);
            $flush = $em->flush();
            if ($flush == null) {
                $status = "La etiqueta se a Borrado Correctamente";
            } else {
                $status = "Error al Borrar la etiqueta";
            }
            $this->session->getFlashBag()->add("status", $status);            
        }
        return $this->redirectToRoute("blog_index_tag");
    }

}
