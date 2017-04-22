<?php

namespace Social\ManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Social\ManagerBundle\SocialManagerBundle as MiniLib;

class BaseController extends Controller {

    protected $em;
    protected $username;
    protected $password;
    protected $fbRegister;

    public function __construct() {
        
        $this->em = MiniLib::getManager();

        $request = MiniLib::getContainer()->get('request');
        $session = $request->getSession();

        $this->fbRegister = $session->get("fbRegister", "");

        $locale = isset($_REQUEST['lang']) ? $_REQUEST['lang'] : "";
        if (!$locale) {
            $locale = $session->get("_locale", "en");
        }
        $session->set("_locale", $locale);
        $request->setLocale($locale);

        $this->username = $session->get('username', "");
        $this->password = $session->get('password', "");

    }

}
