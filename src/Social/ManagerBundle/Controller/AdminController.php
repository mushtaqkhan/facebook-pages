<?php

namespace Social\ManagerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Social\ManagerBundle\SocialManagerBundle as MiniLib;
use Facebook\Facebook;
use Symfony\Component\HttpFoundation\Session\Session;

class AdminController extends BaseController {

    public function myPageAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $session = $request->getSession();

        $session->set("userMenu", "_admin_page");

        $username = $session->get('username', "");
        $password = $session->get('password', "");

        $check = $em->getRepository('SocialManagerBundle:Users')->findOneBy(array("email" => $username, "password" => $password, "supper" => 1));
        if (!$check) {
            $session->clear();
            $session->set('notice', $this->get('translator')->trans('Please Login.'));
            return $this->redirect($this->generateUrl("_homepage"));
        }

        $list = "";
        $limit = (int) $this->container->getParameter('limit');
        $p = isset($_REQUEST['p']) ? (int) $_REQUEST['p'] : 1;
        if (!$p || $p < 1) {
            $p = 1;
        }

        $total = $em->getRepository('SocialManagerBundle:Tokens')->_getCountListByAdmin();
        if ($total > 0) {
            $list = $em->getRepository('SocialManagerBundle:Tokens')->_getProListByAdmin($p, $limit);
        }

        $pager2 = array();
        $pager2['PreviousPage'] = ($p > 1) ? ($p - 1) : $p;
        $pager2['NextPage'] = (ceil($total / $limit) > $p) ? ($p + 1) : $p;
        $pager2['LastPage'] = ceil($total / $limit);
        $pager2['Page'] = $p;

        $arr1 = array("list" => $list, "check" => $check, "page" => $pager2);

        return $this->render('SocialManagerBundle:Admin:lists.html.php', $arr1);
    }

    public function myFeedAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $session = $request->getSession();

        $session->set("userMenu", "_admin_feed");

        $username = $session->get('username', "");
        $password = $session->get('password', "");

        $check = $em->getRepository('SocialManagerBundle:Users')->findOneBy(array("email" => $username, "password" => $password, "supper" => 1));
        if (!$check) {
            $session->clear();
            $session->set('notice', $this->get('translator')->trans('Please Login.'));
            return $this->redirect($this->generateUrl("_homepage"));
        }

        $list = "";
        $limit = (int) $this->container->getParameter('limit');
        $p = isset($_REQUEST['p']) ? (int) $_REQUEST['p'] : 1;
        if (!$p || $p < 1) {
            $p = 1;
        }

        $total = $em->getRepository('SocialManagerBundle:Feeds')->_getCountListByAdmin();
        if ($total > 0) {
            $list = $em->getRepository('SocialManagerBundle:Feeds')->_getProListByAdmin($p, $limit);
        }

        $pager2 = array();
        $pager2['PreviousPage'] = ($p > 1) ? ($p - 1) : $p;
        $pager2['NextPage'] = (ceil($total / $limit) > $p) ? ($p + 1) : $p;
        $pager2['LastPage'] = ceil($total / $limit);
        $pager2['Page'] = $p;

        $arr1 = array("list" => $list, "check" => $check, "page" => $pager2);

        return $this->render('SocialManagerBundle:Admin:listFeeds.html.php', $arr1);
    }

    public function myUserAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $session = $request->getSession();

        $session->set("userMenu", "_admin_user");

        $username = $session->get('username', "");
        $password = $session->get('password', "");

        $check = $em->getRepository('SocialManagerBundle:Users')->findOneBy(array("email" => $username, "password" => $password, "supper" => 1));
        if (!$check) {
            $session->clear();
            $session->set('notice', $this->get('translator')->trans('Please Login.'));
            return $this->redirect($this->generateUrl("_homepage"));
        }

        $list = "";
        $limit = (int) $this->container->getParameter('limit');
        $p = isset($_REQUEST['p']) ? (int) $_REQUEST['p'] : 1;
        if (!$p || $p < 1) {
            $p = 1;
        }

        $total = $em->getRepository('SocialManagerBundle:Users')->_getCountListByAdmin();
        if ($total > 0) {
            $list = $em->getRepository('SocialManagerBundle:Users')->_getProListByAdmin($p, $limit);
        }

        $pager2 = array();
        $pager2['PreviousPage'] = ($p > 1) ? ($p - 1) : $p;
        $pager2['NextPage'] = (ceil($total / $limit) > $p) ? ($p + 1) : $p;
        $pager2['LastPage'] = ceil($total / $limit);
        $pager2['Page'] = $p;

        $arr1 = array("list" => $list, "check" => $check, "page" => $pager2);

        return $this->render('SocialManagerBundle:Admin:listUsers.html.php', $arr1);
    }

    public function deleteAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $session = $request->getSession();

        $username = $session->get('username', "");
        $password = $session->get('password', "");
        if (!$username || !$password) {
            $session->clear();
            $session->set('notice', $this->get('translator')->trans('Please Login.'));
            return $this->redirect($this->generateUrl("_homepage"));
        }
        $checkw = $em->getRepository('SocialManagerBundle:Users')->findOneBy(array("email" => $username, "password" => $password, "supper" => 1));
        if (!$checkw) {
            $session->clear();
            $session->set('notice', $this->get('translator')->trans('Please Login.'));
            return $this->redirect($this->generateUrl("_homepage"));
        }

        if (MiniLib::$demoMode) {
            $session->set('notice', $this->get('translator')->trans('Only View on Demo Mode.'));
            return $this->redirect($this->generateUrl("_user"));
        }

        $viewT = $em->getRepository('SocialManagerBundle:Feeds')->findOneBy(array("id" => $id));
        if ($viewT) {
            $r = "";

            if ($tmp = $viewT->getFeedId()) {
                try {
                    $fbApp = new Facebook(array('app_id' => MiniLib::$fb_app, 'app_secret' => MiniLib::$fb_key));
                    $token = $em->getRepository('SocialManagerBundle:Tokens')->findOneBy(
                            array(
                                "p_id" => $viewT->getPId(),
                                "u_id" => $viewT->getUId()
                            )
                    );

                    if ($token->getTokenFacebook()) {
                        $fbApp->setDefaultAccessToken($token->getTokenFacebook());
                    } else {
                        $fbApp->setDefaultAccessToken($checkw->getTokenFacebook());
                    }

                    try {
                        $r = $fbApp->delete($tmp);
                    } catch (\Facebook\Exceptions\FacebookResponseException $e) {
                        
                    } catch (\Facebook\Exceptions\FacebookAuthorizationException $e) {
                        
                    }
                    $em->remove($viewT);
                    $em->flush();
                } catch (Exception $ex) {
                    
                }
            } else {
                $em->remove($viewT);
                $em->flush();
            }
        }

        return $this->redirect($this->generateUrl("_admin_feed"));
    }

    public function deletePageAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $session = $request->getSession();

        $username = $session->get('username', "");
        $password = $session->get('password', "");
        if (!$username || !$password) {
            $session->clear();
            $session->set('notice', $this->get('translator')->trans('Please Login.'));
            return $this->redirect($this->generateUrl("_homepage"));
        }
        $checkw = $em->getRepository('SocialManagerBundle:Users')->findOneBy(array("email" => $username, "password" => $password, "supper" => 1));
        if (!$checkw) {
            $session->clear();
            $session->set('notice', $this->get('translator')->trans('Please Login.'));
            return $this->redirect($this->generateUrl("_homepage"));
        }

        if (MiniLib::$demoMode) {
            $session->set('notice', $this->get('translator')->trans('Only View on Demo Mode.'));
            return $this->redirect($this->generateUrl("_user"));
        }

        $viewT = $em->getRepository('SocialManagerBundle:Tokens')->findOneBy(array("id" => $id));
        if ($viewT) {

            $query = "DELETE FROM Feeds WHERE u_id = :u_id AND p_id = :p_id";
            $connection = $em->getConnection();
            $statement = $connection->prepare($query);
            $statement->bindValue('u_id', $viewT->getUId());
            $statement->bindValue('p_id', $viewT->getPId());
            $statement->execute();

            $em->remove($viewT);
            $em->flush();
        }

        return $this->redirect($this->generateUrl("_admin_page"));
    }

    public function deleteUserAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $session = $request->getSession();

        $username = $session->get('username', "");
        $password = $session->get('password', "");
        if (!$username || !$password) {
            $session->clear();
            $session->set('notice', $this->get('translator')->trans('Please Login.'));
            return $this->redirect($this->generateUrl("_homepage"));
        }
        $checkw = $em->getRepository('SocialManagerBundle:Users')->findOneBy(array("email" => $username, "password" => $password, "supper" => 1));
        if (!$checkw) {
            $session->clear();
            $session->set('notice', $this->get('translator')->trans('Please Login.'));
            return $this->redirect($this->generateUrl("_homepage"));
        }

        if (MiniLib::$demoMode) {
            $session->set('notice', $this->get('translator')->trans('Only View on Demo Mode.'));
            return $this->redirect($this->generateUrl("_user"));
        }

        $viewT = $em->getRepository('SocialManagerBundle:Users')->findOneBy(array("id" => $id));
        if ($viewT) {
            $query = "DELETE FROM Feeds WHERE u_id = :u_id";
            $connection = $em->getConnection();
            $statement = $connection->prepare($query);
            $statement->bindValue('u_id', $viewT->getId());
            $statement->execute();

            $query1 = "DELETE FROM Tokens WHERE u_id = :u_id";
            $connection1 = $em->getConnection();
            $statement1 = $connection1->prepare($query1);
            $statement1->bindValue('u_id', $viewT->getId());
            $statement1->execute();

            $em->remove($viewT);
            $em->flush();
        }

        return $this->redirect($this->generateUrl("_admin_user"));
    }

    public function editUserAction(Request $request, $id = 0) {
        $session = $request->getSession();
        $userMenu = $session->set('userMenu', "_admin_user");
        $error = 0;

        $notice = $session->get('notice', "");
        $session->set('notice', "");

        $check = $this->em->getRepository('SocialManagerBundle:Users')->findOneBy(array("email" => $this->username, "password" => $this->password, "supper" => 1));
        if (!$check) {
            $session->clear();
            return $this->redirect($this->generateUrl("_homepage"));
        }

        $checkEdit = $this->em->getRepository('SocialManagerBundle:Users')->findOneBy(array("id" => $id));
        if (!$checkEdit) {
            return $this->redirect($this->generateUrl("_user"));
        }

        if ($request->getMethod() == 'POST') {

            if (MiniLib::$demoMode) {
                $session->set('notice', $this->get('translator')->trans('Only View on Demo Mode.'));
                return $this->redirect($this->generateUrl("_user"));
            }

            $newpass = $request->request->get("newpass", "");
            $renewpass = $request->request->get("renewpass", "");
            $name = $request->request->get("name", "");
            $isAdmin = $request->request->get("isAdmin", 0);
            if (!empty($newpass) && $newpass == $renewpass) {
                $error = 1;
                $checkEdit->setPassword(md5(sha1($newpass)));
                $checkEdit->setSupper($isAdmin);
                $checkEdit->setName($name);
                $this->em->persist($checkEdit);
                $this->em->flush();
            } else {
                $error = 2;
            }
        }

        return $this->render('SocialManagerBundle:Admin:password.html.php', array('error' => $error, 'userMenu' => $userMenu, 'info' => $checkEdit, 'notice' => $notice, "fb" => $this->fbRegister));
    }

}
