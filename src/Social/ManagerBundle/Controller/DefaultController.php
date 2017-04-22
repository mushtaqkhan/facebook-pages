<?php

namespace Social\ManagerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Social\ManagerBundle\SocialManagerBundle as MiniLib;
use Facebook\Facebook;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController extends BaseController {

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

    public function indexAction(Request $request) {

        $check = $this->em->getRepository('SocialManagerBundle:Users')->findOneBy(array("email" => $this->username, "password" => $this->password));
        if ($check) {
            return $this->redirect($this->generateUrl("_user"));
        }

        return $this->render('SocialManagerBundle:Default:index.html.php', array());
    }

    public function indexFixedAction(Request $request) {

        $session = $request->getSession();

        $notice = $session->get('notice', "");
        $session->set('notice', "");

        $check = $this->em->getRepository('SocialManagerBundle:Users')->findOneBy(array("email" => $this->username, "password" => $this->password));

        $arr1 = array('fbRegister' => $this->fbRegister, 'notice' => $notice, 'check' => $check);

        return $this->render('SocialManagerBundle:Default:indexFixed.html.php', $arr1);
    }

    public function menuAction(Request $request) {

        $check = $this->em->getRepository('SocialManagerBundle:Users')->findOneBy(array("email" => $this->username, "password" => $this->password));

        return $this->render('SocialManagerBundle:Default:menu.html.php', array('fbRegister' => $this->fbRegister, "check" => $check));
    }

    public function setLangAction(Request $request) {
        $dir = dirname(dirname(__FILE__)) . "/Resources/translations/";

        $a = glob($dir . "*.xlf");
        $arrLan = array();

        if ($a) {
            foreach ($a as $key => $value) {
                $tmp = explode("messages.", $value);
                if (isset($tmp[1])) {
                    $tmp1 = explode(".xlf", $tmp[1]);
                    if (isset($tmp1[0])) {
                        $arrLan[$tmp1[0]]["text"] = strtoupper($tmp1[0]);
                        $arrLan[$tmp1[0]]["code"] = $tmp1[0];
                    }
                }
            }
        }

        $arr1 = array("list" => $arrLan);
        return $this->render('SocialManagerBundle:Default:setLang.html.php', $arr1);
    }
}
