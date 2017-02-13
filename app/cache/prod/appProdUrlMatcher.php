<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        if (0 === strpos($pathinfo, '/log')) {
            if (0 === strpos($pathinfo, '/login')) {
                // login
                if ($pathinfo === '/login') {
                    return array (  '_controller' => 'BlogBundle\\Controller\\UserController::loginAction',  '_route' => 'login',);
                }

                // login_check
                if ($pathinfo === '/login_check') {
                    return array('_route' => 'login_check');
                }

            }

            // logout
            if ($pathinfo === '/logout') {
                return array('_route' => 'logout');
            }

        }

        // blog_homepage
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'blog_homepage');
            }

            return array (  '_controller' => 'BlogBundle\\Controller\\EntryController::indexAction',  '_route' => 'blog_homepage',);
        }

        if (0 === strpos($pathinfo, '/tags')) {
            // blog_index_tag
            if ($pathinfo === '/tags') {
                return array (  '_controller' => 'BlogBundle\\Controller\\TagController::indexAction',  '_route' => 'blog_index_tag',);
            }

            // blog_add_tag
            if ($pathinfo === '/tags/add') {
                return array (  '_controller' => 'BlogBundle\\Controller\\TagController::addAction',  '_route' => 'blog_add_tag',);
            }

            // blog_delete_tag
            if (0 === strpos($pathinfo, '/tags/delete') && preg_match('#^/tags/delete/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'blog_delete_tag')), array (  '_controller' => 'BlogBundle\\Controller\\TagController::deleteAction',));
            }

        }

        if (0 === strpos($pathinfo, '/categories')) {
            // blog_index_category
            if ($pathinfo === '/categories') {
                return array (  '_controller' => 'BlogBundle\\Controller\\CategoryController::indexAction',  '_route' => 'blog_index_category',);
            }

            // blog_add_category
            if ($pathinfo === '/categories/add') {
                return array (  '_controller' => 'BlogBundle\\Controller\\CategoryController::addAction',  '_route' => 'blog_add_category',);
            }

            // blog_delete_category
            if (0 === strpos($pathinfo, '/categories/delete') && preg_match('#^/categories/delete/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'blog_delete_category')), array (  '_controller' => 'BlogBundle\\Controller\\CategoryController::deleteAction',));
            }

            // blog_edit_category
            if (0 === strpos($pathinfo, '/categories/edit') && preg_match('#^/categories/edit/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'blog_edit_category')), array (  '_controller' => 'BlogBundle\\Controller\\CategoryController::editAction',));
            }

        }

        // blog_add_entry
        if ($pathinfo === '/entries/add') {
            return array (  '_controller' => 'BlogBundle\\Controller\\EntryController::addAction',  '_route' => 'blog_add_entry',);
        }

        // mi_homepage
        if (0 === strpos($pathinfo, '/hello') && preg_match('#^/hello/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'mi_homepage')), array (  '_controller' => 'MiBundle\\Controller\\DefaultController::indexAction',));
        }

        if (0 === strpos($pathinfo, '/pruebas')) {
            // pruebas_index
            if (preg_match('#^/pruebas(?:/(?P<lang>es|en|fr)(?:/(?P<name>[a-zA-Z]*)(?:/(?P<page>\\d+))?)?)?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_pruebas_index;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'pruebas_index')), array (  '_controller' => 'AppBundle\\Controller\\PruebasController::indexAction',  'lang' => 'es',  'name' => 'nombre_defecto',  'page' => 1,));
            }
            not_pruebas_index:

            // pruebas_create
            if ($pathinfo === '/pruebas/create') {
                return array (  '_controller' => 'AppBundle\\Controller\\PruebasController::createAction',  '_route' => 'pruebas_create',);
            }

            // pruebas_read
            if ($pathinfo === '/pruebas/read') {
                return array (  '_controller' => 'AppBundle\\Controller\\PruebasController::readAction',  '_route' => 'pruebas_read',);
            }

            // pruebas_update
            if (0 === strpos($pathinfo, '/pruebas/update') && preg_match('#^/pruebas/update/(?P<id>[^/]++)/(?P<titulo>[^/]++)/(?P<descripcion>[^/]++)/(?P<precio>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'pruebas_update')), array (  '_controller' => 'AppBundle\\Controller\\PruebasController::updateAction',));
            }

            // pruebas_delete
            if (0 === strpos($pathinfo, '/pruebas/delete') && preg_match('#^/pruebas/delete/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'pruebas_delete')), array (  '_controller' => 'AppBundle\\Controller\\PruebasController::deleteAction',));
            }

            // pruebas_native
            if ($pathinfo === '/pruebas/native') {
                return array (  '_controller' => 'AppBundle\\Controller\\PruebasController::nativeSqlAction',  '_route' => 'pruebas_native',);
            }

            // pruebas_form
            if ($pathinfo === '/pruebas/form') {
                return array (  '_controller' => 'AppBundle\\Controller\\PruebasController::formAction',  '_route' => 'pruebas_form',);
            }

            // pruebas_validate_email
            if (0 === strpos($pathinfo, '/pruebas/validar-email') && preg_match('#^/pruebas/validar\\-email/(?P<email>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'pruebas_validate_email')), array (  '_controller' => 'AppBundle\\Controller\\PruebasController::validarEmailAction',));
            }

        }

        // homepage
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'homepage');
            }

            return array (  '_controller' => 'AppBundle\\Controller\\DefaultController::indexAction',  '_route' => 'homepage',);
        }

        // hello-Worl
        if ($pathinfo === '/hello-world') {
            return array (  '_controller' => 'AppBundle\\Controller\\DefaultController::helloWorlAction',  '_route' => 'hello-Worl',);
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
