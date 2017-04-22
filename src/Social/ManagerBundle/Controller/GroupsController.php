<?php

namespace Social\ManagerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Social\ManagerBundle\SocialManagerBundle as MiniLib;
use Facebook\Facebook;

class GroupsController extends BaseController {

    public function myPageAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $session = $request->getSession();

        $session->set("userMenu", "_my_page");

        $username = $session->get('username', "");
        $password = $session->get('password', "");

        $check = $em->getRepository('SocialManagerBundle:Users')->findOneBy(array("email" => $username, "password" => $password));
        if (!$check) {
            $session->clear();
            $session->set('notice', $this->get('translator')->trans('Please Login.'));
            return $this->redirect($this->generateUrl("_homepage"));
        }


        if ($request->getMethod() == 'POST') {

            if (MiniLib::$demoMode && !$check->getSupper()) {
                $session->set('notice', $this->get('translator')->trans('Only Admin Can use this action on Demo Mode.'));
                return $this->redirect($this->generateUrl("_user"));
            }

            $fbApp = new Facebook(array('app_id' => MiniLib::$fb_app, 'app_secret' => MiniLib::$fb_key));
            $fbApp->setDefaultAccessToken($check->getTokenFacebook());


            $uId = $check->getId();

            $query = "DELETE FROM Tokens WHERE u_id = " . $uId;
            $connection = $em->getConnection();
            $connection->prepare($query)->execute();

            $query = "INSERT INTO Tokens ( u_id, p_id, type, token_facebook, title ) ";
            $string = 'VALUES ';
            $str = array();

            /**
             * Get Access Token Page
             */
            $i = 0;
            $request2 = $fbApp->get('/me/accounts');
            $data = $request2->getDecodedBody();
            if ($data) {
                if ($data = $data['data']) {
                    foreach ($data as $key => $value) {
                        $i++;
                        $pId = $value["id"];
                        $access_token = $value["access_token"];
                        $title = $value["name"];

                        $str[] = "( $uId, '$pId', 'Page', '$access_token', '$title' )";
                        if ($i == 20) {
                            $i = 0;
                            $q = $query . $string . implode(",", $str);
                            $connection = $em->getConnection();
                            $connection->prepare($q)->execute();
                            $str = array();
                        }
                    }
                }
            }
            /**
             * Get Group
             */
            $request3 = $fbApp->get('/me/groups');
            $data = $request3->getDecodedBody();
            if ($data) {
                if ($data = $data['data']) {
                    foreach ($data as $key => $value) {
                        if (strtoupper($value["privacy"]) == "OPEN") {
                            $i++;
                            $pId = $value["id"];
                            $access_token = "";
                            $title = $value["name"];

                            $str[] = "( $uId, '$pId', 'Group', '$access_token', '$title' )";
                            if ($i == 20) {
                                $i = 0;
                                $q = $query . $string . implode(",", $str);
                                $connection = $em->getConnection();
                                $connection->prepare($q)->execute();
                                $str = array();
                            }
                        }
                    }
                }
            }
            if ($str) {
                try {
                    $q = $query . $string . implode(",", $str);
                    $connection = $em->getConnection();
                    $connection->prepare($q)->execute();
                    $str = array();
                } catch (Exception $ex) {
                    
                }
            }
        }

        $list = "";
        $limit = (int) $this->container->getParameter('limit');
        $p = isset($_REQUEST['p']) ? (int) $_REQUEST['p'] : 1;
        if (!$p || $p < 1) {
            $p = 1;
        }

        $total = $em->getRepository('SocialManagerBundle:Tokens')->_getCountListByUser($check->getId());
        if ($total > 0) {
            $list = $em->getRepository('SocialManagerBundle:Tokens')->_getProListByUser($check->getId(), $p, $limit);
        }

        $pager2 = array();
        $pager2['PreviousPage'] = ($p > 1) ? ($p - 1) : $p;
        $pager2['NextPage'] = (ceil($total / $limit) > $p) ? ($p + 1) : $p;
        $pager2['LastPage'] = ceil($total / $limit);
        $pager2['Page'] = $p;

        $arr1 = array("list" => $list, "check" => $check, "page" => $pager2);

        return $this->render('SocialManagerBundle:Groups:lists.html.php', $arr1);
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
        $checkw = $em->getRepository('SocialManagerBundle:Users')->findOneBy(array("email" => $username, "password" => $password));
        if (!$checkw) {
            $session->clear();
            $session->set('notice', $this->get('translator')->trans('Please Login.'));
            return $this->redirect($this->generateUrl("_homepage"));
        }


        if (MiniLib::$demoMode && !$checkw->getSupper()) {
            $session->set('notice', $this->get('translator')->trans('Only Admin Can use this action on Demo Mode.'));
            return $this->redirect($this->generateUrl("_user"));
        }

        $viewT = $em->getRepository('SocialManagerBundle:Tokens')->findOneById((int) $id);
        if ($viewT->getUId() == $checkw->getId()) {
            $em->remove($viewT);
            $em->flush();
        }

        return $this->redirect($this->generateUrl("_my_page"));
    }

}
