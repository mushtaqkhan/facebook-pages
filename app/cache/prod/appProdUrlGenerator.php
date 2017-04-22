<?php

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Psr\Log\LoggerInterface;

/**
 * appProdUrlGenerator
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdUrlGenerator extends Symfony\Component\Routing\Generator\UrlGenerator
{
    private static $declaredRoutes = array(
        '_homepage' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Social\\ManagerBundle\\Controller\\DefaultController::indexAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'indexFixed' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Social\\ManagerBundle\\Controller\\DefaultController::indexFixedAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/indexFixed',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_set_lang' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Social\\ManagerBundle\\Controller\\DefaultController::setLangAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/set_lang',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'menu' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Social\\ManagerBundle\\Controller\\DefaultController::menuAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/system/menu',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'register' => array (  0 =>   array (    0 => 'fb',  ),  1 =>   array (    '_controller' => 'Social\\ManagerBundle\\Controller\\UsersController::registerAction',    'fb' => 0,  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'fb',    ),    1 =>     array (      0 => 'text',      1 => '/oauth/sign_up',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_login' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Social\\ManagerBundle\\Controller\\UsersController::loginAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/oauth/sign_in',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_logout' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Social\\ManagerBundle\\Controller\\UsersController::logoutAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/oauth/sign_out',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'menuUser' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Social\\ManagerBundle\\Controller\\UsersController::menuUserAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/user/userMenu',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_user' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Social\\ManagerBundle\\Controller\\UsersController::profileAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/user/profile',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_my_page' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Social\\ManagerBundle\\Controller\\GroupsController::myPageAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/my_page',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_del_page' => array (  0 =>   array (    0 => 'id',  ),  1 =>   array (    '_controller' => 'Social\\ManagerBundle\\Controller\\GroupsController::deleteAction',    'id' => 0,  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '-',      2 => '[^/]++',      3 => 'id',    ),    1 =>     array (      0 => 'text',      1 => '/my_page/del',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_my_feed' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Social\\ManagerBundle\\Controller\\FeedsController::myFeedAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/my_feed',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_del_feed' => array (  0 =>   array (    0 => 'u_id',  ),  1 =>   array (    '_controller' => 'Social\\ManagerBundle\\Controller\\FeedsController::deleteAction',    'u_id' => 0,  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '-',      2 => '[^/]++',      3 => 'u_id',    ),    1 =>     array (      0 => 'text',      1 => '/my_feed/del',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_edit_feed' => array (  0 =>   array (    0 => 'title',    1 => 'u_id',  ),  1 =>   array (    '_controller' => 'Social\\ManagerBundle\\Controller\\FeedsController::editAction',    'u_id' => 0,    'title' => NULL,  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'u_id',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'title',    ),    2 =>     array (      0 => 'text',      1 => '/my_feed/edit',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_new_feed' => array (  0 =>   array (    0 => 'title',  ),  1 =>   array (    '_controller' => 'Social\\ManagerBundle\\Controller\\FeedsController::newFeedAction',    'title' => NULL,  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'title',    ),    1 =>     array (      0 => 'text',      1 => '/new_feed',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_admin_page' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Social\\ManagerBundle\\Controller\\AdminController::myPageAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/system/admin_page',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_admin_feed' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Social\\ManagerBundle\\Controller\\AdminController::myfeedAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/system/admin_feed',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_admin_user' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Social\\ManagerBundle\\Controller\\AdminController::myUserAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/system/admin_user',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_admin_del_feed' => array (  0 =>   array (    0 => 'id',  ),  1 =>   array (    '_controller' => 'Social\\ManagerBundle\\Controller\\AdminController::deleteAction',    'id' => 0,  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '-',      2 => '[^/]++',      3 => 'id',    ),    1 =>     array (      0 => 'text',      1 => '/system/admin_feed/del',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_admin_del_page' => array (  0 =>   array (    0 => 'id',  ),  1 =>   array (    '_controller' => 'Social\\ManagerBundle\\Controller\\AdminController::deletePageAction',    'id' => 0,  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '-',      2 => '[^/]++',      3 => 'id',    ),    1 =>     array (      0 => 'text',      1 => '/system/admin_page/del',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        '_admin_del_user' => array (  0 =>   array (    0 => 'id',  ),  1 =>   array (    '_controller' => 'Social\\ManagerBundle\\Controller\\AdminController::deleteUserAction',    'id' => 0,  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '-',      2 => '[^/]++',      3 => 'id',    ),    1 =>     array (      0 => 'text',      1 => '/system/admin_user/del',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
    );

    /**
     * Constructor.
     */
    public function __construct(RequestContext $context, LoggerInterface $logger = null)
    {
        $this->context = $context;
        $this->logger = $logger;
    }

    public function generate($name, $parameters = array(), $referenceType = self::ABSOLUTE_PATH)
    {
        if (!isset(self::$declaredRoutes[$name])) {
            throw new RouteNotFoundException(sprintf('Unable to generate a URL for the named route "%s" as such route does not exist.', $name));
        }

        list($variables, $defaults, $requirements, $tokens, $hostTokens, $requiredSchemes) = self::$declaredRoutes[$name];

        return $this->doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $referenceType, $hostTokens, $requiredSchemes);
    }
}
