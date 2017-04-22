<?php

namespace Social\ManagerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Social\ManagerBundle\Entity\Users;
use Facebook\Facebook;
use Social\ManagerBundle\SocialManagerBundle as MiniLib;
use Symfony\Component\HttpFoundation\Session\Session;

class UsersController extends BaseController {

    public function __construct() {
        parent::__construct();

        if (!$this->fbRegister) {
            $session = new Session();

            $fb = new Facebook(array('app_id' => MiniLib::$fb_app, 'app_secret' => MiniLib::$fb_key));

            $helper = $fb->getRedirectLoginHelper();

            $url = MiniLib::getContainer()->get('router')->generate('register', array("fb" => "facebook"), true);

            $permissions = array('email', 'publish_actions', 'publish_pages', 'manage_pages', 'user_managed_groups');

            $fbRegister = $helper->getLoginUrl($url, $permissions);

            $session->set("fbRegister", $fbRegister);

            $this->fbRegister = $fbRegister;
        }
    }

    public function registerAction(Request $request, $fb = 0) {
        $em = $this->em;

        $session = $request->getSession();
        $username = $session->get('username', "");
        $password = $session->get('password', "");
        $checkw = $em->getRepository('SocialManagerBundle:Users')->findOneBy(array("email" => $username, "password" => $password));
        if ($fb == 0) {
            if ($checkw) {
                return $this->redirect($this->generateUrl("_user"));
            }
        }

        $check = '';

        $email = "";
        $name = "";
        $token = "";
        $fbid = "";

        if ($request->getMethod() == 'POST' || $fb) {
            if ($fb) {
                $userNode = '';
                $longLivedAccessToken = '';
                $fbApp = new Facebook(array('app_id' => MiniLib::$fb_app, 'app_secret' => MiniLib::$fb_key));
                $helper = $fbApp->getRedirectLoginHelper();
                try {
                    $accessToken = $helper->getAccessToken();

                    if (!$accessToken) {
                        $session->set('notice', $this->get('translator')->trans('Connect to Facebook Account not Success.'));
                        return $this->redirect($this->generateUrl("_homepage"));
                    }
                    // OAuth 2.0 client handler
                    $oAuth2Client = $fbApp->getOAuth2Client();
                    // Exchanges a short-lived access token for a long-lived one
                    $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
                } catch (\Facebook\Exceptions\FacebookResponseException $e) {
                    $session->set('notice', $this->get('translator')->trans('Connect to Facebook Account not Success.'));
                    return $this->redirect($this->generateUrl("_homepage"));
                } catch (\Facebook\Exceptions\FacebookSDKException $e) {
                    $session->set('notice', $this->get('translator')->trans('Connect to Facebook Account not Success.'));
                    return $this->redirect($this->generateUrl("_homepage"));
                }
                if ($longLivedAccessToken) {
                    $fbApp->setDefaultAccessToken((string) $longLivedAccessToken);
                    try {
                        $response = $fbApp->get('/me?fields=id,name,email');
                        $userNode = $response->getGraphUser()->asJson();
                    } catch (\Facebook\Exceptions\FacebookResponseException $e) {
                        $session->set('notice', $this->get('translator')->trans('Connect to Facebook Account not Success.'));
                        return $this->redirect($this->generateUrl("_homepage"));
                    } catch (\Facebook\Exceptions\FacebookSDKException $e) {
                        $session->set('notice', $this->get('translator')->trans('Connect to Facebook Account not Success.'));
                        return $this->redirect($this->generateUrl("_homepage"));
                    }
                    if ($userNode) {
                        $userNode = json_decode($userNode, true);

                        $password = MiniLib::$defaultPassword;
                        $email = $userNode["email"];
                        $name = $userNode["name"];
                        $fbid = $userNode["id"];
                        $token = (string) $longLivedAccessToken;
                    }
                }
            } else {
                $password = $request->request->get("password", "");
                $email = $request->request->get("email", "");
            }

            if (!empty($password) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $check = $em->getRepository('SocialManagerBundle:Users')->findOneByEmail($email);
                if (!$check) {
                    $a = new \Datetime();
                    $new_user = new Users();
                    $new_user->setName($name)
                            ->setTokenFacebook($token)
                            ->setSupper(0)
                            ->setFacebookId($fbid)
                            ->setEmail($email)
                            ->setPassword(md5(sha1($password)));
                    $new_user->setCreatedAt($a);
                    $new_user->setUpdatedAt($a);

                    $this->em->persist($new_user);
                    $this->em->flush();

                    $uId = $new_user->getId();

                    $session->set('username', $email);
                    $session->set('password', md5(sha1($password)));

                    if ($userNode) {

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
                } elseif ($check->getTokenFacebook() == "" && $token) {
                    $check->setTokenFacebook($token);
                    $this->em->persist($check);
                    $this->em->flush();

                    $uId = $check->getId();

                    if ($userNode) {

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
                            $q = $query . $string . implode(",", $str);
                            $connection = $em->getConnection();
                            $connection->prepare($q)->execute();
                            $str = array();
                        }
                    }

                    $session->set('username', $check->getEmail());
                    $session->set('password', $check->getPassword());
                } else {
                    $session->set('username', $check->getEmail());
                    $session->set('password', $check->getPassword());
                }

                return $this->redirect($this->generateUrl("_user"));
            } else {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $session->set('notice', $this->get('translator')->trans('You enter invalid Email.'));
                }
            }
        }
        return $this->redirect($this->generateUrl("_homepage"));
    }

    public function loginAction(Request $request) {
        $em = $this->em;
        $session = $request->getSession();
        $username = $session->get('username', "");
        $password = $session->get('password', "");
        $checkw = $em->getRepository('SocialManagerBundle:Users')->findOneBy(array("email" => $username, "password" => $password));
        if ($checkw) {
            return $this->redirect($this->generateUrl("_user"));
        }

        if ($request->getMethod() == 'POST') {
            $password = $request->request->get("password", "");
            $user_name = $request->request->get("username", "");
            if (!empty($user_name) && !empty($password)) {
                $check = $em->getRepository('SocialManagerBundle:Users')->findOneBy(array("email" => $user_name, "password" => md5(sha1($password))));
                if ($check) {
                    $session->set('username', $check->getEmail());
                    $session->set('password', md5(sha1($password)));
                    return $this->redirect($this->generateUrl("_user"));
                }
            }
        }
        return $this->redirect($this->generateUrl("_homepage"));
    }

    public function logoutAction(Request $request) {
        $session = $request->getSession();
        $session->clear();
        return $this->redirect($this->generateUrl("_homepage"));
    }

    public function menuUserAction(Request $request) {
        $session = $request->getSession();
        $userMenu = $session->get('userMenu', "");

        $check = $this->em->getRepository('SocialManagerBundle:Users')->findOneBy(array("email" => $this->username, "password" => $this->password));

        return $this->render('SocialManagerBundle:Users:menu.html.php', array('userMenu' => $userMenu, 'info' => $check));
    }

    public function profileAction(Request $request) {
        $session = $request->getSession();
        $userMenu = $session->set('userMenu', "profile");
        $error = 0;

        $notice = $session->get('notice', "");
        $session->set('notice', "");

        $check = $this->em->getRepository('SocialManagerBundle:Users')->findOneBy(array("email" => $this->username, "password" => $this->password));
        if (!$check) {
            $session = $request->getSession();
            $session->clear();
            return $this->redirect($this->generateUrl("_homepage"));
        }

        if ($request->getMethod() == 'POST') {

            if (MiniLib::$demoMode) {
                $session->set('notice', $this->get('translator')->trans('Only View on Demo Mode.'));
                return $this->redirect($this->generateUrl("_user"));
            }
            
            $oldpass = $request->request->get("oldpass", "");
            $newpass = $request->request->get("newpass", "");
            $renewpass = $request->request->get("renewpass", "");
            $isAdmin = $request->request->get("isAdmin", 0);
            if (!empty($newpass) && $newpass == $renewpass && md5(sha1($oldpass)) == $check->getPassword()) {
                $error = 1;
                $check->setPassword(md5(sha1($newpass)));

//                $check->setSupper($isAdmin);

                $this->em->persist($check);
                $this->em->flush();
            } else {
                $error = 2;
            }
        }

        return $this->render('SocialManagerBundle:Users:password.html.php', array('error' => $error, 'userMenu' => $userMenu, 'info' => $check, 'notice' => $notice, "fb" => $this->fbRegister));
    }

}
