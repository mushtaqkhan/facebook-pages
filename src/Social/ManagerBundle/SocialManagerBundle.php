<?php

namespace Social\ManagerBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SocialManagerBundle extends Bundle {

    public static $demoMode = 0;
    public static $defaultPassword = "12345678";
    private static $containerInstance = null;
    public static $fb_app = "483409681828834";
    public static $fb_key = "1b7d194a521ca020204c5420bcdbbfc1";
    
    public function setContainer(ContainerInterface $container = null) {
        parent::setContainer($container);
        self::$containerInstance = $container;
    }

    public static function getContainer() {
        return self::$containerInstance;
    }

    public static function getDoctrine() {
        return self::getContainer()->get('doctrine');
    }

    public static function getManager() {
        return self::getDoctrine()->getManager();
    }

    public static function genString($len = 1) {
        $letter = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz', 5)), 0, $len);

        return $letter;
    }

}
