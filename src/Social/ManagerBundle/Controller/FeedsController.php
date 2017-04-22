<?php

namespace Social\ManagerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Social\ManagerBundle\SocialManagerBundle as MiniLib;
use Facebook\Facebook;

class FeedsController extends BaseController {

    public function myFeedAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $session = $request->getSession();

        $session->set("userMenu", "_my_feed");

        $username = $session->get('username', "");
        $password = $session->get('password', "");

        $check = $em->getRepository('SocialManagerBundle:Users')->findOneBy(array("email" => $username, "password" => $password));
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

        $total = $em->getRepository('SocialManagerBundle:Feeds')->_getCountListByUser($check->getId());
        if ($total > 0) {
            $list = $em->getRepository('SocialManagerBundle:Feeds')->_getProListByUser($check->getId(), $p, $limit);
        }

        $pager2 = array();
        $pager2['PreviousPage'] = ($p > 1) ? ($p - 1) : $p;
        $pager2['NextPage'] = (ceil($total / $limit) > $p) ? ($p + 1) : $p;
        $pager2['LastPage'] = ceil($total / $limit);
        $pager2['Page'] = $p;

        $arr1 = array("list" => $list, "check" => $check, "page" => $pager2);

        return $this->render('SocialManagerBundle:Feeds:lists.html.php', $arr1);
    }

    public function deleteAction(Request $request, $u_id) {
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

        $viewT = $em->getRepository('SocialManagerBundle:Feeds')->findOneBy(array("id" => $u_id));
        if ($viewT && $checkw->getId() == $viewT->getUId()) {
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
//                        $r = $r->getDecodedBody();
//                        if ($r["success"]) {
//                            $em->remove($viewT);
//                            $em->flush();
//                        }
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

        return $this->redirect($this->generateUrl("_my_feed"));
    }

    public function newFeedAction(Request $request, $title = "text") {

        $em = $this->getDoctrine()->getManager();

        $session = $request->getSession();

        $f = "_new_feed_" . $title;
        $session->set("userMenu", $f);

        $error = 0;

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
            
            $link_url = $request->request->get("link_url", "");
            $message = $request->request->get("message", "");
            $link_title = $request->request->get("link_title", "");
            $link_description = $request->request->get("link_description", "");
            $link_caption = $request->request->get("link_caption", "");
            $image = $request->request->get("image", "");
            $pages = $request->request->get("pages", array());
            $time_post = strtotime($request->request->get("time_post", date("d-m-Y H:i:s")));

            $a = date("Y-m-d H:i:s");

            if ($pages) {
                $query = "INSERT INTO Feeds (u_id, p_id, name, feed_update_count, type_feed, type_page, message, description, caption, link_url, "
                        . "image_url, link_title, time_post, status, feed_id, created_at, updated_at) "
                        . "SELECT :u_id, p_id, title, :feed_update_count, :type_feed, type, :message, :description, :caption, :link_url, "
                        . ":image_url, :link_title, :time_post, :status, :feed_id, :created_at, :updated_at "
                        . "FROM `Tokens` WHERE u_id = :uId AND p_id IN (" . implode(",", $pages) . ")";

                $connection = $em->getConnection();
                $statement = $connection->prepare($query);
                $statement->bindValue('u_id', $check->getId());
                $statement->bindValue('uId', $check->getId());
                $statement->bindValue('feed_update_count', 0);
                $statement->bindValue('type_feed', $title);
                $statement->bindValue('message', $message);
                $statement->bindValue('description', $link_description);
                $statement->bindValue('caption', $link_caption);
                $statement->bindValue('link_url', $link_url);
                $statement->bindValue('image_url', $image);
                $statement->bindValue('link_title', $link_title);
                $statement->bindValue('time_post', $time_post);
                $statement->bindValue('status', 0);
                $statement->bindValue('feed_id', 0);
                $statement->bindValue('created_at', $a);
                $statement->bindValue('updated_at', $a);
                $statement->execute();

                return $this->redirect($this->generateUrl("_my_feed"));
            }
        }


        $list = $em->getRepository('SocialManagerBundle:Tokens')->findBy(array('u_id' => $check->getId()));

        $arr1 = array("list" => $list, "check" => $check, "product" => "", "error" => $error, "title" => $title);

        return $this->render('SocialManagerBundle:Feeds:new.html.php', $arr1);
    }

    public function editAction(Request $request, $title = "text", $u_id = 0) {

        $em = $this->getDoctrine()->getManager();

        $session = $request->getSession();

        $f = "_new_feed_" . $title;
        $session->set("userMenu", $f);

        $error = 0;

        $username = $session->get('username', "");
        $password = $session->get('password', "");

        $check = $em->getRepository('SocialManagerBundle:Users')->findOneBy(array("email" => $username, "password" => $password));
        if (!$check) {
            $session->clear();
            $session->set('notice', $this->get('translator')->trans('Please Login.'));
            return $this->redirect($this->generateUrl("_homepage"));
        }

        $checkFeed = $em->getRepository('SocialManagerBundle:Feeds')->findOneBy(array("id" => $u_id));
        if (!$checkFeed) {
            $session->clear();
            $session->set('notice', $this->get('translator')->trans('Feed Not Found.'));
            return $this->redirect($this->generateUrl("_my_feed"));
        }

        if ($request->getMethod() == 'POST') {

            if (MiniLib::$demoMode && !$check->getSupper()) {
                $session->set('notice', $this->get('translator')->trans('Only Admin Can use this action on Demo Mode.'));
                return $this->redirect($this->generateUrl("_user"));
            }

            $link_url = $request->request->get("link_url", "");
            $message = $request->request->get("message", "");
            $link_title = $request->request->get("link_title", "");
            $link_description = $request->request->get("link_description", "");
            $link_caption = $request->request->get("link_caption", "");
            $image = $request->request->get("image", "");
            $time_post = strtotime($request->request->get("time_post", date("d-m-Y H:i:s")));

            $checkFeed->setFeedUpdateCount($checkFeed->getFeedUpdateCount() + 1);
            $checkFeed->setMessage($message);
            $checkFeed->setDescription($link_description);
            $checkFeed->setCaption($link_caption);
            $checkFeed->setLinkUrl($link_url);
            $checkFeed->setImageUrl($image);
            $checkFeed->setLinkTitle($link_title);
            $checkFeed->setTimePost($time_post);
            $checkFeed->setStatus(0);

            $this->em->persist($checkFeed);
            $this->em->flush();

            return $this->redirect($this->generateUrl("_my_feed"));
        }


        $list = $em->getRepository('SocialManagerBundle:Tokens')->findBy(array('u_id' => $check->getId()));

        $arr1 = array("list" => $list, "check" => $check, "product" => $checkFeed, "error" => $error, "title" => $title);

        return $this->render('SocialManagerBundle:Feeds:new.html.php', $arr1);
    }

}
