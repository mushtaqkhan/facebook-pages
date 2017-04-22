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

        // _homepage
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', '_homepage');
            }

            return array (  '_controller' => 'Social\\ManagerBundle\\Controller\\DefaultController::indexAction',  '_route' => '_homepage',);
        }

        // indexFixed
        if ($pathinfo === '/indexFixed') {
            return array (  '_controller' => 'Social\\ManagerBundle\\Controller\\DefaultController::indexFixedAction',  '_route' => 'indexFixed',);
        }

        if (0 === strpos($pathinfo, '/s')) {
            // _set_lang
            if ($pathinfo === '/set_lang') {
                return array (  '_controller' => 'Social\\ManagerBundle\\Controller\\DefaultController::setLangAction',  '_route' => '_set_lang',);
            }

            // menu
            if ($pathinfo === '/system/menu') {
                return array (  '_controller' => 'Social\\ManagerBundle\\Controller\\DefaultController::menuAction',  '_route' => 'menu',);
            }

        }

        if (0 === strpos($pathinfo, '/oauth/sign_')) {
            // register
            if (0 === strpos($pathinfo, '/oauth/sign_up') && preg_match('#^/oauth/sign_up(?:/(?P<fb>[^/]++))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'register')), array (  '_controller' => 'Social\\ManagerBundle\\Controller\\UsersController::registerAction',  'fb' => 0,));
            }

            // _login
            if ($pathinfo === '/oauth/sign_in') {
                return array (  '_controller' => 'Social\\ManagerBundle\\Controller\\UsersController::loginAction',  '_route' => '_login',);
            }

            // _logout
            if ($pathinfo === '/oauth/sign_out') {
                return array (  '_controller' => 'Social\\ManagerBundle\\Controller\\UsersController::logoutAction',  '_route' => '_logout',);
            }

        }

        if (0 === strpos($pathinfo, '/user')) {
            // menuUser
            if ($pathinfo === '/user/userMenu') {
                return array (  '_controller' => 'Social\\ManagerBundle\\Controller\\UsersController::menuUserAction',  '_route' => 'menuUser',);
            }

            // _user
            if ($pathinfo === '/user/profile') {
                return array (  '_controller' => 'Social\\ManagerBundle\\Controller\\UsersController::profileAction',  '_route' => '_user',);
            }

        }

        if (0 === strpos($pathinfo, '/my_')) {
            if (0 === strpos($pathinfo, '/my_page')) {
                // _my_page
                if ($pathinfo === '/my_page') {
                    return array (  '_controller' => 'Social\\ManagerBundle\\Controller\\GroupsController::myPageAction',  '_route' => '_my_page',);
                }

                // _del_page
                if (0 === strpos($pathinfo, '/my_page/del') && preg_match('#^/my_page/del(?:\\-(?P<id>[^/]++))?$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_del_page')), array (  '_controller' => 'Social\\ManagerBundle\\Controller\\GroupsController::deleteAction',  'id' => 0,));
                }

            }

            if (0 === strpos($pathinfo, '/my_feed')) {
                // _my_feed
                if ($pathinfo === '/my_feed') {
                    return array (  '_controller' => 'Social\\ManagerBundle\\Controller\\FeedsController::myFeedAction',  '_route' => '_my_feed',);
                }

                // _del_feed
                if (0 === strpos($pathinfo, '/my_feed/del') && preg_match('#^/my_feed/del(?:\\-(?P<u_id>[^/]++))?$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_del_feed')), array (  '_controller' => 'Social\\ManagerBundle\\Controller\\FeedsController::deleteAction',  'u_id' => 0,));
                }

                // _edit_feed
                if (0 === strpos($pathinfo, '/my_feed/edit') && preg_match('#^/my_feed/edit(?:/(?P<title>[^/]++)(?:/(?P<u_id>[^/]++))?)?$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_edit_feed')), array (  '_controller' => 'Social\\ManagerBundle\\Controller\\FeedsController::editAction',  'u_id' => 0,  'title' => NULL,));
                }

            }

        }

        // _new_feed
        if (0 === strpos($pathinfo, '/new_feed') && preg_match('#^/new_feed(?:/(?P<title>[^/]++))?$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => '_new_feed')), array (  '_controller' => 'Social\\ManagerBundle\\Controller\\FeedsController::newFeedAction',  'title' => NULL,));
        }

        if (0 === strpos($pathinfo, '/system/admin_')) {
            // _admin_page
            if ($pathinfo === '/system/admin_page') {
                return array (  '_controller' => 'Social\\ManagerBundle\\Controller\\AdminController::myPageAction',  '_route' => '_admin_page',);
            }

            // _admin_feed
            if ($pathinfo === '/system/admin_feed') {
                return array (  '_controller' => 'Social\\ManagerBundle\\Controller\\AdminController::myfeedAction',  '_route' => '_admin_feed',);
            }

            // _admin_user
            if ($pathinfo === '/system/admin_user') {
                return array (  '_controller' => 'Social\\ManagerBundle\\Controller\\AdminController::myUserAction',  '_route' => '_admin_user',);
            }

            // _admin_del_feed
            if (0 === strpos($pathinfo, '/system/admin_feed/del') && preg_match('#^/system/admin_feed/del(?:\\-(?P<id>[^/]++))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_admin_del_feed')), array (  '_controller' => 'Social\\ManagerBundle\\Controller\\AdminController::deleteAction',  'id' => 0,));
            }

            // _admin_del_page
            if (0 === strpos($pathinfo, '/system/admin_page/del') && preg_match('#^/system/admin_page/del(?:\\-(?P<id>[^/]++))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_admin_del_page')), array (  '_controller' => 'Social\\ManagerBundle\\Controller\\AdminController::deletePageAction',  'id' => 0,));
            }

            // _admin_del_user
            if (0 === strpos($pathinfo, '/system/admin_user/del') && preg_match('#^/system/admin_user/del(?:\\-(?P<id>[^/]++))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_admin_del_user')), array (  '_controller' => 'Social\\ManagerBundle\\Controller\\AdminController::deleteUserAction',  'id' => 0,));
            }

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
